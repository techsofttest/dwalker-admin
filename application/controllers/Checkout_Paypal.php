<?php
class Checkout extends CI_Controller {
	
			
	
  public function __construct()

		{

			parent::__construct(); 

			$this->load->library('form_validation');

			$this->load->helper(array('form', 'url', 'text'));
		 $this->load->model("Admin_model");
			$this->load->library('cart');
   $this->load->library('session');}
	function Order($tempidd)
{
	
	
  $data['carts'] = $this -> cart -> contents();
	
	 $data['testimonial']=		$this->Admin_model->fetch_index_testimonial('dwalker_testimonial');
		$cond_cmsfooter=array('contentId' => 5);
		$data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);
		
	  $data['main_category'] 	= 	$this->Admin_model->fetch_all('dwalker_category');
	  $data['relatedproduct'] 	= 	$this->Admin_model->fetch_related_product();
	  $data['categorys'] 	= 	$this->Admin_model->fetch_main_category();
	  $data['country'] 	= 	$this->Admin_model->fetch_all('dwalker_country');
	
	$checkingg_cond = array('payName' => $this->session->userdata('username'),'TransId' => $tempidd,'payStatus' => 0);
	$data['checkingg']	=	$this->Admin_model->fetch_one_row('dwalker_payments',$checkingg_cond);
	
	
	
		
	  $data['cartproduct']	=	$this->Admin_model->cartproduct($tempidd);
	
	
	$user_cond_det = array('payName'  => $this->session->userdata('username'),'TransId'  => $tempidd);
	$data['user_details_order']	=	$this->Admin_model->fetch_one_row('dwalker_payments',$user_cond_det);
		$data['user_details_payment'] =	$this->Admin_model->fetch_data('dwalker_payments',$user_cond_det);
   $data['order_price_details']	=	$this->Admin_model->fetch_one_row('dwalker_payments',$user_cond_det);
	if(isset($_POST['place_order']))
	{
	
		
		 $this->session->set_userdata('TransId', $tempidd);
		
	
	redirect(base_url().'paypalController/buyProduct/'.$tempidd);	
	}
	
	if(($data['checkingg']['payID']) > 0)
	{ 
	$this->load->view('user/checkout',$data);
	}
	else
	{
	redirect(base_url().'Cart/MyCart');		
	}
	
	
	
	
	}
	

}
