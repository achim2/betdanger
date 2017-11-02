<?php

class User_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    public function create_member($data) {
        $insert = $this->db->insert('users', $data);
        return $insert;
    }

    public function verify_user_at_db($random_string){
        $this->db->where('verify', $random_string);
        $data = $this->db->get('users');

        if ($data->num_rows() == 1) {
            return $data->row();
        } else {
            return false;
        }
    }

    public function update_user($user_id, $data) {
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);
    }

    public function get_user($user) {
        if (is_numeric($user) && $user > 0) {
            $this->db->where('user_id', $user);
        } else {
            $this->db->where('email', $user);
        }

        $data = $this->db->get('users');

        if ($data->num_rows() == 1) {
            return $data->row();
        } else {
            return false;
        }
    }

    public function get_users_to_admin(){
        $this->db->select('users.*');
        $query = $this->db->get('users');
        return $query->result();
    }

    public function get_verified_users(){
        $this->db->select('users.*');
        $this->db->where('verify', 'verified');
        $query = $this->db->get('users');
        return $query->result();
    }

    public function get_user_to_newsletter(){
        $this->db->select('users.*');
        $this->db->where('newsletter', 'yes');
        $this->db->where('verify', 'verified');
        $query = $this->db->get('users');
        return $query->result();
    }

    public function delete_user($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->delete('users');
    }
}