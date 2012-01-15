<?php

class Tags extends CI_Controller {

    function Tags() {
        parent::__construct();

        $this->load->library(array('encrypt', 'form_validation', 'session'));
        $this->load->helper(array('form', 'url', 'events_url'));
        $this->load->model(array('tags_model'));

        init_events_page($this->session, $this->lang);
    }

    function add() {
        $name = $this->input->post('name');
        $event_id = $this->input->post('event_id');
        $user = $this->session->userdata('current_user');

        if ($user) {
            $this->tags_model->insert_tag($name, $event_id, $user->id);
        }

        redirect_back($this->session);
    }

    function delete() {
        $tag_id = $this->input->get('tag_id');
        $event_id = $this->input->get('event_id');
        $this->tags_model->delete_tag($tag_id, $event_id);

        redirect_back($this->session);
    }

}
