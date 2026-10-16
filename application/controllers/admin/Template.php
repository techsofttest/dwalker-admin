<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Template extends CI_Controller 
 {
	  public function __construct()
		{
				parent::__construct();
				$this->load->database();
    $this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text'));
    $this->load->model("Admin_model");			
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
		$data['seo_title'] = "View Template | D WALKER JEWELRY";	
		$data['temp']	=	$this->Admin_model->fetch_all('dwalker_template');
		$this->load->view('admin/view_template',$data);}
		
		public function AddTemplate()
		{
		  
	$data['seo_title']= "Add Template | D WALKER JEWELRY";
		  
		if($_POST):
		$gift_data= array(
		'title'	 => $this->input->post('title'),
		'content'	 => $this->input->post('content')); 
  $cid = $this->Admin_model->insertsection('dwalker_template',$gift_data);
		$this->session->set_flashdata('success','Template Added Succesfully');
		redirect(base_url().'admin/Template/AddTemplate');
				 endif; 
			$this->load->view('admin/add_template', $data);
		}
		
		
	  public function EditTemplate($TemplateId)
	  {

				$cond	=	array('tem_id' => $TemplateId);
				$data['Temp']	=	$this->Admin_model->fetch_one_row('dwalker_template',$cond);
		  $data['seo_title']=  "Edit Template | D WALKER JEWELRY";
		  if($_POST):
     $gift_data= array(
      'title'	 => $this->input->post('title'),
      'content'	 => $this->input->post('content'));  
		   $edit 	= 	$this->Admin_model->update_all($gift_data,$cond,'dwalker_template');
		   $this->session->set_flashdata('success','Template Updated Succesfully');			
				redirect(base_url().'admin/Template/EditTemplate/'.$TemplateId);
				endif;				
				
		  $this->load->view('admin/edit_template',$data);	
	} 	 
		public function  DeleteTemplate($pid)
		{
		  $cond=array('tem_id' => $pid);
		  $data['Template'] 	= 	$this->Admin_model->fetch_one_row('dwalker_template',$cond);		  
		  $this->db->where('tem_id',$pid);
		  $this->db->delete('dwalker_template');
		  $this->session->set_flashdata('success', 'Templates Deleted Successfully.'); 
		  redirect(base_url().'admin/Template');
		}	

public function Teams()
		{
		$data['seo_title'] = "View Template | D WALKER JEWELRY";	
		$users	=	$this->Admin_model->fetch_all_order_cond('dwalker_users','USER_ID','Desc',array());
		$data['grouped'] = array_chunk($users, 10);
		$this->load->view('admin/view_teams_members',$data);}

	

		public function Users()
		{
		$data['seo_title'] = "View List Users | D WALKER JEWELRY";	
		$data['users']	=	$this->Admin_model->fetch_all_order_cond('dwalker_users','USER_ID','Desc',array());
		$data['subject_list']	=	$this->Admin_model->fetch_all('dwalker_template');
		$data['grouped'] = array_chunk($data['users'], 10);
		$this->load->view('admin/view_team',$data);}		
		}