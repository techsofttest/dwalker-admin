<?php
class Cart extends CI_Controller {
	
			
	
  public function __construct()

		{

			parent::__construct(); 

			$this->load->library('form_validation');

			$this->load->helper(array('form', 'url', 'text'));

		    $this->load->model("Admin_model");
			$this->load->library('cart');

            $this->load->library('session');	

           

        }
	
	function add_to_cart(){   
	
	
	
	

	
		$data = array(
			'id' => $this->input->post('product_id'), 
			'name' => $this->input->post('product_name'), 
			'price' => $this->input->post('product_price'),
			'image' => $this->input->post('product_image'),
			'qty' => $this->input->post('quantity'), 
			'productcode' => $this->input->post('productcode'),
			'productNameSlug' => $this->input->post('productNameSlug'),
			
		);
		
		
		$this->cart->insert($data);
		
redirect(base_url().'Cart/MyCart');
		//echo $this->count_cart(); 
	}

	function MyCart(){
		
   /*Header*/  
	$data['carts'] = $this -> cart -> contents();
	
	    $data['testimonial']=		$this->Admin_model->fetch_index_testimonial('dwalker_testimonial');
		$cond_cmsfooter=array('contentId' => 5);
		$data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);
		
	  $data['main_category'] 	= 	$this->Admin_model->fetch_all('dwalker_category');
	  $data['relatedproduct'] 	= 	$this->Admin_model->fetch_related_product();
	  $data['categorys'] 	= 	$this->Admin_model->fetch_main_category();
	  $data['country'] 	= 	$this->Admin_model->fetch_all('dwalker_country');
	
	$data['allproduct']=		$this->Admin_model->fetch_productalls('dwalker_product');

	
	
	if(isset($_POST['checkout']))
	{
		
		date_default_timezone_set('Asia/Kolkata');
		$currentdatetime =date('Y-m-d H:i');
		$cart_count          = $_POST['cart_count'];
		 $payName      = $_POST['payName'];  
		  $payCountry      = $_POST['country'];
		 $payPhone     = $_POST['payPhone'];  
		 $payEmail     = $_POST['payEmail'];  
		 $payAddress   = $_POST['payAddress'];
		  $payInstruction   = $_POST['payInstruction'];
		  $Final_totalbefore = $_POST['Final_totalbefore'];
          $Final_shippingprice = $_POST['Final_shippingprice'];
          $Final_Totalprice = $_POST['Final_Totalprice'];
		
$data['TRANS_ID_LAST']	=	$this->Admin_model->maxx_valuee();
		 $TRANS_ID_temp =  $data['TRANS_ID_LAST']['payID'];
	     $TRANS_ID = $TRANS_ID_temp;
		$ORDERID = "ORDER#".$TRANS_ID;
		$user_cond_con = array('country_id'  => $payCountry);
	$data['country_detail']	=	$this->Admin_model->fetch_one_row('dwalker_country',$user_cond_con);
		$countryname =  $data['country_detail']['country_name'];
		
		for($i = 0; $i < $cart_count; $i++)
		{
			
		$PROD_ID         =    $_POST['PROD_ID'][$i]; 
		$PROD_NAME       =    $_POST['PROD_NAME'][$i]; 
		$QTY             =    $_POST['QTY'][$i]; 
		$PRICE           =    $_POST['PRICE'][$i];
		$IMAGE           =    $_POST['IMAGE'][$i]; 
		$productcode     =    $_POST['productcode'][$i]; 
		
		$subtotal        =    $_POST['subtotal'][$i]; 
		 
		
		 $ins_data  	= 	array(
			 'payProID'	         => $PROD_ID,
			 'TransId'  => $TRANS_ID,
			 'OrderID'  => $ORDERID,
		  'payProduct'	         => $PROD_NAME,
		  'payQuantity'	         => $QTY,
		  'payPrice'	         => $PRICE,
		  'payName'	         => $payName,
		   'payCountry'	         => $countryname,
		  'payPhone'	         => $payPhone,
		  'payEmail'	         => $payEmail,
		  'payAddress'	         => $payAddress,
		   'payInstruction'	         => $payInstruction,
		   'payShipping'	         => $Final_shippingprice,
		   'payTotalsingle'   => $subtotal,
		   'payTotalbefore'          => $Final_totalbefore,
		  'payTotal'	         => $Final_Totalprice,	
		  
		  	
			
			);
				
			$or_id =  $this->Admin_model->inserALL('dwalker_payments',$ins_data);
		
		}
		
		 $this->session->set_userdata('username', $payName);
		
		redirect(base_url().'Checkout/Order/'.$TRANS_ID);	

	}
		
		$this->load->view('user/cart',$data);
		}
		
			
	function delete_cart($row_id){ 
		$data = array(
			'rowid' => $row_id, 
			'qty' => 0, 
		);
		$this->cart->update($data);
		//echo $this->show_cart();
		//echo $this->count_cart();
	 $this->session->set_flashdata('success', 'Item removed from cart Successfully.'); 
	redirect(base_url().'Cart/MyCart');	
		
	}
	
	
	
	function qty_update()
	{
		
		 $countryID = $this->input->post('countryID');
		  $cond=array('country_name' =>$countryID);
	  $condnew=array('country_id' =>$countryID);
	
		 
		 $r_id=$this->input->post('row_id');
		 
		 
		$data = array(
			'rowid' => $this->input->post('row_id'), 
			'qty' => $this->input->post('quantity'), 
		);
		$this->cart->update($data);
		
	   
		$A = '<p> $'.$this->show_price($r_id).' x '.$this->show_qty($r_id).' = $'.$this->show_qtyprice($r_id).' NZD</p>';
		$B = number_format($this->cart->total());
		$C = $this->cart->total();
		
	if($countryID ==""){
		$output1 = $C;
			$shipprice="0";
	}
	else{
	  $data['shippingdet'] = $this->Admin_model->fetch_one_row('dwalker_shipping',$cond);
	  $data['countrycurrency'] = $this->Admin_model->fetch_one_row('dwalker_country',$condnew);
	  $currency = $data['countrycurrency']['Currency'];
	  $shippingpriice = $data['shippingdet']['shipPrice'];
	  $maxprice = $data['shippingdet']['shipPriceGreater'];
	  $shipPriceLess = $data['shippingdet']['shipPriceLess'];
	  
	  
	  
	 if($C >= $maxprice){
		
		 $output1 = $C + $shipPriceLess;
		$shipprice=$shipPriceLess;
		  }
		  else{
		    $output1 = $C + $shippingpriice;
			$shipprice=$shippingpriice;
		  }
	}
	
	
		
		$D = $this->input->post('quantity');
		$E = $this->show_qtyprice_get($r_id);
		$F = $shipprice;
		$G = $output1;
		$H = "NZD";
		
		$data=array("AmountDescription"=>$A,"Amount"=>$B,"AmountRight"=>$C,"Quantity"=>$D,"QuantityPrice"=>$E,"Shipping"=>$F,"Totalshipping"=>$G,"Currency"=>$H);
        echo json_encode($data);
		}
		
		
		
		function shipping_update()
	{
		
		 $countryID = $this->input->post('countryID');
		  $cond=array('country_name' =>$countryID);
	  $condnew=array('country_id' =>$countryID);
	
		 
		
		
	   
		
		$A = number_format($this->cart->total());
		$B = $this->cart->total();
		
	if($countryID ==""){
		$output1 = $B;
			$shipprice="";
	}
	else{
	  $data['shippingdet'] = $this->Admin_model->fetch_one_row('dwalker_shipping',$cond);
	  $data['countrycurrency'] = $this->Admin_model->fetch_one_row('dwalker_country',$condnew);
	  $currency = $data['countrycurrency']['Currency'];
	  $shippingpriice = $data['shippingdet']['shipPrice'];
	  $maxprice = $data['shippingdet']['shipPriceGreater'];
	  $shipPriceLess = $data['shippingdet']['shipPriceLess'];
	  
	  
	  
	 if($B >= $maxprice){
		
		 $output1 = $B + $shipPriceLess;
		$shipprice=$shipPriceLess;
		  }
		  else{
		    $output1 = $B + $shippingpriice;
			$shipprice=$shippingpriice;
		  }
	}
	
	
		
		
		$C = $shipprice;
		$D = $output1;
		$E = "NZD";
		
		$data=array("Amount"=>$A,"AmountRight"=>$B,"Shipping"=>$C,"Totalshipping"=>$D,"Currency"=>$E);
        echo json_encode($data);
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		function show_qtyprice_get($r_id)
		{
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			if($r_id==$items['rowid'])
			{
			$output .=$items['price'] * $items['qty'];
			}
		}	
		return $output;		
		}	
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
				
			
	function show_qtyprice($r_id){
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			if($r_id==$items['rowid']){
			$output .='<span>'.number_format($items['price'] * $items['qty']).'</span>';
			}
		}	
		return $output;		
		}
		function show_price($r_id){
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			if($r_id==$items['rowid']){
			$output .='<span>'.number_format($items['price']).'</span>';
			}
		}	
		return $output;		
		}
		function show_qty($r_id){
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			if($r_id==$items['rowid']){
			$output .='<span>'.$items['qty'].'</span>';
			}
		}	
		return $output;		
		}
		
	function count_cart(){ 
		$output1 = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			$output1 .='
			 <span>'.count($this->cart->contents()).'</span>
			';
			
		}
	
		return $output1;
	}
	
	
function count_cart_new(){ 
		$output1 = '';
		
		$output1 .='
			 <span style="color: white;background: #379b46;border-radius: 50px;padding: 4px 8px;">'.count($this->cart->contents()).'</span>
			';
		return $output1;
	}
	function load_cart(){ 	
		echo $this->show_cart();
	}
function count_load()
{ 
 echo $this->count_cart();
		//redirect(base_url());	
	}
	
	
		function show_totalprice(){
			
			$output = '';
			$output .= '
				<div class="total-cost">
							<h6>Total <span><i class="fas fa-rupee-sign"></i> '.number_format($this->cart->total()).'</span></h6>
						</div>
		';
	
		return $output;
			}
		
	

}
