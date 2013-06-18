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
    
    public function updateMainAcount($id,$data){
        $this->db->where('main_id',$id);
        return $this->db->update('user_main', $data);
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
        $this->db->where('user_id', $id);

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

    public function getMainUserByEmail($email) {
        $this->db->select("*");
        $this->db->from("user_main");
        $this->db->where('email', $email);
        $query = $this->db->get();
        $result = $query->result();
        return !empty($result[0]) ? $result[0] : array();
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
    
    

}