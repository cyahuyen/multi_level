<?php

/*
  This model provides all interfaces for user management
 */

class User_model extends CI_Model {

    function verifySignin($name, $password) {

        $this->load->database();
        $username = strtolower(trim($name));
        $password = md5($password);
        $sql = "select user.*, user_data.fullname from user left join user_data on user_data.user_id = user.id where username = '$username' and password = '$password'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getSessionUserDetails() {

        $id = $this->session->userdata('userid');
        $this->db->select("user.email");
        $this->db->select("user.usertype");
        $this->db->select("user_data.*");
        $this->db->from("user");
        $this->db->join("user_data", "user_data.user_id = user.id");
        $this->db->where("user_data.user_id", $id);
        $query = $this->db->get();
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
        $sql = "select user.id, user.username, user.password, user.email, user.status, user.usertype, user_data.fullname, 
			user_data.phone,user_data.mobile from user left join user_data on user_data.user_id = user.id where user.id = $id";
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

    /**
     * Returns TRUE if the username is not being used by another user, owtherwise FALSE
     */
    public function usernameAvailable($username, $excludeUserId) {
        $this->load->database();
        $sql = "select * from user where user.id != $excludeUserId and user.username = '$username'";
        $query = $this->db->query($sql);
        return ($query->num_rows() == 0);
    }

    public function save($userdata) {
        $userId = $userdata['id'];
        $name = $userdata['name'];
        $username = $userdata['username'];
        $email = $userdata['email'];
        $phone = $userdata['phone'];
        $mobile = $userdata['mobile'];

        $this->load->database();

        $sql = "update user set username='$username', email='$email' where id = $userId";
        $this->db->query($sql);

        $sql = "update user_data set fullname='$name', phone='$phone', mobile='$mobile' where user_id = $userId";
        $this->db->query($sql);
    }

    public function updatePassword($userId, $password) {
        $sql = "update user set password=md5('$password') where id = $userId";
        $this->db->query($sql);
    }

    public function listUser($data, $limit = null, $start = null, $sort = null) {
        $this->db->select("user.*");
        $this->db->select("user_data.fullname");
        $this->db->select("user_data.phone");
        $this->db->select("user_data.mobile");
        $this->db->from("user");
        $this->db->join("user_data", "user_data.user_id = user.id");

        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( user.username LIKE '%" . $val . "%' OR user_data.fullname LIKE '%" . $val . "%' OR user.email LIKE '%" . $val . "%' OR user_data.phone LIKE '%" . $val . "%' )";
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
        $this->db->select("user.*");
        $this->db->select("user_data.fullname");
        $this->db->select("user_data.phone");
        $this->db->select("user_data.mobile");
        $this->db->from("user");
        $this->db->join("user_data", "user_data.user_id = user.id");

        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( user.username LIKE '%" . $val . "%' OR user_data.fullname LIKE '%" . $val . "%' OR user.email LIKE '%" . $val . "%' OR user_data.phone LIKE '%" . $val . "%' )";
                    $this->db->where($where);
                }else
                    $this->db->where($key, $val);
            }
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getUserById($id) {
        $this->db->select("user.*");
        $this->db->select("user_data.fullname");
        $this->db->select("user_data.phone");
        $this->db->select("user_data.mobile");
        $this->db->from("user");
        $this->db->join("user_data", "user_data.user_id = user.id");

        $this->db->where('user.id', $id);

        $query = $this->db->get();
        $result = $query->result();
        return $result[0];
    }

    public function insert($data) {
        $dataUser = array(
            'username' => $data['username'],
            'password' => md5($data['password']),
            'email' => $data['email'],
            'status' => 1,
            'usertype' => $data['usertype'],
        );

        $this->db->insert('user', $dataUser);

        $user_id = $this->db->insert_id();

        $dataUser = array(
            'user_id' => $user_id,
            'fullname' => $data['fullname'],
            'phone' => $data['phone'],
            'mobile' => $data['mobile'],
        );

        $this->db->insert('user_data', $dataUser);

        return $user_id;
    }

    public function update($data, $id) {
        $dataUser = array(
            'username' => $data['username'],
            'password' => md5($data['password']),
            'email' => $data['email'],
            'status' => 1,
            'usertype' => $data['usertype'],
        );
        $this->db->where('id', $id);
        $this->db->update('user', $dataUser);


        $dataUser = array(
            'fullname' => $data['fullname'],
            'phone' => $data['phone'],
            'mobile' => $data['mobile'],
        );
        $this->db->where('user_id', $id);
        $this->db->update('user_data', $dataUser);
    }

    public function deactive($id) {
        $this->db->where('id', $id);
        $this->db->update('user', array('status' => 0));
        
    }

}