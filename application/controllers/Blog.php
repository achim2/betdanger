<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

    public function index() {

        $this->blog_content = $this->Content_model->get_content_to_public(false, 'blog');

        $this->load->view('layouts/html_start');
        $this->load->view('blog/index');
        $this->load->view('layouts/html_end');
    }

    public function post($slug){
        $this->blog_content = $this->Content_model->get_content_to_public($slug, 'blog');

        $this->load->view('layouts/html_start');
        $this->load->view('blog/post');
        $this->load->view('layouts/html_end');
    }
}
