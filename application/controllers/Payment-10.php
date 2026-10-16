<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller
{
    function  __construct() {
        parent::__construct();
        $this->load->library('paypal_lib');
		      $this->load->model('Admin_model');
		 	    $this->load->library('cart');
                
        $this->load->database(); 
    }
     
   
    

    function index()
    {

    if(empty($this->session->userdata('order_id_pay')))
    {
        $this->session->set_flashdata('error','Session Expired');
        redirect(base_url());
    }

    $order_id = $this->session->userdata('order_id_pay');

    $order_cond = array('payId' => $order_id);

    $order_details = $this->Admin_model->fetch_one_row('dwalker_payments',$order_cond);

    $pay_amount = floatval($order_details['payTotal']);

    $pay_amount = number_format($pay_amount, 2, '.', '');


    $url = 'https://sec.windcave.com/api/v1/sessions';
    
    //$url = "https://uat.windcave.com/api/v1/sessions"; 
    
    $content = '{

    "type": "purchase",

    "amount": "'.$pay_amount.'",

    "currency": "NZD",

     "merchantReference": "'.$order_id.'",

    "callbackUrls": {

    "approved": "'.base_url().'Payment/Success",

    "declined": "'.base_url().'Payment/Failed",

    "cancelled": "'.base_url().'Payment/Cancel"

  },

  "notificationUrl": ""

}';

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($curl, CURLOPT_HTTPHEADER,array("Content-type: application/json","Authorization: Basic ZHdhbGtlcmpld2Vsc1JFU1RfZGV2OmNkZGE5OTQyZGJlMThiZjliYTI1ZTdkYThhM2RhMGM5NjNlOGYxNDE5OWY5NGVmZjY1ZTE4YmI0ZmNkMDRiY2Y="));
curl_setopt($curl, CURLOPT_HTTPHEADER,array("Content-type: application/json","Authorization: Basic S1JWTGltaXRlZF9SZXN0OjJlNmU5YTdkNzhiYWYzYTFkODI5MzYxNGU4MzE1MWZhMjkxN2FlNWIxZmZiYmIwNWMwYWQ0YWUzOGUzOTVmZGI="));
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

$json_response = curl_exec($curl);

$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

/*
if ( $status != 201 ) {
    die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
}
*/


curl_close($curl);

$response = json_decode($json_response, true);

//var_dump ($response);

//exit;



$pg_url = "";


if(!empty($response['id']))

{

          $sess_id = $response['id'];

          //Update Session Id To Order

          $length_code = 6;
          $string_code = substr(str_repeat(0, $length_code).$this->session->userdata('TransId'), - $length_code);
          $orderID_FINAL = "DWJ-ORDER#".$string_code;

          $update_order_cond = array('payId' => $order_id);

          $update_order_data = array('paySessionId'=> $sess_id,'payOrderid'=>$orderID_FINAL);

          $this->Admin_model->update_all($update_order_data,$update_order_cond,'dwalker_payments');
          

          if(!empty($response['links']))

          {
               foreach($response['links'] as $link)
               {

                if($link['rel']=="hpp")
                {
                 $pg_url = $link['href'];
                }

               }

          }

          else
          {

         $this->session->set_flashdata('success', "Sorry! Your last transaction failed."); 

          }


         redirect($pg_url);



    }


    else
    {


     $this->session->set_flashdata('success', "Sorry! Your last transaction failed.");   
     redirect(base_url());


    }


    }





    function Notification()
    {


     //Notification Check
    
     $transaction_id = $_GET['sessionId'];

   $url = "https://sec.windcave.com/api/v1/transactions/".$transaction_id;
   
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic S1JWTGltaXRlZF9SZXN0OjJlNmU5YTdkNzhiYWYzYTFkODI5MzYxNGU4MzE1MWZhMjkxN2FlNWIxZmZiYmIwNWMwYWQ0YWUzOGUzOTVmZGI="));
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

   $json_response = curl_exec($curl);

   $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

/*
if ( $status != 201 ) {
    die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
}
*/


curl_close($curl);

$response = json_decode($json_response, true);

var_dump ($response);

exit;


     //


    }







    function Success()

    {

     //Update Order Status

    //  $sess_id = $_GET['sessionId'];

      $update_order_cond = array('paySessionId' => "000008012262215808266e1e4c3550ab");

    //  $update_order_data = array('payStatus'=> 1, 'payDate'=>date('Y-m-d'));

    //  $this->Admin_model->update_all($update_order_data,$update_order_cond,'dwalker_payments');

     $order_det = $this->Admin_model->fetch_gift_details($update_order_cond);

     $this->session->unset_userdata('order_id_pay');

     $this->session->unset_userdata('TransId');

     $this->cart->destroy();     
     
$imageShow = $order_det['Image'];

     
     /* Mail  */
     
     
     	$body  = '<div style="font-family:Arial,Helvetica,sans-serif; line-height:18px;">
				 <p>Dear Admin,</p>
				 
				 <p>You have received a new order from <b>'.$order_det['payName'].'</b></p>
				 
				 <table width="600" border="0" cellpadding="0" cellspacing="0">
				  <tbody><tr>
					<td align="left" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #c4891f">
					  <tbody><tr style="">
						<td align="left" valign="top" background="" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tbody><tr>
							<td width="100%" align="left" valign="top" colspan="2" style="text-align:center; padding: 2%; border-bottom:1px solid #c4891f;">
							<h4 style="text-transform: uppercase;font-size: 26px;color: #58595b;font-weight: 800;">D WALKER JEWELRY</h4>
							</td>
							
						  </tr>
						</tbody></table></td>
					  </tr>
					  <tr>
						<td height="22" align="center" valign="top" bgcolor="#FFFFFF"><table width="92%" border="0" cellspacing="0" cellpadding="0">
						  <tbody><tr>
							<td height="14" align="left" valign="middle">&nbsp;</td>
						  </tr>
						  <tr>
							<table align="center" width="500px" cellpadding="5">
								<thead style="background-color:#ce0707;color:white">
								<tr><th colspan="2"><h3>New Order</h3></th></tr>
								</thead>
								<tbody style="background-color:#eee">
								<tr><th>Name</th><td>'.$order_det['payName'].'</td></tr>								
								<tr><th>Phone</th><td>'.$order_det['payPhone'].'</td></tr>								
								<tr><th>Product</th><td>'.$order_det['payProduct'].'</td></tr>								
								<tr><th>Amount</th><td>'.$order_det['payTotal'].'</td></tr>
                <thead style="background-color:#5aa0dc;color:white">
								<tr><th colspan="2"><h3>Complimentary Details</h3></th></tr>
								</thead>               
                <tr><th>Type</th><td>'.$order_det['Mugtype'].'</td></tr>
                <tr><th>Size</th><td>'.$order_det['Mugsize'].'</td></tr>
                <tr><th>Photo Area</th><td>'.$order_det['Photoarea'].'</td></tr>
                <tr><th>Color</th><td><img src="cid:'.$imageShow.'" border="0"></td></tr>    

								</tbody>
								</table>
						  </tr>
						  
						   <tr>
							<td align="left" valign="top">&nbsp;</td>
						  </tr>
						  <tr>
							<td align="left" valign="top">&nbsp;</td>
						  </tr>
						  
						   <tr>
							<td style="border-top:1px solid #c4891f; padding:10px; text-align:center;">&nbsp;</td>
							
						  </tr>
						 
						  
						  <tr>
						  <td align="center" valign="top" style="font-family:Tahoma;font-size:12px;font-weight:normal;color:#333333;text-decoration:none"><strong>D WALKER JEWELRY</strong></td>
						  </tr>
						
						  <tr>
							<td align="left" valign="top">&nbsp;</td>
						  </tr>
						</tbody></table></td>
					  </tr>
					  
					  <tr>
						<td align="left" valign="middle">&nbsp;</td>
					  </tr>
					  
					  
					</tbody></table></td>
				  </tr>
				</tbody></table>';
				
		
			
$this->load->library('email');
					
$config['protocol']    = 'smtp';

/*
$config['smtp_host']    = 'ssl://smtp.gmail.com';
$config['smtp_port']    = '465';
$config['smtp_timeout'] = '7';
$config['smtp_user']    = 'techsofttest@gmail.com';
$config['smtp_pass']    = 'testpwd12345@';
*/


$config['smtp_host']    = 'mail.dwalker.co.nz';
$config['smtp_port']    = '587';
$config['smtp_timeout'] = '7';
$config['smtp_user']    = 'mailus@dwalker.co.nz';
$config['smtp_pass']    = '{~&5O?ay~!XO';



$config['mailtype'] = 'text'; // or html
$config['validation'] = TRUE; // bool whether to validate email or not  
					
					
					
					$config['charset'] = 'utf-8';				 
					$config['newline'] = "\r\n";
					$config['crlf'] = "\r\n";
					$this->email->initialize($config);
					//$this->email->from('techsofttest@gmail.com','D WALKER JEWELRY');  
					
					$this->email->from('mailus@dwalker.co.nz','D WALKER JEWELRY'); 
					                              
						
						$subject = "{$order_det['payOrderID']} :: D WALKER JEWELRY";
					
						
						//$this->email->to($user_email);
						
						//$this->email->to('nzjewels@jdewalker.org');
						
						$this->email->to('techsofttest@gmail.com');
						 
						$this->email->subject($subject);
						
						$this->email->reply_to($cemail, $cname);
						$this->email->message($body);                
						$this->email->set_newline("\r\n");
						$this->email->set_mailtype("html");
            $this->email->attach("http://localhost/dwalker/uploads/Gift/{$imageShow}", "inline");
						$this->email->send();
     
     
     /* ### */
     
     
     
     
     
     
     
     
     
     

     $this->session->set_flashdata('success', "Your Order is sucessfully completed for Trans ID ".$order_det['payOrderID'].".<br> Thank You For Your Order.");   

     redirect(base_url());

    }


    function Failed()
    {

     $this->session->set_flashdata('success', "Sorry! Your last transaction failed.");   
     $this->session->unset_userdata('order_id_pay');
     $this->session->unset_userdata('TransId');
	 redirect(base_url());

    }



    function Cancel()
    {

     $this->session->set_flashdata('success', "Sorry! Your last transaction was Cancelled.");   
     $this->session->unset_userdata('order_id_pay');
     $this->session->unset_userdata('TransId');
	 redirect(base_url());

    }
    
    



}