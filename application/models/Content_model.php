<?php

class Content_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    public function add_content($info) {
        $this->db->insert('content', $info);
    }

    //public content, bounded to the user
    public function get_my_content($category, $slug = FALSE) {
        $user_id = $this->session->userdata("user_id");

        if (isset($user_id) && $user_id != null) {

            if ($slug === FALSE) {
                $this->db->select('content.*');
                $this->db->order_by('content.created_at', 'DESC');
                $this->db->where('user_id', $user_id);
                $this->db->where('category', $category);
                $query = $this->db->get('content');
                return $query->result();
            }

            $this->db->select('content.*');
            $this->db->where('slug', $slug);
            $this->db->where('user_id', $user_id);
            $this->db->where('category', $category);
            $query = $this->db->get('content');
            return $query->row();

        } else {
            return null;
        }
    }

    public function get_cat_content_to_public($category, $slug = FALSE) {
        if ($slug === FALSE) {
            $this->db->select('content.*, users.username');
            $this->db->where('status', 'public');
            $this->db->where('category', $category);
            $this->db->order_by('content.created_at', 'DESC');
            $this->db->join('users', 'users.user_id = content.user_id');
            $query = $this->db->get('content');
            return $query->result();
        }

        $this->db->select('content.*, users.username');
        $this->db->where('slug', $slug);
        $this->db->where('status', 'public');
        $this->db->where('category', $category);
        $this->db->join('users', 'users.user_id = content.user_id');
        $this->db->order_by('content.created_at', 'DESC');
        $query = $this->db->get('content');
        return $query->row();
    }

    public function get_content_to_public($slug = FALSE) {
        if ($slug === FALSE) {
            $this->db->select('content.*, users.username');
            $this->db->where('status', 'public');
            $this->db->order_by('content.created_at', 'DESC');
            $this->db->join('users', 'users.user_id = content.user_id');
            $query = $this->db->get('content');
            return $query->result();
        }

        $this->db->select('content.*, users.username');
        $this->db->where('slug', $slug);
        $this->db->where('status', 'public');
        $this->db->join('users', 'users.user_id = content.user_id');
        $this->db->order_by('content.created_at', 'DESC');
        $query = $this->db->get('content');
        return $query->row();
    }


    public function get_content_to_search($slug) {
        if ($slug === FALSE) {
            $this->db->select('content.*');
            $this->db->where('status', 'public');
            $this->db->order_by('content.created_at', 'DESC');
            $query = $this->db->get('content');
            return $query->result();
        }

        $this->db->select('content.*');
        $this->db->where('slug', $slug);
        $this->db->where('status', 'public');
        $this->db->order_by('content.created_at', 'DESC');
        $query = $this->db->get('content');
        return $query->row();
    }


    //get content id for delete the image
    public function get_content_by_id($id) {
        $this->db->select('content.*');
        $this->db->where('content_id', $id);
        $query = $this->db->get('content');
        return $query->row();
    }

    public function update_content($id, $info) {
        $this->db->where('content_id', $id);
        $this->db->update('content', $info);
    }

    public function delete_content($id) {
        $this->db->where('content_id', $id);
        $this->db->delete('content');
    }

    //delete content when the profile deleted
    public function delete_content_by_user_id($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->delete('content');
    }

    //COMMENTS

    public function add_comment($info) {
        $this->db->insert('comments', $info);
    }

    public function get_comments($content_id) {
        $this->db->select('comments.*, users.username');
        $this->db->where('content_id', $content_id);
        $this->db->join('users', 'users.user_id = comments.user_id');
        $query = $this->db->get('comments');
        return $query->result();
    }

    //delete comment by CONTENT ID
    public function delete_comment_by_content($content_id) {
        $this->db->where('content_id', $content_id);
        $this->db->delete('comments');
    }
    //delete comment by COMMENT ID
    public function delete_comment_by_user($comm_id) {
        $this->db->where('comment_id', $comm_id);
        $this->db->delete('comments');
    }




}