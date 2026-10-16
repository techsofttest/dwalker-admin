<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {



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
		$this->load->library('cart');	
		$data['testimonial']=		$this->Admin_model->fetch_index_testimonial('dwalker_testimonial');
		$cond_cms=array('contentId' => 1);
		$data['cms_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cms);
		$cond_cmsfooter=array('contentId' => 5);
		$data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);
		/*$seocond_cms=array('seoid' => 2);
		$data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('finagro_seopage',$seocond_cms);*/
		$data['main_category'] 	= 	$this->Admin_model->fetch_all('dwalker_category');
		$data['categorys'] 	= 	$this->Admin_model->fetch_main_category();
		$first_cms=array('seoid' => 1);
	    $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_seopage',$first_cms);
	    $this->load->view('user/about',$data);
	
	}
	
	
	
}