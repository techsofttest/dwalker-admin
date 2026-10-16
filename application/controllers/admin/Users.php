<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller 
 {
	  public function __construct()
		{
				parent::__construct();
				$this->load->database();
    $this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text'));
    $this->load->model("Admin_model");			
				$this->load->library('image_lib');
				$this->load->library('session');
				if(!$this->session->userdata('adminId'))
				{
					redirect(base_url().'admin/login');	
				}	
				//get user details
        }
		
		
		
		public function index()
		{
		$data['seo_title'] = "View List Users | D WALKER JEWELRY";	
		$data['users']	=	$this->Admin_model->fetch_all_order_cond('dwalker_users','USER_ID','Desc',array());
		$data['subject_list']	=	$this->Admin_model->fetch_all('dwalker_template');
		$this->load->view('admin/view_users',$data);}
		
		public function ViewUsers($id)
		{
		$data['seo_title'] = "View List Users | D WALKER JEWELRY";	
		$data['users']	=	$this->Admin_model->fetch_all_order_cond('dwalker_users','USER_ID','Desc',array());
		$this->load->view('admin/view_single_user',$data);
	}

		
	  public function EditUsers($UsersId)
	  {

				$cond	=	array('USER_ID' => $UsersId);
				$data['user']	=	$this->Admin_model->fetch_one_row('dwalker_users',$cond);
		  $data['seo_title']=  "Edit List Users | D WALKER JEWELRY";
		  if($_POST):
		   $Users_data=array('FULLNAME'	=> $this->input->post('name'),
					'SADDRESS'	=> $this->input->post('address'),
					'MOBILE_NO'	=> $this->input->post('phone'),'EMAIL_ID'	 => $this->input->post('email'),
					'COUNTRY'	 => $this->input->post('country')); 		 
		   $edit 	= 	$this->Admin_model->update_all($Users_data,$cond,'dwalker_users');
		   $this->session->set_flashdata('success','Users details Updated Succesfully');			
				redirect(base_url().'admin/Users/EditUsers/'.$UsersId);
				endif;				
				
		  $this->load->view('admin/edit_users',$data);	
	} 	 
		public function  DeleteUsers($pid)
		{
		  
		  $this->db->where('USER_ID',$pid);
		  $this->db->delete('dwalker_users');
		  $this->session->set_flashdata('success', 'User Deleted Successfully.'); 
		  redirect(base_url().'admin/Users');
		}
		
		
		public function  Sendmail(){	
		    
    $item 		= $this->input->post('item');	
				$subject	=  $this->input->post('subject');			
				$team	=  $this->input->post('team');

			 $data['sub'] = 	$this->Admin_model->fetch_one_row('dwalker_template',array('tem_id'=>$subject));			
    $body =
					'<html>
						<head>

						<style>
						
						hr.rounded {
							border-top: 5px solid #1ab480;
							border-radius: 5px;
						}
						
						.header_logo
						{
								height: 100px;
						}
						
						.main_head
						{
							font-size:25px;
						}
						
						</style>

						</head>
						

						<body>
						
						<table width="100%">
						
						
						<tr>
						
						<th align="left" valign="" class="main_head">'.$data['sub']['title'].'</th>
						
						<th align="right"><img src="https://techsoftwebsolutions.com/techsoft/demo/labels-of-mind/assets/images/pdf.png" style="width:130px;></th>
						
						</tr>
						
						
						</table>
						
							<table width="100%">
						
					
							<div style="text-align:left">'
							.$data['sub']['content'].'
							</div>
						
					</table>
					
						<table width="100%">
						
						<tr>						
						</tr>						
						</table>				
						
						<br>
						
						<div style="border-top:1px solid #1ab480;padding:10px;text-align:center">
								© Dwalker<strong></strong></a><br>
								<div class="yj6qo"></div><div class="adL">
							</div></div>        <br>
						<div class="yj6qo"></div><div class="adL">
							</div></div>
							
							</body>
							</html>
							';
				
			
			
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
$config['smtp_pass']    = '*2]c-E6FR6V;';



$config['mailtype'] = 'text'; // or html
$config['validation'] = TRUE; // bool whether to validate email or not  
					
					
					
					$config['charset'] = 'utf-8';				 
					$config['newline'] = "\r\n";
					$config['crlf'] = "\r\n";
					$this->email->initialize($config);
					//$this->email->from('techsofttest@gmail.com','D WALKER JEWELRY');  
					
					$this->email->from('mailus@dwalker.co.nz','D WALKER JEWELRY'); 
					
							                                                      
						
						$subject = "D WALKER JEWELRY";
					
						
						//$this->email->to($user_email);
						
						//$this->email->to('nzjewels@jdewalker.org');
						//$this->email->to("techsofttest@gmail.com");
						
						if(!empty($item)){
						foreach($item as $it){
							$data['email'] = $this->Admin_model->fetch_one_row('dwalker_users',array('USER_ID'=>$it));		
							$emails = $data['email']['EMAIL_ID'];				
						$this->email->to('techsofttest@gmail.com');
						}} else {
							$this->email->to('techsofttest@gmail.com');
						}
						 
						$this->email->subject($subject);			
						$this->email->message($body);                
						$this->email->set_newline("\r\n");
						$this->email->set_mailtype("html");
 
						//$this->email->send();
						if(!$this->email->send()){						
						   $data['msg']=0;	
							}else{
								$data['msg']=1;	
							}
						
					echo json_encode($data);		
			}
	


 }