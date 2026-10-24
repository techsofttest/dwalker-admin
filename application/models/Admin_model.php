<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_model {

	
	public function __construct() { 
		parent::__construct();
	}
	
	
public function get_profile_details($id)

	{

		$this->db->select('*');

        $this->db->from('dwalker_admin');

	    $this->db->where('adminId', $id);

	    $query = $this->db->get();

        return $query->result_array();

	}
	
	
public function get_pro_del($id)

	{
	$this->db->select('*');
	$this->db->from('dwalker_product');
	$this->db->where('subcat_id',$id);
	$query = $this->db->get();
	
	return $query->result_array();
	
		
	}

 public function get_sub_del()
 {
	$this->db->select('*');
	$this->db->from('dwalker_subcategorysub');
	$this->db->where('subcat_id',$id);
	$query = $this->db->get();
	
	return $query->result_array(); 
 }
	
	public function inserALL($table,$fields)
		{
			$this->db->insert($table,$fields);
			return ($this->db->insert_id());	
		}
	
	public function insertsection($table,$fields)
		{
			$this->db->insert($table,$fields);
			return ($this->db->insert_id());	
		}
			public function fetch_data($table,$fields)
		{
			$this->db->where($fields);
			$query = $this->db->get($table);
			return $query->result();
		}  
		public function fetch_all($table)
		{
			$query = $this->db->get($table);
			return $query->result();
		} 
		
		public function update_all($fields,$cond,$table)
		{
			return $this->db->update($table, $fields, $cond);
		}
		public function fetch_one_row($table,$cond)
		{
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($cond);
			$query  = $this->db->get();
			$row    = $query->row_array();		
			return $row;
		}

		public function fetch_gift_details($cond)
		{
			$this->db->select('*');
			$this->db->from('dwalker_payments');
			$this->db->join('dwalker_gift','dwalker_gift.gift_id = dwalker_payments.giftmodel','left');	
			$this->db->where($cond);
			$query  = $this->db->get();
			$row    = $query->row_array();		
			return $row;
		}

		
	public function get_login_details($classid,$mobilenumber)
         {
	    $array = array('classID' => $classid,'mobileNo'=>$mobilenumber);
	    $this->db->select('*');
		$this->db->from(' global_students');
		$this->db->where($array);
		$query  = $this->db->get();
		$row    = $query->row_array();		
	    return $row;
		
	  }
	  
	 
	  
	  
	  public function get_login_details_status($classid,$mobilenumber)
         {
	    $array = array('classID' => $classid,'mobileNo'=>$mobilenumber,'status'=>0);
	    $this->db->select('*');
		$this->db->from(' global_students');
		$this->db->where($array);
		$query  = $this->db->get();
		$row    = $query->row_array();		
	    return $row;
		
	  }
	
	
	
	public function fetch_service_front()
	{
	    $this->db->select('*');
		$this->db->from(' kochers_service');
		$this->db->order_by('kochers_service.Service_id','Desc');
		$this->db->limit(1, 0);
		$query  = $this->db->get();
		$return_list    = $query->result();	
		
	 return $return_list;
	
	} 
	public function fetch_service_admin()
	{
	    $this->db->select('*');
		$this->db->from(' kochers_service');
		$this->db->order_by('kochers_service.Service_id','Desc');
		
		$query  = $this->db->get();
		$return_list    = $query->result();	
		
	 return $return_list;
	
	} 
	public function fetch_service_service()
	{
	    $this->db->select('*');
		$this->db->from(' kochers_service');
		$this->db->order_by('kochers_service.Service_id','Desc');
		
		$query  = $this->db->get();
		$return_list    = $query->result();	
		
	 return $return_list;
	
	} 
	
	
	
	
	
	public function fetch_videogallery()
	{
	    $this->db->select('*');
		$this->db->from('kochers_video_gallery');
		$this->db->order_by('kochers_video_gallery.videoID','Desc');
		$query  = $this->db->get();
		$return_list    = $query->result();	
		
	 return $return_list;
	
	} 
	
	public function fetch_clientadmin()
	{
	    $this->db->select('*');
		$this->db->from('kochers_client');
		$this->db->order_by('kochers_client.c_id','Desc');
		$query  = $this->db->get();
		$return_list    = $query->result();	
		
	 return $return_list;
	
	} 

	
	
	public function fetch_proadmin()
	{
	    $this->db->select('*');
		$this->db->from('kochers_upcomingpro');
		$this->db->order_by('kochers_upcomingpro.Pro_id','Desc');
		$query  = $this->db->get();
		$return_list    = $query->result();	
		
	 return $return_list;
	
	} 
	
	
	public function fetch_serviceadmin()
	{
	    $this->db->select('*');
		$this->db->from('kochers_service');
		$this->db->order_by('kochers_service.Service_id','Desc');
		$query  = $this->db->get();
		$return_list    = $query->result();	
		
	 return $return_list;
	
	} 
	public function fetch_videogallery_front()
	{
	    $this->db->select('*');
		$this->db->from(' kochers_video_gallery');
		$this->db->order_by('kochers_video_gallery.videoID','Desc');
		
		$query  = $this->db->get();
		$return_list    = $query->result();	
		
	 return $return_list;
	
	} 
	
	
	public function fetch_products()
	{
	    $this->db->select('*');
		$this->db->from('finagro_products');
		$this->db->order_by('finagro_products.pro_id','Desc');
		$query  = $this->db->get();
		$return_list    = $query->result();	
		
		$i = 0;	
	  foreach($return_list as $prod)
	  {
		
		//$cond =array('b_id' => $prod->bl_id);
		//$return_list[$i]->bl_name = $this->fetch_data('akltcwa_blacklisted',$cond);		
		//$i++;
		
		 $query = $this->db->select('*')->from('finagro_category')->where('cat_id', $prod->c_id)->get();
    	$return_list[$i]->cat_name=$query->result();
		$i++;
		
		
	  }
	 return $return_list;
	
	} 
	
	
	
	
	
	
	
	public function fetch_prod()
	{
	    $this->db->select('*');
		$this->db->from('neobakery_products');
		$this->db->order_by('neobakery_products.pro_id','Desc');
		$query  = $this->db->get();
		$return_list    = $query->result();	
		
		
		 $query = $this->db->select('cat_name')->from('neobakery_category')->where('cat_id',$return_list['c_id'])->get();
    $return_result=$query->result();
		
		
		
	 
	 return $return_list;
	
	} 
	
	
	
	public function fetch_single_category($id)
	{
		$array= array('cat_id' => $id);
	    $this->db->select('*');
		$this->db->from('dwalker_category');
		$this->db->where($array);
		
		$query  = $this->db->get();
		$return_list    = $query->result();	
		
		
		
		
	 
	 return $return_list;
	
	}
	
	
	
	
	
	
	
	
	
	
	
	public function fetch_photogallery_front()
	{
	    $this->db->select('*');
		$this->db->from(' kochers_photocategory');
		$this->db->order_by('kochers_photocategory.id','Desc');
		$query  = $this->db->get();
		$return_list    = $query->result();	
		
		$i = 0;	
	  foreach($return_list as $prod)
	  {
		
		$cond =array('PhotoID' => $prod->id);
		$this->db->limit(1, 0);
		$return_list[$i]->photo = $this->fetch_data('kochers_photos',$cond);		
		$i++;
	  }
	 return $return_list;
	
	} 



	public function fetch_photogallery_front_home()
	{
	    $this->db->select('*');
		$this->db->from(' kochers_photocategory');
		$this->db->order_by('kochers_photocategory.id','Desc');
		$this->db->limit(6, 0);
		$query  = $this->db->get();
		$return_list    = $query->result();	
		
		$i = 0;	
	  foreach($return_list as $prod)
	  {
		
		$cond =array('PhotoID' => $prod->id);
		$this->db->limit(1, 0);
		$return_list[$i]->photo = $this->fetch_data('kochers_photos',$cond);		
		$i++;
	  }
	 return $return_list;
	
	} 
	
	public function search_products_any($term)
		{
			$this->db->where("store_location LIKE '%$term%' || store_address LIKE '%$term%'");
			
			
			$query = $this->db->get('finagro_storelist');
			//echo $this->db->last_query();
			return $query->result();
		}
	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
   public function fetch_all_category()
   {
	   $this->db->select('*');
	   $this->db->from('dwalker_category');
	   $this->db->order_by('dwalker_category.cat_id','Desc');
	   $query  = $this->db->get();
	   $return_list    = $query->result();
	   return $return_list;  
  }
 public function fetch_all_subcategory()
 {
	   $this->db->select('*');
	   $this->db->from('actrade_subcategory');
	   $this->db->order_by('actrade_subcategory.subcat_id','Desc');
	   $query  = $this->db->get();
	   $return_list    = $query->result();
	   return $return_list;   
	 }
	
  
  	public function get_subcat($getsubcat)
	{
	    $array = array('cat_id' => $getsubcat);
	    $this->db->select('*');
		$this->db->from('dwalker_subcategory');
		$this->db->where($array);
		$query  = $this->db->get();
		return $query->result();
	    //return $query->num_rows();
	}	

	public function fetch_all_product()
	{
	   $this->db->select('*');
	   $this->db->from('dwalker_product');
	   $this->db->order_by('dwalker_product.sort_order','ASC');
	   $this->db->order_by('dwalker_product.product_id','DESC');
	   $query  = $this->db->get();
	   $return_list    = $query->result();
	   return $return_list;
  }
    public function fetch_one_product($id)
	 {
		$query="select *from actrade_product where product_id = '".$id."'";
		$sql = $this->db->query($query);
		return $sql->result_array();
	}
	
	public function get_subcat_del()
	{
	$this->db->select('*');
	$this->db->from('dwalker_subcategory');
	$this->db->where('cat_id',$id);
	$query = $this->db->get();
	
	return $query->result_array();
		}
		
	public function get_subcatsub_del()
	{
	  $this->db->select('*');
	  $this->db->from('dwalker_subcategorysub');
	  $this->db->where('cat_id',$id);
	  $query = $this->db->get();
	 return $query->result_array();
	}
	public function get_product_del()
	{
	  $this->db->select('*');
	  $this->db->from('dwalker_product');
	  $this->db->where('cat_id',$id);
	  $query = $this->db->get();
	  return $query->result_array();
	}
	
	public function fetch_all_order_cond($table,$field,$cond,$array)
		{
			$this->db->order_by($field,$cond);
			$this->db->where($array);
			$query  = $this->db->get($table);
			return $query->result();
		} 
   
 public function get_subcatsub($getsubcatsub)
 {
	    $array = array('subcat_id' => $getsubcatsub);
	    $this->db->select('*');
		$this->db->from('dwalker_subcategorysub');
		$this->db->where($array);
		$query  = $this->db->get();
		return $query->result(); 
 }
 
	public function fetch_single_subcategory($id)
	{
		$array= array('cat_id' => $id);
	    $this->db->select('*');
		$this->db->from('dwalker_subcategory');
		$this->db->where($array);
		
		$query  = $this->db->get();
		$return_list    = $query->result();	
		return $return_list;
		}
	public function fetch_all_new($table,$field,$cond)
		{
			$this->db->order_by($field,$cond);
			$query = $this->db->get($table);
			return $query->result();
		} 
  public function fetch_index_limitprod()
  {
   $cond = array('upcoming' => 0);
	$this->db->select('*');
	$this->db->from('dwalker_product');
	$this->db->where($cond);
	$this->db->order_by('dwalker_product.sort_order','ASC');
	$this->db->order_by('dwalker_product.product_id','DESC');
	
	$query  = $this->db->get();
	$return_list    = $query->result();	
	return $return_list; 	
  }
  public function fetch_oneindex_limitprod()
  {
	    $cond = array('type' => 1);
	    $this->db->select('*');
		$this->db->from('dwalker_product');
		$this->db->where($cond);
		$this->db->order_by('product_id','Desc');
		$this->db->limit(1,0);
		$query  = $this->db->get();
		$return_list    = $query->result();	
		return $return_list;
  }
  public function fetch_moreindex_limitprod()
  {
	  $cond = array('type' => 1);
	  $this->db->select('*');
	  $this->db->from('dwalker_product');
	  $this->db->where($cond);
	  $this->db->order_by('product_id','Desc');
	  $this->db->limit(4,0);
	  $query  = $this->db->get();
	  $return_list    = $query->result();	
	  return $return_list;	
	   
  }
  
  
  
   public function fetch_productalls()
  {
   $cond = array('upcoming' => 0);
	$this->db->select('*');
	$this->db->from('dwalker_product');
	$this->db->where($cond);
	$this->db->order_by('dwalker_product.sort_order','ASC');
	$this->db->order_by('dwalker_product.product_id','DESC');
	
	$query  = $this->db->get();
	$return_list    = $query->result();	
	return $return_list; 	
  }
    public function fetch_productallsupcoming()
  {
   $cond = array('upcoming' => 1);
	$this->db->select('*');
	$this->db->from('dwalker_product');
	$this->db->where($cond);
	$this->db->order_by('dwalker_product.product_id','ASC');
	
	$query  = $this->db->get();
	$return_list    = $query->result();	
	return $return_list; 	
  }
  public function fetch_more_image($prodID)
  {
	 $array= array('product_id' => $prodID);
	 $this->db->select('*');
	 $this->db->from('dwalker_productimage');
	 $this->db->where($array);
	 $query  = $this->db->get();
	 $return_list    = $query->result();	
	 return $return_list;
  }
  public function fetch_sub_category()
  {
	 
	  $this->db->select('*');
	  $this->db->from('dwalker_subcategorysub');
	 // $this->db->where($cond);
	  $this->db->order_by('subcatsub_id','Desc');
	  $this->db->limit(5,0);
	  $query  = $this->db->get();
	  $return_list    = $query->result();	
	  return $return_list;	
  }
  public function fetch_related_product()
  
  {
   $cond = array('upcoming' => 0);
	  $this->db->select('*');
	  $this->db->from('dwalker_product');
	 $this->db->where($cond);
	
	  $query  = $this->db->get();
	  $return_list    = $query->result();	
	  return $return_list;	
  }
  public function search($keyword)
  {
	   $result = $this->db->like('product_name',$keyword)
            
             ->get('dwalker_product');
               // print_r($result);
				 //exit();
                 return $result->result_array();
  }
  public function fetch_subcat_subprod($id)
  {
	    $array= array('subcatsub_id' => $id);
	    $this->db->select('*');
		$this->db->from('dwalker_product');
		$this->db->where($array);
		$query  = $this->db->get();
		$return_list    = $query->result();	
		return $return_list;  
  }
  public function fetch_all_orders_completed($mode,$fromdate,$todate,$order)
  {	
				
		$this->db->select('*');
		$this->db->from('dwalker_payments');
		//$this->db->where('payStatus',$id);

		$this->db->where('Codflag',$mode);
		

		if(!empty($fromdate))
{
	$this->db->where('payDate>=',$fromdate);
}
if(!empty($todate)){
	$this->db->where('payDate<=',$todate);
}	
if(!empty($order)){
	$this->db->where('OrderID',$order);
}		
		$this->db->join('dwalker_gift','dwalker_gift.gift_id = dwalker_payments.giftmodel','left');	
		$this->db->order_by('payID','Desc');
		$query  = $this->db->get();
		$return_list    = $query->result();	
		
		return $return_list;  
  }



	public function fetch_single_order($id)
	{	
		$this->db->select('*');

		$this->db->from('dwalker_payments');

		$this->db->where('payID',$id);

		$this->db->join('dwalker_gift','dwalker_gift.gift_id = dwalker_payments.giftmodel','left');	

		$this->db->join('dwalker_product','dwalker_product.product_id = dwalker_payments.payProID','left');	

		$this->db->order_by('payID','Desc');

		$query  = $this->db->get();

		$return_list    = $query->row_array();	
		
		return $return_list;  
	}


	public function fetch_order_products($orderid)
	{

		$this->db->select('*');

		$this->db->from('dwalker_payments');

		$this->db->where('payID',$id);


	}





 public function fetch_main_category()
  {
	 
	 $this->db->select('*');
	 $this->db->from('dwalker_category');
	// $this->db->where($cond);
	 //$this->db->order_by('cat_id','Desc');
	 $query  = $this->db->get();
	 $return_list    = $query->result();	
		
		$i = 0;	
	  foreach($return_list as $userr)
	  {
		
		$cond =array('cat_id' => $userr->cat_id);
		$return_list[$i]->subcat = $this->fetch_data('dwalker_subcategory',$cond);		
		$i++;
	  }
	
	 $r = 0;
	 foreach($return_list as $cat)
	 {
		 $cond =array('cat_id' => $cat->cat_id);
		 $return_list[$r]->subcatsub = $this->fetch_data('dwalker_subcategorysub',$cond);	
		 $r++;
	 }
	//print_r($return_list);
	//exit();
	 return $return_list;
  }
  public function fetch_all_shippingcost()
  {
	 $this->db->select('*');
	 $this->db->from('dwalker_shipping');
	 $this->db->order_by('dwalker_shipping.shipping_id','Desc');
	 $query  = $this->db->get();
	 $return_list    = $query->result();
	 return $return_list;
 }
 public function get_shippingcost($countryID){
	$array = array('country_name' => $countryID);
	$this->db->select('*');
	$this->db->from('dwalker_shipping');
	$this->db->where($array);
	$query  = $this->db->get();
	return $query->result();
 } 
 public function fetch_all_countryshipcost(){
	 $this->db->select('*');
	 $this->db->from('dwalker_shipping');
	 $query= $this->db->get();
     $return_list = $query->result();
	$i=0;
	foreach($return_list as $countryname)
	 {
	   $cond_user = array('country_id' => $countryname->country_name);
	   $return_list[$i]->countryname = $this->fetch_data('dwalker_country',$cond_user);
	   $i++;	
	}
  return $return_list; 
	}
	 
	  public function fetch_index_testimonial()
  {
   
	$this->db->select('*');
	$this->db->from('dwalker_testimonial');
	
	$this->db->order_by('dwalker_testimonial.testi_id','Asc');
	
	$query  = $this->db->get();
	$return_list    = $query->result();	
	return $return_list; 	
  }
	 public function maxx_valuee()
		{
			
		
	    $this->db->select('*');
		$this->db->from('dwalker_payments');
		$this->db->order_by('payID','Desc');	
		$query  = $this->db->get();
		$row    = $query->row_array();		
		return $row;
		}
		 public function cartproduct($prodID)
  {
	 $array= array('TransId' => $prodID);
	 $this->db->select('*');
	 $this->db->from('dwalker_payments');
	 $this->db->where($array);
	 $query  = $this->db->get();
	 $return_list    = $query->result();	
	 return $return_list;
  }
	 
		public function product_cart($prodID)
  {
	 $array= array('OrderID' => $prodID);
	 $this->db->select('*');
	 $this->db->from('dwalker_order_products');
	 $this->db->where($array);
	 $query  = $this->db->get();
	 $return_list    = $query->result();	
	 return $return_list;
  }

		public function check_data($table,$col,$data)
		{
		
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($col,$data);
			$query = $this->db->get();
			return $query->row_array(); 

		}

		public function CheckLogin($username,$password)
		{
	
		$this->db->select('*');
	
		$this->db->from('dwalker_users');
	
		$this->db->where('EMAIL_ID',$username);
	
		$this->db->where('PASSWORD',$password);
	
		$query = $this->db->get();
	
		return $query->row_array();
	
		}

public function select_sum($table,$cond,$col)
	{	
		$this->db->select_sum($col);
		$this->db->from($table);
		$this->db->where($cond);
		$query = $this->db->get();
		$result =  $query->row(); 	
		return $result->$col;
		
	}	
	
		public function fetch_data_cashorder($cond)
		{
			$this->db->select('*');
			$this->db->from('dwalker_order_products');
			$this->db->where($cond);
			$this->db->join('dwalker_payments','dwalker_payments.payID as pay = dwalker_order_products.OrderID as order','right');	
			$query  = $this->db->get();
			return $query->result();
		}  

}