<?php

class Users extends CI_Controller {

    function Users() {
        parent::__construct();

        $this->load->library(array('encrypt', 'form_validation', 'session'));
        $this->load->helper(array('form', 'url', 'html', 'events_url'));
        $this->load->model(array('users_model', 'roles_model'));

        init_events_page($this->session, $this->lang);
    }

    function login() {
        $login = $this->input->post('login');
        $password = $this->input->post('password');

        $user = $this->users_model->get_by_login($login);
        if ($user) {
            if ($password == $this->decrypt_password($user->password)) {
                $this->session->set_userdata('current_user', $user);
                /* set_userdata sets a value to session */
            } else {
                $this->session->set_flashdata('message', 'Incorrect password.');
            }
        } else {
            $this->session->set_flashdata('message', 'User does not exist.');
        }

        redirect_back($this->session);
    }

    function logout() {
        $this->session->unset_userdata('current_user');

        redirect_back($this->session);
    }

    function index() {
        $users = $this->users_model->get_users();
        $roles = $this->roles_model->get_role_map();

        $data['users'] = $users;
        $data['roles'] = $roles;
        $this->load->view('users_view', $data);
    }

    function add() {
        $login = $this->input->post('login');
        $password = $this->encrypt_password($this->input->post('password'));
        $name = $this->input->post('name');
        $surname = $this->input->post('surname');
        $role_id = $this->input->post('role_id');
        $this->users_model->insert_user($login, $password, $name, $surname, $role_id);

        redirect_back($this->session);
    }

    function delete() {
        $user_id = $this->input->get('user_id');
        $this->users_model->delete_user($user_id);

        redirect_back($this->session);
    }

    function edit() {
        $user_id = $this->input->post('user_id');
        $name = $this->input->post('name');
        $surname = $this->input->post('surname');
        $role_id = $this->input->post('role_id');
        $this->users_model->update_user($user_id, $name, $surname, $role_id);

        redirect_back($this->session);
    }

    function register() {
        $this->load->view('register_view');
    }

    function do_register() {
        $login = $this->input->post('login');
        $password = $this->encrypt_password($this->input->post('password'));
        $name = $this->input->post('name');
        $surname = $this->input->post('surname');
        $role_id = 1; // user
        $this->users_model->insert_user($login, $password, $name, $surname, $role_id);

        $this->session->set_flashdata('message', 'Registration successful!');
        /* flashdata - session data that gets cleared after being passed to UI  http://codeigniter.com/user_guide/libraries/sessions.html */
        redirect(events_url('events'));
    }

    private function encrypt_password($decrypted_password) {
        return $this->encrypt->encode($decrypted_password);
    }

    private function decrypt_password($encrypted_password) {
        return $this->encrypt->decode($encrypted_password);
    }

}
