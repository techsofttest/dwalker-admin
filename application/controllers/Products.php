<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {



  public function __construct()

		{

			parent::__construct(); 

			$this->load->library('form_validation');

			$this->load->helper(array('form', 'url', 'text'));

		    $this->load->model("Admin_model");

            $this->load->library('session');	
$this->load->library('cart');
           

        }

	

	public function index($name)

	{
		$data['carts'] = $this -> cart -> contents();
		
$data['testimonial']=		$this->Admin_model->fetch_index_testimonial('dwalker_testimonial');
		$cond_cmsfooter=array('contentId' => 5);
		$data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);
	  $slug=$name;
	  $cond	=	array('SlugName' => $name);
	  $data['productdet']	=	$this->Admin_model->fetch_one_row('dwalker_product',$cond);
	 
	  //print_r($data['productdet']);
	  //exit();
		$prodID=$data['productdet']['product_id'];
		
	  $data['prodmoreimage']	=	$this->Admin_model->fetch_more_image($prodID);
	  $data['main_category'] 	= 	$this->Admin_model->fetch_all('dwalker_category');
	  $data['relatedproduct'] 	= 	$this->Admin_model->fetch_related_product();
	  $data['categorys'] 	= 	$this->Admin_model->fetch_main_category();
	  $data['country'] 	= 	$this->Admin_model->fetch_all('dwalker_country');
	   //$data['country'] 	= 	$this->Admin_model->fetch_all('dwalker_shippingcost');
	  
	  if(isset($_POST['make_payment']))
	  {
		 $payProID     = $_POST['payProID'];
		 $paycurrency     = $_POST['paycurrency'];   
		 $payProduct   = $_POST['payProduct'];  
		 $payQuantity  = $_POST['payQuantity'];  
		 $payPrice     = $_POST['payPrice'];
		 $payName      = $_POST['payName'];  
		 $payPhone     = $_POST['payPhone'];  
		 $payEmail     = $_POST['payEmail'];  
		 $payAddress   = $_POST['payAddress'];
		 // $payTotal     = $_POST['shipppingcost']; 
		 //$payTotal     = $payQuantity * $payPrice;
		 $payTotalcustomer   = $_POST['shippping_cost_value'];
		 
		 $payTotalcustomernew   = $_POST['shippping_cost_value'].$_POST['paycurrency'];
		
		
		
		 
		 function convertCurrencynew($amount,$from_currency,$to_currency){
  $apikey = 'b1cdea7c6f27652080d9';

  $from_Currency = urlencode($from_currency);
  $to_Currency = urlencode($to_currency);
  $query =  "{$from_Currency}_{$to_Currency}";

  $json = file_get_contents("https://free.currencyconverterapi.com/api/v6/convert?q={$query}&compact=ultra&apiKey={$apikey}");
  $obj = json_decode($json, true);

  $val = floatval($obj["$query"]);


  $total = $val * $amount;
  return number_format($total, 2, '.', '');
}
$amount=convertCurrencynew($payTotalcustomer,$paycurrency,'USD');
$payTotal= $amount;
		 

	function convertCurrencyfinal($price,$from_currency,$to_currency){
  $apikey = 'b1cdea7c6f27652080d9';

  $from_Currency = urlencode($from_currency);
  $to_Currency = urlencode($to_currency);
  $query =  "{$from_Currency}_{$to_Currency}";

  $json = file_get_contents("https://free.currencyconverterapi.com/api/v6/convert?q={$query}&compact=ultra&apiKey={$apikey}");
  $obj = json_decode($json, true);

  $val = floatval($obj["$query"]);


  $totalnew = $val * $price;
  return number_format($totalnew, 2, '.', '');
}
$price=convertCurrencynew($payTotalcustomer,$paycurrency,'NZD');
$payTotalNZD= $price."NZD";	 
		 
		 
		 
		 
		 
		  $pay_data= array(
		  'payProID'	         => $payProID,
		  'payProduct'	         => $payProduct,
		  'payQuantity'	         => $payQuantity,
		  'payPrice'	         => $payPrice,
		  'payName'	         => $payName,
		  'payPhone'	         => $payPhone,
		  'payEmail'	         => $payEmail,
		  'payAddress'	         => $payAddress,
		  'payTotal'	         => $payTotal,	
		  'payTotalcustomer'	         => $payTotalcustomernew,	
		  'payTotalNZD'	         => $payTotalNZD,		  
	     ); 
		 
		$payID = $this->Admin_model->insertsection('dwalker_payments',$pay_data);
		
		
		 $this->session->set_userdata('payTotal', $payTotal);
		 $this->session->set_userdata('payID', $payID);
		echo $this->session->userdata('payID');
	
	
	redirect(base_url().'paypalController/buyProduct/'.$payID);	
		 
	  }
	  
	  $this->load->view('user/productdetail', $data);
	
	}
	public function productdetails($name)
	{ 
	$data['carts'] = $this -> cart -> contents();
	$data['testimonial']=		$this->Admin_model->fetch_index_testimonial('dwalker_testimonial');
	$cond_cmsfooter=array('contentId' => 5);
		$data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);
	  $slug=$name;
	  $cond	=	array('SlugName' => $name);
	  $data['productdet']	=	$this->Admin_model->fetch_one_row('dwalker_product',$cond);
	 
	  //print_r($data['productdet']);
	  //exit();
		$prodID=$data['productdet']['product_id'];
		
	  $data['prodmoreimage']	=	$this->Admin_model->fetch_more_image($prodID);
	  $data['main_category'] 	= 	$this->Admin_model->fetch_all('dwalker_category');
	 $data['relatedproduct'] 	= 	$this->Admin_model->fetch_related_product();
	  $data['categorys'] 	= 	$this->Admin_model->fetch_main_category();
	  
	  
	  if(isset($_POST['make_payment']))
	  {
		 $payProID     = $_POST['payProID'];  
		 $payProduct   = $_POST['payProduct'];  
		 $payQuantity  = $_POST['payQuantity'];  
		 $payPrice     = $_POST['payPrice'];
		 $payName      = $_POST['payName'];  
		 $payPhone     = $_POST['payPhone'];  
		 $payEmail     = $_POST['payEmail'];  
		 $payAddress   = $_POST['payAddress']; 
		 $payTotal     = $payQuantity * $payPrice;
		 
		 
		  $pay_data= array(
		  'payProID'	         => $payProID,
		  'payProduct'	         => $payProduct,
		  'payQuantity'	         => $payQuantity,
		  'payPrice'	         => $payPrice,
		  'payName'	         => $payName,
		  'payPhone'	         => $payPhone,
		  'payEmail'	         => $payEmail,
		  'payAddress'	         => $payAddress,
		  'payTotal'	         => $payTotal,		  
	     ); 
		 
		$payID = $this->Admin_model->insertsection('dwalker_payments',$pay_data);
		
		
		 $this->session->set_userdata('payTotal', $payTotal);
		 $this->session->set_userdata('payID', $payID);
		
	
	
	redirect(base_url().'paypalController/buyProduct/'.$payID);	
		 
	  }
	  
	  $this->load->view('user/productdetail', $data);
	}
	
	



	
	
	
	
}