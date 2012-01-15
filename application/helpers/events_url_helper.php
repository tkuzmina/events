<?php

if (!function_exists('events_url')) {
    function events_url($internal_url) {
        return base_url($internal_url);
    }
}

if (!function_exists('is_owner')) {
    function is_owner($user, $entity) {
        if (!$user || !$entity) {
            return false;
        }
        if (is_admin($user)) {
            return true;
        }
        return $user->id == $entity->user_id;
    }
}

if (!function_exists('is_admin')) {
    function is_admin($user) {
        return $user && $user->role_id == 2;
    }
}

if (!function_exists('redirect_back')) {
    function redirect_back($session) {
        $last_page = $session->userdata('last_page');
        $session->unset_userdata('last_page');
        redirect(events_url($last_page));
    }
}

if (!function_exists('init_events_page')) {
    function init_events_page($session, $lang) {
        $language = $session->userdata('language');
        if (!$language) {
            $language = 'en';
        }
        $lang->load('ui', $language);

        $current_page = substr($_SERVER["REQUEST_URI"], strlen("/events"));
        $last_page = $session->userdata("current_page");
        if (!$last_page) {
            $last_page = $current_page;
        }
        $session->set_userdata('last_page', $last_page);
        $session->set_userdata('current_page', $current_page);
    }
}

