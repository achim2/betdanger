<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    public function index() {
    }

    public function execute_search() {
        $jsonData = array();

        $search_term = $this->input->post('search');
        $jsonData['result'] = $this->Search_model->get_search_results($search_term);

        $jsonData['url'] = base_url('search/search_result/');
        echo json_encode($jsonData);
    }

    public function search_result($category, $slug){
        $this->title = $this->mylib->get_nice_category_title($category);
        $this->get_content = $this->Content_model->get_cat_content_to_public($category, $slug);

        $this->load->view('/layouts/html_start');
        $this->load->view('/content/content_page');
        $this->load->view('/layouts/html_end');

    }
}
