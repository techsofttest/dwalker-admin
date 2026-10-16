<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Subcategories extends CI_Controller 
 {
	  public function __construct()
		{
				parent::__construct();
				$this->load->database();
                $this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text'));
                $this->load->model("Admin_model");
				//$this->pr_details=get_profile_details();
				$this->load->library('session');
				if(!$this->session->userdata('adminId'))
				{
					redirect(base_url().'admin/login');	
				}	
				//get user details
        }
		
		
		
		public function index()
		{
		$data['seo_title'] = "View categories | ACTRADE";
		
		$data['subcategory']=$this->Admin_model->fetch_all_subcategory();
		
		$this->load->view('admin/view_subcategory',$data);
			
			
		}
		
	 public function AddSubcategories()
	 {
		  $data['seo_title']= "Add categories | D WALKER JEWELRY";
		  $catID= $this->uri->segment(4);
		  if($_POST):
		  $subcat_data= array(
		    'cat_id'	=> $catID,
		    'subcat_name'	=> $this->input->post('Title'),
			'SlugName'  => $this->create_slug($this->input->post('Title')),	
		 );
		$cid = $this->Admin_model->insertsection('dwalker_subcategory',$subcat_data);
		$this->session->set_flashdata('success','Subcategories Added Succesfully');
		redirect(base_url().'admin/Subcategories/AddSubcategories');
	    endif;
		$this->load->view('admin/add_subcategory', $data);
	}
		
		
    public function EditSubcategories($cid)
	  {
		 $cond	=	array('subcat_id' => $cid);
		 $data['subcategory']	=	$this->Admin_model->fetch_one_row('dwalker_subcategory',$cond);
		 $data['category']	=	$this->Admin_model->fetch_all('dwalker_category');
		 $subcat_id =$data['subcategory']['cat_id'];
		 $data['drop']		= $this->Admin_model->fetch_single_category($subcat_id);
		 
		 $data['seo_title']=  "Edit categories | D WALKER JEWELRY";
		 if($_POST):
		 $subcat_data=array(
		  'cat_id'	         => $this->input->post('category'),
		  'subcat_name'        => $this->input->post('title'),
		  'SlugName'  => $this->change_slug($this->input->post('title'),$cid),	
		
		);
		$cond	=	array('subcat_id'	=>	$cid);
		$edit 	= 	$this->Admin_model->update_all($subcat_data,$cond,'dwalker_subcategory');
		$this->session->set_flashdata('success','Subcategories Updated Succesfully');
		redirect(base_url().'admin/Subcategories/EditSubcategories/'.$cid);
		endif;
		$this->load->view('admin/edit_sucategory',$data);	
	 }
	 
	 
		public function  DeleteSubcategories($pid)
		{
		 $cond	=	array('subcat_id' => $pid);
		
		$data['subcategory'] 	= $this->Admin_model->fetch_one_row('dwalker_subcategory',$cond);
		$sucatID=$data['subcategory']['cat_id'];
		//print_r($data['subcategory']);
		//exit();
		$data['subcatsub']=$this->Admin_model->get_sub_del($pid);
		$data['product']   = $this->Admin_model->get_pro_del($pid);
		$cid= $data['product']['product_id'];
		
		
		foreach($data['product'] as $img)
		
		{
		
		@unlink('uploads/Products/'.$img['	ProductImage']);		
		}
		//@unlink('uploads/subcategory/'.$data['subcategory']['subcat_image']);

		
		$this->db->where('subcat_id',$pid);
		$this->db->delete('dwalker_subcategory');
		$this->db->where('subcat_id',$pid);
		$this->db->delete('dwalker_subcategorysub');
		$this->db->where('subcat_id',$pid);
		$this->db->delete('dwalker_product');
		
		$this->session->set_flashdata('success','Subcategorys & Product Deleted Successfully');
		redirect(base_url().'admin/Subcategories/ViewsubCategory/'.$sucatID.'');
		}
		
		
	 public function ViewsubCategory($catid)
	 {
		 $cond1		=	array('cat_id' => $catid);
		 $data['subcategory']	=	$this->Admin_model->fetch_all_order_cond('dwalker_subcategory','subcat_id','Desc',$cond1);
		 $this->load->view('admin/view_subcategory',$data);
	}
	 public function create_slug($name)
		{
			
			$count 	= 	0;
			$name 	= 	url_title($name);
			$slug_name 	= 	$name;             // Create temp name
			while(true) 
			{
				$this->db->select('*');
				$this->db->where('SlugName', $slug_name);   // Test temp name
				$query = $this->db->get('dwalker_subcategory');
				if ($query->num_rows() == 0) break;
				$slug_name 	=	$name . '-' . (++$count);  // Recreate new temp name
			}
			return $slug_name;
		}
		
		public function change_slug($name,$id)
		{
			$count 	= 	0;
			$name 	= 	url_title($name);
			$slug_name 	= 	$name;             // Create temp name
			while(true) 
			{
				$this->db->select('*');
				$this->db->where('SlugName', $slug_name); 
				$this->db->where_not_in('subcat_id', $id);  // Test temp name
				$query 	= 	$this->db->get('dwalker_subcategory');
				if ($query->num_rows() == 0) break;
				$slug_name 	= 	$name . '-' . (++$count);  // Recreate new temp name
			}
			return $slug_name;
		}
	 
 }