<?php

/*
  This model provides all interfaces for user management
 */

class User_model extends CI_Model {

    private $tbl = 'user';
    private $user_id = 'user_id';

    function verifySignin($name, $password) {
        $this->load->database();
        $email = strtolower(trim($name));
        $password = md5($password);
        $sql = "select * from user where email = '$email' and password = '$password'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function loadUser($id) {
        $this->load->database();
        $sql = "select * from user where user_id = $id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * Returns TRUE if the password is the same as the one currently stored, owtherwise FALSE
     */
    public function passwordMatches($id, $password) {
        $this->load->database();
        $sql = "select * from user where user.id = $id and user.password = md5('$password')";
        $query = $this->db->query($sql);
        return ($query->num_rows() != 0);
    }

    public function update($id, $data) {
        $this->db->where('user_id', $id);
        return $this->db->update('user', $data);
    }

    public function updateTransaction($id) {
        $this->db->where('user_id', $id);
        $this->db->set('transaction_start', 'NOW()', FALSE);
        $this->db->set('transaction_finish', 'DATE_ADD(NOW(),INTERVAL 30 DAY )', FALSE);
        return $this->db->update('user');
    }

    public function updateUserType($id) {
        $user = $this->getUserById($id);
        if (!empty($user) && $user->usertype == 0) {
            $this->update(array('usertype' => 1), $id);
        }
    }

    public function listUser($data, $limit = null, $start = null, $sort = null) {
        $this->db->select("*");
        $this->db->from("user");
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( fullname LIKE '%" . $val . "%' OR email LIKE '%" . $val . "%' OR phone LIKE '%" . $val . "%' )";
                    $this->db->where($where);
                }
                else
                    $this->db->where($key, $val);
            }
        }

        if ($limit)
            $this->db->limit((int) $limit);

        if ($limit && $start)
            $this->db->limit((int) $limit, (int) $start);

        if (!empty($sort)) {
            foreach ($sort as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function totalUser($data) {
        $this->db->select("*");
        $this->db->from("user");

        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( fullname LIKE '%" . $val . "%' OR email LIKE '%" . $val . "%' OR phone LIKE '%" . $val . "%' )";
                    $this->db->where($where);
                }
                else
                    $this->db->where($key, $val);
            }
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getUserById($id) {
        $this->db->select("*");
        $this->db->from("user");

        $this->db->where('user_id', $id);

        $query = $this->db->get();
        $result = $query->result();
        return $result[0];
    }

    public function insert($data) {
        $data['created_on'] = 'NOW()';
        $this->db->insert('user', $data);

        $user_id = $this->db->insert_id();

        return $user_id;
    }

    function getAccount($id) {
        $results = $this->db->get_where($this->tbl, array('user_id' => $id))->result();
        if ($results) {
            return $results[0];
        }
        else
            return false;
    }

    function get_auto($email) {
        $this->db->select('*');
        $this->db->like('email', $email);
        $query = $this->db->get('user');
        if ($query->num_rows > 0) {
            foreach ($query->result_array() as $row) {
                $new_row['label'] = htmlentities(stripslashes($row['email']));
                $new_row['value'] = htmlentities(stripslashes($row['user_id']));
                $row_set[] = $new_row;
            }
            echo json_encode($row_set);
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
        $this->db->query("INSERT INTO " . $this->tbl . " SET fullname = '" . $data['fullname'] . "',password = '" . $password . "', address = '" . $data['address'] . "',  phone = '" . $data['phone'] . "', email = '" . $data['email'] . "',fax = '" . $data['fax'] . "',birthday = '" . $data['birthday'] . "',referring = '" . $data['referring'] . "', created_on = NOW()");
        return $this->db->insert_id();
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