<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->mylib->auth('moderator');
    }

    public function index() {
        $this->users();
    }

    public function users() {
        $this->title = "Users";

        $this->users = $this->User_model->get_users_to_admin();

        $this->load->view('/layouts/html_start');
        $this->load->view('/admin/users');
        $this->load->view('/layouts/html_end');
    }

    public function newsletters() {
        $this->users = $this->User_model->get_user_to_newsletter();

        $this->load->view('/layouts/html_start');
        $this->load->view('/admin/newsletters');
        $this->load->view('/layouts/html_end');
    }

    public function blog_posts() {

        $this->load->view('/layouts/html_start');
        $this->load->view('/admin/blog_posts');
        $this->load->view('/layouts/html_end');
    }

    public function previews() {

        $this->load->view('/layouts/html_start');
        $this->load->view('/admin/previews');
        $this->load->view('/layouts/html_end');
    }


}
