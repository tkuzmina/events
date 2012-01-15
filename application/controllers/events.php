<?php

class Events extends CI_Controller {

    function Events() {
        parent::__construct();

        $this->load->library(array('encrypt', 'form_validation', 'session'));
        $this->load->helper(array('form', 'url', 'html', 'events_url'));
        $this->load->model(array('events_model', 'users_model', 'tags_model', 'categories_model', 'comments_model'));

        init_events_page($this->session, $this->lang);
    }

    function index() {
        $search_params = $this->session->userdata('search_params');
        $events = $this->events_model->get_events_by_criteria($search_params);
        $this->render_events($events);
    }

    function filter() {
        $this->set_search_params(
            $this->input->post('category_id'),
            $this->input->post('user_login'),
            $this->input->post('tag_name'),
            $this->input->post('search_text')
        );

        redirect(events_url('events'));
    }

    function filter_tag() {
        $tag_id = $this->input->get('tag_id');
        $tag = $this->tags_model->get_by_id($tag_id);

        if ($tag) {
            $user = $this->users_model->get_by_id($tag->user_id);
            $this->set_search_params('', $user->login, $tag->name, '');
        }

        redirect(events_url('events'));
    }

    function my_events() {
        $current_user = $this->session->userdata('current_user');
        $user_login = $current_user ? $current_user->login : '';
        $this->set_search_params('', $user_login, '', '');
        redirect(events_url('events'));
    }

    function clear_filter() {
        $this->set_search_params('', '', '', '');
        redirect(events_url('events'));
    }

    private function set_search_params($category_id, $user_login, $tag_name, $search_text) {
        $search_params = array(
            'category_id' => $category_id,
            'user_login' => $user_login,
            'tag_name' => $tag_name,
            'search_text' => $search_text,
        );
        $this->session->set_userdata('search_params', $search_params);
    }

    function show_add() {
        $data['categories'] = $this->categories_model->get_category_map(false);
        $this->load->view('event_view', $data);
    }

    function add() {
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $category_id = $this->input->post('category_id');
        $user = $this->session->userdata('current_user');

        if ($user) {
            $this->events_model->insert_event($name, $description, $category_id, $user->id);
        }

        redirect(events_url('events'));
    }

    function show_edit() {
        $event_id = $this->input->get('event_id');
        $events = $this->events_model->get_event_by_id($event_id);

        $data['event'] = $events[0];
        $data['categories'] = $this->categories_model->get_category_map(false);
        $this->load->view('event_view', $data);
    }

    function edit() {
        $event_id = $this->input->post('event_id');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $category_id = $this->input->post('category_id');

        $this->events_model->update_event($event_id, $name, $description, $category_id);

        redirect(events_url('events'));
    }

    function delete() {
        $event_id = $this->input->get('event_id');
        $this->events_model->delete_event($event_id);

        redirect_back($this->session);
    }

    private function render_events($events) {
        $this->tags_model->load_tags($events);
        $this->comments_model->load_comment_count($events);

        $data['events'] = $events;
        $data['categories'] = $this->categories_model->get_category_map(true);
        $this->load->view('events_view', $data);
    }
}
