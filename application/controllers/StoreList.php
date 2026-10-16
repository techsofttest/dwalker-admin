<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class StoreList extends CI_Controller {



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
		
		$seocond_cms=array('seoid' => 7);
		$data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('finagro_seopage',$seocond_cms);
		
		$data['stores']     =   $this->Admin_model->fetch_all('finagro_storelist'); 
	$cond_cmsfooter=array('contentId' => 5);
		$data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);
		
		
      $this->load->view('user/storelist',$data);
	
	}
	
	
	function Searching()
	{
	/*Header*/  
		
	/*Header*/  
	$seocond_cms=array('seoid' => 7);
		$data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('finagro_seopage',$seocond_cms);	
	
		
	 $data['all_products'] = $this->Admin_model->search_products_any($_GET['headsearch']);
	 //echo count($data['all_products']);exit;
	$this->load->view('user/search',$data);	
	
		}
	
	
	
}