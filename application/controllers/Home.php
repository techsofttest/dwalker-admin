<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {



  public function __construct()

		{

			parent::__construct(); 

			$this->load->library('form_validation');

			$this->load->helper(array('form', 'url', 'text'));

		    $this->load->model("Admin_model");
			$this->load->library('cart');

            $this->load->library('session');	

           

        }

	

	public function index()


	{
	    
	      
	    
	    
		$data['carts'] = $this -> cart -> contents();
	  $data['limitprod']=		$this->Admin_model->fetch_index_limitprod('dwalker_product');
	  $data['oneproductlimit']=		$this->Admin_model->fetch_oneindex_limitprod('dwalker_product');
	  $data['moreproductlimit']=		$this->Admin_model->fetch_moreindex_limitprod('dwalker_product');
	  
	   $data['testimonial']=		$this->Admin_model->fetch_index_testimonial('dwalker_testimonial');
	  
	 // $data['mainproduct']=   $this->Admin_model->fetch_main_category();
	  $data['main_category'] 	= 	$this->Admin_model->fetch_all('dwalker_category');
	   $data['subcategorysub'] 	= 	$this->Admin_model->fetch_sub_category();
	   
	  $data['categorys'] 	= 	$this->Admin_model->fetch_main_category();
	  $seocond_cms=array('seoid' => 2);
	  $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_seopage',$seocond_cms);
	   $cond_cmshome=array('contentId' => 6);

		$data['cmshome_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmshome);
	  $cond_cmsfooter=array('contentId' => 5);
		$data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);
	  //$data['catID']=$data['categorys']['cat_id'];
	  //print_r($data['categorys']);
	  //exit();
	  $this->load->view('user/index',$data);
	
	}
	
	  public function GetSubcatt()
   {
	  $payprice = $this->input->post('payprice');
	  $payquantity = $this->input->post('payquantity');
	  $countryID = $this->input->post('countryID');
	  $cond=array('country_name' =>$countryID);
	  $condnew=array('country_id' =>$countryID);
	  $data['shippingdet'] = $this->Admin_model->fetch_one_row('dwalker_shipping',$cond);
	  $data['countrycurrency'] = $this->Admin_model->fetch_one_row('dwalker_country',$condnew);
	  $currency = $data['countrycurrency']['Currency'];
	  $shippingpriice = $data['shippingdet']['shipPrice'];
	  $maxprice = $data['shippingdet']['shipPriceGreater'];
	  $shipPriceLess = $data['shippingdet']['shipPriceLess'];
	  
	  
	function convertCurrency($amount,$from_currency,$to_currency){
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
$amount=convertCurrency($payprice,'NZD',$currency);
$totalamount= $amount;
  $payTotal = $totalamount;
	  
	  
	  
	  if($payTotal >= $maxprice){
		
		 $output1 = $totalamount + $shipPriceLess;
		$shipprice=$shipPriceLess;
		  }
		  else{
		    $output1 = $totalamount + $shippingpriice;
			$shipprice=$shippingpriice;
		  }
	   $Dcurrency=$currency;
$Dtotal=$output1;
$Dshipprice=$shipprice;
$D=$payTotal;
$data=array("Amount"=>$Dtotal,"Currency"=>$Dcurrency,"Shippingprice"=>$Dshipprice,"Currentamount"=>$D);
echo json_encode($data);
	  
	  
	//$output1 = $shippingpriice+$totalprice;
	//echo 123;
	
  }	
	
			
	
}