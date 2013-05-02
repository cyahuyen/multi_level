<?php

class Register_model extends CI_Model {

    private $tbl = 'user';
    private $user_id = 'user_id';

    function __construct() {
        parent::__construct();
    }

    function checkUser($username) {
        $r = $this->db->get_where($this->tbl, array('username' => $username))->result();

        if ($r) {
            return true;
        } else {
            return false;
        }
    }

    function checkEmail($email) {
        $data = $this->db->get_where($this->tbl, array('email' => $email))->result();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    function save($data) {

        $password = md5($data['password']);
        $this->db->query("INSERT INTO " . $this->tbl . " SET username = '" . $data['username'] . "',password = '" . $password . "', address = '" . $data['address'] . "',  phone = '" . $data['phone'] . "', email = '" . $data['email'] . "',fax = '" . $data['fax'] . "',birthday = '" . $data['birthday'] . "',referring = '" . $data['referring'] . "', created_on = NOW()");
        return $this->db->insert_id();
    }

    function update($id, $data) {
        $this->db->where($this->user_id, $id);

        $this->db->update($this->tbl, $data);
    }

    function check_reset($email, $code) {
        $results = $this->db->get_where($this->tbl, array('email' => $email, 'forgotten_password_code' => $code))->result();

        if ($results) {
            return true;
        } else {
            return false;
        }
    }

    function getEmailbyUser($username) {
        $data = $this->db->get_where($this->tbl, array('username' => $username))->result();
        if ($data) {
            return $data[0]->email;
        }
        else
            return false;
    }

    function getEmmail($email) {
        $results = $this->db->get_where($this->tbl, array('email' => $email))->result();
        if ($results) {
            return $results[0];
        }
        else
            return false;
    }

    function getUsers($data = array()) {
        $sql = 'SELECT * FROM ' . $this->tbl;

        $sql .= " WHERE 1=1";

        if (!empty($data['filter_name'])) {
            $sql .= " AND username LIKE '" . $this->db->escape($data['filter_name']) . "%'";
        }
        $data = $this->db->query($sql)->result();

        return $data;
    }

}

