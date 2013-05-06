<?php

class Account_model extends CI_Model {

    private $tbl = 'user';
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
    
 

    function get_auto($username) {
        $this->db->select('*');
        $this->db->like('username', $username);
        $query = $this->db->get('user');
        if ($query->num_rows > 0) {
            foreach ($query->result_array() as $row) {
                $new_row['label'] = htmlentities(stripslashes($row['username']));
                $new_row['value'] = htmlentities(stripslashes($row['user_id']));
                $row_set[] = $new_row;
            }
            echo json_encode($row_set);
        }
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

    function checkPassword($password) {
        $data = $this->db->get_where($this->tbl, array('password' => md5($password)))->result();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    function save($data) {

        $password = md5($data['password']);
        $this->db->query("INSERT INTO " . $this->tbl . " SET fullname = '" . $data['fullname'] . "',username = '" . $data['username'] . "',password = '" . $password . "', address = '" . $data['address'] . "',  phone = '" . $data['phone'] . "', email = '" . $data['email'] . "',fax = '" . $data['fax'] . "',birthday = '" . $data['birthday'] . "',referring = '" . $data['referring'] . "', created_on = NOW()");
        return $this->db->insert_id();
    }

    function update($id, $data) {
        $this->db->query("UPDATE " . $this->tbl . " SET fullname = '" . $data['fullname'] . "',address = '" . $data['address'] . "',  phone = '" . $data['phone'] . "', email = '" . $data['email'] . "',fax = '" . $data['fax'] . "',birthday = '" . $data['birthday'] . "' WHERE user_id='" . (int) $id . "'");
    }

    function updatePassword($id, $data) {
        $this->db->query("UPDATE " . $this->tbl . " SET password = '" . md5($data['password']) . "' WHERE user_id='" . (int) $id . "'");
    }

    function getSumOpen($id, $transaction_start, $transaction_finish) {
        $sql = $this->db->query("SELECT SUM(open_fees) AS totalopen FROM transaction WHERE created >='" . $transaction_start . "' AND created <='" . $transaction_finish . "' AND user_id='" . (int) $id . "' ")->result();
        if ($sql)
            return $sql[0]->totalopen;
        else {
            return 0;
        }
    }

    function getSumTotal($id, $transaction_start, $transaction_finish) {
        $sql = $this->db->query("SELECT SUM(total_fees) AS total FROM transaction WHERE created >='" . $transaction_start . "' AND created <='" . $transaction_finish . "' AND user_id='" . (int) $id . "' ")->result();
        if ($sql)
            return $sql[0]->total;
        else {
            return 0;
        }
    }

    public function getRefereds($id, $limit = null, $start = null) {
        $this->db->select("*");
        $this->db->from($this->tbl);

        if ($id) {
            $this->db->where('referring', $id);
        }
        if ($limit)
            $this->db->limit((int) $limit);

        if ($limit && $start) {
            $this->db->limit((int) $limit, (int) $start);
        }
        $this->db->order_by('user_id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function totalRefered($id) {
        $this->db->select("*");
        $this->db->from($this->tbl);
        $this->db->where('referring', $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getHistorys($id, $limit = null, $start = null) {
        $this->db->select("*");
        $this->db->from("transaction");

        if ($id) {
            $this->db->where('user_id', $id);
        }
        if ($limit)
            $this->db->limit((int) $limit);

        if ($limit && $start) {
            $this->db->limit((int) $limit, (int) $start);
        }
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function totalHistory($id) {
        $this->db->select("*");
        $this->db->from("transaction");
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

}

