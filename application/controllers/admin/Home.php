<?php
class Home extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		//$this->pr_details=get_profile_details();
		if(!$this->session->userdata('adminId'))
		{
			redirect(base_url().'admin/login');	
		}
	}
	
	//index	   
	function index()
	{   
		$this->load->view('admin/home');
		
	}
	
	// change profile
	
		
}
