<?php

class User_model extends CI_Model {

    private $tbl = 'user';
    private $id = 'user_id';

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
        $this->db->query("INSERT INTO " . $this->tbl . " SET username = '" . $data['username'] . "',password = '" . $password . "', address = '" . $data['address'] . "',  phone = '" . $data['phone'] . "', email = '" . $data['email'] . "',fax = '" . $data['fax'] . "',birthday = '" . $data['birthday'] . "',usertype = '" . $data['usertype'] . "',referring = '" . $data['referring'] . "',status = '" . $data['status'] . "', created_on = NOW()");
        return $this->db->insert_id();
    }

    function getEmailbyUser($username) {
        $data = $this->db->get_where($this->tbl, array('username' => $username))->result();
        if ($data) {
            return $data[0]->email;
        }
        else
            return false;
    }

    public function getUsers($data = array()) {
        $sql = 'SELECT * FROM ' . $this->tbl;

        $sql .= " WHERE 1=1";

        if (!empty($data['filter_account_number'])) {
            $sql .= " AND account_number= '" . $data['filter_account_number'] . "'";
        }
        if (!empty($data['filter_name'])) {
            $sql .= " AND username LIKE '%" . $data['filter_name'] . "%' OR first_name LIKE '%" . $data['filter_name'] . "%' OR last_name LIKE '%" . $data['filter_name'] . "%'";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
        }
        $data = $this->db->query($sql)->result();

        return $data;
    }

    function totalUsers() {
        return $this->db->count_all_results($this->tbl);
    }

    function getUser($id) {
        $r = $this->db->get_where($this->tbl, array($this->id => $id))->result();
        if ($r) {
            return $r[0];
        }
        else
            return false;
    }

    function update($id, $data) {
        $this->db->query("UPDATE " . $this->tbl . " SET username = '" . $data['username'] . "',address = '" . $data['address'] . "',  phone = '" . $data['phone'] . "', email = '" . $data['email'] . "',fax = '" . $data['fax'] . "',birthday = '" . $data['birthday'] . "',usertype = '" . $data['usertype'] . "',referring = '" . $data['referring'] . "',status = '" . $data['status'] . "',created_on = NOW() WHERE user_id='" . (int) $id . "'");
        if ($data['password']) {
            $this->db->query("UPDATE " . $this->tbl . " SET password = '" . md5($data['password']) . "' WHERE user_id = '" . (int) $id . "'");
        }
    }

    function delete($id) {
        $this->db->where($this->id, $id);

        $this->db->delete($this->tbl);
    }

}

