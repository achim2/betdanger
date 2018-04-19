<?php

class Comment_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    public function add_comment($info) {
        $this->db->insert('comments', $info);
    }

    public function get_comments_by_content_id($content_id) {
        $this->db->select('comments.*, users.username');
        $this->db->where('content_id', $content_id);
        $this->db->join('users', 'users.user_id = comments.user_id');
        $query = $this->db->get('comments');
        return $query->result();
    }

    public function get_comment_by_comment_id($comm_id) {
        $this->db->select('comments.*');
        $this->db->where('id', $comm_id);
        $query = $this->db->get('comments');
        return $query->row();
    }

    public function update_comment($id, $info) {
        $this->db->where('id', $id);
        $this->db->update('comments', $info);
    }

    //delete comment by COMMENT ID
    public function delete_comment_by_content_id($id) {
        $this->db->where('content_id', $id);
        $this->db->delete('comments');
    }

    //delete comment by COMMENT ID
    public function delete_comment($id) {
        $this->db->where('id', $id);
        $this->db->delete('comments');
    }
}