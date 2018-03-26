<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('file');
//        $this->mylib->auth('moderator');
    }

    public function index() {
        $this->users();
    }

    public function users() {
        $this->title = "Users";

        $this->users = $this->User_model->get_users_to_admin();

        $this->load->view('/layouts/html_start');
        $this->load->view('/layouts/admin/header');
        $this->load->view('/admin/users');
        $this->load->view('/layouts/html_end');
    }

    public function newsletters() {
        $this->users = $this->User_model->get_users_to_admin();

        $this->load->view('/layouts/html_start');
        $this->load->view('/layouts/admin/header');
        $this->load->view('/admin/newsletters');
        $this->load->view('/layouts/html_end');
    }

    public function cms() {
        $this->category = null;
        $this->get_content = $this->Content_model->get_content();
        $this->categories = $this->Content_model->get_categories();

        $this->load->view('/layouts/html_start');
        $this->load->view('/layouts/admin/header');
        $this->load->view('/admin/cms');
        $this->load->view('/layouts/html_end');
    }

    public function add_category() {
        $this->load->view('/layouts/html_start');
        $this->load->view('/layouts/admin/header');
        $this->load->view('/admin/add_category');
        $this->load->view('/layouts/html_end');
    }

    public function add_category_process() {
        $jsonData = array();

        $this->form_validation->set_rules('name', 'Name', 'required|min_length[4]');

        if ($this->form_validation->run() === FALSE) {
            $jsonData['message'] = $this->form_validation->error_array();
            $jsonData['success'] = false;

        } else {

            $info = array(
                'name' => $this->input->post('name')
            );

            $this->Content_model->add_category($info);

            $jsonData['message'] = array('title' => 'Category successfully added.');
            $jsonData['success'] = true;
            $jsonData['redirect'] = "/admin/cms/categories";
        }

        echo json_encode($jsonData);
    }

    public function edit_category($id) {
        $this->category = $this->Content_model->get_categories($id);

        $this->load->view('/layouts/html_start');
        $this->load->view('/layouts/admin/header');
        $this->load->view('/admin/add_category');
        $this->load->view('/layouts/html_end');
    }

    public function edit_category_process($id) {
        $jsonData = array();

        $this->form_validation->set_rules('name', 'Name', 'required|min_length[4]');

        if ($this->form_validation->run() === FALSE) {

            $jsonData['message'] = $this->form_validation->error_array();
            $jsonData['success'] = false;

        } else {

            $info = array(
                'name' => $this->input->post('name')
            );

            $this->Content_model->update_category($id, $info);

            $jsonData['message'] = array('title' => 'Category successfully updated.');
            $jsonData['success'] = true;
            $jsonData['redirect'] = "/admin/cms/categories";

        }

        echo json_encode($jsonData);
    }

    public function add_content() {
        $this->categories = $this->Content_model->get_categories();

        $this->load->view('/layouts/html_start');
        $this->load->view('/layouts/admin/header');
        $this->load->view('/admin/add_content');
        $this->load->view('/layouts/html_end');
    }

    public function add_content_process() {
        $jsonData = array();

        $this->form_validation->set_rules('title', 'Title', 'required|min_length[4]');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('image_file', 'File', 'callback_file_check');

        if ($this->form_validation->run() === false) {
            $jsonData['message'] = $this->form_validation->error_array();
            $jsonData['success'] = false;

        } else {

            $config['upload_path'] = './assets/images/uploaded/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image_file')) {
                $jsonData['message']['image_file'] = $this->upload->display_errors();
                $jsonData['success'] = false;

            } else {
                $img = $this->upload->data();
                //get file name from the upload array
                $img = $img['file_name'];

                $title = $this->input->post('title');
                $slug = $this->mylib->get_slug($title);

                $info = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'category_id' => $this->input->post('category'),
                    'title' => $title,
                    'slug' => $slug,
                    'image_name' => $img,
                    'body' => $this->input->post('content'),
                    'status' => $this->input->post('status'),
                    'created_at' => date('Y-m-d H:i:s'),
                );

                $this->Content_model->add_content($info);

                $jsonData['message'] = array('title' => 'Content successfully added.');
                $jsonData['success'] = true;
                $jsonData['redirect'] = "/admin/cms/content";
            }
        }

        echo json_encode($jsonData);
    }

    public function edit_content($slug) {
        $this->categories = $this->Content_model->get_categories();
        $this->content = $this->Content_model->get_content($slug);

        $this->load->view('/layouts/html_start');
        $this->load->view('/layouts/admin/header');
        $this->load->view('/admin/add_content');
        $this->load->view('/layouts/html_end');
    }

    //id or slug ??
    //nem törli a képet cserénél
    // javítani //ha a slug megegyezik egy másik sluggal akkor mind a két contentet felülírja
    public function edit_content_process($id) {
        $jsonData = array();

        $this->get_content = $this->Content_model->get_content($id);

        $this->form_validation->set_rules('title', 'Cím', 'required|min_length[4]');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        //if the user wants to change the picture
        if (isset($_FILES['image_file']['name']) && $_FILES['image_file']['name'] != '') {
            $this->form_validation->set_rules('image_file', 'File', 'callback_file_check');
        }

        if ($this->form_validation->run() === FALSE) {
            $jsonData['message'] = $this->form_validation->error_array();
            $jsonData['success'] = false;

        } else {
            //get the img name (if the user wants to delete or the don't want to change we need to update the new img name)
            $img = $this->get_content->image_name;

            //if the user wants to change the picture
            if (isset($_FILES['image_file']['name']) && $_FILES['image_file']['name'] != '') {

                $config['upload_path'] = './assets/images/uploaded/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image_file')) {
                    $jsonData['message']['image_file'] = $this->upload->display_errors();
                    $jsonData['success'] = false;

                } else {
                    //if the picture changed than delete the old picture
                    $this->delete_img_file($img);
                    $img = $this->upload->data();
                    //get the file name to update at db
                    $img = $img['file_name'];
                }
            }

            $title = $this->input->post('title');
            $slug = $this->mylib->get_slug($title);

            $info = array(
                'title' => $title,
                'slug' => $slug,
                'image_name' => $img,
                'body' => $this->input->post('content'),
                'category_id' => $this->input->post('category'),
                'status' => $this->input->post('status'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            $this->Content_model->update_content($id, $info);

            $jsonData['message'] = array('title' => 'Content successfully updated.');
            $jsonData['success'] = true;
            $jsonData['redirect'] = "/admin/cms/content";
        }

        echo json_encode($jsonData);
    }

    public function file_check() {
        $allowed_mime_type_arr = array('application/pdf', 'image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png');
        $mime = get_mime_by_extension($_FILES['image_file']['name']);

        if (isset($_FILES['image_file']['name']) && $_FILES['image_file']['name'] != "") {

            if (in_array($mime, $allowed_mime_type_arr)) {
                return true;

            } else {
                $this->form_validation->set_message('file_check', 'Please select only pdf/gif/jpg/png file.');
                return false;
            }

        } else {
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }

    public function delete_img_file($img_name) {
        $files = glob($_SERVER['DOCUMENT_ROOT'] . './assets/images/uploaded/' . $img_name); // get all file names

        foreach ($files as $file) { // iterate files
            if (is_file($file))
                unlink($file); // delete file
        }
    }
}
