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

            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|is_unique[users.username]|xss_clean',
                array(
//                    'is_unique' => 'Ez a %s már létezik.',
//                    'min_length' => 'A %snek legalább 4 karaktert tartalmaznia kell.',
//                    'required' => 'A %s mező kitöltése kötelező.',
                )
            );
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
//        $user_join_date_plus_1->format('Y-m-d H:i:s');

        $currentTime = new DateTime();
//        $currentTime->format('Y-m-d H:i:s');

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
            if ($this->form_validation->run() == FALSE) {
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
//                        $jsonData['message'] = array('info' => 'Password not verified.');
                        $jsonData['message'] = array('info' => 'Login datas not verified.');
                        $jsonData['success'] = false;
                    }

                } else {
                    //if user not exist or not verified
//                    $jsonData['message'] = array('info' => 'Email not exist or not verified.');
                    $jsonData['message'] = array('info' => 'Login datas not exist or not verified.');
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
        $user_type = $this->session->userdata('user_type');

        if ($user_type == null) {
            redirect('/');
        }

        $logged_user = $this->session->userdata('email');
        $this->user = $this->User_model->get_user($logged_user);
//        var_dump($this->user);

        $this->load->view('/layouts/html_start');
        $this->load->view('/layouts/main/header');
        $this->load->view('/user/profile');
        $this->load->view('/layouts/main/footer');
        $this->load->view('/layouts/html_end');
    }

    public function update_pass() {
        $jsonData = array();

        if ($this->input->method() == 'post') {

            $this->form_validation->set_rules('cur_pass', 'Cur Pass', 'trim|required|xss_clean',
                array(
                    'required' => 'A %s mező kitöltése kötelező.'
                )
            );
            $this->form_validation->set_rules('new_pass', 'New Pass', 'trim|required|min_length[4]|max_length[50]|xss_clean',
                array(
                    'required' => 'A %s mező kitöltése kötelező.',
                    'min_length' => 'A %snak legalább 4 karaktert tartalmaznia kell.',
                )
            );
            $this->form_validation->set_rules('new_pass2', 'New Pass', 'trim|required|matches[new_pass]|xss_clean',
                array(
                    'required' => 'A %s mező kitöltése kötelező.',
                    'matches' => 'A két jelszó nem egyezik meg',
                )
            );

            if ($this->form_validation->run() === FALSE) {

                $jsonData['message'] = $this->form_validation->error_array();
                $jsonData['success'] = false;
            } else {

                $session_id = $this->session->userdata('user_id');
                $user = $this->User_model->get_user($session_id);
//                var_dump($user);
                $cur_pass = $this->input->post('cur_pass');

                //verify the current password
                if (password_verify($cur_pass, $user->password)) {

                    $user_id = $user->user_id;

                    $new_pass_info = array(
                        'password' => password_hash($this->input->post('new_pass'), PASSWORD_DEFAULT)
                    );

                    $this->User_model->update_user($user_id, $new_pass_info);

                    $jsonData['message'] = array('cur_pass' => 'A jelszó csere sikeres volt!');
                    $jsonData['success'] = true;
//                    $jsonData['redirect'] = '';

                } else {
                    $jsonData['message'] = array('cur_pass' => 'A jelenlegi jelszó nem megfelelő');
                    $jsonData['success'] = false;
                }
            }
        }

        echo json_encode($jsonData);
    }

    public function unsubscribe_from_email($encoded_username) {
        $users = $this->User_model->get_verified_users();

        foreach ($users as $user) {
            if ($encoded_username == md5($user->username)) {
                $this->newsletter_sub_change($user->user_id);
                $this->session->set_flashdata('unsubscribe', 'Successfully unsubscribe from the newsletter.');
                redirect(base_url());

            } else {
                $this->session->set_flashdata('unsubscribe', 'Unsubscribe was not successfull. pls contact with the administrator');
                redirect(base_url());            }
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

            $this->form_validation->set_rules('cur_pass', 'Cur Pass', 'trim|required|xss_clean',
                array(
                    'required' => 'A %s mező kitöltése kötelező.'
                )
            );

            if ($this->form_validation->run() === FALSE) {

                $jsonData['message'] = $this->form_validation->error_array();
                $jsonData['success'] = false;

            } else {

                $session_id = $this->session->userdata('user_id');
                $user = $this->User_model->get_user($session_id);
//                var_dump($user);
                $cur_pass = $this->input->post('cur_pass');

                //verify the current password
                if (password_verify($cur_pass, $user->password)) {

                    //delete user function
                    $this->delete_user($user->user_id);
                    $this->session->set_flashdata('profile_deleted', 'Profile deleted');
                    $jsonData['success'] = true;
                    $jsonData['redirect'] = base_url();

                } else {
                    $jsonData['message'] = array('cur_pass' => 'A jelszavak nem egyeznek');
                    $jsonData['success'] = false;
                }
            }
        }

        echo json_encode($jsonData);
    }

    // javítani //a képet nem törli ha profilból lesz törölve a profile és a content
    public function delete_user($user_id) {
        //unset session user data
        $this->unsetUserData();

        //nem jól működik mert a contenthez tartozó képeket nem törli
//        //delete contents which bounded to the user
//        $this->Content_model->delete_content_by_user_id($user_id);

        //delete user profile
        $this->User_model->delete_user($user_id);

    }
}
