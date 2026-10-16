<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CMS extends CI_Controller {
		// construct
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
		
		
		
	
		
		// View CMS Pages   
        public function ViewCMS()
		{			 
			
			
			
			$data['seo_title'] 	= 	"View CMS Pages| D WALKER JEWELRY"; 
			 
			 $parent =  $this->uri->segment(4);
			
				 
			  $data['cms_data']	=	$this->Admin_model->fetch_all('dwalker_content');
			
			 
			 
			 $this->load->view('admin/view_cms_page', $data);
		}
				
		
	 public function EditCMS($contentid)
		{
			$cond=array('contentId' => $contentid);
			
			$data['cms_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond);
			
			$data['seo_title'] 	= 	"Edit CMS | D WALKER JEWELRY"; 
											
			if($_POST):
				
				
										
				//Update CMS
				$cms_data  = array(
			'pageName'  => preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $this->input->post('page_name')),
			'pageDescription'  => preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $this->input->post('page_description')),
			
			'pageSlug'  => $this->change_slug($this->input->post('page_name'),$contentid),	
					
					
					
				);

				$cms_cond  		= 	array('contentId'  => $contentid,);
				$this->Admin_model->update_all($cms_data,$cms_cond,'dwalker_content');
				
				$this->session->set_flashdata('success', 'CMS Page Updated Successfully.'); 
				redirect(base_url().'admin/CMS/ViewCMS');
				
			endif;
			$this->load->view('admin/edit_cms_pages', $data);
        }
		
		
		
	
		
		
		public function change_slug($name,$id)
		{
			$count 	= 	0;
			$name 	= 	url_title($name);
			$slug_name 	= 	$name;  
			//echo $slug_name;
			//exit;           // Create temp name
			while(true) 
			{
				$this->db->select('*');
				$this->db->where('pageSlug', $slug_name); 
				$this->db->where_not_in('contentId', $id);  // Test temp name
				$query 	= 	$this->db->get('dwalker_content');
				if ($query->num_rows() == 0) break;
				$slug_name 	= 	$name . '-' . (++$count);  // Recreate new temp name
			}
			return $slug_name;
		}
				
			    			
}