<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

    public function send_contact_email() {
        $jsonData = array();

        if ($this->input->method() == 'post') {

            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[4]|xss_clean',
                array(
//                    'min_length' => 'A %snek legalább 4 karaktert tartalmaznia kell.',
//                    'required' => 'A %s mező kitöltése kötelező.',
                )
            );
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean',
                array(
//                    'required' => 'A %s mező kitöltése kötelező.',
//                    'valid_email' => 'A %s cím formátuma nem megfelelő. pl: pelda@pelda.com',
                )
            );
            $this->form_validation->set_rules('message', 'Message', 'trim|required|min_length[4]|xss_clean',
                array(
//                    'min_length' => 'A %snek legalább 4 karaktert tartalmaznia kell.',
//                    'required' => 'A %s mező kitöltése kötelező.',
                )
            );

            if ($this->form_validation->run() == false) {
                $jsonData['message'] = $this->form_validation->error_array();
                $jsonData['success'] = false;

            } else {

//                error_log('email');

                $config['protocol'] = 'smtp';
                $config['smtp_host'] = 's7.tarhely.com';
                $config['smtp_user'] = 'info@sportsalmanac.org';
                $config['smtp_pass'] = 'nokedli123';
                $config['smtp_port'] = 587;
                $config['smtp_crypto'] = 'tls';
                $config['mailtype'] = 'html';

                $this->load->library('email');

                $this->email->initialize($config);

                $this->email->from('info@sportsalmanac.org');
                $this->email->to('ahimjuhasz@gmail.com');
                $this->email->subject('betDANGER! email ' . $this->input->post('name') . '!');

                $data = $this->input->post('name') . '<br/>';
                $data .= 'Email: ' . $this->input->post('email') . '<br>';
                $data .= 'Üzenet:' . $this->input->post('message');


                $this->email->message($data);
                $this->email->send();
                $this->email->clear();

//                log_message('debug', $data);

                //send json data
                $jsonData['message'] = array('info' => 'Sikeres üzenet küldés!');
                $jsonData['success'] = true;

            }
        }

        echo json_encode($jsonData);
    }

    public function send_user_verification_email($id) {

        //get the user by id
        $user = $this->User_model->get_user($id);

        //send verification email
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 's7.tarhely.com';
        $config['smtp_user'] = 'info@sportsalmanac.org';
        $config['smtp_pass'] = 'nokedli123';
        $config['smtp_port'] = 587;
        $config['smtp_crypto'] = 'tls';
        $config['mailtype'] = 'html';

        $this->load->library('email');

        $this->email->initialize($config);

        $this->email->from('info@sportsalmanac.org');
        $this->email->to($user->email);
        $this->email->subject('betDANGER! email ' . $user->username . '!');

        $data = $user->username . '<br/>';
        $data .= 'Email: ' . $user->email . '<br>';
        $data .= 'Üzenet: Email verification. Click the below the URL if you registered at Prisca.com <br/>';
        $data .= '<a href="' . base_url('/user/user_verify/' . $user->verify) .'">' . $user->verify . '</a>';

        $this->email->message($data);
        $this->email->send();
        $this->email->clear();

//        log_message('debug', $data);

        //set notice
        $this->session->set_flashdata('verification_notice', 'Successful registering. You can verify your account at your given email.');
        //redirect hte welcome page
        redirect(base_url());
    }
}