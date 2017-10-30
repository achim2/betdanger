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

    public function search_result($search_term){
//        $this->result = $this->Search_model->get_search_results($search_term);
        $this->result = $this->Event_model->get_events_to_public($search_term);

        $this->load->view('/layouts/html_start');
        $this->load->view('/search/search_result');
        $this->load->view('/layouts/html_end');

    }
}
