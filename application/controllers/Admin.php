<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->mylib->auth('moderator');
    }

    public function index() {

        $this->load->view('/layouts/html_start');
        $this->load->view('/admin/index');
        $this->load->view('/layouts/html_end');
    }

    public function users() {
        $this->title = "Users";

        $this->load->view('/layouts/html_start');
        $this->load->view('/admin/users');
        $this->load->view('/layouts/html_end');
    }

    public function newsletter() {
        $this->users = $this->User_model->get_user_to_newsletter();

        $this->load->view('/layouts/html_start');
        $this->load->view('/admin/newsletter');
        $this->load->view('/layouts/html_end');
    }


}
