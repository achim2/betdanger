<?php

class Search_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    public function get_search_results($search_term = '') {
        // Use the Active Record class for safer queries.
        $this->db->select('*');
        $this->db->from('content');
        $this->db->where('status', 'public');
        $this->db->group_start();
//        $this->db->join('post_tags_relationship AS ptr', 'ptr.tag_id = tags.tag_id');
//        $this->db->join('posts', 'ptr.post_id = posts.post_id');
        $this->db->like('title', $search_term);
//        $this->db->or_like('body',$search_term);
        $this->db->group_end();

        // Execute the query.
        $query = $this->db->get();
        // Return the results.
        return $query->result();
    }

    public function get_admin_content_search($search_term = '') {
        $this->db->select('content.*, content_category.name as category_name');
        $this->db->from('content');
        $this->db->join('content_category', 'content_category.id = content.category_id');
        $this->db->order_by('content.created_at', 'DESC');
        $this->db->group_start();
        $this->db->like('title', $search_term);
        $this->db->or_like('body', $search_term);
        $this->db->or_like('content.id', $search_term);
        $this->db->or_like('status', $search_term);
        $this->db->group_end();

        // Execute the query.
        $query = $this->db->get();
        // Return the results.
        return $query->result();
    }


}