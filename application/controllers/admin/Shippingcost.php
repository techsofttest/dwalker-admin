<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Shippingcost extends CI_Controller 
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
				// Auto-ensure status column exists in dwalker_country
				if ($this->db->table_exists('dwalker_country') && !$this->db->field_exists('status', 'dwalker_country')) {
					$this->db->query("ALTER TABLE `dwalker_country` ADD COLUMN `status` TINYINT(1) NOT NULL DEFAULT 1");
				}
        }
		
		public function index()
		{
			$data['seo_title'] = "View Shippingcost | D WALKER JEWELRY";
			$data['shippingcost'] = $this->Admin_model->fetch_all_countryshipcost();
			$this->load->view('admin/view_shippingcost', $data);
		}

		public function toggle_country_status($country_id = null)
		{
			if ($country_id) {
				$country = $this->db->get_where('dwalker_country', array('country_id' => $country_id))->row_array();
				if ($country) {
					$new_status = (isset($country['status']) && $country['status'] == 1) ? 0 : 1;
					$this->db->where('country_id', $country_id);
					$this->db->update('dwalker_country', array('status' => $new_status));
					
					// Return JSON for AJAX or redirect
					if ($this->input->is_ajax_request() || $this->input->get('ajax') == 1) {
						echo json_encode(array(
							'status' => 'success',
							'new_status' => $new_status,
							'message' => 'Country status updated to ' . ($new_status == 1 ? 'Active' : 'Inactive')
						));
						return;
					}
					$this->session->set_flashdata('success', 'Country status updated successfully.');
				}
			}
			redirect(base_url().'admin/Shippingcost');
		}
		
		public function AddShippingcost()
		{
		  $data['country'] 	= 	$this->Admin_model->fetch_all('dwalker_country');
		  $data['seo_title']= "Add Shippingcost | D WALKER JEWELRY";
		  
		  if($_POST):
		  $shipping_data= array(
		  'country_name'	         => $this->input->post('category'),
		  'shipPrice'        => $this->input->post('shipPrice'),
		  'shipPriceGreater'        => $this->input->post('shipPriceGreater'),
		  'shipPriceLess'        => $this->input->post('shipPriceLess'),
		  'description'        => $this->input->post('shippingcost'),
		  'deliverytime'        => $this->input->post('deliverytime'),
		  'express_shipping'        => $this->input->post('express_shipping'),
		  'expressamount'        => $this->input->post('expressamount'),
		  
		  
	     ); 
		// print_r($shipping_data);
		 //exit();
		$cid = $this->Admin_model->insertsection('dwalker_shipping',$shipping_data);
		$this->session->set_flashdata('success','Shipping Added Succesfully');
		endif; 
			$this->load->view('admin/add_shippingcost', $data);
		}
		
		
	  public function EditShippingcost($costId)
	  {
		 $cond=array('shipping_id' => $costId);
		 $data['allcountry']	=	$this->Admin_model->fetch_all('dwalker_country');
		 $data['shippingcost'] 	= 	$this->Admin_model->fetch_one_row('dwalker_shipping',$cond);
		$data['seo_title']=  "Edit Shippingcost | D WALKER JEWELRY";
		 if($_POST):
		 
		 
		 $b=$this->input->post('express_shipping');
		 if($b==0){
		 $c=0;
		 }
		 else{
		 $c=$this->input->post('expressamount');
		 }
		
		 $cost_data=array(
		  'country_name'	         => $this->input->post('country'),
		  'shipPrice'        => $this->input->post('shipPrice'),
		  'shipPriceGreater'        => $this->input->post('shipPriceGreater'),
		   'shipPriceLess'        => $this->input->post('shipPriceLess'),
		    'description'        => $this->input->post('shippingcost'),
			 'deliverytime'        => $this->input->post('deliverytime'),
			  'express_shipping'        => $this->input->post('express_shipping'),
		  'expressamount'        => $c,
		
		 
		); 
		$cond	=	array('shipping_id'	=>	$costId);
		$edit 	= 	$this->Admin_model->update_all($cost_data,$cond,'dwalker_shipping');
		$this->session->set_flashdata('success','Shippingcost Updated Succesfully');
		$shippingcost = $costId;
	    redirect(base_url().'admin/Shippingcost/EditShippingcost/'.$shippingcost);
		endif;
	    $this->load->view('admin/edit_shippingcost',$data);	
	}
	 
	public function  DeleteShippingcost($cid)
	 {
		 $cond=array('shippingcost_id' => $cid);
		 $data['shippingcost'] 	= 	$this->Admin_model->fetch_one_row('dwalker_shippingcost',$cond);
		 $this->db->where('shippingcost_id',$cid);
		 $this->db->delete('dwalker_shippingcost');
		 $this->session->set_flashdata('success', 'Shipping cost Deleted Successfully.'); 
		 redirect(base_url().'admin/Shippingcost');
	}
		
		

 
 
	
	
		
 }