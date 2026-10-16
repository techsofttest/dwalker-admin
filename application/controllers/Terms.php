<?php
class Terms extends CI_Controller {
	
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
	
	public function index()
	{   
	$data['carts'] = $this -> cart -> contents();	
	$data['testimonial']=		$this->Admin_model->fetch_index_testimonial('dwalker_testimonial');
	$third_content=array('contentId' => '4');
	$data['cmsfour_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$third_content);
	$data['main_category'] 	= 	$this->Admin_model->fetch_all('dwalker_category');
	$data['categorys'] 	= 	$this->Admin_model->fetch_main_category();
	$cond_cmsfooter=array('contentId' => 5);
	$data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);
	$this->load->view('user/terms',$data);
		
	}

}