<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seo extends CI_Controller {
		// construct
        public function __construct()
		{
				parent::__construct();
				$this->load->database();
                $this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text'));
                $this->load->model("Admin_model");
				//$this->pr_details=get_profile_details();
				$this->load->library('session');
				if(!$this->session->userdata('adminId'))
				{
					redirect(base_url().'admin/login');	
				}	
				//get user details
        }
		
		
		 public function index()

		{  
		   
		   
		   
			$data['seo_data']	=	$this->Admin_model->fetch_all('dwalker_seopage');
			
			
			$data['seo_title'] 	= 	"View Seo Page | D WALKER JEWELRY"; 
			
			
			
			
			
			$this->load->view('admin/view_seo',$data);
		
        }
	
		
		// Add Qualification   
       
		
	 public function EditSeo($seoid)
		{
			
			
			$cond=array('seoid' => $seoid);
			
			$data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_seopage',$cond);
			
			
			
			$data['seo_title'] 	= 	"Edit Seo Page | D WALKER JEWELRY"; 
			
			
		 
											
			if($_POST):
				
			
			
			 
				$stud_data  	= 	array(
		'meta_title'  =>$this->input->post('m_title'),
		'meta_description'  =>$this->input->post('m_dis'),
		'meta_keyword'  =>$this->input->post('m_key'),
		
		
		 );
				
				
				
				$cond  	= 	array('seoid'  =>$seoid);
				$add_img	=	$this->Admin_model->update_all($stud_data,$cond,'dwalker_seopage');
				
					
				$this->session->set_flashdata('success', 'Seo Page Updated Successfully.'); 
				
				
				
				
				
				
				
				
					
				
				
				
				redirect(base_url().'admin/Seo/EditSeo/'.$seoid);
				
			endif;
			$this->load->view('admin/edit_seo', $data);
        }
		
			
	 
		
		
		
		
		
	
}