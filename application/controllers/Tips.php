<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tips extends CI_Controller {

    public function __construct() {
        parent::__construct();


    }

    public function index() {

    }

    public function my_tips(){
        $this->mylib->auth('administrator');

        $this->load->view('/layouts/html_start');
        $this->load->view('/tips/mytips');
        $this->load->view('/layouts/html_end');

    }

    public function tipsters() {
        $this->load->view('/layouts/html_start');
        $this->load->view('/tips/tipsters');
        $this->load->view('/layouts/html_end');
    }
}