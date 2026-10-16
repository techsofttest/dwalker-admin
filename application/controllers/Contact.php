<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {



  public function __construct()

		{

			parent::__construct(); 

			$this->load->library('form_validation');

			$this->load->helper(array('form', 'url', 'text'));

		    $this->load->model("Admin_model");

            $this->load->library('session');
			$this->load->library('cart');	

			//Gkey 6LdwC4YrAAAAAGmNy7SvfclTMq0zG-kMTZQXy--Z
			//GSecretKey 6LdwC4YrAAAAANleIzaZ4Uvkp3ajPNMSwLNEZDAB
           

        }

	

	public function index()

	{
		
		$data['carts'] = $this -> cart -> contents();
		$data['testimonial']=		$this->Admin_model->fetch_index_testimonial('dwalker_testimonial');
		/*$seocond_cms=array('seoid' => 6);
		$data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('finagro_seopage',$seocond_cms);*/
	  $data['main_category'] 	= 	$this->Admin_model->fetch_all('dwalker_category');
	  $data['categorys'] 	= 	$this->Admin_model->fetch_main_category();
	  $forth_cms=array('seoid' => 4);
	  $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_seopage',$forth_cms);
		$cond_cmsfooter=array('contentId' => 5);
		$data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);
      $this->load->view('user/contact',$data);
	  
	  
	  	
if(isset($_POST['contact_submit']))
  
{


			if(isset($_POST['g-recaptcha-response']))

        	$captcha=$_POST['g-recaptcha-response'];

			if(!$captcha){
				$this->session->set_flashdata('error', 'Please complete the captcha');
				redirect(base_url()."Contact");
			}

			$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdwC4YrAAAAANleIzaZ4Uvkp3ajPNMSwLNEZDAB&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
			if($response['success'] == false)
			{
				$this->session->set_flashdata('error', 'Captcha Failed');
				redirect(base_url()."Contact");
			}
			else
			{
	
                $cname 		=  $this->input->post('fname');
				$cemail	=  $this->input->post('email');
				$cphone 	=  $this->input->post('phone');
				$csubject 	=  $this->input->post('subject');
				$cmessage  	=  $this->input->post('messsage');		
				
				
				
				$body  = '<div style="font-family:Arial,Helvetica,sans-serif; line-height:18px;">
				 <p>Dear Admin,</p>
				 <p>You have received an enquiry from <b>'.$cname.'</b>. Contact him/her immediately.</p>
				 
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
								<tr><th colspan="2"><h3>CONTACT MESSAGE</h3></th></tr>
								</thead>
								<tbody style="background-color:#eee">
								<tr><th>Name</th><td>'.$cname.'</td></tr>
								<tr><th>Email</th><td>'.$cemail.'</td></tr>
								<tr><th>Mobile</th><td>'.$cphone.'</td></tr>
							    <tr><th>Subject</th><td>'.$csubject.'</td></tr>
								<tr><th>Message</th><td>'.$cmessage.'</td></tr>
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
					$this->load->config('email', TRUE);

					$from_email   = $this->config->item('from_email') ?: 'techsofttest123@gmail.com';
					$from_name    = $this->config->item('from_name') ?: 'D. Walker Jewellers';
					$admin_emails = $this->config->item('admin_emails') ?: 'dwalkerjewels@gmail.com, nair182002@gmail.com, techsofttest@gmail.com';

					$this->email->clear(TRUE);
					$this->email->from($from_email, $from_name);
					$this->email->to($admin_emails);
					$this->email->reply_to($cemail, $cname);
					$this->email->subject("Contact :: " . $from_name);
					$this->email->message($body);

						if(!$this->email->send()){
						
						show_error($this->email->print_debugger());
							
						}
						
						$this->session->set_flashdata('success', 'Message has been sent');
					    // echo $this->session->flashdata('success');
						//	exit();
						redirect(base_url().'Contact');


						}
			
			
			
			
			}
	
	
	}
	
	
	
	
	
	
	
	
			
	
}