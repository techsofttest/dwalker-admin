<?php
class Track extends CI_Controller {
	
	function __construct()
	{
		        parent::__construct();
				$this->load->database();
                $this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text'));
                $this->load->model("Admin_model");
				$this->load->library('session');
				$this->load->library('cart');
				$this->load->config('nzpost_config');

				$this->client_id = $this->config->item('client_id');
				$this->client_secret = $this->config->item('client_secret');

			}
	
	public function index()
	{   


	$data['tracking'] = array();

	$data['order'] = array();

	if(!empty($_GET['trackid']))
	{
	
	$data['order'] = $this->Admin_model->fetch_one_row('dwalker_payments',array('OrderID' => trim($_GET['trackid'])));

	if($data['order']['orderLabelStatus']!=0)
	{
	$data['tracking'] = $this->trackParcel($data['order']['payID']);

	}
	else
	{
	$data['tracking'] = array();	
	}

	}


	$data['main_category'] 	= 	$this->Admin_model->fetch_all('dwalker_category');
	$data['categorys'] 	= 	$this->Admin_model->fetch_main_category();
	$cond_cmsfooter=array('contentId' => 5);
	$data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);

	$this->load->view('user/track',$data);
	}



	public function authenticate()
		{
		//phpinfo(); exit;

		// Define the OAuth endpoint and credentials
		$url = $this->config->item('nz_auth_url');

		$grant_type = 'client_credentials';

		// Prepare POST fields
		$post_fields = http_build_query([
			'grant_type'    => $grant_type,
			'client_id'     => $this->client_id,
			'client_secret' => $this->client_secret
		]);

		// Initialize cURL
		$ch = curl_init($url);	

		// Set cURL options
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Return the response as a string
		curl_setopt($ch, CURLOPT_POST, true);            // Use POST request
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);  // Attach POST data
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/x-www-form-urlencoded'
		]);

		// Execute cURL and get the response
		$response = curl_exec($ch);

		$response_data = json_decode($response,true);

		// Check for cURL errors
		if (curl_errno($ch)) {
			//echo 'Error:' . curl_error($ch);
			
		} else {
			//echo "Response: " . $response;
			
		}
		// Close cURL
		curl_close($ch);

		return $response_data['access_token'];

		}


		public function trackParcel($orderId)
		{

			$auth_token = $this->authenticate();

			$order_details = $this->Admin_model->fetch_one_row('dwalker_payments',array('payID'=>$orderId));

			$track_ref = $order_details['orderTrackingRef'];

			$url = 'https://api.nzpost.co.nz/parceltrack/3.0/parcels/'.$track_ref;

			$headers = [
				'client_id: '.$this->client_id,
				'Content-Type: application/json',
				'Authorization: Bearer '.$auth_token
			];


			$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPGET, true); 
				curl_setopt($ch, CURLOPT_POST, false);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				//curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
				$response = curl_exec($ch);
				$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);

				$responseData = json_decode($response, true); 

				return $responseData;

		}





}