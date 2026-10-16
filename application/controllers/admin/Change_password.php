<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_password extends CI_Controller {
		
		// construct
        public function __construct()
		{
				parent::__construct();
				$this->load->database();
                $this->load->library('form_validation');
				$this->load->helper(array('form', 'url'));               
				$this->load->library('session');	
	            $this->load->model('Admin_model');
				//get user details
				//$this->pr_details=get_profile_details();
				
				if(!$this->session->userdata('adminId'))
				{
					redirect(base_url().'admin/login');	
				}
        }
		
		// index        
        public function index()
		{
		   
		   $data['seo_title']="Change Password | D WALKER JEWELRY";
		   $user_id= $this->session->userdata('adminId');
		   $data['profile']  = $this->Admin_model->get_profile_details($user_id);
		   $this->load->view('admin/change_password',$data);
		    
        }
		
		//update ajax admin password
		public function update_password()
		{
				$user_id = $this->session->userdata('adminId');
				$new_password=md5($this->input->post('newpass'));
				$data=array(
							'adminPassword'=>$new_password,
							);
				$this->db->where('adminId',$user_id);
				$this->db->update('dwalker_admin',$data);
				
		}
		
	   
	}