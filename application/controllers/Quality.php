<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Quality extends CI_Controller {



  public function __construct()

		{

			parent::__construct(); 

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
		$cond_cms=array('contentId' => 2);
		$data['cms_data'] 	= 	$this->Admin_model->fetch_one_row('finagro_content',$cond_cms);
		
		$seocond_cms=array('seoid' => 9);
		$data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('finagro_seopage',$seocond_cms);
	
	$cond_cmsfooter=array('contentId' => 5);
		$data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);
		
		
      $this->load->view('user/quality',$data);
	
	}
	
	
	
}