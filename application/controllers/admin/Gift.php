<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gift extends CI_Controller 
 {
	  public function __construct()
		{
				parent::__construct();
				$this->load->database();
    $this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text'));
    $this->load->model("Admin_model");			
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
		$data['seo_title'] = "View Gift | D WALKER JEWELRY";	
		$data['gift']	=	$this->Admin_model->fetch_all('dwalker_gift');
		$this->load->view('admin/view_gift',$data);}
		
		public function AddGift()
		{
		  
		  $data['seo_title']= "Add Gift | D WALKER JEWELRY";
		  
		if($_POST):
		$gift_data= array(
		'code'	 => $this->input->post('code')); 
  $cid = $this->Admin_model->insertsection('dwalker_gift',$gift_data);
		$this->session->set_flashdata('success','Gift Added Succesfully');
		
		if(!empty($_FILES["Image"]["name"]))
							{		
					 @unlink('uploads/Gift/'.$data['Image']['name']);
					 										
					$filename2 	= 	basename($_FILES["Image"]["name"]);
					$ext2 		= 	@end(explode('.', $filename2));
					$ext2 		= 	strtolower($ext2);			
					$gallery2    = 	"gift_".rand().'.'.$ext2;			
					$uploadfile2 = 	"uploads/Gift";		
					move_uploaded_file($_FILES["Image"]["tmp_name"],  $uploadfile2."/".$gallery2);			
					
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
						
				$data_imgg  	= array('Image' => $gallery2);
				$condd  	= 	array('gift_id'  => $cid);
				$add_imgg	=	$this->Admin_model->update_all($data_imgg,$condd,'dwalker_gift');
				
				}				
				
				$this->session->set_flashdata('success', 'Gift Added Successfully.'); 
				redirect(base_url().'admin/Gift/AddGift');
				 endif; 
			$this->load->view('admin/add_gift', $data);
		}
		
		
	  public function EditGift($GiftId)
	  {

				$cond	=	array('gift_id' => $GiftId);
				$data['gift']	=	$this->Admin_model->fetch_one_row('dwalker_gift',$cond);
		  $data['seo_title']=  "Edit Gift | D WALKER JEWELRY";
		  if($_POST):
		    $Gift_data=array('code'	=> $this->input->post('title')); 
		 
		   $edit 	= 	$this->Admin_model->update_all($Gift_data,$cond,'dwalker_gift');
		   $this->session->set_flashdata('success','Gift Updated Succesfully');		
	
		if(!empty($_FILES["Image"]["name"])){
						
										if($_FILES["Image"]["name"]!='')
										{											
					 @unlink('uploads/Gift/'.$data['Gift']['Gift_img']);
					 										
					$filename2 	= 	basename($_FILES["Image"]["name"]);
					$ext2 		= 	@end(explode('.', $filename2));
					$ext2 		= 	strtolower($ext2);			
					$gallery2    = 	"gift_".rand().'.'.$ext2;			
					$uploadfile2 = 	"uploads/Gift";	

					move_uploaded_file($_FILES["Image"]["tmp_name"],  $uploadfile2."/".$gallery2);
					
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
					
						
				$data_imgg  	= array('Image'  =>$gallery2);
				$condd  	= 	array('gift_id'  =>$GiftId);
				$add_imgg	=	$this->Admin_model->update_all($data_imgg,$condd,'dwalker_gift');
				
				}}	
				
					
				$this->session->set_flashdata('success', 'Gift Updated Successfully.'); 
				redirect(base_url().'admin/Gift/EditGift/'.$GiftId);
				endif;
				
				
		        $this->load->view('admin/edit_gift',$data);	
	} 
	 
		public function  DeleteGift($pid)
		{
		  $cond=array('gift_id' => $pid);
		  $data['Gift'] 	= 	$this->Admin_model->fetch_one_row('dwalker_gift',$cond);
			
		    @unlink('uploads/Gifts/'.$data['Gift']['GiftImage']);
		  $this->db->where('gift_id',$pid);
		  $this->db->delete('dwalker_gift');
		  $this->session->set_flashdata('success', 'Gifts Deleted Successfully.'); 
		  redirect(base_url().'admin/Gift');
		}	

 }