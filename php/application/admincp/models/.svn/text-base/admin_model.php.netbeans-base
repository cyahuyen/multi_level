<?php

class Admin_model extends CI_Model {

    private $tbl = 'admins';
    private $id = 'id';

    function __construct() {
        parent::__construct();
        $this->load->library('encryption');
    }

    function check_user($username) {
        $r = $this->db->get_where($this->tbl, array('username' => $username))->result();

        if ($r) {
            return true;
        } else {
            return false;
        }
    }

    function check_email($email) {
        $r = $this->db->get_where($this->tbl, array('email' => $email))->result();

        if ($r) {
            return true;
        } else {
            return false;
        }
    }

    function getAdmin($id) {
        $r = $this->db->get_where($this->tbl, array($this->id => $id))->result();
        if ($r) {
            return $r[0];
        }
        else
            return false;
    }

    public function getAdmins($data = array()) {
        $sql = 'SELECT * FROM ' . $this->tbl;

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

        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function getGroups() {
        $sql = "SELECT * FROM groups_admin";
        $data = $this->db->query($sql)->result_array();

        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function totalAdmins() {

        return $this->db->count_all_results($this->tbl);
    }

    function save($data) {

        $password = $this->encryption->encrypt_password($data['password']);

        $this->db->query("INSERT INTO " . $this->tbl . " SET username = '" . $data['username'] . "',group_id = '" . $data['group_id'] . "', contactname = '" . $data['contactname'] . "', password = '" . $password . "', email = '" . $data['email'] . "', created_on = NOW()");

        return $this->db->insert_id();
    }

    function update($id, $data) {

        $this->db->query("UPDATE " . $this->tbl . " SET username = '" . $data['username'] . "',group_id = '" . $data['group_id'] . "', contactname = '" . $data['contactname'] . "', email = '" . $data['email'] . "', created_on = NOW() WHERE id = '" . (int) $id . "'");

        if ($data['password']) {

            $password = $this->encryption->encrypt_password($data['password']);

            $this->db->query("UPDATE " . $this->tbl . " SET password = '" . $password . "' WHERE id = '" . (int) $id . "'");
        }
    }

    function updateLogin($id) {
        $this->db->query("UPDATE " . $this->tbl . " SET ip_address = '" . $this->session->userdata('ip_address') . "', last_login = NOW() WHERE id = '" . (int) $id . "'");
    }

    function deleteAdmin($id) {
        $this->db->where($this->id, $id);

        $this->db->delete($this->tbl);
    }

    function getPermission($id) {
        $data = $this->db->get_where('groups_admin', array('group_id' => $id))->result();
        if ($data) {
            return $data[0];
        }
        else
            return false;
    }

}

