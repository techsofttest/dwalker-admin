<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class NZPost extends CI_Controller {


  public function __construct()

		{
			parent::__construct(); 

			$this->load->library('form_validation');

			$this->load->helper(array('form', 'url', 'text'));

		    $this->load->model("Admin_model");

            $this->load->library('session');	

			$this->load->library('cart');

			$this->load->config('nzpost_config');

			$this->client_id = $this->config->item('client_id');

			$this->client_secret = $this->config->item('client_secret');
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

		$this->session->set_userdata('access_token', $response_data['access_token']);

		return $response_data['access_token'];

		}







		public function searchAddress()
		{


			if($this->input->post('term'))
			{

			if(!empty($this->session->userdata('access_token')))
			{
				$auth_token = $this->session->userdata('access_token');
			}
			else
			{
				$auth_token = $this->authenticate();
			}	

			

			$q = urlencode(strtolower($this->input->post('term')));

			$country_code = $this->input->post('country_code');

			$url = $this->config->item('nz_search_address_url') . "?count=10&q={$q}&country_code={$country_code}";

			//echo $url; 
			
			// Prepare new cURL resource
			$ch = curl_init("{$url}");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLINFO_HEADER_OUT, true);
			curl_setopt($ch, CURLOPT_HTTPGET, true); // Use GET instead of POST
			curl_setopt($ch, CURLOPT_POST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			
			// Set HTTP Header for POST request 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'client_id:'.$this->client_id.'',
				'Authorization: Bearer '.$auth_token.'')
			);
			
			// Submit the POST request
			$result = curl_exec($ch);


			//exit;
			
			
			// Close cURL session handle


			$result_data = json_decode($result,true);


			if (curl_errno($ch)) {

			echo 'Error:' . curl_error($ch);
				
			} 
			

			curl_close($ch);

			echo json_encode($result_data);
				
			}

		}




		public function getAddressDetails()
		{

			if($this->input->post('address_id'))
			{

			if(!empty($this->session->userdata('access_token')))
			{
				$auth_token = $this->session->userdata('access_token');
			}
			else
			{
				$auth_token = $this->authenticate();
			}	

			$address_id = $this->input->post('address_id');


			$url = $this->config->item('nz_address_detail_url')."{$address_id}";


			// Prepare new cURL resource
			$ch = curl_init("{$url}");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLINFO_HEADER_OUT, true);
			curl_setopt($ch, CURLOPT_HTTPGET, true); // Use GET instead of POST
			curl_setopt($ch, CURLOPT_POST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			
			// Set HTTP Header for POST request 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'client_id:'.$this->client_id.'',
				'Authorization: Bearer '.$auth_token.'')
			);
			
			// Submit the POST request
			$result = curl_exec($ch);


			$result_data = json_decode($result,true);

			curl_close($ch);

			echo json_encode($result_data);

			}

		}













	


	
	
}