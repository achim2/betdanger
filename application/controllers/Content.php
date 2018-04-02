<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {

    public function __construct() {
        parent::__construct();

//        $this->mylib->auth('administrator');
    }

    //add tags to the contents
    //if slug != false return a row, if slug == false return an array
    private function get_content($query, $slug = false) {
        $tags = $this->Content_model->get_tags();

        if ($slug != false) {
            $query->tag_names = array();

            foreach ($tags as $tag) {
                if ($tag->content_id == $query->id) {
                    array_push($query->tag_names, $tag->name);
                }
            }

            return $this->get_content = $query;

        } else {
            $this->get_content = array();

            foreach ($query as $content) {
                $content->tag_names = array();

                foreach ($tags as $tag) {
                    if ($tag->content_id == $content->id) {
                        array_push($content->tag_names, $tag->name);
                    }
                }

                array_push($this->get_content, $content);
            }

            return $this->get_content;
        }
    }

    public function welcome() {
        //simple query
        $query = $this->Content_model->get_content_to_public();
        //category query
        $this->get_category = $this->Content_model->get_categories();
        //simple query with tags
        $this->contents = $this->get_content($query);

        $this->load->view('/layouts/html_start');
        $this->load->view('/layouts/main/header');
        $this->load->view('/content/welcome');
        $this->load->view('/layouts/main/footer');
        $this->load->view('/layouts/html_end');
    }

    public function category($category) {
        //category query
        $this->get_category = $this->Content_model->get_categories(false, $category);
        //category filtered query
        $query = $this->Content_model->get_content_to_public(false, $this->get_category->id);
        //category filtered query with tags
        $this->contents = $this->get_content($query, false);

        $this->load->view('/layouts/html_start');
        $this->load->view('/layouts/main/header');
        $this->load->view('/content/category');
        $this->load->view('/layouts/main/footer');
        $this->load->view('/layouts/html_end');
    }

    public function page($slug) {
        //row query
        $query = $this->Content_model->get_content_to_public($slug);
        //row query with tags
        $this->content = $this->get_content($query, $slug);

        $this->load->view('/layouts/html_start');
        $this->load->view('/layouts/main/header');
        $this->load->view('/content/page');
        $this->load->view('/layouts/main/footer');
        $this->load->view('/layouts/html_end');
    }

    public function tag($tag) {
        //simple query
        $query = $this->Content_model->get_content_to_public();
        //query with tags
        $contents = $this->get_content($query);
        //empty array, after foreach pushed array
        $this->contents = array();

        foreach ($contents as $content) {
            foreach ($content->tag_names as $tag_name) {
                if ($tag_name == $tag) {
                    array_push($this->contents, $content);
                }
            }
        }

        $this->load->view('/layouts/html_start');
        $this->load->view('/layouts/main/header');
        $this->load->view('/content/tag');
        $this->load->view('/layouts/main/footer');
        $this->load->view('/layouts/html_end');
    }

    public function search_result($search_term) {
        //searched query
        $query = $this->Search_model->get_search_results($search_term);
        //searched query with tags
        $this->get_results = $this->get_content($query);

        $this->load->view('/layouts/html_start');
        $this->load->view('/layouts/main/header');
        $this->load->view('/content/search_result');
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