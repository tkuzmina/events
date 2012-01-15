<?php

class Comments_model extends CI_Model {

    function get_comments($event_id) {
        $query = $this->db->query("select * from comments where event_id = ?", array($event_id));
        return $query->result();
    }

    function load_comment_count($events) {
        foreach($events as $event) {
            $event_id = $event->id;
            $query = $this->db->query("select count(*) as count_rows from comments where event_id = ?", array($event_id));
            $result = $query->result();
            $event->comment_count = $result[0]->count_rows;
        }
    }

    function load_comments($event_id) {
        $sql = "select c.*, u.login as user_login, u.name as user_name, u.surname as user_surname from comments c, users u
                where c.event_id = ? and c.user_id = u.id order by c.created_date desc";
        $query = $this->db->query($sql, array($event_id));
        $comments = $query->result();
        return $comments;
    }

    function insert_comment($text, $event_id, $user_id) {
        $created_date = date("Y-m-d H:i:s");
        $this->db->insert('comments', array("text" => $text, "event_id" => $event_id, "user_id" => $user_id, "created_date" => $created_date));
    }

    function delete_comment($comment_id) {
        if ($comment_id) {
            $this->db->delete('comments', array("id" => $comment_id));
        }
    }
}
