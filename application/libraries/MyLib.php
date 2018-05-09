<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyLib {
    public $ci;
    protected $scripts = array();
    protected $styles = array();

    function __construct() {
        //now ci == $this
        $this->ci =& get_instance();
    }

    function add_script($script, $location = 0) {
        if (!isset($this->scripts[$location])) {
            $this->scripts[$location] = array();
        }
        $this->scripts[$location][] = $script;
    }

    function get_scripts($location = 0) {
        if (isset($this->scripts[$location])) {
            foreach ($this->scripts[$location] as $script) {
                echo '<script src="' . $script . '"></script>';
            }
        }
    }

    function add_style($style) {
        $this->styles[] = $style;
    }

    function get_styles() {
        foreach ($this->styles as $style) {
            echo '<link rel="stylesheet" href="' . $style . '">';
        }
    }

    function auth($permission) {
        $user_type = $this->ci->session->userdata('user_type');

        // user -> administrator -> moderator
        $user = 'user';
        $administrator = 'administrator';
        $moderator = 'moderator';

        //for debug
        $error = 'Permission level: ' . $permission . ', user type: ' . $user_type . ', result: redirect';

        switch ($user_type) {
            case $moderator:
                break;

            case $administrator:
                if ($permission == $moderator) {
//                    echo $error;
                    redirect(base_url());
                }
                break;

            case $user:
                if ($permission == $moderator || $permission == $administrator) {
//                    echo $error;
                    redirect(base_url());
                }
                break;

            default:
//                echo $error;
                redirect(base_url());
                break;
        }

        return;
    }

    function get_clear_slug($str) {
        $str = word_limiter($str, '3', '');
        $str = trim(preg_replace('/[^a-z0-9-]+/', '-', strtolower($str)), '-');

        return $str;
    }

    function custom_dateTime($time) {
        $date = new DateTime($time);
        return $date->format("Y.m.d. H:i");
    }
}