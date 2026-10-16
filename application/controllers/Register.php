<?php

class Register extends CI_Controller {

	function __construct()
	{

		  parent::__construct();
				$this->load->database();
    $this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text'));
    $this->load->model("Admin_model");
				$this->load->library('session');		
    $this->load->library('cart');
			}

	

public function index(){

$cond_cms=array('seoid' => 2);
$data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_seopage',$cond_cms);
$data['categorys'] 	= 	$this->Admin_model->fetch_main_category();
$cond_cmsfooter=array('contentId' => 5);
$data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);

if(!empty($_SERVER['HTTP_REFERER']))
{
$ret_url = $_SERVER['HTTP_REFERER'];
}
else
{
$ret_url = base_url();
}

 if($_POST) {

   $this->form_validation->set_rules('name', 'Name', 'required');
   $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
   $this->form_validation->set_rules('phone', 'Phone', 'required');
   $this->form_validation->set_rules('address', 'address', 'required');
   $this->form_validation->set_rules('country', 'country', 'required');
   if ($this->form_validation->run() == FALSE) {
   // Validation failed, return to the form   
    $this->session->set_flashdata('notification','msg');
    redirect($ret_url);

   } else {
    $name = $this->input->post('name',TRUE);
    $email = str_replace(" ","",$this->input->post('email',TRUE));
    $phone = str_replace(" ","",$this->input->post('phone',TRUE));
    $password = str_replace(" ","",$this->input->post('password',TRUE));
    
    $email_check = $this->Admin_model->check_data('dwalker_users','EMAIL_ID',$email);

    $phone_check = $this->Admin_model->check_data('dwalker_users','MOBILE_NO',$phone);	

   if(!empty($email_check)) {     
 
      $this->session->set_flashdata('Emailexist','msg');
 
      redirect($ret_url);

    }
    if(!empty($phone_check))
    {
      $this->session->set_flashdata('Phoneexist','msg'); 
      redirect($ret_url);
    }		

     $user_data = array(

      'FULLNAME' => $name,

      'EMAIL_ID' => $email,

      'MOBILE_NO' => $phone,

      'PASSWORD'   => sha1($password),

      'COUNTRY' => $this->input->post('country'),

      'REG_DATE' => date('Y-m-d'),

      'SADDRESS'=>$this->input->post('address'));

    $uid =	$this->Admin_model->insertsection('dwalker_users',$user_data);
    $this->session->set_flashdata('regi', 'registration success');
    
    $this->session->set_userdata('userid', $uid);
    redirect(base_url()."register/Profile");

   }
 }
      $this->load->view("user/register",$data);
}


public function Login()
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
 
 $this->form_validation->set_rules('username', 'Email', 'required|valid_email');
 $this->form_validation->set_rules('password', 'Password', 'required');

 if ($this->form_validation->run() == FALSE) {
  // Validation failed, return to the form

  $this->session->set_flashdata('notification','msg');
  redirect($ret_url);

  } else {

  $email_user = str_replace(" ","",$this->input->post('username'));
  $password = str_replace(" "," ",sha1($this->input->post('password')));  
  $login = $this->Admin_model->CheckLogin($email_user,$password); 

  if(!empty($login))
  {
   
 $this->session->set_flashdata('login',"login success"); 
 $this->session->set_userdata('userid', $login['USER_ID']);
 $this->session->set_userdata('Username', $login['FULLNAME']);        
 redirect(base_url().'register/Profile');
  }

  else
  {			
    $this->session->set_flashdata('notlogin',"not found");
    redirect($ret_url);

  }

  
  }

}
else
{

 redirect($ret_url);

}
  
} 

public function Profile()
{
 $cond_cms=array('seoid' => 2);
 $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_seopage',$cond_cms);
 $data['categorys'] 	= 	$this->Admin_model->fetch_main_category();
 $cond_cmsfooter=array('contentId' => 5);
 $data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);
 $data['user_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_users',array('USER_ID' => $this->session->userdata('userid')));
 $this->load->view("user/profile",$data);
}  

public function Logout()
{

 $this->session->unset_userdata('userid');
 $this->session->unset_userdata('Username'); 
 redirect(base_url()); 

} 


public function Update(){
$cond_cms=array('seoid' => 2);
$data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_seopage',$cond_cms);
$data['categorys'] 	= 	$this->Admin_model->fetch_main_category();
$cond_cmsfooter=array('contentId' => 5);
$data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);
$data['user_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_users',array('USER_ID' => $this->session->userdata('userid')));

   $this->form_validation->set_rules('name', 'Name', 'required');
   $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
   $this->form_validation->set_rules('phone', 'Phone', 'required');
   $this->form_validation->set_rules('country', 'country', 'required');
   if ($this->form_validation->run() == FALSE) { 
   
   // Validation failed, return to the form   
    $this->session->set_flashdata('notification','msg');
    redirect(base_url()."register/Profile");

   } else {
    $name = $this->input->post('name',TRUE);
    $email = str_replace(" ","",$this->input->post('email',TRUE));
    $phone = str_replace(" ","",$this->input->post('phone',TRUE)); 
    if($data['user_data']['EMAIL_ID'] != $email){
    $email_check = $this->Admin_model->check_data('dwalker_users','EMAIL_ID',$email);
    }

    if($data['user_data']['MOBILE_NO'] != $phone){
    $phone_check = $this->Admin_model->check_data('dwalker_users','MOBILE_NO',$phone);	
    }

   if(!empty($email_check)) {     
 
      $this->session->set_flashdata('Emailexist','msg');
 
      redirect(base_url()."register/Profile");

    }
    if(!empty($phone_check))
    {
      $this->session->set_flashdata('Phoneexist','msg'); 
      redirect(base_url()."register/Profile");
    }		

     $user_data = array(

      'FULLNAME' => $name,

      'EMAIL_ID' => $email,

      'MOBILE_NO' => $phone,    

      'COUNTRY' => $this->input->post('country'));

    $uid =	$this->Admin_model->update_all($user_data, array('USER_ID'=>$this->session->userdata('userid')),'dwalker_users');
    $this->session->set_flashdata('update', 'Update');
    redirect(base_url()."register/Profile");

   }
 
      $this->load->view("user/register",$data);
}


  public function Address(){ 
  $cond_cms=array('seoid' => 2);
  $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_seopage',$cond_cms);
  $data['categorys'] 	= 	$this->Admin_model->fetch_main_category();
  $cond_cmsfooter=array('contentId' => 5);
  $data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);
  $data['user_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_users',array('USER_ID' => $this->session->userdata('userid')));  
  if($_POST){ 
    $user_data = array('SADDRESS' => $this->input->post('address'));
    $uid =	$this->Admin_model->update_all($user_data, array('USER_ID'=>$this->session->userdata('userid')),'dwalker_users');
    $this->session->set_flashdata('update', 'Update');
    redirect(base_url()."register/Address");
  } 
    $this->load->view("user/address",$data);
  }  
  
  public function Changepassword(){ 
    $cond_cms=array('seoid' => 2);
    $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_seopage',$cond_cms);
    $data['categorys'] 	= 	$this->Admin_model->fetch_main_category();
    $cond_cmsfooter=array('contentId' => 5);
    $data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);
    $data['user_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_users',array('USER_ID' => $this->session->userdata('userid')));  
    if($_POST){ 
      $user_data = array('PASSWORD' => sha1($this->input->post('new_pass')));
      $uid =	$this->Admin_model->update_all($user_data, array('USER_ID'=>$this->session->userdata('userid')),'dwalker_users');
      $this->session->set_flashdata('update', 'Update');
      redirect(base_url()."register/Changepassword");    
    } 
      $this->load->view("user/changepassword",$data);
    }  

    public function Fetchpass(){ 
      $cpass = sha1($this->input->post("cpass"));      
      $data['user_data'] = $this->Admin_model->fetch_one_row('dwalker_users',array('USER_ID' => $this->session->userdata('userid')));  
      if($cpass != $data['user_data']['PASSWORD']){     
        $data['msg'] = 0;
      }
      echo json_encode($data);
    }

    public function Paidorders(){ 
      $cond_cms=array('seoid' => 2);
      $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_seopage',$cond_cms);
      $data['categorys'] 	= 	$this->Admin_model->fetch_main_category();
      $cond_cmsfooter=array('contentId' => 5);
      $data['cmsfooter_data'] 	=  $this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);
      $data['paid'] 	= 	$this->Admin_model->fetch_data('dwalker_payments',array('USER_ID' => $this->session->userdata('userid'),'payStatus'=>1));  
      $this->load->view("user/paidorders",$data);
      }  

      public function Cash_on_delivery(){ 
        $cond_cms=array('seoid' => 2);
        $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_seopage',$cond_cms);
        $data['categorys'] 	= 	$this->Admin_model->fetch_main_category();
        $cond_cmsfooter=array('contentId' => 5);
        $data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);
        // $data['cash'] 	= 	$this->Admin_model->fetch_data('dwalker_payments',array('USER_ID' => $this->session->userdata('userid'),'payStatus'=>3)); 
        $data['main_order'] 	= 	$this->Admin_model->fetch_one_row('dwalker_payments',array('USER_ID' => $this->session->userdata('userid'),'payStatus'=>3));
        $data['cash'] 	= 	$this->Admin_model->fetch_data('dwalker_order_products',array('OrderID' => $data['main_order']['payID'])); 
        $this->load->view("user/cash-on-delivery",$data);
        }  


        public function GenerateInvoice($id)
	{

		$order = $this->Admin_model->fetch_one_row('dwalker_payments',array('payID'=>$id));		
		$cartproduct	=	$this->Admin_model->product_cart($id);
		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Dwalker');
		$pdf->SetTitle('');
		$pdf->SetSubject('Invoice');		
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);	
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->AddPage();
		$html = '

		<table cellpadding="10">

		<tr>
		
		<th width="20%">

		<img src="'.base_url().'assets/images/pdf.png">

		</th>

		<th width="40%"></th>

		<th width="40%" align="right">
		<b>64+ 092501890</b><br>
		<b>dwalkerjewels@gmail.com</b>
		</th>

		</tr>

		</table>

		<table cellpadding="10">
		<tr>
		
		<th><b>Order ID </b> : '.$order['OrderID'].'</th>

		<th><b>Billing Address</b></th>

		<th><b>Shipping Address</b></th>

		</tr>
		

		<tr>
		
		<th><b>Order Date</b> : '.date('d-m-Y',strtotime($order['payDate'])).'</th>

		<th>
						<br>
						'.$order['payName'].'<br>
						'.$order['payAddress'].'<br>									
						'.$order['payPhone'].'<br>
						'.$order['payEmail'].'
		</th>

		<th>
		<br>
		'.$order['payName'].'<br>
		'.$order['payAddress'].'<br>							
		'.$order['payPhone'].'<br>
		'.$order['payEmail'].'
		</th>
		
		</tr>

		</table>';

		$html .='

				<table cellpadding="10" style="border-top:.5px solid black;">
				
				<tr>

				<td align="center"></td>

				<td align="center"></td>
			  
			 </tr>			

				<tr>
				<td align="center"></td>
				<td align="center"></td>			  
			 </tr>
				</table>				
			';


			$item_sec = "";

			foreach($cartproduct as $itm)
			{
				$item_sec .="
				
				<tr>

				<td>{$itm->payProduct}</td>
				
				<td>{$itm->payQuantity}</td>

				<td align=\"right\">Rs. {$itm->payPrice}</td>
				
				</tr>
				
				";
			}


			$ship_sec="";


			if(!empty($order['payShipping']))
			{

			$ship_sec .='
			
					<tr>
					
					<td align="right" colspan="2">Shipping Cost</td>
					<td align="right">Rs.'.$order['payShipping'].'</td>

					</tr>
			
			';

			}


			$discount_sec ="";

			if($order['promo_status']==1)
			{
   $promo_card = 
			$discount_sec .='
				<tr style="color:red;">		
				<td align="right" colspan="2"></td>			
					<td align="right">- Rs. '.$order['promo_dis'].'</td>
				</tr>
				';

			}


				$html .='

					<table cellpadding="10" border="1">

					<tr style="background-color:#071f75">
						
						<th width="60%;"><b style="color:white">Product</b></th>

						<th width="20%;color:white"><b style="color:white">Qty</b></th>

						<th width="20%;color:white"><b style="color:white">Price</b></th>
					
					</tr>
					

					'.$item_sec.'



					<tr>
					
					<td align="right" colspan="2" >Total</td>
					<td align="right">Rs. '.$order['payTotalbefore'].'</td>

					</tr>


					'.$ship_sec.'

					'.$discount_sec.'


					<tr>
					
					<td align="right" colspan="2" style="font-size:16px;"><b>Grand Total</b></td>
					<td align="right" style="font-size:16px;"><b>Rs. '.$order['payTotal'].'</b></td>

					</tr>

				</table>

				';
		

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output("{$order['OrderID']}.pdf", "I");


}

    
  
 }




