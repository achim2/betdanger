<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {

    public function __construct() {
        parent::__construct();

//        $this->mylib->auth('administrator');
        $this->load->helper('file');
    }

    private function get_slug($str) {
        $str = convert_accented_characters($str);
        $str = word_limiter($str, '4', '');
        $str = strtolower($str);
        $cleaning = array(',', '.', '\'', '"', ' ', '!', '_', '#', '<', '>', '/');
        $str = str_replace($cleaning, '-', $str);

        return $str;
    }

    public function content_welcome() {
        $this->categories = array('news', 'previews', 'blog');
        $this->get_content = $this->Content_model->get_content_to_public();

        $this->load->view('/layouts/html_start');
        $this->load->view('/content/content_welcome');
        $this->load->view('/layouts/html_end');
    }

    public function content_cms($category) {
//        $this->mylib->auth('administrator');

        $this->title = $this->mylib->get_nice_category_title($category);

        $this->category = $category;
        $this->get_content = $this->Content_model->get_my_content($category);

        $this->load->view('/layouts/html_start');
        $this->load->view('/content/content_cms');
        $this->load->view('/layouts/html_end');
    }

    public function content_category($category) {
        $this->title = $this->mylib->get_nice_category_title($category);

        $this->get_content = $this->Content_model->get_cat_content_to_public($category);

        $this->load->view('/layouts/html_start');
        $this->load->view('/content/content_category');
        $this->load->view('/layouts/html_end');
    }

    public function content_page($category, $slug) {
        $this->title = $this->mylib->get_nice_category_title($category);
        $this->get_content = $this->Content_model->get_cat_content_to_public($category, $slug);

        $this->load->view('/layouts/html_start');
        $this->load->view('/content/content_page');
        $this->load->view('/layouts/html_end');
    }

    public function file_check($str) {
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

    public function add_content($category) {
//        $this->mylib->auth('administrator');

        $this->title = $this->mylib->get_nice_category_title($category);

        $this->category = $category;

        $this->load->view('/layouts/html_start');
        $this->load->view('/content/add_content');
        $this->load->view('/layouts/html_end');
    }

    public function add_content_process($category) {
//        $this->mylib->auth('administrator');

        $jsonData = array();

        $this->form_validation->set_rules('title', 'Cím', 'required|min_length[4]');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_rules('image_file', '', 'callback_file_check');

        if ($this->form_validation->run() === FALSE) {
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

                $info = array(
                    'user_id' => $this->session->userdata('user_id'),
//                    'category' => $this->input->post('category'),
                    'category' => $category,
                    'title' => $title,
                    'slug' => $this->get_slug($title),
                    'front_img' => $img,
                    'body' => $this->input->post('content'),
                    'status' => $this->input->post('status'),
                    'created_at' => date('Y-m-d H:i:s'),
                );

                $this->Content_model->add_content($info);

                $jsonData['message'] = array('title' => 'Content successfully added.');
                $jsonData['success'] = true;
                $jsonData['redirect'] = "/content/$category";
            }
        }

        echo json_encode($jsonData);
    }

    public function edit_content($category, $slug) {
//        $this->mylib->auth('administrator');

        $this->get_content = $this->Content_model->get_my_content($category, $slug);

        $this->load->view('/layouts/html_start');
        $this->load->view('/content/edit_content');
        $this->load->view('/layouts/html_end');
    }

    // javítani //ha a slug megegyezik egy másik sluggal akkor mind a két contentet felülírja
    public function edit_content_process($category, $slug) {
//        $this->mylib->auth('administrator');

        $jsonData = array();

        $this->get_content = $this->Content_model->get_my_content($category, $slug);

        $this->form_validation->set_rules('title', 'Cím', 'required|min_length[4]');
        $this->form_validation->set_rules('content', 'Content', 'required');

        //if the user wants to change the picture
        if (isset($_FILES['image_file']['name']) && $_FILES['image_file']['name'] != '') {
            $this->form_validation->set_rules('image_file', '', 'callback_file_check');
        }

        if ($this->form_validation->run() === FALSE) {

            $jsonData['message'] = $this->form_validation->error_array();
            $jsonData['success'] = false;

        } else {
            //get the img name (if the user wants to delete or the don't want to change we need to update the new img name)
            $img = $this->get_content->front_img;

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

            $id = $this->get_content->content_id;
            $title = $this->input->post('title');

            $info = array(
                'title' => $title,
                'slug' => $this->get_slug($title),
                'front_img' => $img,
                'body' => $this->input->post('content'),
//                'category' => $this->input->post('category'),
                'category' => $category,
                'status' => $this->input->post('status'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            $this->Content_model->update_content($id, $info);

            $jsonData['message'] = array('title' => 'Content successfully edited.');
            $jsonData['success'] = true;
            $jsonData['redirect'] = "/content/$category";
        }

        echo json_encode($jsonData);
    }

    public function delete_content($content_id) {
//        $this->mylib->auth('administrator');

        $content = $this->Content_model->get_content_by_id($content_id);

        //the user can del just the own contents
        if ($content->user_id == $this->session->userdata("user_id")) {
            $this->delete_img_file($content->front_img);
            $this->del_com_by_content($content_id);
            $this->Content_model->delete_content($content_id);

        } else {
            echo "error";
        }
    }

    public function delete_img_file($img_name) {
        $files = glob($_SERVER['DOCUMENT_ROOT'] . './assets/images/uploaded/' . $img_name); // get all file names

        foreach ($files as $file) { // iterate files
            if (is_file($file))
                unlink($file); // delete file
            //echo $file.'file deleted';
        }
    }

    //COMMENTS PART
    public function add_comment_process($content_id) {
        $jsonData = array();

        $this->form_validation->set_rules('comment', 'Comment', 'required|min_length[4]');

        if ($this->form_validation->run() === FALSE) {
            $jsonData['message'] = $this->form_validation->error_array();
            $jsonData['success'] = false;

        } else {

            $info = array(
                'user_id' => $this->session->userdata('user_id'),
                'content_id' => $content_id,
                'body' => $this->input->post('comment'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            $this->Content_model->add_comment($info);

            $jsonData['comment'] = $this->Content_model->get_comments($content_id);

            $jsonData['message'] = array('title' => 'Comment successfully added.');
            $jsonData['success'] = true;

        }

        echo json_encode($jsonData);
    }

    public function get_comments($content_id){
        $jsonData = array();
        $jsonData['comment'] = $this->Content_model->get_comments($content_id);
        echo json_encode($jsonData);
    }

    public function del_com_by_content($content_id){
        $this->Content_model->delete_comment_by_content($content_id);
    }

    public function del_com_by_user($comment_id){
        $this->Content_model->delete_comment_by_user($comment_id);
    }

}