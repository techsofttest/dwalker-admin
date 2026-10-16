<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Windcave Helper Functions
 * Handles session querying and idempotent order finalization for FRPN & return redirects.
 */

if (!function_exists('get_windcave_config')) {
    function get_windcave_config() {
        // Mode toggle: Set to 'test' for UAT/Sandbox testing, or 'live' for production
        $mode = 'test';

        $configs = array(
            'test' => array(
                'mode'        => 'test',
                'api_url'     => 'https://uat.windcave.com/api/v1',
                'username'    => 'dwalkerjewelsREST_dev',
                'api_key'     => 'cdda9942dbe18bf9ba25e7da8a3da0c963e8f14199f94eff65e18bb4fcd04bcf',
                'auth_header' => 'Basic ' . base64_encode('dwalkerjewelsREST_dev:cdda9942dbe18bf9ba25e7da8a3da0c963e8f14199f94eff65e18bb4fcd04bcf')
            ),
            'live' => array(
                'mode'        => 'live',
                'api_url'     => 'https://sec.windcave.com/api/v1',
                'username'    => 'KRVLimited_Rest',
                'api_key'     => '2e6e9a7d78baf3a1d8293614e83151fa2917ae5b1ffbbb05c0ad4ae38e395fdb',
                'auth_header' => 'Basic ' . base64_encode('KRVLimited_Rest:2e6e9a7d78baf3a1d8293614e83151fa2917ae5b1ffbbb05c0ad4ae38e395fdb')
            )
        );

        return isset($configs[$mode]) ? $configs[$mode] : $configs['live'];
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

            // Send confirmation email if not already sent
            if ((int)$existing['payEmailSent'] === 0) {
                windcave_send_confirmation_email($session_id);
                $ci->db->where('paySessionId', $session_id);
                $ci->db->update('dwalker_payments', array('payEmailSent' => 1));
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
                            <tr><th>Name</th><td>' . htmlspecialchars($order_det['payName']) . '</td></tr>
                            <tr><th>Email</th><td>' . htmlspecialchars($order_det['payEmail']) . '</td></tr>
                            <tr><th>Phone</th><td>' . htmlspecialchars($order_det['payPhone']) . '</td></tr>
                            <tr><th>Product</th><td>' . htmlspecialchars($order_det['payProduct']) . '</td></tr>
                            <tr><th>Amount</th><td>$' . htmlspecialchars($order_det['payTotal']) . ' NZD</td></tr>
                            <thead style="background-color:#5aa0dc;color:white">
                              <tr><th colspan="2"><h3>Complimentary Details</h3></th></tr>
                            </thead>  
                            <tr><th>Model</th><td>' . htmlspecialchars($order_det['code']) . '</td></tr>             
                            <tr><th>Type</th><td>' . htmlspecialchars($order_det['Mugtype']) . '</td></tr>
                            <tr><th>Size</th><td>' . htmlspecialchars($order_det['Mugsize']) . '</td></tr>
                            <tr><th>Photo Area</th><td>' . htmlspecialchars($order_det['Photoarea']) . '</td></tr>
                            <tr><th>Color</th><td>' . htmlspecialchars($order_det['Colors']) . '</td></tr>   
                            <tr><th></th><td><img src="cid:' . $imageShow . '" border="0"></td></tr>
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

        $ci->load->config('email', TRUE);
        $from_email   = $ci->config->item('from_email') ?: 'techsofttest123@gmail.com';
        $from_name    = $ci->config->item('from_name') ?: 'D. Walker Jewellers';
        $admin_emails = $ci->config->item('admin_emails') ?: 'dwalkerjewels@gmail.com, nair182002@gmail.com, techsofttest@gmail.com';

        $ci->email->clear(TRUE);
        $ci->email->from($from_email, $from_name);
        if (!empty($order_det['photo']) && file_exists(FCPATH . 'uploads/Gift/' . $order_det['photo'])) {
            $ci->email->attach(FCPATH . 'uploads/Gift/' . $order_det['photo'], 'inline');
        }

        $subject = ($order_det['payOrderID'] ? $order_det['payOrderID'] : 'Order Confirmation') . ' :: ' . $from_name;
        $ci->email->to($admin_emails);
        if (!empty($order_det['payEmail'])) {
            $ci->email->bcc($order_det['payEmail']);
        }
        $ci->email->subject($subject);
        $ci->email->message($body);

        return @$ci->email->send();
    }
}
