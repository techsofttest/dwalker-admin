<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Banners extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'text'));
        $this->load->model("Admin_model");
        $this->load->library('session');

        if (!$this->session->userdata('adminId')) {
            redirect(base_url() . 'admin/login');
        }

        // Auto-create dwalker_banners table if missing
        if (!$this->db->table_exists('dwalker_banners')) {
            $this->db->query("CREATE TABLE IF NOT EXISTS `dwalker_banners` (
              `banner_id` int(11) NOT NULL AUTO_INCREMENT,
              `title` varchar(255) DEFAULT NULL,
              `small_text` text DEFAULT NULL,
              `media_file` varchar(500) NOT NULL,
              `media_type` enum('image','video') NOT NULL DEFAULT 'image',
              `button_text` varchar(255) DEFAULT NULL,
              `button_link` varchar(500) DEFAULT NULL,
              `sort_order` int(11) NOT NULL DEFAULT '0',
              `status` tinyint(1) NOT NULL DEFAULT '1',
              `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`banner_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        }
    }

    // View All Banners
    public function index() {
        $data['seo_title'] = "Manage Hero Banners / Carousel | D WALKER JEWELRY";
        
        $this->db->order_by('sort_order', 'ASC');
        $this->db->order_by('banner_id', 'DESC');
        $data['banners'] = $this->db->get('dwalker_banners')->result_array();

        $this->load->view('admin/view_banners', $data);
    }

    // Add Banner Form & Processing
    public function AddBanner() {
        $data['seo_title'] = "Add Hero Banner | D WALKER JEWELRY";

        if ($_POST) {
            $title       = trim($this->input->post('title'));
            $small_text  = trim($this->input->post('small_text'));
            $button_text = trim($this->input->post('button_text'));
            $button_link = trim($this->input->post('button_link'));
            $sort_order  = (int)$this->input->post('sort_order');
            $status      = (int)$this->input->post('status');

            $media_file = '';
            $media_type = 'image';

            if (!empty($_FILES['media_file']['name'])) {
                // Ensure upload directory exists
                $upload_path = './uploads/Banners/';
                if (!is_dir($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }

                $ext = strtolower(pathinfo($_FILES['media_file']['name'], PATHINFO_EXTENSION));
                $new_filename = 'banner_' . time() . '_' . rand(1000, 9999) . '.' . $ext;

                $config['upload_path']   = $upload_path;
                $config['allowed_types'] = 'jpg|jpeg|png|webp|avif|gif|mp4|webm|mov|ogg';
                $config['file_name']     = $new_filename;
                $config['max_size']      = 50000; // 50MB for video support

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('media_file')) {
                    $media_file = $new_filename;
                    // Detect media type
                    if (in_array($ext, array('mp4', 'webm', 'mov', 'ogg'))) {
                        $media_type = 'video';
                    } else {
                        $media_type = 'image';
                    }
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(base_url() . 'admin/Banners/AddBanner');
                    return;
                }
            } else {
                $this->session->set_flashdata('error', 'Please select an image or video file.');
                redirect(base_url() . 'admin/Banners/AddBanner');
                return;
            }

            $insert_data = array(
                'title'       => $title,
                'small_text'  => $small_text,
                'media_file'  => $media_file,
                'media_type'  => $media_type,
                'button_text' => $button_text,
                'button_link' => $button_link,
                'sort_order'  => $sort_order,
                'status'      => $status,
            );

            $this->db->insert('dwalker_banners', $insert_data);
            $this->session->set_flashdata('success', 'Hero banner added successfully!');
            redirect(base_url() . 'admin/Banners');
            return;
        }

        $this->load->view('admin/add_banner', $data);
    }

    // Edit Banner Form & Processing
    public function EditBanner($banner_id = null) {
        if (!$banner_id) {
            redirect(base_url() . 'admin/Banners');
        }

        $data['seo_title'] = "Edit Hero Banner | D WALKER JEWELRY";
        $data['banner'] = $this->db->get_where('dwalker_banners', array('banner_id' => $banner_id))->row_array();

        if (!$data['banner']) {
            redirect(base_url() . 'admin/Banners');
        }

        if ($_POST) {
            $title       = trim($this->input->post('title'));
            $small_text  = trim($this->input->post('small_text'));
            $button_text = trim($this->input->post('button_text'));
            $button_link = trim($this->input->post('button_link'));
            $sort_order  = (int)$this->input->post('sort_order');
            $status      = (int)$this->input->post('status');

            $update_data = array(
                'title'       => $title,
                'small_text'  => $small_text,
                'button_text' => $button_text,
                'button_link' => $button_link,
                'sort_order'  => $sort_order,
                'status'      => $status,
            );

            if (!empty($_FILES['media_file']['name'])) {
                $upload_path = './uploads/Banners/';
                if (!is_dir($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }

                $ext = strtolower(pathinfo($_FILES['media_file']['name'], PATHINFO_EXTENSION));
                $new_filename = 'banner_' . time() . '_' . rand(1000, 9999) . '.' . $ext;

                $config['upload_path']   = $upload_path;
                $config['allowed_types'] = 'jpg|jpeg|png|webp|avif|gif|mp4|webm|mov|ogg';
                $config['file_name']     = $new_filename;
                $config['max_size']      = 50000;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('media_file')) {
                    // Remove old file if exists
                    if (!empty($data['banner']['media_file']) && file_exists($upload_path . $data['banner']['media_file'])) {
                        @unlink($upload_path . $data['banner']['media_file']);
                    }

                    $update_data['media_file'] = $new_filename;
                    if (in_array($ext, array('mp4', 'webm', 'mov', 'ogg'))) {
                        $update_data['media_type'] = 'video';
                    } else {
                        $update_data['media_type'] = 'image';
                    }
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(base_url() . 'admin/Banners/EditBanner/' . $banner_id);
                    return;
                }
            }

            $this->db->where('banner_id', $banner_id);
            $this->db->update('dwalker_banners', $update_data);

            $this->session->set_flashdata('success', 'Hero banner updated successfully!');
            redirect(base_url() . 'admin/Banners');
            return;
        }

        $this->load->view('admin/edit_banner', $data);
    }

    // Delete Banner
    public function DeleteBanner($banner_id = null) {
        if ($banner_id) {
            $banner = $this->db->get_where('dwalker_banners', array('banner_id' => $banner_id))->row_array();
            if ($banner) {
                $file_path = './uploads/Banners/' . $banner['media_file'];
                if (file_exists($file_path)) {
                    @unlink($file_path);
                }
                $this->db->where('banner_id', $banner_id);
                $this->db->delete('dwalker_banners');
                $this->session->set_flashdata('success', 'Hero banner deleted successfully!');
            }
        }
        redirect(base_url() . 'admin/Banners');
    }
}
