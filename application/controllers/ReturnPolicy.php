<?php

class ReturnPolicy extends CI_Controller {

	

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
	/*Header*/  

	/*$data['carts'] = $this -> cart -> contents();

	$data['wish_list_items']	=	$this->Home_model->fetch_all_wishlist($this->session->userdata('userid'));

	    $wish_listed_items ='';

		foreach($data['wish_list_items'] as $new)

		{

		$wish_listed_items .= $new->productID.',';

		}

		

		$data['wish_listed_items'] = explode(',',rtrim($wish_listed_items,","));

		

	$where_men       = 	array('MainCat' =>'Men','parent' => 0);

	$where_women     = 	array('MainCat' =>'Women','parent' => 0);

	$data['men_category'] = $this->Home_model->fetch_all_new_cond_datas('lm_category','catID','Desc',$where_men);	

	$data['women_category'] = $this->Home_model->fetch_all_new_cond_datas('lm_category','catID','Desc',$where_women);	

	$data['header_products'] = $this->Home_model->header_products();	*/

	/*Header*/  
$data['testimonial']=		$this->Admin_model->fetch_index_testimonial('dwalker_testimonial');
	$third_content=array('contentId' => '3');

	$data['cmsthird_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$third_content);

	$data['main_category'] 	= 	$this->Admin_model->fetch_all('dwalker_category');

	  $data['categorys'] 	= 	$this->Admin_model->fetch_main_category();

	  $forth_cms=array('seoid' => 5);

	  $data['seo_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_seopage',$forth_cms);

		$cond_cmsfooter=array('contentId' => 5);

		$data['cmsfooter_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cmsfooter);

      $this->load->view('user/returnpolicy',$data);

	

	

		

	}



}