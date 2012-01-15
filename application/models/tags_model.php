<?php

class Tags_model extends CI_Model {

    function insert_tag($name, $event_id, $user_id) {
        $tag = $this->get_by_user_and_name($user_id, $name);
        if ($tag) {
            $tag_id = $tag->id;
        } else {
            $this->db->insert('tags', array("name" => $name, "user_id" => $user_id));
            $tag_id = $this->db->insert_id();
        }

        $query = $this->db->query("select * from eventtags where event_id = ? and tag_id = ?", array($event_id, $tag_id));
        $existing_tags = $query->result();
        if (count($existing_tags) == 0) {
            $this->db->insert('eventtags', array("event_id" => $event_id, "tag_id" => $tag_id));
        }
    }

    function get_by_user_and_name($user_id, $name) {
        $query = $this->db->query("select * from tags where user_id = ? and name like ?", array($user_id, $name));
        $tags = $query->result();
        return count($tags) > 0 ? $tags[0] : NIL;
    }

    function get_by_id($tag_id) {
        $query = $this->db->query("select * from tags where id = ?", array($tag_id));
        $tags = $query->result();
        return count($tags) > 0 ? $tags[0] : NIL;
    }

    function delete_tag($tag_id, $event_id) {
        if ($event_id) {
            $this->db->delete('eventtags', array("tag_id" => $tag_id, 'event_id' => $event_id));
            $query = $this->db->query("select * from eventtags where tag_id = ?", array($tag_id));
            $remove_tag = (count($query->result()) == 0);
        } else {
            $remove_tag = true;
        }

        if ($remove_tag) {
            $this->db->delete('tags', array("id" => $tag_id));
        }
    }

    function load_tags($events) {
        foreach($events as $event) {
            $id = $event->id;
            $query = $this->db->query("select t.id, t.name, t.user_id from tags t, eventtags et where t.id = et.tag_id and et.event_id = ?", array($id));
            $tags = $query->result();
            $event->tags = $tags;
        }
    }
}
