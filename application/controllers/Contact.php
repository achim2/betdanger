<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function index()
    {
        $this->load->view('layouts/html_start');
        $this->load->view('contact/index');
        $this->load->view('layouts/html_end');
    }
}
