<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Categories extends CI_Controller 
 {
	  public function __construct()
		{
				parent::__construct();
				$this->load->database();
                $this->load->library('form_validation');
				$this->load->library('image_lib');
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
	    $data['seo_title'] = "View Categories | D WALKER JEWELRY";
		//$data['category']=$this->Admin_model->fetch_all_category();
	    $this->load->view('admin/view_category',$data);
	  }
		
   public function Category()
	{
	   $data['seo_title']= "Main Categories | D WALKER JEWELRY";
	   $data['category']=$this->Admin_model->fetch_all_category();
	   if($_POST):
		$cat_data= array(
		   'cat_name'	=> $this->input->post('title'),
		 );
		$cid = $this->Admin_model->insertsection('dwalker_category',$cat_data);
		$this->session->set_flashdata('success','Categories Added Succesfully');
		
		if(!empty($_FILES["image"]["name"]))
		{
			for ($i = 0; $i < count($_FILES['image']['name']); $i++) 
								  {
			if($_FILES["image"]["name"][$i]!='')
										{						
					$filename2 	= 	basename($_FILES["image"]["name"][$i]);
					$ext2 		= 	@end(explode('.', $filename2));
					$ext2 		= 	strtolower($ext2);			
					$gallery2    = 	"cat_".rand().'.'.$ext2;			
					$uploadfile2 = 	"uploads/Category";
					move_uploaded_file($_FILES["image"]["tmp_name"][$i],  $uploadfile2."/".$gallery2);
					
						$configer =  array(
              'image_library'   => 'gd2',
              'source_image'    =>  $uploadfile2."/".$gallery2,
              'maintain_ratio'  =>  TRUE,
              'width'           =>  320,
              'height'          =>  230,
            );
            $this->image_lib->clear();
            $this->image_lib->initialize($configer);
            $this->image_lib->resize();
					
				   $data_imgg  	= array('cat_image'  =>$gallery2);
				   $condd  	= 	array('cat_id'  =>$cid);
				   $add_imgg	=	$this->Admin_model->update_all($data_imgg,$condd,'dwalker_category');
				}}}	
				
			$this->session->set_flashdata('success', 'Categories Added Successfully.'); 
			
			redirect(base_url().'admin/Categories/Category');
	        endif;
			$this->load->view('admin/add_category', $data);
	}
		
   public function EditCategories($cid)
	  {
		 $cond	=	array('cat_id' => $cid);
		 $data['category']	=	$this->Admin_model->fetch_one_row('dwalker_category',$cond);
	     $data['seo_title']=  "Edit Main Categories |D WALKER JEWELRY";
		 if($_POST):
		 $cat_data=array(
		  'cat_name'	         => $this->input->post('title'),
		  'SlugName'  => $this->change_slug($this->input->post('title'),$cid),	
		);
		$cond	=	array('cat_id'	=>	$cid);
		$edit 	= 	$this->Admin_model->update_all($cat_data,$cond,'dwalker_category');
		$this->session->set_flashdata('success','Categories Updated Succesfully');
		if(!empty($_FILES["Image"]["name"]))
			{
								
		for ($i = 0; $i < count($_FILES['Image']['name']); $i++) 
								  {
										if($_FILES["Image"]["name"][$i]!='')
										{	
										
					 @unlink('uploads/Category/'.$data['category']['cat_image']);
					 										
					$filename2 	= 	basename($_FILES["Image"]["name"][$i]);
					$ext2 		= 	@end(explode('.', $filename2));
					$ext2 		= 	strtolower($ext2);			
					$gallery2    = 	"cat__".rand().'.'.$ext2;			
					$uploadfile2 = 	"uploads/Category";
					move_uploaded_file($_FILES["Image"]["tmp_name"][$i],$uploadfile2."/".$gallery2);
					
					$configer =  array(
              'image_library'   => 'gd2',
              'source_image'    =>  $uploadfile2."/".$gallery2,
              'maintain_ratio'  =>  TRUE,
              'width'           =>  320,
              'height'          =>  230,
            );
            $this->image_lib->clear();
            $this->image_lib->initialize($configer);
            $this->image_lib->resize();
				    $data_imgg  	= array('cat_image'  =>$gallery2);
				    $condd  	= 	array('cat_id'  =>$cid);
				     $add_imgg	=	$this->Admin_model->update_all($data_imgg,$condd,'dwalker_category');
				
				}}}
		       $this->session->set_flashdata('success','Categories Updates Succesfully');
		       redirect(base_url().'admin/Categories/EditCategories/'.$cid);
		       endif;
		       $this->load->view('admin/edit_category',$data);	
	}
	 
	 
		public function  DeleteCategories($pid)
		{
		  $cond	=	array('cat_id' => $pid);
		
		$data['category'] 	= $this->Admin_model->fetch_one_row('dwalker_category',$cond);
		//print_r($data['subcategory']);
		//exit();
		$data['subcategory']   = $this->Admin_model->get_subcat_del($pid);
		$data['subcatsub'] = $this->Admin_model->get_subcatsub_del($pid);
		$data['product']   = $this->Admin_model->get_product_del($pid);
		$cid= $data['subcategory']['subcat_id'];
		
		
		
		
		
		foreach($data['product'] as $img)
		
		{
		
		@unlink('uploads/Products/'.$img['ProductImage']);		
		}
		
		@unlink('uploads/Category/'.$data['category']['cat_image']);

		
		$this->db->where('cat_id',$pid);
		$this->db->delete('dwalker_category');
		$this->db->where('cat_id',$pid);
		$this->db->delete('dwalker_subcategory');
		$this->db->where('cat_id',$pid);
		$this->db->delete('dwalker_subcategorysub');
		$this->db->where('cat_id',$pid);
		$this->db->delete('dwalker_product');
		
		$this->session->set_flashdata('success','Category,Subcategorys & Product Deleted Successfully');
		redirect(base_url().'admin/Categories/Category');
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
				$this->db->where_not_in('cat_id', $id);  // Test temp name
				$query 	= 	$this->db->get('dwalker_category');
				if ($query->num_rows() == 0) break;
				$slug_name 	= 	$name . '-' . (++$count);  // Recreate new temp name
			}
			return $slug_name;
		}
	 
	 
 }