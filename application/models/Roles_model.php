<?php

class Roles_model extends CI_Model {

    function get_role_map() {
        $query = $this->db->query("select * from roles");
        $roles = $query->result();
        $role_map = array();
        foreach($roles as $role) {
            $role_map[$role->id] = $role->name; // array("1" => "user", "2" => "admin")
        }
        return $role_map;
    }
}