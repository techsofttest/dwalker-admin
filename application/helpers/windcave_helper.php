<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Windcave Helper Functions
 * Handles session querying and idempotent order finalization for FRPN & return redirects.
 */

if (!function_exists('get_windcave_config')) {
    function get_windcave_config() {
        $CI =& get_instance();
        if ($CI && isset($CI->config)) {
            $CI->config->load('windcave_config', TRUE, TRUE);
            $loaded = $CI->config->item('windcave_config');
            if (!empty($loaded) && !empty($loaded['windcave_username'])) {
                $username = $loaded['windcave_username'];
                $apiKey = $loaded['windcave_api_key'];
                $authHeader = !empty($loaded['windcave_auth_header']) 
                    ? $loaded['windcave_auth_header'] 
                    : ('Basic ' . base64_encode($username . ':' . $apiKey));

                return array(
                    'mode'        => !empty($loaded['windcave_mode']) ? $loaded['windcave_mode'] : 'test',
                    'api_url'     => !empty($loaded['windcave_api_url']) ? $loaded['windcave_api_url'] : 'https://uat.windcave.com/api/v1',
                    'username'    => $username,
                    'api_key'     => $apiKey,
                    'auth_header' => $authHeader
                );
            }
        }

        // Fallback default structure
        return array(
            'mode'        => 'test',
            'api_url'     => 'https://uat.windcave.com/api/v1',
            'username'    => '',
            'api_key'     => '',
            'auth_header' => ''
        );
    }
}

if (!function_exists('windcave_query_session')) {
    /**
     * Query session from Windcave REST API
     * @param string $session_id
     * @return array|null
     */
    function windcave_query_session($session_id) {
        if (empty($session_id)) {
            return null;
        }

        $config = get_windcave_config();
        $url = rtrim($config['api_url'], '/') . '/sessions/' . trim($session_id);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: ' . $config['auth_header']
        ));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);

        $json_response = curl_exec($curl);
        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($status_code >= 200 && $status_code < 300 && !empty($json_response)) {
            return json_decode($json_response, true);
        }

        return null;
    }
}

if (!function_exists('windcave_finalize_order')) {
    /**
     * Idempotently finalizes order status in dwalker_payments and sends confirmation email.
     * Safe to call from both FRPN webhook and frontend return/check endpoints.
     *
     * @param string $session_id
     * @param array|null $session_data Windcave session query payload
     * @return array status details
     */
    function windcave_finalize_order($session_id, $session_data = null) {
        $ci =& get_instance();
        $ci->load->database();
        $ci->load->model('Admin_model');

        if (empty($session_id)) {
            return array('status' => 'error', 'message' => 'Missing session ID');
        }

        if (empty($session_data)) {
            $session_data = windcave_query_session($session_id);
        }

        if (empty($session_data)) {
            return array('status' => 'pending', 'message' => 'Session query returned empty response');
        }

        // Determine if authorized
        $is_authorised = false;
        $txn_id = '';
        $card_type = '';
        $card_last4 = '';

        if (!empty($session_data['transactions']) && is_array($session_data['transactions'])) {
            foreach ($session_data['transactions'] as $txn) {
                if (!empty($txn['authorised']) && $txn['authorised'] === true) {
                    $is_authorised = true;
                    $txn_id = isset($txn['id']) ? $txn['id'] : '';
                    if (!empty($txn['card'])) {
                        $card_type = isset($txn['card']['type']) ? $txn['card']['type'] : '';
                        $card_num = isset($txn['card']['cardNumber']) ? $txn['card']['cardNumber'] : '';
                        $card_last4 = substr($card_num, -4);
                    }
                    break;
                }
            }
        }

        // Check current record in dwalker_payments
        $existing = $ci->db->get_where('dwalker_payments', array('paySessionId' => $session_id))->row_array();
        if (!$existing) {
            return array('status' => 'not_found', 'message' => 'Order not found for session');
        }

        $order_id_ref = !empty($existing['OrderID']) ? $existing['OrderID'] : ('DW' . $existing['payID']);
        $trans_id_ref = !empty($existing['TransId']) ? $existing['TransId'] : $existing['payID'];

        if ($is_authorised) {
            // Check if already finalized and email already sent
            if ((int)$existing['payStatus'] === 1 && (int)$existing['payEmailSent'] === 1) {
                return array(
                    'status'    => 'approved',
                    'order_id'  => $order_id_ref,
                    'trans_id'  => $trans_id_ref,
                    'already_processed' => true
                );
            }

            // Update order status to approved
            $update_data = array(
                'payStatus' => 1,
                'payDate'   => date('Y-m-d')
            );
            if (!empty($txn_id)) {
                $update_data['payTxnID'] = $txn_id;
            }
            if (empty($existing['payOrderID'])) {
                $length_code = 6;
                $string_code = substr(str_repeat(0, $length_code) . $trans_id_ref, - $length_code);
                $update_data['payOrderID'] = "DWJ-ORDER#" . $string_code;
            }

            $ci->db->where('paySessionId', $session_id);
            $ci->db->update('dwalker_payments', $update_data);

            // Atomic conditional update to ensure only 1 thread sends the email
            $ci->db->query("UPDATE dwalker_payments SET payEmailSent = 1 WHERE paySessionId = ? AND (payEmailSent = 0 OR payEmailSent IS NULL)", array($session_id));
            if ($ci->db->affected_rows() > 0) {
                windcave_send_confirmation_email($session_id);
            }

            return array(
                'status'    => 'approved',
                'order_id'  => $order_id_ref,
                'trans_id'  => $trans_id_ref,
                'already_processed' => false
            );
        } else {
            // Check if session completed and declined, or still active/pending
            $session_state = isset($session_data['state']) ? strtolower($session_data['state']) : '';
            if ($session_state === 'complete' || $session_state === 'declined' || $session_state === 'failed') {
                $ci->db->where('paySessionId', $session_id);
                $ci->db->update('dwalker_payments', array('payStatus' => 2));

                return array(
                    'status'   => 'declined',
                    'order_id' => $order_id_ref,
                    'trans_id' => $trans_id_ref
                );
            }

            return array(
                'status'   => 'pending',
                'order_id' => $order_id_ref,
                'trans_id' => $trans_id_ref
            );
        }
    }
}

if (!function_exists('windcave_send_confirmation_email')) {
    /**
     * Send order confirmation email
     * @param string $session_id
     */
    function windcave_send_confirmation_email($session_id) {
        $ci =& get_instance();
        $ci->load->model('Admin_model');
        $ci->load->library('email');

        $update_order_cond = array('paySessionId' => $session_id);
        $order_det = $ci->Admin_model->fetch_gift_details($update_order_cond);
        if (!$order_det) {
            return false;
        }

        $imageShow = base_url() . "uploads/Gift/" . $order_det['photo'];

        $body = '<div style="font-family:Arial,Helvetica,sans-serif; line-height:18px;">
            <p>New Order Received <b>' . htmlspecialchars($order_det['payName']) . '</b></p>
            <table width="600" border="0" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td align="left" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #c4891f">
                  <tbody><tr>
                    <td width="100%" align="left" valign="top" colspan="2" style="text-align:center; padding: 2%; border-bottom:1px solid #c4891f;">
                      <h4 style="text-transform: uppercase;font-size: 26px;color: #58595b;font-weight: 800;">D WALKER JEWELRY</h4>
                    </td>
                  </tr>
                  <tr>
                    <td height="22" align="center" valign="top" bgcolor="#FFFFFF"><table width="92%" border="0" cellspacing="0" cellpadding="0">
                      <tbody><tr>
                        <table align="center" width="500px" cellpadding="5">
                          <thead style="background-color:#ce0707;color:white">
                            <tr><th colspan="2"><h3>New Order</h3></th></tr>
                          </thead>
                          <tbody style="background-color:#eee">
                            <tr><th>Order ID</th><td><b>' . htmlspecialchars($order_det['OrderID']) . '</b></td></tr>
                            <tr><th>Name</th><td>' . htmlspecialchars($order_det['payName']) . '</td></tr>
                            <tr><th>Email</th><td>' . htmlspecialchars($order_det['payEmail']) . '</td></tr>
                            <tr><th>Phone</th><td>' . htmlspecialchars($order_det['payPhone']) . '</td></tr>
                            <tr><th>Shipping Address</th><td>' . nl2br(htmlspecialchars($order_det['payAddress'])) . '</td></tr>
                            <tr>
                              <th colspan="2" style="background:#ddd;text-align:left;padding:8px;">Order Items:</th>
                            </tr>
                            <tr>
                              <td colspan="2" style="padding:0;">
                                <table width="100%" cellpadding="6" cellspacing="0" border="1" style="border-collapse:collapse;border-color:#ccc;font-size:12px;">
                                  <tr style="background:#f2f2f2;"><th>Product</th><th>Qty</th><th>Price</th><th>Total</th></tr>
                                  ' . (function() use ($ci, $order_det) {
                                      $order_items = $ci->db->get_where('dwalker_order_products', array('OrderID' => $order_det['payID']))->result_array();
                                      if (empty($order_items)) {
                                          return '<tr><td colspan="4">' . htmlspecialchars($order_det['payProduct']) . ' (Qty: ' . $order_det['payQuantity'] . ')</td></tr>';
                                      }
                                      $rows = '';
                                      foreach ($order_items as $it) {
                                          $item_total = (float)$it['payPrice'] * (int)$it['payQuantity'];
                                          $rows .= '<tr><td>' . htmlspecialchars($it['payProduct']) . '</td><td align="center">' . (int)$it['payQuantity'] . '</td><td align="right">$' . number_format((float)$it['payPrice'], 2) . '</td><td align="right">$' . number_format($item_total, 2) . '</td></tr>';
                                      }
                                      return $rows;
                                  })() . '
                                </table>
                              </td>
                            </tr>
                            <tr><th>Subtotal</th><td>$' . number_format((float)$order_det['payTotalbefore'], 2) . ' NZD</td></tr>
                            ' . (!empty($order_det['promo_status']) && (int)$order_det['promo_status'] === 1 ? (function() use ($order_det) {
                                $before = (float)$order_det['payTotalbefore'];
                                $shipping = (float)$order_det['payShipping'];
                                $tax = !empty($order_det['payTax']) ? (float)$order_det['payTax'] : 0;
                                $actual_total = (float)$order_det['payTotal'];
                                $computed_expected = $before + $shipping + $tax;

                                if ($actual_total > 0 && abs(($computed_expected - (float)$order_det['promo_dis']) - $actual_total) < 0.05) {
                                    $dis_amount = (float)$order_det['promo_dis'];
                                    $dis_pct = $before > 0 ? round(($dis_amount / $before) * 100, 2) : 0;
                                } else {
                                    $dis_pct = (float)$order_det['promo_dis'];
                                    $dis_amount = ($before * $dis_pct) / 100;
                                }
                                return '<tr style="color:#b91c1c;"><th>Promo Discount (' . $dis_pct . '%)</th><td>- $' . number_format($dis_amount, 2) . ' NZD</td></tr>';
                            })() : '') . '
                            ' . (!empty($order_det['payTax']) && (float)$order_det['payTax'] > 0 ? '<tr><th>GST / Tax</th><td>$' . number_format((float)$order_det['payTax'], 2) . ' NZD</td></tr>' : '') . '
                            <tr><th>Shipping</th><td>$' . number_format((float)$order_det['payShipping'], 2) . ' NZD</td></tr>
                            <tr><th><b>Grand Total</b></th><td><b>$' . number_format((float)$order_det['payTotal'], 2) . ' NZD</b></td></tr>
                          </tbody>
                        </table>
                      </tr>
                      <tr>
                        <td align="center" valign="top" style="font-family:Tahoma;font-size:12px;font-weight:normal;color:#333333;text-decoration:none;padding-top:15px;"><strong>D WALKER JEWELRY</strong></td>
                      </tr>
                    </tbody></table></td>
                  </tr>
                </tbody></table></td>
              </tr></tbody>
            </table>
        </div>';

        $ci->load->config('email');
        $from_email   = $ci->config->item('from_email');
        $from_name    = $ci->config->item('from_name') ?: 'D. Walker Jewellers';
        $admin_emails = $ci->config->item('admin_emails');

        $ci->email->clear(TRUE);
        $ci->email->from($from_email, $from_name);

        $subject = ($order_det['payOrderID'] ? $order_det['payOrderID'] : 'Order Confirmation') . ' :: ' . $from_name;
        $ci->email->to($admin_emails);
        if (!empty($order_det['payEmail'])) {
            $admin_list = array_map('trim', explode(',', strtolower((string)$admin_emails)));
            if (!in_array(strtolower(trim($order_det['payEmail'])), $admin_list, true)) {
                $ci->email->bcc($order_det['payEmail']);
            }
        }
        $ci->email->subject($subject);
        $ci->email->message($body);

        return @$ci->email->send();
    }
}
