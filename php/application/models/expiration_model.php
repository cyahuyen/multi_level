<?php

class Expiration_model extends CI_Model {

    private $user = 'user';
    private $transfer = 'transaction';
    private $user_id = 'user_id';

    function __construct() {
        parent::__construct();
    }

    function getAccount($id) {
        $results = $this->db->get_where($this->tbl, array('user_id' => $id))->result();
        if ($results) {
            return $results[0];
        }
        else
            return false;
    }

    function updateUser() {
        $this->db->query("UPDATE " . $this->user . " SET usertype=1 WHERE usertype=2");
    }

    function getUsers($data = array()) {
        $data = $this->db->query('SELECT * FROM ' . $this->user)->result();
        return $data;
    }

    function getUsersLimit($currentdata, $type) {
        $sql = "SELECT email FROM user WHERE transaction_finish <='" . $currentdata . "' AND usertype=" . $type . "";
        $data = $this->db->query($sql)->result();
        return $data;
    }

}

