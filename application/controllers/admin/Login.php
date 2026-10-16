<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller 
 {
 

	// construct
 	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');	
		$this->load->helper('url');	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');		
	}
	
	// index	
	public function index()
	{
		
         if($this->session->userdata('adminId'))
		{
			
			//echo 123;
			//exit;
			redirect(base_url().'admin/home');	
		}
		$this->form_validation->set_rules('admin_username',		'adminUsername',	'trim|strtolower|required');
		$this->form_validation->set_rules('password',	'adminPassword',	'required');				
	
		if($this->form_validation->run() == FALSE) {
			 
			 
			
			  $this->load->view('admin/login');			
		}
		else 
		{	

	        $password = $this->input->post('password');
			$admin_username = $this->input->post('admin_username');
			
			
		
			$query = $this->db->get_where('dwalker_admin',
			 array('adminUsername' => $this->input->post('admin_username'),
			 'adminPassword'=>md5($password)));	
			
		    $user  = $query->row_array();
			
			
			
			if(empty($user))
			{
				$attempt = $this->session->userdata('attempt');
                $attempt++;
				$this->session->set_userdata('attempt', $attempt);
				$this->session->set_flashdata('success', 'Incorrect username or password');
				if($this->session->userdata('attempt')>=5)
				{
				   redirect(base_url().'admin/login_failed');	
				}
				else
				{
					redirect(base_url().'admin/login');	
				}
			}
			$this->session->set_userdata('adminId', $user['adminId']);
			$this->session->set_userdata('adminUsername', $this->input->post('admin_username'));
			$this->session->set_userdata('signed_in', TRUE);					
			
			// Assign remember me value					
		/*	$rememberme = $this->input->post('rememberme');		
			if($rememberme !='') {			  
				$expires = 1 * 1000 * 60 * 60 * 24;
				setcookie("admin_username", $this->input->post('admin_username'), time()+$expires);
				setcookie("password", $this->input->post('password'), time()+$expires);
				setcookie("remember_me", $this->input->post('rememberme'), time()+$expires);
			}	*/			
			//end			
			$this->session->unset_userdata('attempt');  
			redirect(base_url().'admin/home');
		}	   
	}	
	// logout	
	public function logout()
	{
		
		$this->session->unset_userdata('adminId');   
		$this->session->unset_userdata('adminUsername');
		$this->session->unset_userdata('signed_in');
		redirect(base_url()."admin/login");
    }
	// home	
	public function home()
	{  
		if(!$this->session->userdata('adminUsername'))
	    {
			redirect(base_url().'admin/login');
		}		  
		$this->load->view('admin/home');				
	}
	
	
	
	

	
}