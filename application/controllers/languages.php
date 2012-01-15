<?php

class Languages extends CI_Controller {

    function Languages() {
        parent::__construct();

        $this->load->library(array('encrypt', 'form_validation', 'session'));
        $this->load->helper(array('form', 'url', 'html', 'events_url'));

        init_events_page($this->session, $this->lang);
    }

    function set_language() {
        $language = $this->input->get('language');
        if ($language) {
            $this->session->set_userdata('language', $language);
        }

        redirect_back($this->session);
    }

}
