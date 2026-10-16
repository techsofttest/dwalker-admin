<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SignatureCollection extends CI_Controller {

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

        // Auto-create dwalker_signature_collection table if missing
        if (!$this->db->table_exists('dwalker_signature_collection')) {
            $this->db->query("CREATE TABLE IF NOT EXISTS `dwalker_signature_collection` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `section_key` varchar(100) DEFAULT NULL,
              `section_name` varchar(255) DEFAULT NULL,
              `eyebrow` varchar(255) DEFAULT 'The Signature Collection',
              `title` varchar(255) DEFAULT 'Natural',
              `script_text` varchar(255) DEFAULT 'beauty.',
              `description` text DEFAULT NULL,
              `button_text` varchar(255) DEFAULT 'Explore the Collection',
              `button_link` varchar(500) DEFAULT '#collections',
              `sort_order` int(11) NOT NULL DEFAULT '0',
              `status` tinyint(1) NOT NULL DEFAULT '1',
              `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        }

        // Ensure missing columns exist in dwalker_signature_collection
        if ($this->db->table_exists('dwalker_signature_collection')) {
            if (!$this->db->field_exists('section_key', 'dwalker_signature_collection')) {
                $this->db->query("ALTER TABLE `dwalker_signature_collection` ADD COLUMN `section_key` varchar(100) DEFAULT NULL AFTER `id`;");
            }
            if (!$this->db->field_exists('section_name', 'dwalker_signature_collection')) {
                $this->db->query("ALTER TABLE `dwalker_signature_collection` ADD COLUMN `section_name` varchar(255) DEFAULT NULL AFTER `section_key`;");
            }
            if (!$this->db->field_exists('sort_order', 'dwalker_signature_collection')) {
                $this->db->query("ALTER TABLE `dwalker_signature_collection` ADD COLUMN `sort_order` int(11) NOT NULL DEFAULT '0';");
            }
            if (!$this->db->field_exists('status', 'dwalker_signature_collection')) {
                $this->db->query("ALTER TABLE `dwalker_signature_collection` ADD COLUMN `status` tinyint(1) NOT NULL DEFAULT '1';");
            }
        }

        // Auto-create dwalker_signature_images table for UNLIMITED images per collection
        if (!$this->db->table_exists('dwalker_signature_images')) {
            $this->db->query("CREATE TABLE IF NOT EXISTS `dwalker_signature_images` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `collection_id` int(11) NOT NULL DEFAULT '1',
              `image_file` varchar(500) NOT NULL,
              `sort_order` int(11) NOT NULL DEFAULT '0',
              `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        }

        // Ensure missing column collection_id exists in dwalker_signature_images
        if ($this->db->table_exists('dwalker_signature_images')) {
            if (!$this->db->field_exists('collection_id', 'dwalker_signature_images')) {
                $this->db->query("ALTER TABLE `dwalker_signature_images` ADD COLUMN `collection_id` int(11) NOT NULL DEFAULT '1' AFTER `id`;");
            }
        }

        // Seed default section records if missing
        $this->seed_default_collections();
    }

    private function seed_default_collections() {
        $defaults = array(
            array(
                'section_key'  => 'signature_collection',
                'section_name' => 'The Signature Collection',
                'eyebrow'      => 'The Signature Collection',
                'title'        => 'Natural',
                'script_text'  => 'beauty.',
                'description'  => 'A considered collection of sterling silver pieces paired with gemstones chosen for their unique colour, character and individuality.',
                'button_text'  => 'Explore the Collection',
                'button_link'  => '#collections',
                'sort_order'   => 1
            ),
            array(
                'section_key'  => 'everyday_icons',
                'section_name' => 'Everyday Icons',
                'eyebrow'      => 'Everyday Icons',
                'title'        => 'Quiet',
                'script_text'  => 'luxury.',
                'description'  => 'Understated pieces designed to become part of your everyday. Elegant enough for special occasions, effortless enough for every day.',
                'button_text'  => 'Shop Icons',
                'button_link'  => '#collections',
                'sort_order'   => 2
            ),
            array(
                'section_key'  => 'raw_minerals',
                'section_name' => 'Raw Minerals to Fine Jewellery',
                'eyebrow'      => 'Raw Minerals to Fine Jewellery',
                'title'        => 'Born from',
                'script_text'  => 'the earth.',
                'description'  => 'Every D Walker piece begins in nature. We source authentic raw minerals, crystalline geodes, and unrefined gemstones—thoughtfully polishing them into distinctive sterling silver jewellery that honors their natural origin.',
                'button_text'  => 'Explore collection',
                'button_link'  => '#craftsmanship',
                'sort_order'   => 3
            ),
            array(
                'section_key'  => 'dwalker_collection',
                'section_name' => 'The D Walker Collection',
                'eyebrow'      => 'More to explore',
                'title'        => 'Discover D Walker',
                'script_text'  => 'heritage.',
                'description'  => 'Discover the heritage and passion behind our handcrafted jewellery. Learn how every piece is thoughtfully created in New Zealand.',
                'button_text'  => 'Discover',
                'button_link'  => '#about',
                'sort_order'   => 4
            )
        );

        foreach ($defaults as $def) {
            $exists = $this->db->get_where('dwalker_signature_collection', array('section_key' => $def['section_key']))->row_array();
            if (!$exists) {
                // If table is completely empty, first row might lack section_key
                if ($this->db->count_all('dwalker_signature_collection') == 0 && $def['section_key'] === 'signature_collection') {
                    $this->db->insert('dwalker_signature_collection', $def);
                } else {
                    $this->db->insert('dwalker_signature_collection', $def);
                }
            } else {
                // Update empty section_name or section_key if missing
                if (empty($exists['section_key']) || empty($exists['section_name'])) {
                    $this->db->where('id', $exists['id']);
                    $this->db->update('dwalker_signature_collection', array(
                        'section_key'  => $def['section_key'],
                        'section_name' => $def['section_name']
                    ));
                }
            }
        }
    }

    // List View — Table of all showcase collection records
    public function index() {
        $data['seo_title'] = "Manage Showcase Collections | D WALKER JEWELRY";
        
        $this->db->order_by('sort_order', 'ASC');
        $this->db->order_by('id', 'ASC');
        $collections = $this->db->get('dwalker_signature_collection')->result_array();

        foreach ($collections as &$col) {
            $col['image_count'] = $this->db->where('collection_id', $col['id'])->count_all_results('dwalker_signature_images');
        }

        $data['collections'] = $collections;
        $this->load->view('admin/view_signature_collection', $data);
    }

    // Add New Showcase Collection Section
    public function AddCollection() {
        $data['seo_title'] = "Add Showcase Collection Section | D WALKER JEWELRY";

        if ($_POST) {
            $section_name = trim($this->input->post('section_name'));
            $section_key  = strtolower(url_title(trim($this->input->post('section_key'))));
            if (empty($section_key)) {
                $section_key = strtolower(url_title($section_name));
            }

            $eyebrow     = trim($this->input->post('eyebrow'));
            $title       = trim($this->input->post('title'));
            $script_text = trim($this->input->post('script_text'));
            $description = trim($this->input->post('description'));
            $button_text = trim($this->input->post('button_text'));
            $button_link = trim($this->input->post('button_link'));
            $sort_order  = (int)$this->input->post('sort_order');
            $status      = (int)$this->input->post('status');

            $insert_data = array(
                'section_key'  => $section_key,
                'section_name' => $section_name,
                'eyebrow'      => $eyebrow,
                'title'        => $title,
                'script_text'  => $script_text,
                'description'  => $description,
                'button_text'  => $button_text,
                'button_link'  => $button_link,
                'sort_order'   => $sort_order,
                'status'       => $status,
            );

            $this->db->insert('dwalker_signature_collection', $insert_data);
            $collection_id = $this->db->insert_id();

            // Handle uploading multiple images
            $this->handle_image_uploads($collection_id);

            $this->session->set_flashdata('success', 'Collection section added successfully!');
            redirect(base_url() . 'admin/SignatureCollection');
            return;
        }

        $this->load->view('admin/add_signature_collection', $data);
    }

    // Edit Showcase Collection Section
    public function EditCollection($id = null) {
        if (!$id) {
            // Default to first record if no ID passed
            $first = $this->db->get('dwalker_signature_collection')->row_array();
            if ($first) {
                $id = $first['id'];
            } else {
                redirect(base_url() . 'admin/SignatureCollection');
                return;
            }
        }

        $data['seo_title'] = "Edit Collection Section | D WALKER JEWELRY";
        $data['record']    = $this->db->get_where('dwalker_signature_collection', array('id' => $id))->row_array();

        if (!$data['record']) {
            redirect(base_url() . 'admin/SignatureCollection');
            return;
        }

        // Fetch images for this collection
        $this->db->where('collection_id', $id);
        $this->db->order_by('sort_order', 'ASC');
        $this->db->order_by('id', 'ASC');
        $data['images'] = $this->db->get('dwalker_signature_images')->result_array();

        if ($_POST) {
            $section_name = trim($this->input->post('section_name'));
            $section_key  = strtolower(url_title(trim($this->input->post('section_key'))));
            if (empty($section_key)) {
                $section_key = strtolower(url_title($section_name));
            }

            $eyebrow     = trim($this->input->post('eyebrow'));
            $title       = trim($this->input->post('title'));
            $script_text = trim($this->input->post('script_text'));
            $description = trim($this->input->post('description'));
            $button_text = trim($this->input->post('button_text'));
            $button_link = trim($this->input->post('button_link'));
            $sort_order  = (int)$this->input->post('sort_order');
            $status      = (int)$this->input->post('status');

            $update_data = array(
                'section_key'  => $section_key,
                'section_name' => $section_name,
                'eyebrow'      => $eyebrow,
                'title'        => $title,
                'script_text'  => $script_text,
                'description'  => $description,
                'button_text'  => $button_text,
                'button_link'  => $button_link,
                'sort_order'   => $sort_order,
                'status'       => $status,
            );

            $this->db->where('id', $id);
            $this->db->update('dwalker_signature_collection', $update_data);

            // Handle updating sort orders of existing images
            $sort_orders = $this->input->post('sort_orders');
            if (is_array($sort_orders)) {
                foreach ($sort_orders as $img_id => $order_val) {
                    $this->db->where('id', (int)$img_id);
                    $this->db->update('dwalker_signature_images', array('sort_order' => (int)$order_val));
                }
            }

            // Handle uploading new images
            $this->handle_image_uploads($id);

            $this->session->set_flashdata('success', 'Collection section updated successfully!');
            redirect(base_url() . 'admin/SignatureCollection/EditCollection/' . $id);
            return;
        }

        $this->load->view('admin/edit_signature_collection', $data);
    }

    // Delete Collection Section and its images
    public function DeleteCollection($id = null) {
        if ($id) {
            $record = $this->db->get_where('dwalker_signature_collection', array('id' => $id))->row_array();
            if ($record) {
                // Delete image files from disk
                $images = $this->db->get_where('dwalker_signature_images', array('collection_id' => $id))->result_array();
                foreach ($images as $img) {
                    $file_path = './uploads/Signature/' . $img['image_file'];
                    if (file_exists($file_path)) {
                        @unlink($file_path);
                    }
                }
                // Delete image records
                $this->db->where('collection_id', $id);
                $this->db->delete('dwalker_signature_images');

                // Delete section record
                $this->db->where('id', $id);
                $this->db->delete('dwalker_signature_collection');

                $this->session->set_flashdata('success', 'Collection section deleted successfully!');
            }
        }
        redirect(base_url() . 'admin/SignatureCollection');
    }

    // Delete single image from gallery
    public function DeleteImage($image_id = null, $collection_id = null) {
        if ($image_id) {
            $img = $this->db->get_where('dwalker_signature_images', array('id' => $image_id))->row_array();
            if ($img) {
                if (!$collection_id) {
                    $collection_id = $img['collection_id'];
                }
                $file_path = './uploads/Signature/' . $img['image_file'];
                if (file_exists($file_path)) {
                    @unlink($file_path);
                }
                $this->db->where('id', $image_id);
                $this->db->delete('dwalker_signature_images');
                $this->session->set_flashdata('success', 'Image deleted from gallery successfully!');
            }
        }
        if ($collection_id) {
            redirect(base_url() . 'admin/SignatureCollection/EditCollection/' . $collection_id);
        } else {
            redirect(base_url() . 'admin/SignatureCollection');
        }
    }

    // Private helper for uploading images
    private function handle_image_uploads($collection_id) {
        if (!empty($_FILES['new_images']['name'][0])) {
            $upload_path = './uploads/Signature/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            $files_count = count($_FILES['new_images']['name']);
            for ($i = 0; $i < $files_count; $i++) {
                if (!empty($_FILES['new_images']['name'][$i])) {
                    $_FILES['file']['name']     = $_FILES['new_images']['name'][$i];
                    $_FILES['file']['type']     = $_FILES['new_images']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['new_images']['tmp_name'][$i];
                    $_FILES['file']['error']    = $_FILES['new_images']['error'][$i];
                    $_FILES['file']['size']     = $_FILES['new_images']['size'][$i];

                    $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
                    $new_filename = 'sig_img_' . time() . '_' . rand(1000, 9999) . '.' . $ext;

                    $config['upload_path']   = $upload_path;
                    $config['allowed_types'] = 'jpg|jpeg|png|webp|avif|gif';
                    $config['file_name']     = $new_filename;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('file')) {
                        $this->db->insert('dwalker_signature_images', array(
                            'collection_id' => $collection_id,
                            'image_file'    => $new_filename,
                            'sort_order'    => 0
                        ));
                    }
                }
            }
        }
    }
}
