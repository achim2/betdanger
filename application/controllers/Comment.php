<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller {

    public function __construct() {
        parent::__construct();

//        $this->mylib->auth('administrator');
    }

    public function add_comment_process($id) {
        $jsonData = array();

        $this->form_validation->set_rules('comment', 'Comment', 'required|min_length[4]');

        if ($this->form_validation->run() === FALSE) {
            $jsonData['message'] = $this->form_validation->error_array();
            $jsonData['success'] = false;

        } else {
            $info = array(
                'user_id' => $this->session->userdata('user_id'),
                'content_id' => $id,
                'status' => 'enabled',
                'body' => $this->input->post('comment'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            $this->Comment_model->add_comment($info);

            $jsonData['message'] = array('title' => 'Comment successfully added.');
            $jsonData['success'] = true;
        }

        echo json_encode($jsonData);
    }

    public function get_comments($content_id) {
        $jsonData = array();
        $data = $this->Comment_model->get_comments_by_content_id($content_id);
        $str = '';
        $user = $this->session->userdata();

        //javítani a domot, ha nincs id akkor az id üresen marad. stb (dom javítás)

        foreach ($data as $item) {

            //if user logged in or moderator
            $terms = (isset($user['user_id']) && ($user['user_id'] == $item->user_id) || (isset($user['user_type']) && $user['user_type'] == 'moderator'));

            //if user == moderator
            $terms_moderator = (isset($user['user_type']) && $user['user_type'] == 'moderator');

            if ((isset($user['user_type']) && $user['user_type'] == 'moderator') || $item->status != 'disabled') {

                $str .= '<div class="comment ' . ($item->status != 'enabled' ? 'banned' : '') . '" id="' . ($terms ? $item->id : '') . '">
                            <div class="comment__info">
                                <p class="m-0">' . $item->username . '</p>
                                <p>' . $item->created_at . '</p>
                                <a class="icon ' .
                    ($item->status != 'enabled' ? 'icon-thumb-down js-enable-comment' : 'icon-thumb-up js-disable-comment') . ' ' .
                    (!$terms_moderator ? 'd-none' : 'js-comment-status') . '"></a>
                                <a class="icon icon-pencil ' . ($terms ? 'js-edit-comment' : 'd-none') . '"></a>
                                <a class="icon icon-close ' . ($terms ? 'js-delete-comment' : 'd-none') . '"></a>
                            </div>
                            <p class="comment__text">' . $item->body . '</p>
                         </div>';
            }
        }

        $jsonData['comment'] = $str;
        echo json_encode($jsonData);
    }

    public function change_commit_status($id, $status) {
        $user = $this->session->userdata();
        $info = array();

        if (isset($user['user_type']) && $user['user_type'] == 'moderator') {
            if ($status == 'disable') {
                $info = array('status' => 'disabled');

            } elseif ($status == 'enable') {
                $info = array('status' => 'enabled');

            } else {
            }

            $this->Comment_model->update_comment($id, $info);
        }
    }

    public function del_comment($comm_id) {
        $user = $this->session->userdata();
        $comment = $this->Comment_model->get_comment_by_comment_id($comm_id);

        if ((isset($user['user_id']) && $user['user_id'] == $comment->user_id) || (isset($user['user_type']) && $user['user_type'] == 'moderator')) {
            $this->Comment_model->delete_comment($comm_id);
        }
//           echo "You have not permission to delete this comment!";
    }

}