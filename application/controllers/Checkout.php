<?php
class Checkout extends CI_Controller {
	
			
	
  public function __construct()

		{
			parent::__construct(); 

			$this->load->library('form_validation');

			$this->load->helper(array('form', 'url', 'text'));

		 $this->load->model("Admin_model");
		    
			$this->load->library('cart');

   $this->load->library('session');	

  }
        
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

	$data['cartproduct']	=	$this->Admin_model->product_cart($tempidd);
		
	$user_cond_det = array('payName'  => $this->session->userdata('username'),'TransId'  => $tempidd);
	$data['user_details_order']	=	$this->Admin_model->fetch_one_row('dwalker_payments',$user_cond_det);
	$data['user_gift_details']	=	$this->Admin_model->fetch_gift_details($user_cond_det);
	$data['user_details_payment'] =	$this->Admin_model->fetch_data('dwalker_payments',$user_cond_det);
 	$data['order_price_details']	=	$this->Admin_model->fetch_one_row('dwalker_payments',$user_cond_det);

	if(isset($_POST['place_order']))
	{
	//$this->Admin_model->update_all(array('payMode' => $payMode),array('TransId'=>$tempidd),'dwalker_payments');
  	if(!empty($this->input->post('promocode'))){
		$promo_data= array(
		'promocode'	 => $this->input->post('promocode'),
		'email' => $this->input->post('Email')); 		
		$this->Admin_model->insertsection('dwalker_usedpromo',$promo_data);
		$data['dis']	=	$this->Admin_model->fetch_one_row('dwalker_promocode',array('code'=>$this->input->post('promocode')));
		$up_data = array('promo_status'=>1,'promo_dis'=>$data['dis']['discount'],'payTotal'=>$this->input->post('final_db'));
		$this->Admin_model->update_all($up_data,array('TransId'=>$tempidd),'dwalker_payments');
		}
		$this->session->set_userdata('TransId', $tempidd);
	if($this->input->post("mode")==3){
		$this->session->set_userdata('TransId', $tempidd);
		redirect(base_url().'Cashondelivery');	
	}else{
		$this->session->set_userdata('TransId', $tempidd);
  redirect(base_url().'Payment');	
	}
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

	public function CheckPromo()
	{		
		
		$Promo = $this->input->post("Promo");
		$email = $this->input->post("email");
		$data['details'] = $this->Admin_model->fetch_one_row('dwalker_promocode',array('code'=>$Promo));	
		$data['used'] = $this->Admin_model->fetch_one_row('dwalker_usedpromo',array('promocode'=>$Promo,'email'=>$email));	
		if(empty($data['details'])){
			$data['status']=0;
		}
		elseif($data['details']['to'] < date("Y-m-d")){
			$data['status']=0;
		}	
		elseif(!empty($data['used'])){
			$data['status']=1;
		}			
		echo json_encode($data);
	}

	public function CalculatePromo()
	{				
		$Promo = $this->input->post("Promo");
		$Total = $this->input->post("total");
		$Shipping = $this->input->post("shipping");	
		$data['details'] = $this->Admin_model->fetch_one_row('dwalker_promocode',array('code'=>$Promo));	
		$data['Total'] = 	$Total-($Total*$data['details']['discount'])/100;
		$data['TotalA'] = 	$data['Total']+$Shipping;
		echo json_encode($data);
	}	
	
}
