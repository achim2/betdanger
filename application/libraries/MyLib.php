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

    function auth($permission_level) {
        $user_type = $this->ci->session->userdata('user_type');

        // user -> administrator -> moderator
        $user = 'user';
        $administrator = 'administrator';
        $moderator = 'moderator';

        //if user type from db not isset
        if ((isset($user_type)) && ($user_type != null) && ($user_type != '')) {
            //for debug
            $string = 'Permission level: ' . $permission_level . ', user type: ' . $user_type . ', result: ';

            //if permission level administrator then admin and moderator has access
            if ($permission_level == $administrator) {

                if ($user_type == $user) {
//                    echo $string . 'redirect';
                    redirect(base_url());
                }

                //if permission level moderator then moderator has access
            } elseif ($permission_level == $moderator) {

                if ($user_type == $user || $user_type == $administrator) {
//                    echo $string . 'redirect';
                    redirect(base_url());
                }

                //if permission level something else then redirect
            } else {
//                echo $string . 'redirect';
                redirect(base_url());
            }

        } else {
//            echo 'user_type not isset, redirect';
            redirect(base_url());
        }

    }

    public function get_slug($str) {
        $str = convert_accented_characters($str);
        $str = word_limiter($str, '4', '');
        $str = strtolower($str);
        $cleaning = array(',', '.', '\'', '"', ' ', '!', '_', '#', '<', '>', '/');
        $str = str_replace($cleaning, '-', $str);

        return $str;
    }
}