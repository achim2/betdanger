<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    public function index() {
    }

    public function execute_search() {
        $jsonData = array();

        $search_term = $this->input->post('search');
        $jsonData['result'] = $this->Search_model->get_search_results($search_term);

        $jsonData['url'] = base_url();
        echo json_encode($jsonData);
    }
}
