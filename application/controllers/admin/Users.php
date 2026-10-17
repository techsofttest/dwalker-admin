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
						$this->load->config('email', TRUE);

						$from_email = $this->config->item('from_email') ?: 'mailus@dwalker.co.nz';
						$from_name  = $this->config->item('from_name') ?: 'D WALKER JEWELRY';

						$recipient_emails = array();

						if (!empty($item)) {
							foreach ($item as $it) {
								if (is_numeric($it)) {
									// Check dwalker_newsletter_subscribers first
									$subRow = $this->Admin_model->fetch_one_row('dwalker_newsletter_subscribers', array('id' => $it));
									if (!empty($subRow['email'])) {
										$recipient_emails[] = trim($subRow['email']);
									} else {
										// Fallback to dwalker_users
										$userRow = $this->Admin_model->fetch_one_row('dwalker_users', array('USER_ID' => $it));
										if (!empty($userRow['EMAIL_ID'])) {
											$recipient_emails[] = trim($userRow['EMAIL_ID']);
										}
									}
								} elseif (filter_var($it, FILTER_VALIDATE_EMAIL)) {
									$recipient_emails[] = trim($it);
								}
							}
						}

						$recipient_emails = array_unique(array_filter($recipient_emails));

						if (empty($recipient_emails)) {
							echo json_encode(array('status' => 0, 'msg' => 0, 'message' => 'No recipients selected'));
							return;
						}

						$subject_title = !empty($data['sub']['title']) ? $data['sub']['title'] : 'D WALKER JEWELRY';

						$success_count = 0;
						foreach ($recipient_emails as $recipient) {
							$this->email->clear(TRUE);
							$this->email->from($from_email, $from_name);
							$this->email->to($recipient);
							$this->email->subject($subject_title);
							$this->email->message($body);
							$this->email->set_mailtype("html");

							if (@$this->email->send()) {
								$success_count++;
							}
						}

						$data['msg'] = ($success_count > 0) ? 1 : 0;
						$data['status'] = ($success_count > 0) ? 1 : 0;
						echo json_encode($data);
			}

	


 }