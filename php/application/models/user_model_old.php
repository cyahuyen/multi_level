<?php

class User_model extends CI_Model {

    private $tbl = 'user';
    private $user_id = 'user_id';

    function verifySignin($name, $password) {
        $this->load->database();
        $email = strtolower(trim($name));
        $password = md5($password);
        $sql = "select * from user where email = '$email' and password = '$password' and status = 1";
        $data = $this->db->query($sql)->result_array();
        return !empty($data) ? $data[0] : array();
    }

    public function loadUser($id) {
        $this->load->database();
        $sql = "select * from user where user_id = $id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function passwordMatches($id, $password) {
        $this->load->database();
        $sql = "select * from user where user.user_id = $id and user.password = md5('$password')";
        $query = $this->db->query($sql);
        return ($query->num_rows() != 0);
    }

    public function update($id, $data) {
        $this->db->where('user_id', $id);
        return $this->db->update('user', $data);
    }

    public function updateWithdrawalDate($id) {
        $this->db->where('user_id', $id);
        $this->db->set('withdrawal_date', 'NOW()', FALSE);
        return $this->db->update('user');
    }

    public function updateTransaction($id, $balance) {
        $this->db->where('user_id', $id);
        $this->db->set('transaction_start', 'NOW()', FALSE);
        $this->db->set('transaction_finish', 'DATE_ADD(NOW(),INTERVAL 30 DAY )', FALSE);
        $data = array();
        if ($balance >= 100) {
            $data['usertype'] = 2;
        } elseif ($balance < 100 & $balance > 0) {
            $data['usertype'] = 1;
        } else {
            $data['usertype'] = 0;
        }
        return $this->update($id, $data);
    }

    public function updateTransactionWithoutDate($id, $balance) {

        $this->db->where('user_id', $id);
        $data = array();
        if ($balance >= 100) {
            $data['usertype'] = 2;
        } elseif ($balance < 100 && $balance > 0) {
            $data['usertype'] = 1;
        }
        if (!empty($data))
            $this->db->update('user', $data);
        return FALSE;
    }

    public function updateUserType($refferal) {
        $user = $this->getUserByReferral($refferal);
        if (!empty($user) && $user->usertype == 0) {
            $this->db->where('username', $refferal);
            if (empty($user->withdrawal_date))
                $this->db->set('withdrawal_date', 'NOW()', FALSE);
            $this->db->update('user', array('usertype' => 1));
        }
    }

    public function updateDate($id) {
        $this->db->where('user_id', $id);
        $this->db->set('transaction_start', 'NOW()', FALSE);
        $this->db->set('transaction_finish', 'DATE_ADD(NOW(),INTERVAL 30 DAY )', FALSE);
        $this->db->update('user');
    }

    public function listUser($data, $limit = null, $start = null, $sort = null) {
        $this->db->select("*");
        $this->db->from("user");
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( firstname LIKE '%" . $val . "%' OR lastname LIKE '%" . $val . "%' OR email LIKE '%" . $val . "%' OR phone LIKE '%" . $val . "%' )";
                    $this->db->where($where);
                } elseif ($key == 'term') {
                    $where = "( email LIKE '%" . $val . "%' OR username LIKE '%" . $val . "%' )";
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

    public function searchUser($path, $limit) {
        $this->db->select("*");
        $this->db->from("user");
        $where = "( email LIKE '%" . $path . "%')";
        $this->db->where($where);
        $limit = $this->config->item('limit_page', 'my_config');
        if ($limit)
            $this->db->limit((int) $limit);
        $query = $this->db->get();
        return $query->result();
    }

    public function checkEmailExists($email, $id = 0) {
        $this->db->select("*");
        $this->db->from("user");
        $this->db->where('email', $email);
        if (!empty($id)) {
            $this->db->where('user_id != ', $id);
        }
        $query = $this->db->get();
        if ($query->result())
            return TRUE;
        return FALSE;
    }

    public function listUserBouns($type) {
        $this->db->select("*");
        $this->db->from("user");
        $this->db->where('usertype', $type);
        $this->db->where('DATE_FORMAT(transaction_finish,"%Y-%m-%d") = DATE_FORMAT(NOW(),"%Y-%m-%d")');

        $query = $this->db->get();
        return $query->result();
    }

    public function totalUser($data) {
        $this->db->select("*");
        $this->db->from("user");

        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( firstname LIKE '%" . $val . "%' OR lastname LIKE '%" . $val . "%' OR email LIKE '%" . $val . "%' OR phone LIKE '%" . $val . "%' )";
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
        return !empty($result[0]) ? $result[0] : array();
    }

    public function getUserByReferral($referral) {
        $this->db->select("*");
        $this->db->from("user");
        $this->db->join("user_main","user_main.main_id = user.main_user_id");

        $this->db->where('username', $referral);

        $query = $this->db->get();
        $result = $query->result();
        return !empty($result[0]) ? $result[0] : array();
    }

    public function getAdmin() {
        $this->db->select("*");
        $this->db->from("user");

        $this->db->where('permission', 'administrator');

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

        $this->db->set('created_on', 'NOW()', FALSE);
        $data_user_main = array(
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'password' => $password,
            'address' => $data['address'],
            'phone' => $data['phone'],
            'referring' => $data['referring'],
        );
        
        $this->db->insert('user_main',$data_user_main);
        $main_id = $this->db->insert_id();
        $return['main_id'] = $main_id;
        
        
        
        $data_user_silver = array(
            'main_user_id' => $main_id,
            'username' => $data['username_silver'],
            'usertype' => 1,
        );
        $this->db->insert('user',$data_user_silver);
        $return['silver_id'] = $this->db->insert_id();
        
        $data_user_gold = array(
            'main_user_id' => $main_id,
            'username' => $data['username_gold'],
            'usertype' => 2,
        );
        $this->db->insert('user',$data_user_gold);
        $return['gold_id'] = $this->db->insert_id();

//        if ($data['usertype'] == 2)
//            $this->db->query("INSERT INTO " . $this->tbl . " SET firstname = '" . $data['firstname'] . "',username = '" . $data['username'] . "',lastname = '" . $data['lastname'] . "',password = '" . $password . "', address = '" . $data['address'] . "',  phone = '" . $data['phone'] . "', email = '" . $data['email'] . "',referring = '" . $data['referring'] . "',usertype = '" . $data['usertype'] . "', created_on = NOW() , withdrawal_date = NOW()");
//        else
//            $this->db->query("INSERT INTO " . $this->tbl . " SET firstname = '" . $data['firstname'] . "',username = '" . $data['username'] . "',lastname = '" . $data['lastname'] . "',password = '" . $password . "', address = '" . $data['address'] . "',  phone = '" . $data['phone'] . "', email = '" . $data['email'] . "',referring = '" . $data['referring'] . "',usertype = '" . $data['usertype'] . "', created_on = NOW()");
        return $return;
    }

    function updatePassword($id, $data) {
        $this->db->where('user_id', $id);
        return $this->db->update('user', $data);
    }

    function getBalance($id) {
        $sql = $this->db->query("SELECT balance FROM balance WHERE user_id='" . (int) $id . "' ")->result();
        if ($sql)
            return $sql[0]->balance;
        else {
            return 0;
        }
    }

    public function getRefereds($id, $dataWhere = array(), $limit = null, $start = null) {
        $this->db->select("*");
        $this->db->from($this->tbl);

        if ($id) {
            $this->db->where('referring', $id);
        }

        if (!empty($dataWhere['search'])) {
            $where = "( firstname LIKE '%" . $dataWhere['search'] . "%' OR lastname LIKE '%" . $dataWhere['search'] . "%' OR email LIKE '%" . $dataWhere['search'] . "%' )";
            $this->db->where($where);
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

    public function totalRefered($id, $dataWhere = array()) {
        $this->db->select("*");
        $this->db->from($this->tbl);
        $this->db->where('referring', $id);
        if (!empty($dataWhere['search'])) {
            $where = "( firstname LIKE '%" . $dataWhere['search'] . "%' OR lastname LIKE '%" . $dataWhere['search'] . "%' OR email LIKE '%" . $dataWhere['search'] . "%' )";
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getHistorys($id, $search = null, $limit = null, $start = null) {
        $this->db->select("*");
        $this->db->from("transaction");

        if ($id) {
            $this->db->where('user_id', $id);
        }
        if ($search) {
            $this->db->where('transaction_type', $search);
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

    public function totalHistory($id, $search = null) {
        $this->db->select("*");
        $this->db->from("transaction");
        if ($search) {
            $this->db->where('transaction_type', $search);
        }
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

}
