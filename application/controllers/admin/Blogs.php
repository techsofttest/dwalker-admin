<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'text'));
        $this->load->model("Admin_model");
        $this->load->library('image_lib');
        $this->load->library('session');

        if (!$this->session->userdata('adminId')) {
            redirect(base_url() . 'admin/login');
        }
    }

    private function create_slug($string, $exclude_id = 0) {
        $slug = url_title($string, 'dash', TRUE);
        if (empty($slug)) {
            $slug = 'blog-' . rand(1000, 9999);
        }
        $orig_slug = $slug;
        $i = 1;
        while (true) {
            $this->db->where('slug', $slug);
            if (!empty($exclude_id)) {
                $this->db->where('id !=', $exclude_id);
            }
            $exists = $this->db->get('dwalker_blogs')->num_rows();
            if ($exists === 0) {
                break;
            }
            $slug = $orig_slug . '-' . $i;
            $i++;
        }
        return $slug;
    }

    public function index() {
        $data['seo_title'] = "View Blogs | D WALKER JEWELRY";
        $data['blogs'] = $this->Admin_model->fetch_all_order_cond('dwalker_blogs', 'id', 'DESC', array());
        $this->load->view('admin/view_blogs', $data);
    }

    public function AddBlog() {
        $data['seo_title'] = "Add Blog | D WALKER JEWELRY";

        if ($this->input->post()) {
            $title = $this->input->post('title');
            $custom_slug = $this->input->post('slug');
            $slug = !empty($custom_slug) ? $this->create_slug($custom_slug) : $this->create_slug($title);

            $image_name = '';
            if (!empty($_FILES['image']['name'])) {
                $filename = basename($_FILES['image']['name']);
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                $new_name = "blog_" . time() . "_" . rand(100, 999) . "." . $ext;
                $upload_dir = "uploads/Blogs";
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }

                if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . "/" . $new_name)) {
                    $image_name = $new_name;
                }
            }

            $blog_data = array(
                'title'            => $title,
                'slug'             => $slug,
                'short_desc'       => $this->input->post('short_desc'),
                'content'          => $this->input->post('content'),
                'image'            => $image_name,
                'blog_date'        => $this->input->post('blog_date') ?: date('Y-m-d'),
                'meta_title'       => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description'),
                'meta_keywords'    => $this->input->post('meta_keywords'),
                'status'           => 1
            );

            $this->Admin_model->insertsection('dwalker_blogs', $blog_data);
            $this->session->set_flashdata('success', 'Blog added successfully.');
            redirect(base_url() . 'admin/Blogs');
            return;
        }

        $this->load->view('admin/add_blog', $data);
    }

    public function EditBlog($id) {
        $cond = array('id' => $id);
        $data['blog'] = $this->Admin_model->fetch_one_row('dwalker_blogs', $cond);
        if (!$data['blog']) {
            redirect(base_url() . 'admin/Blogs');
            return;
        }

        $data['seo_title'] = "Edit Blog | D WALKER JEWELRY";

        if ($this->input->post()) {
            $title = $this->input->post('title');
            $custom_slug = $this->input->post('slug');
            $slug = !empty($custom_slug) ? $this->create_slug($custom_slug, $id) : $this->create_slug($title, $id);

            $blog_data = array(
                'title'            => $title,
                'slug'             => $slug,
                'short_desc'       => $this->input->post('short_desc'),
                'content'          => $this->input->post('content'),
                'blog_date'        => $this->input->post('blog_date') ?: date('Y-m-d'),
                'meta_title'       => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description'),
                'meta_keywords'    => $this->input->post('meta_keywords')
            );

            if (!empty($_FILES['image']['name'])) {
                $filename = basename($_FILES['image']['name']);
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                $new_name = "blog_" . time() . "_" . rand(100, 999) . "." . $ext;
                $upload_dir = "uploads/Blogs";
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }

                if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . "/" . $new_name)) {
                    if (!empty($data['blog']['image']) && file_exists($upload_dir . "/" . $data['blog']['image'])) {
                        @unlink($upload_dir . "/" . $data['blog']['image']);
                    }
                    $blog_data['image'] = $new_name;
                }
            }

            $this->Admin_model->update_all($blog_data, $cond, 'dwalker_blogs');
            $this->session->set_flashdata('success', 'Blog updated successfully.');
            redirect(base_url() . 'admin/Blogs/EditBlog/' . $id);
            return;
        }

        $this->load->view('admin/edit_blog', $data);
    }

    public function DeleteBlog($id) {
        $cond = array('id' => $id);
        $blog = $this->Admin_model->fetch_one_row('dwalker_blogs', $cond);
        if ($blog && !empty($blog['image'])) {
            $path = 'uploads/Blogs/' . $blog['image'];
            if (file_exists($path)) {
                @unlink($path);
            }
        }

        $this->db->where('id', $id);
        $this->db->delete('dwalker_blogs');
        $this->session->set_flashdata('success', 'Blog deleted successfully.');
        redirect(base_url() . 'admin/Blogs');
    }
}
