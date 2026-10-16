<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {



  public function __construct()

		{

			parent::__construct(); 

			$this->load->library('form_validation');

			$this->load->helper(array('form', 'url', 'text'));

	  $this->load->model("Admin_model");

   $this->load->library('session');	

   $this->load->library('cart');	

        }

	

	public function index($name)

	{
		$data['carts'] = $this -> cart -> contents();
	  $data['testimonial']=		$this->Admin_model->fetch_index_testimonial('dwalker_testimonial');
	 $cond	=	array('SlugName' => $name);
		
		$data['categorymain_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_subcategorysub',$cond);
		 $id = $data['categorymain_data']['subcatsub_id'];
		
		$data['subcatsubprod']	=	$this->Admin_model->fetch_subcat_subprod($id);
		$data['main_category'] 	= 	$this->Admin_model->fetch_all('dwalker_category');
		$data['types']	=	$this->Admin_model->fetch_all('dwalker_type');
		$data['categorys'] 	= 	$this->Admin_model->fetch_main_category();
		$third_cms=array('seoid' => 3);
	    $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_seopage',$third_cms);
		$cond_cmsfooter=array('contentId' => 5);
		$data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);
		//print_r($data['type']);
		//exit();
		$this->load->view('user/category',$data);
	}
	
	

			

	

}