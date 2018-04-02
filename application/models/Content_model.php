<?php

class Content_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    public function add_category($info) {
        $this->db->insert('content_category', $info);
    }

    public function update_category($id, $info) {
        $this->db->where('id', $id);
        $this->db->update('content_category', $info);
    }

    public function re_categorise_content($id, $info) {
        $this->db->where('id', $id);
        $this->db->update('content', $info);
    }

    public function get_categories($id = false, $name = false) {
        if ($id != false) {
            $this->db->select('content_category.*');
            $this->db->where('id', $id);
            $query = $this->db->get('content_category');
            return $query->row();
        }

        if ($name != false) {
            $this->db->select('content_category.*');
            $this->db->where('name', $name);
            $query = $this->db->get('content_category');
            return $query->row();
        }

        $this->db->select('content_category.*');
        $query = $this->db->get('content_category');
        return $query->result();
    }

    public function add_content($info) {
        $this->db->insert('content', $info);
    }

    public function update_content($id, $info) {
        $this->db->where('id', $id);
        $this->db->update('content', $info);
    }

    public function get_content($id = false) {
        if ($id == false) {
            $this->db->select('content.*, content_category.name as category_name');
            $this->db->order_by('content.created_at', 'DESC');
            $this->db->join('content_category', 'content_category.id = content.category_id');
            $query = $this->db->get('content');
            return $query->result();
        }

        $this->db->select('content.*, content_category.name as category_name');
        $this->db->join('content_category', 'content_category.id = content.category_id');
        $this->db->where('content.id', $id);
        $query = $this->db->get('content');
        return $query->row();
    }

    public function get_content_to_public($slug = false, $category_id = false) {
        if ($slug != false) {
            $this->db->select('content.*, users.username, content_category.name as category_name');
            $this->db->where('slug', $slug);
            $this->db->where('status', 'public');
            $this->db->not_like('category_id', 1);
            $this->db->join('users', 'users.user_id = content.user_id');
            $this->db->join('content_category', 'content_category.id = content.category_id');
            $this->db->order_by('content.created_at', 'DESC');
            $query = $this->db->get('content');
            return $query->row();
        }

        if ($category_id != false) {
            $this->db->select('content.*, users.username, content_category.name as category_name');
            $this->db->where('category_id', $category_id);
            $this->db->where('status', 'public');
            $this->db->not_like('category_id', 1);
            $this->db->join('users', 'users.user_id = content.user_id');
            $this->db->join('content_category', 'content_category.id = content.category_id');
            $this->db->order_by('content.created_at', 'DESC');
            $query = $this->db->get('content');
            return $query->result();
        }

        $this->db->select('content.*, users.username, content_category.name as category_name');
        $this->db->where('status', 'public');
        $this->db->not_like('category_id', 1);
        $this->db->order_by('content.created_at', 'DESC');
        $this->db->join('users', 'users.user_id = content.user_id');
        $this->db->join('content_category', 'content_category.id = content.category_id');
        $query = $this->db->get('content');
        return $query->result();
    }


//    public function get_content_to_search($slug) {
//        if ($slug == false) {
//            $this->db->select('content.*');
//            $this->db->where('status', 'public');
//            $this->db->order_by('content.created_at', 'DESC');
//            $query = $this->db->get('content');
//            return $query->result();
//        }
//
//        $this->db->select('content.*');
//        $this->db->where('slug', $slug);
//        $this->db->where('status', 'public');
//        $this->db->order_by('content.created_at', 'DESC');
//        $query = $this->db->get('content');
//        return $query->row();
//    }


    public function delete_category($id) {
        $this->db->where('id', $id);
        $this->db->delete('content_category');
    }

    //get content id for delete the image
    public function get_content_by_id($id) {
        $this->db->select('content.*');
        $this->db->where('id', $id);
        $query = $this->db->get('content');
        return $query->row();
    }

    public function delete_content($id) {
        $this->db->where('id', $id);
        $this->db->delete('content');
    }

    //COMMENTS

//    public function add_comment($info) {
//        $this->db->insert('comments', $info);
//    }
//
//    public function get_comments($content_id) {
//        $this->db->select('comments.*, users.username');
//        $this->db->where('content_id', $content_id);
//        $this->db->join('users', 'users.user_id = comments.user_id');
//        $query = $this->db->get('comments');
//        return $query->result();
//    }
//
//    //delete comment by CONTENT ID
//    public function delete_comment_by_content($content_id) {
//        $this->db->where('content_id', $content_id);
//        $this->db->delete('comments');
//    }
//
//    //delete comment by COMMENT ID
//    public function delete_comment_by_user($comm_id) {
//        $this->db->where('comment_id', $comm_id);
//        $this->db->delete('comments');
//    }


}