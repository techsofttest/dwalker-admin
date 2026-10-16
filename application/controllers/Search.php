<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {



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
$keyword=$this->input->post('search');
	     $data['users']=$this->Admin_model->search($keyword);
		// print_r($data['users']);
		 //exit();
	   /*  $seocond_cms=array('seoid' => 4);
		 $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('visionmetal_seopage',$seocond_cms);*/
		 $data['main_category'] 	= 	$this->Admin_model->fetch_all('dwalker_category');
		 $data['categorys'] 	= 	$this->Admin_model->fetch_main_category();
		 $third_cms=array('seoid' => 3);
	     $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_seopage',$third_cms);
		 $cond_cmsfooter=array('contentId' => 5);
		$data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);
		 $this->load->view('user/search' , $data);
		
		
		
		/* $keyword=$this->input->post('headsearch');
	   //print_r($keyword);
	   $this->users=$this->Admin_model->search($keyword);
		//print_r($this->users);
		//exit();
		 $cond	=	array('c_id' => $pid);
		 $data['product']	=	$this->Admin_model->fetch_one_row('visionmetal_products',$cond);
		 $catID = $pid;
		 $data['allproducts'] =	$this->Admin_model->fetch_all_catproducts($catID);
		 $data['allcategory'] =	$this->Admin_model->fetch_all_category($catID);
		 $seocond_cms=array('seoid' => 4);
		 $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('visionmetal_seopage',$seocond_cms);
		$this->load->view('user/products');*/
	
	}
	public function searchkeyword()
	{
			$data['carts'] = $this -> cart -> contents();
		 $keyword=$this->input->post('search');
	     $data['users']=$this->Admin_model->search($keyword);
		// print_r($data['users']);
		 //exit();
	   /*  $seocond_cms=array('seoid' => 4);
		 $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('visionmetal_seopage',$seocond_cms);*/
		 $data['main_category'] 	= 	$this->Admin_model->fetch_all('dwalker_category');
		 $data['categorys'] 	= 	$this->Admin_model->fetch_main_category();
		 $third_cms=array('seoid' => 3);
	     $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_seopage',$third_cms);
		 $cond_cmsfooter=array('contentId' => 5);
		$data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);
		 $this->load->view('user/search' , $data);
	}
	
	
	
}