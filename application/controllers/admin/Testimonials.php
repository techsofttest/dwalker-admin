<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Testimonials extends CI_Controller 
 {
	  public function __construct()
		{
				parent::__construct();
				$this->load->database();
                $this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text'));
                $this->load->model("Admin_model");
				//$this->pr_details=get_profile_details();
				$this->load->library('image_lib');
				$this->load->library('session');
				if(!$this->session->userdata('adminId'))
				{
					redirect(base_url().'admin/login');	
				}	
				//get user details
        }
		
		
		
		public function index()
		{
		$data['seo_title'] = "View Testimonials | D WALKER JEWELRY";
		
		//$data['shippingcost']=$this->Admin_model->fetch_all_shippingcost();
		$data['testimonials']=$this->Admin_model->fetch_index_testimonial('dwalker_testimonial');
		
		$this->load->view('admin/view_testimonials',$data);
			
			
		}
		
		public function AddTestimonials()
		{
		
		  $data['seo_title']= "Add Testimonials | D WALKER JEWELRY";
		  
		  if($_POST):
		  $shipping_data= array(
		  'testi_name'	         => $this->input->post('name'),
		  'testi_location'        => $this->input->post('location'),
		  'testi_description'        => $this->input->post('desc'),
		  
		  
		  
	     ); 
		// print_r($shipping_data);
		 //exit();
		$cid = $this->Admin_model->insertsection('dwalker_testimonial',$shipping_data);
		$this->session->set_flashdata('success','Testimonials Added Succesfully');
		endif; 
			$this->load->view('admin/add_testimonials', $data);
		}
		
		
	  public function EditTestimonials($costId)
	  {
		 $cond=array('testi_id' => $costId);
		
		 $data['testimonial'] 	= 	$this->Admin_model->fetch_one_row('dwalker_testimonial',$cond);
		$data['seo_title']=  "Edit Testimonials | D WALKER JEWELRY";
		 if($_POST):
		 
		 
		
		
		 $cost_data=array(
		   'testi_name'	         => $this->input->post('name'),
		  'testi_location'        => $this->input->post('location'),
		  'testi_description'        => $this->input->post('desc'),
		
		 
		); 
		$cond	=	array('testi_id'	=>	$costId);
		$edit 	= 	$this->Admin_model->update_all($cost_data,$cond,'dwalker_testimonial');
		$this->session->set_flashdata('success','Testimonials Updated Succesfully');
		$testiid = $costId;
	    redirect(base_url().'admin/Testimonials/EditTestimonials/'.$testiid);
		endif;
	    $this->load->view('admin/edit_testimonials',$data);	
	}
	 
	public function  DeleteTestimonials($cid)
	 {
		 $cond=array('testi_id' => $cid);
		 $data['testimonials'] 	= 	$this->Admin_model->fetch_one_row('dwalker_testimonial',$cond);
		 $this->db->where('testi_id',$cid);
		 $this->db->delete('dwalker_testimonial');
		 $this->session->set_flashdata('success', 'Testimonials Deleted Successfully.'); 
		 redirect(base_url().'admin/Testimonials');
	}
		
		

 
 
	
	
		
 }