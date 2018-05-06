<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller {

    public function __construct() {
        parent::__construct();

//        $this->mylib->auth('administrator');
    }

    public function add_comment_process($id) {
        //$id == content id
        $jsonData = array();
        $this->form_validation->set_rules('comment', 'Comment', 'required|min_length[1]');

        if ($this->form_validation->run() === false) {
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

    public function edit_comment_process($id) {
        //$id == comment id
        $jsonData = array();
        $this->form_validation->set_rules('edit_comment', 'Comment', 'required|min_length[1]');

        if ($this->form_validation->run() === false) {
            $jsonData['message'] = $this->form_validation->error_array();
            $jsonData['success'] = false;

        } else {
            $info = array(
                'body' => $this->input->post('edit_comment')
            );

            $this->Comment_model->update_comment($id, $info);

            $jsonData['message'] = array('title' => 'Comment successfully edited..');
            $jsonData['redirect'] = "";
            $jsonData['success'] = true;
        }

        echo json_encode($jsonData);
    }

    public function get_comments($content_id) {
        $jsonData = array();
        $data = $this->Comment_model->get_comments_by_content_id($content_id);
        $str = '';
        $user = $this->session->userdata();

        foreach ($data as $item) {
            //if user == moderator
            $moderator = (isset($user['user_type']) && $user['user_type'] == 'moderator');
            //if user logged in or moderator
            $terms = (isset($user['user_id']) && ($user['user_id'] == $item->user_id) || $moderator);

            //moderator can see all of the content || disabled content
            if ($moderator || $item->status != 'disabled') {
                $form = '<form class="comment__form" style="display: none;">
                            <div class="form-group">
                                <input type="text" class="form-control" name="edit_comment" value="' . $item->body . '">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary js-submit-comment" value="Submit">
                            </div>
                         </form>';

                $str .= '<div class="comment' . ($item->status != 'enabled' ? ' banned' : '') . '" ' . ($terms ? ' id="' . $item->id . '" ' : '') . '>
                            <div class="comment__info">
                                <p class="m-0">' . $item->username . '</p>
                                <p>' . $this->mylib->custom_dateTime($item->created_at) . '</p>
                                ' . ($moderator ? '<a class="js-comment-status icon ' . ($item->status != 'enabled' ? 'icon-thumb-down js-enable-comment' : 'icon-thumb-up js-disable-comment') . '"></a>' : '') . '
                                ' . ($terms ? '<a class="icon icon-pencil js-edit-comment"></a>' : '') . '
                                ' . ($terms ? '<a class="icon icon-close js-delete-comment"></a>' : '') . '
                            </div>
                            <div class="comment__body">
                                <p class="comment__text">' . $item->body . '</p>
                                ' . ($terms ? $form : '') . '
                            </div>
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
    }

}