<?php

class Permission_Model extends CI_Model {

    private $tbl = 'groups_admin';
    private $id = 'id';

    function __construct() {
        parent::__construct();
    }

    public function getGroups() {
        $sql = 'SELECT * FROM ' . $this->tbl;

        $data = $this->db->query($sql)->result_array();

        return $data;
    }

    public function getGroup($id) {
        $data = $this->db->get_where($this->tbl, array($this->id => $id))->result_array();
        if ($data) {
            return $data;
        }
        else
            return false;
    }

    public function getPermission($id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . $this->tbl . " WHERE group_id = '" . (int) $id . "'")->result_array();
        $user_group = array(
            'name' => $query[0]['name'],
            'permission' => unserialize($query[0]['permission'])
        );

        return $user_group;
    }

    function update($id, $data) {
        $this->db->query("UPDATE " . $this->tbl . " SET permission='" . serialize($data['actions']) . "' WHERE group_id='" . (int) $id . "'");
    }

    public function getModules() {
        $sql = "SELECT * FROM modules";

        $data = $this->db->query($sql)->result_array();

        return $data;
    }

}

