<?php

class Events_model extends CI_Model {

    private $EVENT_SELECT = "
            select e.*, u.login as user_login, u.name as user_name, u.surname as user_surname, c.name as category_name
            from events e, categories c, users u
            where e.category_id = c.id and e.user_id = u.id";

    private $EVENT_ORDER = " order by e.created_date desc";

/*
select e.*, u.login as user_login, u.name as user_name, u.surname as user_surname, c.name as category_name
from events e, categories c, users u
where e.category_id = c.id and e.user_id = u.id
and u.login like 'admin'
and e.id in (select et.event_id from eventtags et, tags t where et.tag_id = t.id and t.name like 'gggg')
order by e.created_date desc
*/

    function get_events_by_criteria($search_params) {
        $sql = $this->EVENT_SELECT;
        $sql = $this->append_criteria($sql, $search_params);
        $sql = $sql.$this->EVENT_ORDER;

        $query = $this->db->query($sql);
        return $query->result();
    }

    private function append_criteria($sql, $search_params) {
        if (!$search_params) {
            return $sql;
        }

        if ($search_params['category_id']) {
            $sql = $sql." and e.category_id=".$search_params['category_id'];
        }
        if ($search_params['user_login']) {
            $sql = $sql." and u.login like '".$search_params['user_login']."'";
        }
        if ($search_params['tag_name']) {
            $sql = $sql." and e.id in (select et.event_id from eventtags et, tags t where et.tag_id = t.id and t.name like '".$search_params['tag_name']."')";
            /* many-to-many query */
        }
        if ($search_params['search_text']) {
            $sql = $sql." and MATCH (e.name, e.description) AGAINST ('".$search_params['search_text']."' IN BOOLEAN MODE)";
            /* mysql fulltext search http://dev.mysql.com/doc/refman/5.0/en/fulltext-search.html */
        }
        return $sql;
    }

    function get_event_by_id($event_id) {
        $sql = $this->EVENT_SELECT." and e.id=".$event_id.$this->EVENT_ORDER;
        $query = $this->db->query($sql);
        return $query->result();
    }

    function insert_event($name, $description, $category_id, $user_id) {
        $created_date = date("Y-m-d H:i:s");
        $this->db->insert('events', array("name" => $name, "description" => $description, "category_id" => $category_id, "user_id" => $user_id, "created_date" => $created_date));
    }

    function update_event($event_id, $name, $description, $category_id) {
        $this->db->update('events', array("name" => $name, "description" => $description, "category_id" => $category_id), array('id' => $event_id));
    }

    function delete_event($event_id) {
        if ($event_id) {
            $this->db->delete('events', array("id" => $event_id));
        }
    }
}
