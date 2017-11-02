<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preview extends CI_Controller {

    public function index() {
        $this->preview_content = $this->Content_model->get_content_to_public(false, 'preview');

        $this->load->view('layouts/html_start');
        $this->load->view('preview/index');
        $this->load->view('layouts/html_end');
    }
}
