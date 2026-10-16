<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot_password extends CI_Controller {
		
		// construct
        public function __construct()
		{
				parent::__construct();
				$this->load->database();
                $this->load->library('form_validation');
				$this->load->helper(array('form', 'url'));               
				$this->load->library('session');	
	            $this->load->model('Admin_model');
				
        }
		
		// index        
 

	public function index()
		{
		

			if(!empty($_SERVER['HTTP_REFERER']))
			{
			$ret_url = $_SERVER['HTTP_REFERER'];
			}
			else
			{
			$ret_url = base_url();
			}


		if($_POST)

		{

		$this->form_validation->set_rules('email_r', 'email', 'required|valid_email');

		if ($this->form_validation->run() == FALSE) {
			// Validation failed, return to the form

			$flashdata = array(
				'type' => "error",
				'msg' => "Please try with correct details",
			);

				$this->session->set_flashdata('missing',$flashdata);

				redirect($ret_url);

			} else {


				$email = str_replace(" ","",$this->input->post('email_r',TRUE));

				$user = $this->Admin_model->check_data('dwalker_users','EMAIL_ID',$email);
				if(empty($user)){

					$flashdata = array(
						'type' => "error",
						'msg' => "User with this email address not found",
					);
		
						$this->session->set_flashdata('fornotfound',$flashdata);
						redirect($ret_url);
		
				}

				if(!empty($user))
				{
					


			//Generate Token And Update To Database

			$token_generated_time = date("Y-m-d H:i:s");
			
			$token = sha1(bin2hex(rand(10000000,99999999))); // bin2hex output is url safe.
			
			$token_data = array(
						  
						  'PASSOTP' => $token,
						  
						  'PASSOTPTIME' => $token_generated_time,

						  );
			
			$update_cond = array('USER_ID' => $user['USER_ID']);
			
			$this->Admin_model->update_all($token_data,$update_cond,'dwalker_users');	

						$title="Dwalker";

						$subject_mail ="Reset Password :: $title";

						$logo_link = base_url().'assets/images/logod.jpg';
						
						$reset_link =base_url().'ResetPassword/'.$token.'';
						
						
						$body='
							
				<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
								
				<tr>
						<td>
				<table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"			align="center" cellpadding="0" cellspacing="0">					<tr>																					<td style="height:80px;">&nbsp;</td></tr><tr>
				<td style="text-align:center;">
				<a href="'.base_url().'" title="logo" target="_blank">
				<img width="60" src="'.$logo_link.'" title="logo" alt="logo"></a></td></tr><tr>
				<td style="height:20px;">&nbsp;</td></tr><tr><td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);"><tr>
			<td style="height:40px;">&nbsp;</td></tr>
			<tr><td style="padding:0 35px;">
			<h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:"Rubik",sans-serif;">Password Reset</h1><span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
			<p style="color:#455056; font-size:15px;line-height:24px; margin:0;">							Please Click Below Link To Reset Your Password<br>
			Ignore If Not Done By You</p><a target="_blank" href="'.$reset_link.'" style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Reset Password</a></td></tr><tr><td style="height:40px;">&nbsp;</td></tr></table></td><tr><td style="height:20px;">&nbsp;</td></tr><tr><td style="text-align:center;"><p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>'.$title.'</strong></p></td></tr><tr><td style="height:80px;">&nbsp;</td></tr></table></tr>
							</table>
					';
					 $subject="Reset Password :: Dwalker";				
			   $this->load->library("phpmailer_library");
			   $mail = $this->phpmailer_library->load();
			   try {
					   //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
					   $mail->isSMTP();                                      // Set mailer to use SMTP
					   $mail->Host = 'ssl://smtp.gmail.com';  // Specify main and backup SMTP servers
					   $mail->SMTPAuth = true;                               // Enable SMTP authentication
					   $mail->Username = 'techsofttest@gmail.com';                 // SMTP username
					   $mail->Password = 'celzboqebpcusnce';                           // SMTP password
					   $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
					   $mail->Port = 465;                                    // TCP port to connect to
					   $mail->setFrom('techsofttest@gmail.com');
					   $mail->FromName = 'Dwalker';
					   $mail->addAddress($user['EMAIL_ID']); 		   
					   $mail->isHTML(true);                                
					   $mail->Subject = $subject;
					   $mail->Body    = $body;
					   $mail->AltBody = '';		   
					   $mail->send();					
							

							//Mail Function End


			$flashdata = array(
				'type' => "success",
				'msg' => "A password reset link has been sent to your email, Use that link to reset your password",
			);	

				$this->session->set_flashdata('Forget',$flashdata);

				redirect($ret_url);

				}

				
				  catch (Exception $e) {
						redirect($ret_url);
				}
			}



			}


		}

		else
		{

			redirect($ret_url);
			
		}

		}
		
	   
	}