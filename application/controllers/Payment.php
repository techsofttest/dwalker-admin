<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->library('paypal_lib');
        $this->load->model('Admin_model');
        $this->load->library('cart');
        $this->load->helper(array('url', 'windcave'));
        $this->load->database();
    }

    /**
     * Initiate payment session with Windcave Hosted Payments (HPP)
     */
    function index()
    {
        if (empty($this->session->userdata('order_id_pay'))) {
            $this->session->set_flashdata('error', 'Session Expired');
            redirect(base_url());
        }

        $order_id = $this->session->userdata('order_id_pay');
        $order_cond = array('payId' => $order_id);
        $order_details = $this->Admin_model->fetch_one_row('dwalker_payments', $order_cond);

        $pay_amount = floatval($order_details['payTotal']);
        $pay_amount = number_format($pay_amount, 2, '.', '');

        $config = get_windcave_config();
        $url = rtrim($config['api_url'], '/') . '/sessions';

        $callback_return = base_url() . 'Payment/Confirming';
        $notification_url = base_url() . 'Payment/Notification';

        $payload = array(
            'type'              => 'purchase',
            'amount'            => $pay_amount,
            'currency'          => 'NZD',
            'merchantReference' => (string)$order_id,
            'callbackUrls'      => array(
                'approved'  => $callback_return,
                'declined'  => $callback_return,
                'cancelled' => $callback_return
            ),
            'notificationUrl'   => $notification_url
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: ' . $config['auth_header']
        ));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $json_response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($json_response, true);
        $pg_url = "";

        if (!empty($response['id'])) {
            $sess_id = $response['id'];

            $length_code = 6;
            $trans_id = $this->session->userdata('TransId') ? $this->session->userdata('TransId') : $order_id;
            $string_code = substr(str_repeat('0', $length_code) . $trans_id, - $length_code);
            $orderID_FINAL = "DWJ-ORDER#" . $string_code;

            $update_order_cond = array('payId' => $order_id);
            $update_order_data = array('paySessionId' => $sess_id, 'payOrderid' => $orderID_FINAL);
            $this->Admin_model->update_all($update_order_data, $update_order_cond, 'dwalker_payments');

            if (!empty($response['links'])) {
                foreach ($response['links'] as $link) {
                    if (isset($link['rel']) && $link['rel'] == "hpp") {
                        $pg_url = $link['href'];
                    }
                }
            }

            if (!empty($pg_url)) {
                redirect($pg_url);
            } else {
                $this->session->set_flashdata('success', "Sorry! Your transaction initiation failed.");
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('success', "Sorry! Your transaction initiation failed.");
            redirect(base_url());
        }
    }

    /**
     * User Return Page after Windcave Hosted Payment Page
     * Displays confirming payment status until updated by FRPN / status check
     */
    function Confirming()
    {
        $session_id = $this->input->get('sessionId');
        if (empty($session_id)) {
            $session_id = $this->input->get('id');
        }

        $order = null;
        if (!empty($session_id)) {
            $order = $this->db->get_where('dwalker_payments', array('paySessionId' => $session_id))->row_array();
        }

        $data = array(
            'session_id' => $session_id,
            'order'      => $order
        );

        $this->load->view('user/confirming_payment', $data);
    }

    /**
     * Windcave Fail-Proof Result Notification (FPRN) Server-to-Server Endpoint
     */
    function Notification()
    {
        $raw_input = file_get_contents('php://input');
        $session_id = $this->input->get('sessionId');
        if (empty($session_id)) {
            $session_id = $this->input->get('id');
        }

        $body_json = !empty($raw_input) ? json_decode($raw_input, true) : null;
        if (empty($session_id) && !empty($body_json)) {
            if (!empty($body_json['sessionId'])) {
                $session_id = $body_json['sessionId'];
            } elseif (!empty($body_json['id'])) {
                $session_id = $body_json['id'];
            }
        }

        if (empty($session_id)) {
            $this->output->set_status_header(400)->set_output(json_encode(array('status' => 'error', 'message' => 'Missing sessionId')));
            return;
        }

        // Query session from Windcave REST API and idempotently finalize order
        $session_data = windcave_query_session($session_id);
        $result = windcave_finalize_order($session_id, $session_data);

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'status'  => 'success',
                'message' => 'FPRN received and processed successfully',
                'result'  => $result
            )));
    }

    /**
     * Legacy redirect handler for Approved (maintained for compatibility)
     */
    function Success()
    {
        $sess_id = $this->input->get('sessionId');
        if (empty($sess_id)) {
            $sess_id = $this->input->get('id');
        }

        if (!empty($sess_id)) {
            windcave_finalize_order($sess_id);
            $this->session->unset_userdata('order_id_pay');
            $this->session->unset_userdata('TransId');
            $this->cart->destroy();
            redirect(base_url() . 'Payment/Confirming?sessionId=' . urlencode($sess_id));
        }

        redirect(base_url());
    }

    function Failed()
    {
        $sess_id = $this->input->get('sessionId');
        if (!empty($sess_id)) {
            windcave_finalize_order($sess_id);
            redirect(base_url() . 'Payment/Confirming?sessionId=' . urlencode($sess_id));
        }
        $this->session->set_flashdata('success', "Sorry! Your last transaction failed.");
        $this->session->unset_userdata('order_id_pay');
        $this->session->unset_userdata('TransId');
        redirect(base_url());
    }

    function Cancel()
    {
        $sess_id = $this->input->get('sessionId');
        if (!empty($sess_id)) {
            windcave_finalize_order($sess_id);
            redirect(base_url() . 'Payment/Confirming?sessionId=' . urlencode($sess_id));
        }
        $this->session->set_flashdata('success', "Sorry! Your last transaction was Cancelled.");
        $this->session->unset_userdata('order_id_pay');
        $this->session->unset_userdata('TransId');
        redirect(base_url());
    }
}