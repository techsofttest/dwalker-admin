<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Cashondelivery extends CI_Controller

{

    function  __construct() {

    parent::__construct();  

    $this->load->model('Admin_model');

				$this->load->helper(array('form', 'url', 'text'));

    $this->load->library('cart');                

    $this->load->database(); 

    } 

    function index()

    {
					
     $update_order_cond = array('TransId' => $this->session->userdata('TransId'));					

					$data['order_det'] = $this->Admin_model->fetch_one_row('dwalker_payments', $update_order_cond);

     $update_order_data = array('payStatus'=> 3, 'payDate'=>date('Y-m-d'));			

     $this->Admin_model->update_all($update_order_data,$update_order_cond,'dwalker_payments');

     $order_det = $this->Admin_model->fetch_gift_details($update_order_cond);

     $this->session->unset_userdata('order_id_pay');

     $this->session->unset_userdata('TransId');

     $this->cart->destroy();  
     
     $imageShow = base_url()."uploads/Gift/".$order_det['photo'];        

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
					
      $this->email->to('techsofttest@gmail.com');						 

						$this->email->subject($subject);						

						$this->email->reply_to($cemail, $cname);

						$this->email->message($body);                

						$this->email->set_newline("\r\n");

						$this->email->set_mailtype("html");

						$this->email->send(); 

     $this->session->set_flashdata('success', "Your Order is sucessfully completed for Trans ID ".$order_det['OrderID'].".<br> Thank You For Your Order.");   

     redirect(base_url());
    }


}