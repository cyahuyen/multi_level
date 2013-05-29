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
class Balance_history_model extends CI_Model {

    public function updateBalanceHistory($data) {
        $this->db->insert('balance_history', $data);
        return $this->db->insert_id();
    }

    public function getBalanceHistory($user_id, $date) {
        $this->db->select("*");
        $this->db->from("balance_history");
        $this->db->where('user_id', $user_id);
        $this->db->where('date', $date);

        $query = $this->db->get();
        $results = $query->result();
        return !empty($results[0]) ? $results[0] : array();
    }

}

?>
