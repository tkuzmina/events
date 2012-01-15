<?php

class Categories extends CI_Controller {

    function Categories() {
        parent::__construct();

        $this->load->library(array('encrypt', 'form_validation', 'session'));
        $this->load->helper(array('form', 'url', 'html', 'events_url'));
        $this->load->model(array('categories_model'));

        init_events_page($this->session, $this->lang);
    }

    /* loads category list and passes it to the view */
    function index() {
        $categories = $this->categories_model->get_categories();
        $data['categories'] = $categories;

        $this->load->view('categories_view', $data);
    }

    function add() {
        $name = $this->input->post('name');
        $this->categories_model->insert_category($name);

        redirect_back($this->session);
    }

    function delete() {
        $category_id = $this->input->get('category_id');
        $this->categories_model->delete_category($category_id);

        redirect_back($this->session);
    }

    function edit() {
        $category_id = $this->input->post('category_id');
        $name = $this->input->post('name');
        $this->categories_model->update_category($category_id, $name);

        redirect_back($this->session);
    }
}
