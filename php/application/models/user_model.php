<?php

/*
  This model provides all interfaces for user management
 */

class User_model extends CI_Model {

    function verifySignin($name, $password) {

        $this->load->database();
        $username = strtolower(trim($name));
        $password = md5($password);
        $sql = "select * from user where username = '$username' and password = '$password'";
        $query = $this->db->query($sql);
        
        return $query->result();
    }


    function resetPassword($name) {
        $this->load->database();
        $username = strtolower(trim($name));
        $sql = "select * from user where username = '$username'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $data = array('password' => md5(time()));
            $this->db->update('user', $data, array('username' => $username));
            return time();
        } else {
            return 'error';
        }
    }

    public function loadUser($id) {
        $this->load->database();
        $sql = "select * from user where id = $id";
        $query = $this->db->query($sql);
        return $query;
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

    public function update($data, $id) {

        $this->db->where('id', $id);
        $this->db->update('product', $data);
    }

    public function listUser($data, $limit = null, $start = null, $sort = null) {
        $this->db->select("*");
        $this->db->from("user");

        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( username LIKE '%" . $val . "%' OR fullname LIKE '%" . $val . "%' OR email LIKE '%" . $val . "%' OR phone LIKE '%" . $val . "%' )";
                    $this->db->where($where);
                }else
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
                    $where = "( username LIKE '%" . $val . "%' OR fullname LIKE '%" . $val . "%' OR email LIKE '%" . $val . "%' OR phone LIKE '%" . $val . "%' )";
                    $this->db->where($where);
                }else
                    $this->db->where($key, $val);
            }
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getUserById($id) {
        $this->db->select("*");
        $this->db->from("user");

        $this->db->where('id', $id);

        $query = $this->db->get();
        $result = $query->result();
        return $result[0];
    }

    public function insert($data) {

        $this->db->insert('user', $data);

        $user_id = $this->db->insert_id();


        return $user_id;
    }

}