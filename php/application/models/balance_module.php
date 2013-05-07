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
class Balance_module extends CI_Model {

    public function updateBalance($user_id, $data) {
        $this->load->model('user_model', 'user');
        $user = $this->user->getUserById($user_id);

        if (!empty($user)) {
            $balance = $this->getBalance($user_id);
            if (!empty($balance)) {
                
            }
        }
    }

    public function update($user_id, $data) {

        $this->db->where('user_id', $user_id);
        return $this->db->update('user_id', $data);
    }

    public function getBalance($user_id) {
        $this->db->select("*");
        $this->db->from("balance");

        $this->db->where('user_id', $user_id);

        $query = $this->db->get();
        $result = $query->result();
        return $result[0];
    }

}

?>
