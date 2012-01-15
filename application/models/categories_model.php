<?php

class Categories_model extends CI_Model {

    function get_category_map($include_all) {
        $query = $this->db->query("select * from categories");
        $categories = $query->result();
        $category_map = array();
        if ($include_all) {
            $category_map[NIL] = "All";
        }

        foreach($categories as $category) {
            $category_map[$category->id] = $category->name;
        }
        return $category_map;
    }

    function get_categories() {
        $query = $this->db->query("select * from categories");
        $categories = $query->result();
        return $categories;
    }

    function insert_category($name) {
        $this->db->insert('categories', array("name" => $name));
        // insert into categories (name) values ($name);
    }

    function delete_category($category_id) {
        $this->db->delete('categories', array("id" => $category_id));
        // delete from categories where id = $category_id;
    }

    function update_category($category_id, $name) {
        $this->db->update('categories', array("name" => $name), array('id' => $category_id));
        // update categories set name = $name where id = $category_id;
    }
}
