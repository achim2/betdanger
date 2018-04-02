<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {

    public function __construct() {
        parent::__construct();

//        $this->mylib->auth('administrator');
    }

    public function welcome() {
        $this->get_category = $this->Content_model->get_categories();
        $this->get_content = $this->Content_model->get_content_to_public();

        $this->load->view('/layouts/html_start');
        $this->load->view('/layouts/main/header');
        $this->load->view('/content/welcome');
        $this->load->view('/layouts/main/footer');
        $this->load->view('/layouts/html_end');
    }

    public function category($category) {
        $this->get_category = $this->Content_model->get_categories(false, $category);
        $this->get_content = $this->Content_model->get_content_to_public(false, $this->get_category->id);

        $this->load->view('/layouts/html_start');
        $this->load->view('/layouts/main/header');
        $this->load->view('/content/category');
        $this->load->view('/layouts/main/footer');
        $this->load->view('/layouts/html_end');
    }

    public function page($slug) {
        $this->get_content = $this->Content_model->get_content_to_public($slug);

        $this->load->view('/layouts/html_start');
        $this->load->view('/layouts/main/header');
        $this->load->view('/content/page');
        $this->load->view('/layouts/main/footer');
        $this->load->view('/layouts/html_end');
    }

//    //COMMENTS PART
//    public function add_comment_process($content_id) {
//        $jsonData = array();
//
//        $this->form_validation->set_rules('comment', 'Comment', 'required|min_length[4]');
//
//        if ($this->form_validation->run() === FALSE) {
//            $jsonData['message'] = $this->form_validation->error_array();
//            $jsonData['success'] = false;
//
//        } else {
//
//            $info = array(
//                'user_id' => $this->session->userdata('user_id'),
//                'content_id' => $content_id,
//                'body' => $this->input->post('comment'),
//                'created_at' => date('Y-m-d H:i:s'),
//            );
//
//            $this->Content_model->add_comment($info);
//
//            $jsonData['comment'] = $this->Content_model->get_comments($content_id);
//
//            $jsonData['message'] = array('title' => 'Comment successfully added.');
//            $jsonData['success'] = true;
//
//        }
//
//        echo json_encode($jsonData);
//    }
//
//    public function get_comments($content_id) {
//        $jsonData = array();
//        $jsonData['comment'] = $this->Content_model->get_comments($content_id);
//        echo json_encode($jsonData);
//    }
//
//    public function del_com_by_content($content_id) {
//        $this->Content_model->delete_comment_by_content($content_id);
//    }
//
//    public function del_com_by_user($comment_id) {
//        $this->Content_model->delete_comment_by_user($comment_id);
//    }

}