<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Controller 
 {
	  public function __construct()
		{
				parent::__construct();
				$this->load->database();
                $this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text'));
                $this->load->model("Admin_model");
				//$this->pr_details=get_profile_details();
				$this->load->library('image_lib');
				$this->load->library('session');
				if(!$this->session->userdata('adminId'))
				{
					redirect(base_url().'admin/login');	
				}	
				//get user details
        }
		
		
		
		public function index()
		{
		$data['seo_title'] = "View Product | D WALKER JEWELRY";
		
		$data['product']=$this->Admin_model->fetch_all_product();
		$data['all_product']	=	$this->Admin_model->fetch_all_new('dwalker_product','product_id','Desc');
		$data['all_categories']	=	$this->Admin_model->fetch_all('dwalker_category');
		$data['all_categories1']	=	$this->Admin_model->fetch_all('dwalker_subcategory');
		$data['all_categories2']	=	$this->Admin_model->fetch_all('dwalker_subcategorysub');
		//print_r($data['all_categories']);
		//exit();
		$this->load->view('admin/view_product',$data);
			
			
		}
		
		public function AddProduct()
		{
		  $data['category'] =  $this->Admin_model->fetch_all('dwalker_category');
		  $data['subcategory']	=	$this->Admin_model->fetch_all('dwalker_subcategory');
		  $data['all_gemstone']	=	$this->Admin_model->fetch_all('dwalker_gemstone');
		  $data['all_type']	=	$this->Admin_model->fetch_all('dwalker_type');
		  $data['all_collection']	=	$this->Admin_model->fetch_all('dwalker_collection');
		  $data['all_color']	=	$this->Admin_model->fetch_all('dwalker_colors');
		  $data['seo_title']= "Add Product | D WALKER JEWELRY";
		  
		  if($_POST):
		  $subcatsub_data= array(
		  'cat_id'	         => $this->input->post('category'),
		  'subcat_id'        => $this->input->post('subcat'),
		  'subcatsub_id'        => $this->input->post('subcatsub'),
		  'product_name'        => $this->input->post('name'),
		  'productCode'        => $this->input->post('code'),
		  'productPrice'        => $this->input->post('product_price'),
		  'productStrikePrice'  =>  $this->input->post('strike_price'),
		  'productTax'  =>  $this->input->post('tax'),
		  'productStock'  =>  $this->input->post('stock'),
		  /*'productType'        => $this->input->post('type'),
		  'productGemstone'        => $this->input->post('Gemstone'),
		  'productGemcolor'        => $this->input->post('color'),
		  'productCollection'        => $this->input->post('collection'),
		  'ProductMetal'        => $this->input->post('metal'),*/
		  'productType' => (int)$this->input->post('productType'),
		  'type'        => (int)$this->input->post('productType'),
		  'upcoming'    => (int)$this->input->post('upcoming'),
		  'ProductDesc'        => $this->input->post('desc_i'),
		  'meta_title'        => $this->input->post('metatitle'),
		  'meta_description'        => $this->input->post('metadescription'),
		  'meta_keyword'        => $this->input->post('metakeyword'),
		  'SlugName'  => $this->create_slug($this->input->post('name')),	
	     ); //implode(',',$this->input->post('productSizes')),
		
		// Auto-assign next sort_order
		$max_order_query = $this->db->select_max('sort_order', 'max_order')->get('dwalker_product')->row();
		$subcatsub_data['sort_order'] = ($max_order_query && $max_order_query->max_order !== null) ? ((int)$max_order_query->max_order + 1) : 1;

		$cid = $this->Admin_model->insertsection('dwalker_product',$subcatsub_data);
		$this->session->set_flashdata('success','Product Added Succesfully');
		
		if(!empty($_FILES["Image"]["name"]))
							{
								
								for ($i = 0; $i < count($_FILES['Image']['name']); $i++) 
								  {
										if($_FILES["Image"]["name"][$i]!='')
										{	
										
					 @unlink('uploads/Product/'.$data['productImage']['Image']);
					 										
					$filename2 	= 	basename($_FILES["Image"]["name"][$i]);
					$ext2 		= 	@end(explode('.', $filename2));
					$ext2 		= 	strtolower($ext2);			
					$gallery2    = 	"prod__".rand().'.'.$ext2;			
					$uploadfile2 = 	"uploads/Products";
					
				

					move_uploaded_file($_FILES["Image"]["tmp_name"][$i],  $uploadfile2."/".$gallery2);
					
					
					 $configer =  array(
                   'image_library'   => 'gd2',
                   'source_image'    =>  $uploadfile2."/".$gallery2,
                 'maintain_ratio'  =>  FALSE,
                   'width'           =>  504,
                   'height'          =>  650,
                 );
                $this->image_lib->clear();
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();
						
				$data_imgg  	= array('ProductImage'  =>$gallery2);
				$condd  	= 	array('product_id'  =>$cid);
				$add_imgg	=	$this->Admin_model->update_all($data_imgg,$condd,'dwalker_product');
				
				}}}
				
				
				
				if(!empty($_FILES["Imaged"]["name"]))
							{
								
								for ($i = 0; $i < count($_FILES['Imaged']['name']); $i++) 
								  {
										if($_FILES["Imaged"]["name"][$i]!='')
										{	
										
					 @unlink('uploads/Product/'.$data['productImage']['Imaged']);
					 										
					$filename2 	= 	basename($_FILES["Imaged"]["name"][$i]);
					$ext2 		= 	@end(explode('.', $filename2));
					$ext2 		= 	strtolower($ext2);			
					$gallery2    = 	"prod__".rand().'.'.$ext2;			
					$uploadfile2 = 	"uploads/Products";
					
				

					move_uploaded_file($_FILES["Imaged"]["tmp_name"][$i],  $uploadfile2."/".$gallery2);
					
					
					 $configer =  array(
                   'image_library'   => 'gd2',
                   'source_image'    =>  $uploadfile2."/".$gallery2,
                   'maintain_ratio'  =>  FALSE,
                   'width'           =>  504,
                   'height'          =>  650,
                 );
                $this->image_lib->clear();
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();
						
				$data_imgg  	= array('ProductdefaultImage'  =>$gallery2);
				$condd  	= 	array('product_id'  =>$cid);
				$add_imgg	=	$this->Admin_model->update_all($data_imgg,$condd,'dwalker_product');
				
				}}}
				
				
				
				
				if(!empty($_FILES["document_more"]["name"]))
							{
								
								for ($i = 0; $i < count($_FILES['document_more']['name']); $i++) 
								  {
										if($_FILES["document_more"]["name"][$i]!='')
										{						
					$filename 	= 	basename($_FILES["document_more"]["name"][$i]);
					$ext 		= 	@end(explode('.', $filename));
					$ext 		= 	strtolower($ext);			
					$gallery    = 	"productmore_".rand().'.'.$ext;			
					$uploadfile = 	"uploads/Products";
					move_uploaded_file($_FILES["document_more"]["tmp_name"][$i],  $uploadfile."/".$gallery);
					
					 $configer =  array(
                   'image_library'   => 'gd2',
                   'source_image'    =>  $uploadfile."/".$gallery,
                   'maintain_ratio'  =>  FALSE,
                   'width'           =>  504,
                   'height'          =>  650,
                 );
                $this->image_lib->clear();
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();
					
					$more_img  	= 	array(
					       'product_id'  =>$cid,
		                   'ProductImage'  => $gallery,);
					$add_img2	=	$this->Admin_model->insertsection('dwalker_productimage',$more_img);
				}}}
				$this->session->set_flashdata('success', 'Product Added Successfully.'); 
				redirect(base_url().'admin/Product/AddProduct');
				 endif; 
			$this->load->view('admin/add_product', $data);
		}
		
		
	  public function EditProduct($productId)
	  {
		   $data['all_categories']	=	$this->Admin_model->fetch_all('dwalker_category');
		   $data['all_categories1']	=	$this->Admin_model->fetch_all('dwalker_subcategory');
		   $data['all_categories2']	=	$this->Admin_model->fetch_all('dwalker_subcategorysub');
			
			$cond=array('product_id' => $productId);
			$data['product'] 	= 	$this->Admin_model->fetch_one_row('dwalker_product',$cond);
			//print_r($data['all_categories2']);
			//exit();
			$getsubcat=$data['product']['cat_id'];
			
			 $data['all_type']	=	$this->Admin_model->fetch_all('dwalker_type');
			 $data['all_gemstone']	=	$this->Admin_model->fetch_all('dwalker_gemstone');
			 $data['all_color']	=	$this->Admin_model->fetch_all('dwalker_colors');
			 $data['all_collection']	=	$this->Admin_model->fetch_all('dwalker_collection');
			/*$data['all_subcat']	    = $this->Admin_model->get_subcat($getsubcat);
			
			$fields_docs= array('productId'  => $productId);*/
			
			$fields_docs= array('product_id'  => $productId);
			$data['img_data_all']	=	$this->Admin_model->fetch_data('dwalker_productimage',$fields_docs);
		 
		 $data['seo_title']=  "Edit Product | D WALKER JEWELRY";
		 if($_POST):
		 $product_data=array(
		  'cat_id'	         => $this->input->post('category'),
		  'subcat_id'        => $this->input->post('subcat'),
		  'subcatsub_id'        => $this->input->post('subcatsub'),
		  'product_name'        => $this->input->post('name'),
		  'productCode'        => $this->input->post('code'),
		  'productPrice'        => $this->input->post('product_price'),
		  'productStrikePrice'  =>  $this->input->post('strike_price'),
		    'productTax'  =>  $this->input->post('tax'),
		'productStock'  =>  $this->input->post('stock'),
		 /* 'productType'        => implode(',',$this->input->post('type')),
		  'productGemstone'        => implode(',',$this->input->post('gemstone')),
		  'productGemcolor'        => implode(',',$this->input->post('color')),
		  'productCollection'        => implode(',',$this->input->post('collection')),
		  'ProductMetal'        => $this->input->post('metal'),*/
		  'productType' => (int)$this->input->post('productType'),
		  'type'        => (int)$this->input->post('productType'),
		  'upcoming'    => (int)$this->input->post('upcoming'),
		  'ProductDesc'        => $this->input->post('desc_i'),
		  'meta_title'        => $this->input->post('metatitle'),
		  'meta_description'        => $this->input->post('metadescription'),
		  'meta_keyword'        => $this->input->post('metakeyword'),
		  'SlugName'  => $this->change_slug($this->input->post('name'),$productId),
		 
		); //implode(',',$this->input->post('productSizes')),
		$cond	=	array('product_id'	=>	$productId);
		$edit 	= 	$this->Admin_model->update_all($product_data,$cond,'dwalker_product');
		$this->session->set_flashdata('success','Product Updated Succesfully');
		
		$pro_id = $productId;
		if(!empty($_FILES["Image"]["name"]))
							{
								
								for ($i = 0; $i < count($_FILES['Image']['name']); $i++) 
								  {
										if($_FILES["Image"]["name"][$i]!='')
										{	
										
					 @unlink('uploads/Product/'.$data['product']['product_img']);
					 										
					$filename2 	= 	basename($_FILES["Image"]["name"][$i]);
					$ext2 		= 	@end(explode('.', $filename2));
					$ext2 		= 	strtolower($ext2);			
					$gallery2    = 	"prod__".rand().'.'.$ext2;			
					$uploadfile2 = 	"uploads/Products";
					
				

					move_uploaded_file($_FILES["Image"]["tmp_name"][$i],  $uploadfile2."/".$gallery2);
					
					 $configer =  array(
                   'image_library'   => 'gd2',
                   'source_image'    =>  $uploadfile2."/".$gallery2,
                   'maintain_ratio'  =>  FALSE,
                   'width'           =>  504,
                   'height'          =>  650,
                 );
                $this->image_lib->clear();
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();
					
						
				$data_imgg  	= array('ProductImage'  =>$gallery2);
				$condd  	= 	array('product_id'  =>$pro_id);
				$add_imgg	=	$this->Admin_model->update_all($data_imgg,$condd,'dwalker_product');
				
				}}}
				
				
					if(!empty($_FILES["Imaged"]["name"]))
							{
								
								for ($i = 0; $i < count($_FILES['Imaged']['name']); $i++) 
								  {
										if($_FILES["Imaged"]["name"][$i]!='')
										{	
										
					 @unlink('uploads/Product/'.$data['product']['product_img']);
					 										
					$filename2 	= 	basename($_FILES["Imaged"]["name"][$i]);
					$ext2 		= 	@end(explode('.', $filename2));
					$ext2 		= 	strtolower($ext2);			
					$gallery2    = 	"prod__".rand().'.'.$ext2;			
					$uploadfile2 = 	"uploads/Products";
					
				

					move_uploaded_file($_FILES["Imaged"]["tmp_name"][$i],  $uploadfile2."/".$gallery2);
					
					 $configer =  array(
                   'image_library'   => 'gd2',
                   'source_image'    =>  $uploadfile2."/".$gallery2,
                   'maintain_ratio'  =>  FALSE,
                   'width'           =>  504,
                   'height'          =>  650,
                 );
                $this->image_lib->clear();
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();
					
						
				$data_imgg  	= array('ProductdefaultImage'  =>$gallery2);
				$condd  	= 	array('product_id'  =>$pro_id);
				$add_imgg	=	$this->Admin_model->update_all($data_imgg,$condd,'dwalker_product');
				
				}}}
				
				
				
				
				
				if(!empty($_FILES["document_more"]["name"]))
							{
								
								for ($i = 0; $i < count($_FILES['document_more']['name']); $i++) 
								  {
										if($_FILES["document_more"]["name"][$i]!='')
										{						
					$filename 	= 	basename($_FILES["document_more"]["name"][$i]);
					$ext 		= 	@end(explode('.', $filename));
					$ext 		= 	strtolower($ext);			
					$gallery    = 	"productmore_".rand().'.'.$ext;			
					$uploadfile = 	"uploads/Products";
					move_uploaded_file($_FILES["document_more"]["tmp_name"][$i],  $uploadfile."/".$gallery);
					
					 $configer =  array(
                   'image_library'   => 'gd2',
                   'source_image'    =>  $uploadfile."/".$gallery,
                   'maintain_ratio'  =>  FALSE,
                   'width'           =>  504,
                   'height'          =>  650,
                   );
                  $this->image_lib->clear();
                  $this->image_lib->initialize($configer);
                  $this->image_lib->resize();
					
					
					$more_img  	= 	array(
					       'product_id'  =>$pro_id,
		                   'ProductImage'  => $gallery,);
					$add_img2	=	$this->Admin_model->insertsection('dwalker_productimage',$more_img);
				}}}
				
				$this->session->set_flashdata('success', 'Product Updated Successfully.'); 
				redirect(base_url().'admin/Product/EditProduct/'.$pro_id);
				endif;
				
				
		        $this->load->view('admin/edit_product',$data);	
	}
	 
	 
		public function  DeleteProduct($pid)
		{
		  $cond=array('product_id' => $pid);
		  $data['product'] 	= 	$this->Admin_model->fetch_one_row('dwalker_product',$cond);
			
		    @unlink('uploads/Products/'.$data['product']['ProductImage']);
		  $this->db->where('product_id',$pid);
		  $this->db->delete('dwalker_product');
		  $this->session->set_flashdata('success', 'Products Deleted Successfully.'); 
		  redirect(base_url().'admin/Product');
		}
		
public function GetSubcat()
		{
			
			$getsubcat = $this->input->post('getsubcat');
			
			if($getsubcat > 0)
			{
			
		  $data['all_subcat']	    = $this->Admin_model->get_subcat($getsubcat);
		
			
			$output = '<div class="col-xs-12 col-sm-3 row-seperate">
							 <label> Select Category<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
			<select class="form-control" name="subcat" onchange="getsubcatsub(this.value);" required><option value="">Select Category</option>';
			
			
						foreach($data['all_subcat'] as $item=>$val):
						
						
							$output .= '<option value="' . $val->subcat_id . '">' . $val->subcat_name . '</option>';
						
						 endforeach;
					$output .= '</select></div>';
			
			
			echo $output;
			}
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
 
  public function DeleteProductmore($imageId)
		{
			$cond		=	array('imageId' => $imageId);
			$unlink_img = 	$this->Admin_model->fetch_one_row('dwalker_productimage',$cond);
			$productId=$unlink_img['product_id'];
			
			
			
			@unlink('uploads/Products/'.$unlink_img['ProductImage']);
			
			$this->db->where('imageId',$imageId);
			$this->db->delete('dwalker_productimage');
			
			$this->session->set_flashdata('success', 'Product Image Deleted Successfully.'); 			
			redirect(base_url().'admin/Product/EditProduct/'.$productId.'');
		
		}
	public function GetSubcatsub()
		{
			
			$getsubcatsub = $this->input->post('getsubcatsub');
			
			if($getsubcatsub > 0)
			{
			
		  $data['all_subcatsub']	    = $this->Admin_model->get_subcatsub($getsubcatsub);
		
			
			$output = '<div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Select Sub Category<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
			<select class="form-control" name="subcatsub" ><option value="">Select Sub Category</option>';
			
			
						foreach($data['all_subcatsub'] as $item=>$val):
						
						
							$output .= '<option value="' . $val->subcatsub_id . '">' . $val->subcatsub_name . '</option>';
						
						 endforeach;
					$output .= '</select></div>';
			
			
			echo $output;
			}
		}	
		public function GetSubcatsub_edit()
		{
			
		 $getsubcatsub = $this->input->post('getsubcatsub');
			
			
			if($getsubcatsub > 0)
			{
			
		  $data['all_subcatsub']	    = $this->Admin_model->get_subcatsub($getsubcatsub);
			
			$output = '';
			
			
						foreach($data['all_subcatsub'] as $item=>$val):
						
							$output .= '<option value="' . $val->subcatsub_id . '">' . $val->subcatsub_name . '</option>';
						
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
				$query = $this->db->get('dwalker_product');
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
				$this->db->where_not_in('product_id', $id);  // Test temp name
				$query 	= 	$this->db->get('dwalker_product');
				if ($query->num_rows() == 0) break;
				$slug_name 	= 	$name . '-' . (++$count);  // Recreate new temp name
			}
			return $slug_name;
		}

		public function update_order()
		{
			$orders = $this->input->post('orders');
			if (!empty($orders) && is_array($orders)) {
				foreach ($orders as $item) {
					$product_id = isset($item['id']) ? (int)$item['id'] : 0;
					$position = isset($item['position']) ? (int)$item['position'] : 0;
					if ($product_id > 0) {
						$this->db->where('product_id', $product_id);
						$this->db->update('dwalker_product', array('sort_order' => $position));
					}
				}
				echo json_encode(array('status' => 'success', 'message' => 'Product order updated successfully.'));
				return;
			}
			echo json_encode(array('status' => 'error', 'message' => 'No order data provided.'));
		}
 }