<?php
defined('BASEPATH') or exit('No direct script access allowed');
class About_H extends CI_Controller{
	
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->library('form_validation');
			$this->load->helper(array('url','form','text'));
			$this->load->model("Admin_model");
			$this->load->library('session');
			if(!$this->session->userdata('userId')){
				
				redirect(baseurl().'admin/login');
				
				
				}
			}
			
			
			
			
		
		
	
	
	}


?>