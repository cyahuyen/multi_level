<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of balance_module
 *
 * @author ngoalongkt
 */
class Balance_model extends CI_Model {

    public function updateBalance($user_id, $balance) {
        $this->load->model('user_model', 'user');
        $user = $this->user->getUserById($user_id);

        if (!empty($user)) {
            $balanceData = $this->getBalance($user_id);
            if (!empty($balanceData)) {
                $data['balance'] = $balanceData->balance + $balance;
                $this->update($user_id, $data);
            } else {
                $data['balance'] = $balance;
                $data['user_id'] = $user_id;
                $this->insert($data);
            }
        }
    }

    public function updateAdminBalance($balance) {
        $this->load->model('user_model', 'user');
        $user = $this->user->getAdmin();
        $this->updateBalance($user->user_id, $balance);
    }

    public function insert($data) {
        $this->db->insert('balance', $data);

        $id = $this->db->insert_id();

        return $id;
    }

    public function update($user_id, $data) {

        $this->db->where('user_id', $user_id);
        return $this->db->update('balance', $data);
    }

    public function getBalance($user_id) {
        $this->db->select("*");
        $this->db->from("balance");

        $this->db->where('user_id', $user_id);

        $query = $this->db->get();
        $result = $query->result();
        return !empty($result) ? $result[0] : array();
    }

}

?>
