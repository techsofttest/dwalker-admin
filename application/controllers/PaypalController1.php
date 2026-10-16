<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PaypalController extends CI_Controller
{
    function  __construct() {
        parent::__construct();
        $this->load->library('paypal_lib');
		 $this->load->model('Admin_model');
		 	$this->load->library('cart');
        $this->load->database();
    }
     
   
     
    function buyProduct($id){

        $returnURL = base_url().'PaypalController/paymentSuccess';
        $failURL = base_url().'PaypalController/paymentFail'; 
        $notifyURL = base_url().'PaypalController/ipn'; 
		
      $cond	=	array('TransId' => $id);
	  $product	=	$this->Admin_model->fetch_one_row('dwalker_payments',$cond);
	
	
		
        $userID = $id; 
        $logo = base_url().'assets/images/logod.jpg';
         
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('fail_return', $failURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $product['payProduct']);
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number', $id);
        $this->paypal_lib->add_field('amount',  $product['payTotal']);        
        $this->paypal_lib->image($logo);
         
        $this->paypal_lib->paypal_auto_form();
    }
 
     function paymentSuccess(){
 $data['carts'] = $this -> cart -> contents();
        //get the transaction data
        $paypalInfo = $this->input->get();
           
		  
		   
        $data['item_number'] = $this->session->userdata('TransId');
       // $data['txn_id'] = $paypalInfo["tx"];
//        $data['payment_amt'] = $paypalInfo["amt"];
//        $data['currency_code'] = $paypalInfo["cc"];
//        $data['status'] = $paypalInfo["st"];
		  
	
		
$length_code = 6;
$string_code = substr(str_repeat(0, $length_code).$this->session->userdata('TransId'), - $length_code);
$orderID_FINAL = "DWJ-ORDER#".$string_code;

        date_default_timezone_set('Asia/Kolkata');
		$currentdate =date('Y-m-d');
         
		 
		$user_cond_det = array('TransId'  => $this->session->userdata('TransId'));
		$updating_data  	= 	array('payStatus'  => '1',
		                               //'payTxnID'  => $data['txn_id'],
									   'payOrderID'  => $orderID_FINAL,
									   'payDate'  => $currentdate,);	
        $this->Admin_model->update_all($updating_data,$user_cond_det,'dwalker_payments');
		
		
  		
		
		
$user_cond_order = array('TransId'  => $this->session->userdata('TransId'));
$data['all_product']	=	$this->Admin_model->fetch_one_row('dwalker_payments',$user_cond_order);
$all_product_fetch = $data['all_product'];

$FULLNAME = $data['all_product']['payName'];
$email    = $data['all_product']['payEmail'];
$country    = $data['all_product']['payCountry'];
$final_totalbefore = $data['all_product']['payTotalbefore'];
$final_shipping = $data['all_product']['payShipping'];
$final_total = $data['all_product']['payTotal'];
$transID_CREATED =  $data['all_product']['payOrderID'];


				
				$user_cond_ordert = array('TransId'  => $this->session->userdata('TransId'));
$data['all_productfull']	=	$this->Admin_model->fetch_data('dwalker_payments',$user_cond_ordert);
$all_product_fetch = $data['all_productfull'];
				
				
					$num=1;		
			 
		$table_row="";
			foreach($all_product_fetch as $val)
				{
			
					$product = $val->payProduct;
					$quantity = $val->payQuantity;
					$price = $val->payPrice;
					
					
					  $cart_price = $val->payTotalsingle;
					
					$table_row.='<tr style="line-height: 3.1;">
					<td style="text-align:center;">'.$num.'</td>
					<td>
					<p class="cart-title">'.$product.'</p>
					</td>
					<td style="text-align:center;">
					'.$quantity.' 
					</td>
					<td style="text-align:center;">$'.$price.' NZD</td>
					<td class="txt" style="text-align:center;">$'.$cart_price.' NZD</td>
					</tr>';
					
					$num++;
				}
				
			$body = '<div style="font-family:Arial,Helvetica,sans-serif;line-height:18px">
        <p>Dear '.$FULLNAME.'</p>
        <p>We are pleased to inform that your order is under process. For your reference, here are the details.</p>
        
<table cellspacing="0" width="100%" style="border-collapse:collapse">
<thead>

<tr style="background:#e8e8e8;color:#555">
<th style="padding:8px;text-align:left" width="3%">Sl.No</th>
<th style="padding:8px;text-align:left" width="30%">Product</th>
<th style="padding:8px;text-align:center" width="10%">Quantity</th>
<th style="padding:8px;text-align:center" width="20%">Price <span>(NZD)</span></th>
<th style="padding:8px;text-align:center" width="20%">Subtotal <span>(NZD)</span></th>
</tr>  
</thead>'.$table_row.'<tr>
<td colspan="4" style="padding:8px;text-align:right;font-size:14px; background: #F5F5F5;">TOTAL</td>
<td style="text-align:center;padding:8px;font-size:14px;white-space:nowrap; background: #F5F5F5;" colspan="2"><b>$'.$final_totalbefore.' NZD</b></td></tr><tr>
<td colspan="4" style="padding:8px;text-align:right;font-size:14px; background: #F5F5F5;">SHIPPING CHARGE</td>
<td style="text-align:center;padding:8px;font-size:14px;white-space:nowrap; background: #F5F5F5;" colspan="2"><b>$'.$final_shipping.' NZD</b></td></tr><tr>
<td colspan="4" style="padding:8px;text-align:right;font-size:14px; background: #F5F5F5;">GRANT TOTAL</td>
<td style="text-align:center;padding:8px;font-size:14px;white-space:nowrap; background: #F5F5F5;" colspan="2"><b>$'.$final_total.' NZD</b></td>
</tr>
<tr>
<td colspan="4" style="padding:8px;text-align:right;font-size:14px; background: #F5F5F5;">TRANSACTION ID.</td>
<td style="text-align:center;padding:8px;font-size:14px;white-space:nowrap; background: #F5F5F5;" colspan="2"><b>'.$transID_CREATED.'</b></td>
</tr>

 </table>
        
         
 
        <br>
        
<div style="border-top:1px solid #555;padding:10px;text-align:center">
    	D WALKER JEWELRY<strong></strong></a><br>
    	<div class="yj6qo"></div><div class="adL">
    </div></div>        <br>
<div class="yj6qo"></div><div class="adL">
    </div></div>';
	
	
											
					$body_admin = '<div style="font-family:Arial,Helvetica,sans-serif;line-height:18px">
        <p>Dear Admin,</p>
        <p>New Order from '.$FULLNAME.'</p>
        
<table cellspacing="0" width="100%" style="border-collapse:collapse">
<thead>

<tr style="background:#e8e8e8;color:#555">
<th style="padding:8px;text-align:left" width="3%">Sl.No</th>
<th style="padding:8px;text-align:left" width="30%">Product</th>
<th style="padding:8px;text-align:center" width="10%">Quantity</th>
<th style="padding:8px;text-align:center" width="20%">Price <span>(INR)</span></th>
<th style="padding:8px;text-align:center" width="20%">Subtotal <span>(INR)</span></th>
</tr>  
</thead>'.$table_row.'<tr>
<td colspan="4" style="padding:8px;text-align:right;font-size:14px; background: #F5F5F5;">TOTAL</td>
<td style="text-align:center;padding:8px;font-size:14px;white-space:nowrap; background: #F5F5F5;" colspan="2"><b>$'.$final_totalbefore.' NZD</b></td></tr><tr>
<td colspan="4" style="padding:8px;text-align:right;font-size:14px; background: #F5F5F5;">SHIPPING CHARGE</td>
<td style="text-align:center;padding:8px;font-size:14px;white-space:nowrap; background: #F5F5F5;" colspan="2"><b>$'.$final_shipping.' NZD</b></td></tr><tr>
<td colspan="4" style="padding:8px;text-align:right;font-size:14px; background: #F5F5F5;">GRANT TOTAL</td>
<td style="text-align:center;padding:8px;font-size:14px;white-space:nowrap; background: #F5F5F5;" colspan="2"><b>$'.$final_total.' NZD</b></td>
</tr>
<tr>
<td colspan="4" style="padding:8px;text-align:right;font-size:14px; background: #F5F5F5;">TRANSACTION ID.</td>
<td style="text-align:center;padding:8px;font-size:14px;white-space:nowrap; background: #F5F5F5;" colspan="2"><b>'.$transID_CREATED.'</b></td>
</tr>

 </table>
        
         
 
        <br>
        
<div style="border-top:1px solid #555;padding:10px;text-align:center">
    	D WALKER JEWELRY<strong></strong></a><br>
    	<div class="yj6qo"></div><div class="adL">
    </div></div>        <br>
<div class="yj6qo"></div><div class="adL">
    </div></div>';	
	
$subject= "SUCCESSFULL PAYMENT :: D WALKER JEWELRY";	
$email_admin = 'nzjewels@jdewalker.org';
$email_admin_cc = 'dwalkerjewels@gmail.com';
	
$this->load->library('email');
$config['protocol']    = 'smtp';
$config['smtp_host']    = 'ssl://smtp.gmail.com';
$config['smtp_port']    = '465';
$config['smtp_timeout'] = '7';
$config['smtp_user']    = 'techsofttest@gmail.com';
$config['smtp_pass']    = 'testpwd12345@';
$config['mailtype'] = 'text';
$config['validation'] = TRUE;  					
$config['charset'] = 'utf-8';				 
$config['newline'] = "\r\n";
$config['crlf'] = "\r\n";
$this->email->initialize($config);
$this->email->from('techsofttest@gmail.com','D WALKER JEWELRY');  
$this->email->to($email);
$this->email->cc($email_admin_cc);
$this->email->subject($subject);
$this->email->message($body);                
$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
$this->email->send();



$this->load->library('email');
$config['protocol']    = 'smtp';
$config['smtp_host']    = 'ssl://smtp.gmail.com';
$config['smtp_port']    = '465';
$config['smtp_timeout'] = '7';
$config['smtp_user']    = 'techsofttest@gmail.com';
$config['smtp_pass']    = 'testpwd12345@';
$config['mailtype'] = 'text';
$config['validation'] = TRUE;  					
$config['charset'] = 'utf-8';				 
$config['newline'] = "\r\n";
$config['crlf'] = "\r\n";
$this->email->initialize($config);
$this->email->from('techsofttest@gmail.com','D WALKER JEWELRY');  
$this->email->to($email_admin);
$this->email->subject($subject);
$this->email->message($body_admin);                
$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
$this->email->send();
																		
																								
		
	$this->session->set_flashdata('success', "Your Order is sucessfully completed for Trans ID ".$transID_CREATED.".<br> Thank You For Your Order.");   
	
	 $this->cart->destroy();
	redirect(base_url());
	 
    // $this->load->view('paypal/paymentSuccess', $data);
     }
      
     function paymentFail()
	 {
		 
		 
	$this->session->set_flashdata('error', "Sorry! Your last transaction was cancelled.");   
	redirect(base_url());
	 

        //$this->load->view('paypal/paymentFail');
     }
      
     function ipn(){
        //paypal return transaction details array
        $paypalInfo    = $this->input->post();
 
        $data['user_id'] = $paypalInfo['custom'];
        $data['product_id']    = $paypalInfo["item_number"];
        $data['txn_id']    = $paypalInfo["txn_id"];
        $data['payment_gross'] = $paypalInfo["mc_gross"];
        $data['currency_code'] = $paypalInfo["mc_currency"];
        $data['payer_email'] = $paypalInfo["payer_email"];
        $data['payment_status']    = $paypalInfo["payment_status"];
 
        $paypalURL = $this->paypal_lib->paypal_url;        
        $result    = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
         
        //check whether the payment is verified
        if(preg_match("/VERIFIED/i",$result)){
            //insert the transaction data into the database
            $this->product->storeTransaction($data);
        }
    }
}