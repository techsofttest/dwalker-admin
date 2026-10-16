<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SubcategoySub extends CI_Controller 
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
		$data['seo_title'] = "View Subcategories | D WALKER JEWELRY";
		
		$data['subcategory']=$this->Admin_model->fetch_all_subcategory();
		
		$this->load->view('admin/view_subcategorysub',$data);
			
			
		}
		
	 public function AddSubcategorysub($cid)
	 {
		 $data['seo_title']= "Add Subcategories | D WALKER JEWELRY";
		 $cond	=	array('subcat_id' => $cid);
		 $data['subcategory']	=	$this->Admin_model->fetch_one_row('dwalker_subcategory',$cond);
		 $cat_ID =  $data['subcategory']['cat_id'];
		 $subcatID= $this->uri->segment(4);
		 if($_POST):
		 $subcat_data= array(
		    'subcat_id'	=> $subcatID,
			'cat_id'  => $cat_ID,
		    'subcatsub_name'	=> $this->input->post('Title'),
			'SlugName'  => $this->create_slug($this->input->post('Title')),	
		 );
		$pid = $this->Admin_model->insertsection('dwalker_subcategorysub',$subcat_data);
		
		$this->session->set_flashdata('success','Subcategories Added Succesfully');
		
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
					$data_imgg  	= array('image'  =>$gallery2);
					$cond  	= 	array('subcatsub_id'  =>$pid);
					$add_imgg	=	$this->Admin_model->update_all($data_imgg,$cond,'dwalker_subcategorysub');
					//$data_imgg  	= array('image'  =>$gallery2);
					//print_r($cond);
					//exit();
		            //$subcatsubimage=  $this->Admin_model->insertsection('dwalker_subcategorysub',$data_imgg);
				 
				   
				}}}
					
				$this->session->set_flashdata('success', 'Subcategories Added Successfully.');
		
		redirect(base_url().'admin/SubcategoySub/AddSubcategorysub/'.$cid);
		//redirect(base_url().'admin/SubcategoySub/AddSubcategorysub/'.$cid);
	    endif;
		$this->load->view('admin/add_subcategorysub', $data);
	}
		
		
    public function EditSubcategories($cid)
	  {
		 $cond	=	array('subcatsub_id' => $cid);
		 $data['subcategorysub']	=	$this->Admin_model->fetch_one_row('dwalker_subcategorysub',$cond);
	     $data['category']	=	$this->Admin_model->fetch_all('dwalker_category');
		 $subcatsub_id =$data['subcategorysub']['cat_id'];
		 $data['drop']		= $this->Admin_model->fetch_single_category($subcatsub_id);
		 
		$data['subcategory']	=	$this->Admin_model->fetch_all('dwalker_subcategory');
		
		$subcat_id =$data['subcategorysub']['cat_id']; 
		$data['catdrop']		= $this->Admin_model->fetch_single_subcategory($subcat_id);
		// print_r($data['catdrop']);
		//exit();
		 $data['seo_title']=  "Edit Subcategories | D WALKER JEWELRY";
		 if($_POST):
		 $subcat_data=array(
		  'cat_id'	         => $this->input->post('category'),
		  'subcat_id'        => $this->input->post('subcategory'),
		  'subcatsub_name'        => $this->input->post('subcaytegorysub'),
		   'SlugName'  => $this->change_slug($this->input->post('subcaytegorysub'),$cid),	
		);
		$cond	=	array('subcatsub_id'	=>	$cid);
		$edit 	= 	$this->Admin_model->update_all($subcat_data,$cond,'dwalker_subcategorysub');
		$this->session->set_flashdata('success','Subcategories Updated Succesfully');
		if(!empty($_FILES["Image"]["name"]))
							{
								
								for ($i = 0; $i < count($_FILES['Image']['name']); $i++) 
								  {
										if($_FILES["Image"]["name"][$i]!='')
										{	
										
					 @unlink('uploads/Category/'.$data['subcategorysub']['image']);
					 										
					$filename2 	= 	basename($_FILES["Image"]["name"][$i]);
					$ext2 		= 	@end(explode('.', $filename2));
					$ext2 		= 	strtolower($ext2);			
					$gallery2    = 	"cat_".rand().'.'.$ext2;			
					$uploadfile2 = 	"uploads/Category";
					move_uploaded_file($_FILES["Image"]["tmp_name"][$i],$uploadfile2."/".$gallery2);
				    $data_imgg  	= array('image'  =>$gallery2);
				    $condd  	= 	array('subcatsub_id'  =>$cid);
				    $add_imgg	=	$this->Admin_model->update_all($data_imgg,$condd,'dwalker_subcategorysub');
				}}}
		$this->session->set_flashdata('success','Subcategories Updated Succesfully');
		redirect(base_url().'admin/SubcategoySub/EditSubcategories/'.$cid);
		endif;
		$this->load->view('admin/edit_sucategorysub',$data);	
	 }
	 
	 
		public function  DeleteSubcategories($pid)
		{
		 $cond	=	array('subcatsub_id' => $pid);
		
		$data['subcategorysub'] 	= $this->Admin_model->fetch_one_row('dwalker_subcategorysub',$cond);
		$sucatID=$data['subcategorysub']['subcat_id'];
		//print_r($data['subcategory']);
		//exit();
		$data['product']   = $this->Admin_model->get_pro_del($pid);
		$cid= $data['product']['product_id'];
		
		
		foreach($data['product'] as $img)
		
		{
		
		@unlink('uploads/Products/'.$img['ProductImage']);		
		}
		//@unlink('uploads/subcategory/'.$data['subcategory']['subcat_image']);

		
		$this->db->where('subcatsub_id',$pid);
		$this->db->delete('dwalker_subcategorysub');
		$this->db->where('subcatsub_id',$pid);
		$this->db->delete('dwalker_product');
		
		$this->session->set_flashdata('success','Subcategory & Product Deleted Successfully');
		redirect(base_url().'admin/SubcategoySub/ViewsubCategorysub/'.$sucatID.'');
		}
		
		
	 public function ViewsubCategorysub($catid)
	 {
		 $cond1		=	array('subcat_id' => $catid);
		 $data['subcategorysub']	=	$this->Admin_model->fetch_all_order_cond('dwalker_subcategorysub','subcatsub_id','Desc',$cond1);
		 $this->load->view('admin/view_subcategorysub',$data);
	}
		public function GetSubcat_edit()
		{
			
			$getsubcat = $this->input->post('getsubcat');
			
			
			if($getsubcat > 0)
			{
			
		  $data['all_subcat']	    = $this->Admin_model->get_subcat($getsubcat);
			
			$output = '';
			
			
						foreach($data['all_subcat'] as $item=>$val):
						
							$output .= '<option value="' . $val->subcat_id . '">' . $val->subcat_name . '</option>';
						
						 endforeach;
					$output .= '</select></div>';
			
			
			echo $output;
			}
			
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
				$query = $this->db->get('dwalker_subcategorysub');
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
				$this->db->where_not_in('subcatsub_id', $id);  // Test temp name
				$query 	= 	$this->db->get('dwalker_subcategorysub');
				if ($query->num_rows() == 0) break;
				$slug_name 	= 	$name . '-' . (++$count);  // Recreate new temp name
			}
			return $slug_name;
		}
	 
	 
 }