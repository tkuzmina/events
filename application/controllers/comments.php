<?php

class Comments extends CI_Controller {

    function Comments() {
        parent::__construct();

        $this->load->library(array('encrypt', 'form_validation', 'session'));
        $this->load->helper(array('form', 'url', 'html', 'events_url'));
        $this->load->model(array('events_model', 'tags_model', 'comments_model'));

        init_events_page($this->session, $this->lang);
    }

    function index() {
        $event_id = $this->input->get('event_id');

        $events = $this->events_model->get_event_by_id($event_id);
        $this->tags_model->load_tags($events);

        $event = $events[0];
        $comments = $this->comments_model->load_comments($event_id);
        $event->comment_count = count($comments);

        $data['event'] = $event;
        $data['comments'] = $comments;
        $this->load->view('comments_view', $data);
    }

    function add() {
        $text = $this->input->post('text');
        $event_id = $this->input->post('event_id');
        $user = $this->session->userdata('current_user');

        if ($user) {
            $this->comments_model->insert_comment($text, $event_id, $user->id);
        }

        redirect_back($this->session);
    }

    function delete() {
        $comment_id = $this->input->get('comment_id');
        $this->comments_model->delete_comment($comment_id);

        redirect_back($this->session);
    }
}
