<?php

class User_model extends CI_Model {

    /**
     * Function createMainAcount
     * Create main user.
     * @param mixed $data.
     */
    public function createMainAcount($data) {
        $this->db->set('created_on', 'NOW()', FALSE);
        $this->db->insert('user_main', $data);
        return $this->db->insert_id();
    }

    /**
     * Function updateMainAcount
     * Create main user.
     * @param mixed $data.
     */
    public function updateMainAcount($id, $data) {
        $this->db->where('main_id', $id);
        return $this->db->update('user_main', $data);
    }

    /**
     * Function checkEmailExists
     * Check Email exists in main user
     * @param string $email.
     * @param int $id
     */
    public function checkEmailExists($email, $id = 0) {
        $this->db->select("*");
        $this->db->from("user_main");
        $this->db->where('email', $email);
        if (!empty($id)) {
            $this->db->where('main_id != ', $id);
        }
        $query = $this->db->get();
        if ($query->result())
            return TRUE;
        return FALSE;
    }

    /**
     * Function createGoldAcount
     * Create gold account.
     * @param mixed $data.
     */
    public function createGoldAcount($data) {
        $data['usertype'] = 2;
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    /**
     * Function createSilverAcount
     * Create silver account.
     * @param mixed $data.
     */
    public function createSilverAcount($data) {
        $data['usertype'] = 1;
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    /**
     * Function getUserByMainId
     * Get User By MainId.
     * @param int $id.
     */
    public function getUserByMainId($id, $userType) {
        $this->db->select("*");
        $this->db->from("user");
        $this->db->join("user_main", "user_main.main_id = user.main_user_id");
        $this->db->where('user_main.main_id', $id);
        $this->db->where('user.usertype', $userType);
        $query = $this->db->get();
        $result = $query->result();
        return !empty($result[0]) ? $result[0] : array();
    }

    /**
     * Function getMainUserByMainId
     * Get Main User By MainId.
     * @param int $id.
     */
    public function getMainUserByMainId($id) {
        $this->db->select("*");
        $this->db->from("user_main");
        $this->db->where('main_id', $id);
        $query = $this->db->get();
        $result = $query->result();
        return !empty($result[0]) ? $result[0] : array();
    }

    /**
     * Function getMainUserById
     * Get User By Id.
     * @param int $id.
     */
    public function getMainUserById($id) {
        $this->db->select("*");
        $this->db->from("user");
        $this->db->join("user_main", "user_main.main_id = user.main_user_id");
        $this->db->where('user.user_id', $id);
        $query = $this->db->get();
        $result = $query->result();
        return !empty($result[0]) ? $result[0] : array();
    }

    public function getUserById($id) {
        $this->db->select("*");
        $this->db->from("user");
        $this->db->join("user_main", "user_main.main_id = user.main_user_id");
        $this->db->where('user.user_id', $id);

        $query = $this->db->get();
        $result = $query->result();
        return !empty($result[0]) ? $result[0] : array();
    }

    /**
     * Function getUserByEmail
     * Get User By Email
     * @param string $email
     * @param int $userType
     * return array $result
     */
    public function getUserByEmail($email, $userType) {
        $this->db->select("*");
        $this->db->from("user_main");
        $this->db->join("user", "user_main.main_id = user.main_user_id");
        $this->db->where('user_main.email', $email);
        $this->db->where('user.usertype', $userType);
        $query = $this->db->get();
        $result = $query->result();
        return !empty($result[0]) ? $result[0] : array();
    }

    public function totalRefered($id, $dataWhere = array()) {
        $this->db->select("*");
        $this->db->from('user_main');
        $this->db->where('referring', $id);
        if (!empty($dataWhere['search'])) {
            $where = "( firstname LIKE '%" . $dataWhere['search'] . "%' OR lastname LIKE '%" . $dataWhere['search'] . "%' OR email LIKE '%" . $dataWhere['search'] . "%' )";
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getRefereds($id, $dataWhere = array(), $limit = null, $start = null) {
        $this->db->select("*");
        $this->db->from('user_main');

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
        $this->db->order_by('main_id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getMainUserByEmail($email) {
        $this->db->select("*");
        $this->db->from("user_main");
        $this->db->where('email', $email);
        $query = $this->db->get();
        $result = $query->result();
        return !empty($result[0]) ? $result[0] : array();
    }

    public function getAllAcountByMainId($main_id) {
        $this->db->select("*");
        $this->db->from("user");
        $this->db->where('main_user_id', $main_id);
        return $this->db->get()->result();
    }
    
    public function getAllbalanceAcountByMainId($main_id){
        $this->db->select("*");
        $this->db->from("user");
        $this->db->join("balance","user.user_id = balance.user_id","left");
        $this->db->where('main_user_id', $main_id);
        return $this->db->get()->result();
    }

    /**
     * Function verifySignin
     * check Login
     * @param string $email
     * @param string $password
     * return array $result
     */
    function verifySignin($email, $password) {
        $this->load->database();
        $email = strtolower(trim($email));
        $password = md5($password);
        $sql = "select * from user_main where email = '$email' and password = '$password' and status = 1";
        $data = $this->db->query($sql)->result_array();
        return !empty($data) ? $data[0] : array();
    }

    /**
     * Function getAdmin
     * Get User Acount
     * return array $result
     */
    public function getAdmin() {
        $this->db->select("*");
        $this->db->from("user_main");
        $this->db->join("user", "user_main.main_id = user.main_user_id");
        $this->db->where('permission', 'administrator');

        $query = $this->db->get();
        $result = $query->result();
        return !empty($result[0]) ? $result[0] : array();
    }

    /**
     * Function searchUser
     * Search user
     * return array $result
     */
    public function searchUser($path) {
        $this->db->select("*");
        $this->db->from("user_main");
        $where = "( email LIKE '%" . $path . "%')";
        $this->db->where($where);

        $query = $this->db->get();
        return $query->result();
    }

    function getEmmail($email) {
        $results = $this->db->get_where('user_main', array('email' => $email))->result();
        if ($results) {
            return $results[0];
        }
        else
            return false;
    }

    public function listUserByType($userType) {
        $this->db->select("*");
        $this->db->from("user_main");
        $this->db->join("user", "user_main.main_id = user.main_user_id");
        $this->db->where('user.usertype', $userType);
        $query = $this->db->get();
        return $query->result();
    }

    public function totalMainUser($data) {
        $this->db->select("*");
        $this->db->from("user_main");

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

  
    public function listMainUser($data, $limit = null, $start = null, $sort = null) {
        $this->db->select("*");
        $this->db->from("user_main");
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

    public function updateWithdrawalDate($id) {
        $this->db->where('user_id', $id);
        $this->db->set('withdrawal_date', 'NOW()', FALSE);
        return $this->db->update('user');
    }
    
      public function totalUser($data) {
        $this->db->select("*");
        $this->db->from("user");
        $this->db->join("user_main",'user.main_user_id = user_main.main_id');

        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $this->db->where($key, $val);
            }
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function listReferes($data){
        $this->db->select("referring ,COUNT(main_id) as total_user");
        $this->db->from("user_main");
        
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $this->db->where($key, $val);
            }
        }
        
        $this->db->group_by('referring');


        $query = $this->db->get();
        return $query->result();
    }

}