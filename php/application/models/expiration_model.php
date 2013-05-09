<?php

class Expiration_model extends CI_Model {

    private $user = 'user';
    private $user_id = 'user_id';

    function __construct() {
        parent::__construct();
    }

    function updateUser($id, $type) {
        $this->db->query("UPDATE " . $this->user . " SET usertype='" . (int) $type . "' WHERE usertype=2 AND user_id='" . (int) $id . "'");
    }

    function getUsers($data = array()) {
        $data = $this->db->query('SELECT * FROM ' . $this->user)->result();
        return $data;
    }

    public function getAdmin() {
        $this->db->select("*");
        $this->db->from("user");
        $this->db->where('permission', 'administrator');
        $query = $this->db->get();
        $result = $query->result();
        return $result[0];
    }

    function getReferedsbyId($user_id) {
        $data = $this->db->get_where($this->user, array('referring' => $user_id))->result();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    function getUsersLimit($currentdata, $type) {
        $sql = "SELECT user_id,email,fullname FROM user WHERE transaction_finish <='" . $currentdata . "' AND usertype=" . $type . "";
        $data = $this->db->query($sql)->result();
        return $data;
    }

}

