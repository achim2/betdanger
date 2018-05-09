<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        redirect('/');
    }

    public function signup() {
        $jsonData = array();

        //if post exist
        if ($this->input->method() == 'post') {

            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|is_unique[users.username]|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[50]|xss_clean');
            $this->form_validation->set_rules('password2', 'Password again', 'trim|required|matches[password]|xss_clean');

            // if form validation == FALSE
            if ($this->form_validation->run() == false) {
                $jsonData['message'] = $this->form_validation->error_array();
                $jsonData['success'] = false;

            } else {
                //if form validation TRUE
                //encrypt the password
                $encrypted_password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

                //set data array to the user infos
                $data = array(
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'password' => $encrypted_password,
                    'newsletter' => $this->input->post('newsletter') == 'on' ? 'yes' : 'no',
                    'ip_address' => $this->input->ip_address(),
                    'verify' => random_string('md5', 16)
                );

                //send user data to the model
                $this->User_model->create_member($data);

                //get user data by email
                $user = $this->User_model->get_user($data['email']);

                //set json true and set the user id to the url
                $jsonData['success'] = true;
                //redirect the url below
                $jsonData['redirect'] = base_url('/email/send_user_verification_email/' . $user->user_id);
            }
        }

        echo json_encode($jsonData);
    }

    public function user_verify($random_string) {
        //get user by random string that sent to the user's email
        $user = $this->User_model->verify_user_at_db($random_string);

        date_default_timezone_set('Europe/Budapest');

        $user_join_date_plus_1 = new DateTime($user->join_date);
        $user_join_date_plus_1->add(new DateInterval('P1D'));

        $currentTime = new DateTime();

        //if exist user and sign up email not expired (24 hours)
        if ($user && ($user_join_date_plus_1 > $currentTime)) {
            //verify the user and send info
            $new_data = array(
                'verify' => 'verified'
            );

            //update data
            $this->User_model->update_user($user->user_id, $new_data);

            //redirect the page
            $this->session->set_flashdata('registered', 'Successful verify. You can login now.');
            redirect(base_url());

        } else {
            //delete user account and send info
            $this->delete_user($user->user_id);

            $this->session->set_flashdata('registered', 'Verify code expired. Please sign up again');
            redirect(base_url());
        }
    }

    public function login() {
        $jsonData = array();

        //if post exist
        if ($this->input->method() == 'post') {
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|min_length[4]|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[50]|xss_clean');

            // if form validation == FALSE
            if ($this->form_validation->run() == false) {
                $jsonData['message'] = $this->form_validation->error_array();
                $jsonData['succes'] = false;

            } else {
                //if form validation TRUE
                //get email and password from input
                $email_input = $this->input->post('email');
                $password_input = $this->input->post('password');

                //get user info by email
                $user = $this->User_model->get_user($email_input);

                //if user exist and verified
                if ($user && ($user->verify == 'verified')) {

                    // if password verification oke
                    if (password_verify($password_input, $user->password)) {
                        //Create array of user data
                        $user_data = array(
                            'user_id' => $user->user_id,
                            'user_type' => $user->user_type,
                            'username' => $user->username,
                            'email' => $user->email,
                            'logged_in' => true
                        );

                        //Set session userdata
                        $this->session->set_userdata($user_data);
                        $this->session->set_flashdata('login_success', 'Successful login.');
                        $jsonData['success'] = true;
                        $jsonData['redirect'] = base_url();

                    } else {
                        // if password verification not oke
                        $jsonData['message'] = array('info' => 'Login data not exist or not verified.');
                        $jsonData['success'] = false;
                    }

                } else if ($user && ($user->verify == 'tilted')) {
                    //if user exist & tilted
                    $jsonData['message'] = array('info' => 'We are sorry, but you are tilted now. Please contact us.');
                    $jsonData['success'] = false;

                } else {
                    //if user not exist or not verified
                    $jsonData['message'] = array('info' => 'Login data not exist or not verified.');
                    $jsonData['success'] = false;
                }
            }
        }
        echo json_encode($jsonData);
    }

    private function unsetUserData() {
        //Unset user data
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_type');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('logged_in');
    }

    public function logout() {
        $this->unsetUserData();
//        $this->session->sess_destroy();

        //Set message
        $this->session->set_flashdata('log_out', 'Successful logout.');
        redirect(base_url());
    }

    public function profile() {
        $this->mylib->auth('user');
        $user = $this->session->userdata();
        $this->user = $this->User_model->get_user($user['email']);

        $this->load->view('/layouts/html_start');
        $this->load->view('/layouts/main/header');
        $this->load->view('/user/profile');
        $this->load->view('/layouts/main/footer');
        $this->load->view('/layouts/html_end');
    }

    public function new_pass($encoded_email) {
        $user_data = array();
        $users = $this->User_model->get_verified_users();

        foreach ($users as $user) {
            if ($encoded_email == sha1($user->email)) {
                $user_data = $user;
            }
        }

        if (isset($user_data) && !empty($user_data)) {
            $this->id = $user_data->user_id;

        } else {
            redirect(base_url());
        }

        $this->load->view('/layouts/html_start');
        $this->load->view('/layouts/main/header');
        $this->load->view('/user/new_pass');
        $this->load->view('/layouts/main/footer');
        $this->load->view('/layouts/html_end');
    }

    public function new_pass_process($id) {
        $jsonData = array();

        if ($this->input->method() == 'post') {
            $this->form_validation->set_rules('new_pass', 'Add new password', 'trim|required|min_length[4]|max_length[50]|xss_clean');
            $this->form_validation->set_rules('new_pass_re', 'Add new password again', 'trim|required|matches[new_pass]|xss_clean');

            if ($this->form_validation->run() === false) {
                $jsonData['message'] = $this->form_validation->error_array();
                $jsonData['success'] = false;

            } else {
                $password = password_hash($this->input->post('new_pass'), PASSWORD_DEFAULT);

                $this->User_model->update_user($id, array('password' => $password));

                $this->session->set_flashdata('pass_changed', 'Password successfully changed. You can <a href="#" data-toggle="modal" data-target="#login">login</a> now');

                $jsonData['success'] = true;
                $jsonData['redirect'] = base_url();
            }

        } else {
            $jsonData['message'] = array('info' => 'This process was not successful!');
            $jsonData['success'] = false;
        }

        echo json_encode($jsonData);
    }

    public function update_pass() {
        $jsonData = array();

        if ($this->input->method() == 'post') {

            $this->form_validation->set_rules('cur_pass', 'Cur Pass', 'trim|required|xss_clean');
            $this->form_validation->set_rules('new_pass', 'New Pass', 'trim|required|min_length[4]|max_length[50]|xss_clean');
            $this->form_validation->set_rules('new_pass2', 'New Pass', 'trim|required|matches[new_pass]|xss_clean');

            if ($this->form_validation->run() === false) {
                $jsonData['message'] = $this->form_validation->error_array();
                $jsonData['success'] = false;

            } else {
                $session_id = $this->session->userdata('user_id');
                $user = $this->User_model->get_user($session_id);
                $cur_pass = $this->input->post('cur_pass');

                //verify the current password
                if (password_verify($cur_pass, $user->password)) {

                    $user_id = $user->user_id;

                    $new_pass_info = array(
                        'password' => password_hash($this->input->post('new_pass'), PASSWORD_DEFAULT)
                    );

                    $this->User_model->update_user($user_id, $new_pass_info);

                    $jsonData['message'] = array('cur_pass' => 'Password changed successfully!');
                    $jsonData['success'] = true;

                } else {
                    $jsonData['message'] = array('cur_pass' => 'The current password is not ok!');
                    $jsonData['success'] = false;
                }
            }
        }

        echo json_encode($jsonData);
    }

    public function unsubscribe_from_email($encoded_username) {
        $users = $this->User_model->get_verified_users();
        $user_data = array();

        foreach ($users as $user) {
            if ($encoded_username == md5($user->username)) {
                array_push($user_data, $user);
            }
        }

        if (is_array($user_data) && !empty($user_data) && sizeof($user_data) == 1) {
            $this->User_model->update_user($user_data[0]->user_id, array('newsletter' => 'no'));
            $this->session->set_flashdata('unsubscribe', 'Successfully unsubscribe from the newsletter.');
            redirect(base_url());

        } else {
            $this->session->set_flashdata('unsubscribe', 'Unsubscribe was not successful. pls contact with the administrator');
            redirect(base_url());
        }
    }

    public function newsletter_sub_change($user_id = null) {
        if ($user_id == null) {
            $user = $this->User_model->get_user($this->session->userdata('user_id'));
        } else {
            $user = $this->User_model->get_user($user_id);
        }

        if ($user->newsletter == 'yes') {
            $this->User_model->update_user($user->user_id, array('newsletter' => 'no'));

        } else {
            $this->User_model->update_user($user->user_id, array('newsletter' => 'yes'));
        }
    }

    public function delete_user_from_profile() {
        $jsonData = array();

        if ($this->input->method() == 'post') {

            $this->form_validation->set_rules('current_pass', 'Cur Pass', 'trim|required|xss_clean');

            if ($this->form_validation->run() === false) {
                $jsonData['message'] = $this->form_validation->error_array();
                $jsonData['success'] = false;

            } else {
                $session_id = $this->session->userdata('user_id');
                $user = $this->User_model->get_user($session_id);
                $cur_pass = $this->input->post('current_pass');

                //verify the current password
                if (password_verify($cur_pass, $user->password)) {
                    //delete user function
                    $this->delete_user($user->user_id);
                    $this->session->set_flashdata('profile_deleted', 'Profile deleted');
                    $jsonData['success'] = true;
                    $jsonData['redirect'] = base_url();

                } else {
                    $jsonData['message'] = array('current_pass' => 'The passwords are not equal!');
                    $jsonData['success'] = false;
                }
            }
        }

        echo json_encode($jsonData);
    }

    public function delete_user($user_id) {
        //unset session user data
        $this->unsetUserData();
        //delete user profile
        $this->User_model->delete_user($user_id);
    }

    public function tilt_toggle($id) {
        $jsonData = array();
        $option = $this->input->post('toggle-' . $id);

        if ($option == 'on') {
            $option = 'verified';
        } else {
            $option = 'tilted';
        }

        $jsonData['option'] = $option;

        $info = array('verify' => $option);
        $this->User_model->update_user($id, $info);

        echo json_encode($jsonData);
    }

    public function change_user_type($id) {
        $jsonData = array();
        $type = $this->input->post('select_type');

        if ($type != null) {
            $jsonData['success'] = true;
            $jsonData['type'] = $type;

            $info = array('user_type' => $type);
            $this->User_model->update_user($id, $info);

        } else {
            $jsonData['success'] = false;
            $jsonData['msg'] = 'Something not cool, pls contact with a developer. :D';
        }

        echo json_encode($jsonData);
    }
}
