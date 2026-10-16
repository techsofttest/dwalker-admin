<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Promocode extends CI_Controller 
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
		$data['seo_title'] = "View Promocode | D WALKER JEWELRY";	
		$data['promo']	=	$this->Admin_model->fetch_all('dwalker_promocode');
		$this->load->view('admin/view_promocode',$data);}
		
		public function AddPromocode()
		{
		  
	$data['seo_title']= "Add Promocode | D WALKER JEWELRY";
	
		if($_POST):
			$data['promo']	=	$this->Admin_model->fetch_one_row('dwalker_promocode',array('code'=>$this->input->post('code')));
		 if(!empty($data['promo'])) {
				$this->session->set_flashdata('error','Promocode Already Exist!');
		  redirect(base_url().'admin/Promocode/AddPromocode');
			}
		$gift_data= array(
		'code'	 => $this->input->post('code'),
		'from'	 => $this->input->post('from'),
		'to'	 => $this->input->post('to'),
		'discount'	 => $this->input->post('discount')); 
  $cid = $this->Admin_model->insertsection('dwalker_promocode',$gift_data);
		$this->session->set_flashdata('success','Promocode Added Succesfully');
		redirect(base_url().'admin/Promocode/AddPromocode');
				 endif; 
			$this->load->view('admin/add_promocode', $data);
		}
		
		
	  public function EditPromocode($PromocodeId)
	  {

				$cond	=	array('pro_id' => $PromocodeId);
				$data['promo']	=	$this->Admin_model->fetch_one_row('dwalker_promocode',$cond);
		  $data['seo_title']=  "Edit Promocode | D WALKER JEWELRY";
		  if($_POST):
		   $Promocode_data=array('code'	=> $this->input->post('code'),
					'from'	=> $this->input->post('from'),
					'to'	=> $this->input->post('to'),'discount'	 => $this->input->post('discount')); 		 
		   $edit 	= 	$this->Admin_model->update_all($Promocode_data,$cond,'dwalker_promocode');
		   $this->session->set_flashdata('success','Promocode Updated Succesfully');			
				redirect(base_url().'admin/Promocode/EditPromocode/'.$PromocodeId);
				endif;				
				
		  $this->load->view('admin/edit_promocode',$data);	
	} 	 
		public function  DeletePromocode($pid)
		{
		  $cond=array('pro_id' => $pid);
		  $data['Promocode'] 	= 	$this->Admin_model->fetch_one_row('dwalker_promocode',$cond);		  
		  $this->db->where('pro_id',$pid);
		  $this->db->delete('dwalker_promocode');
		  $this->session->set_flashdata('success', 'Promocodes Deleted Successfully.'); 
		  redirect(base_url().'admin/Promocode');
		}	

 }