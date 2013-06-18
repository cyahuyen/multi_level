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

    public function getBalance($user_id) {
        $this->db->select("*");
        $this->db->from("balance");
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $result = $query->result();
        return !empty($result) ? $result[0] : array();
    }

    public function updateBalance($data) {
        $this->load->model('user_model', 'user');
        $user = $this->user->getUserById($data['user_id']);
        if (!empty($user)) {
            $balanceData = $this->getBalance($user->user_id);
            if (!empty($balanceData)) {
                $data['balance'] += $balanceData->balance;
                $this->update($user->user_id, $data);
            } else {
                $data['balance'] = $data['balance'];
                $data['user_id'] = $user->user_id;
                $this->insert($data);
            }
        }
    }

    public function updateAdminBalance($balance, $status = '+') {
        $this->load->model('user_model', 'user');
        $user = $this->user->getAdmin();
        if (!empty($user)) {
            $balanceData = $this->getBalance($user->user_id);
            if (!empty($balanceData)) {
                if ($status == '+')
                    $data['balance'] = $balanceData->balance + $balance;
                else
                    $data['balance'] = $balanceData->balance - $balance;
                $this->update($user->user_id, $data);
            } else {
                if ($status == '+')
                    $data['balance'] = $balance;
                else
                    $data['balance'] = -$balance;
                $data['user_id'] = $user->user_id;
                $this->insert($data);
            }
        }
    }

    public function getAdminBalance() {
        $this->load->model('user_model', 'user');
        $user = $this->user->getAdmin();

        return $this->getBalance($user->user_id);
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

}

?>
