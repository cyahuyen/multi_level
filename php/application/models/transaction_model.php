<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of reansaction_model
 *
 * @author ngoalongkt
 */
class Transaction_model extends CI_Model {

    public function insert($data) {
        $this->db->set('created', 'NOW()', FALSE);
        $this->db->insert('transaction', $data);

        $user_id = $this->db->insert_id();
        return $user_id;
    }

    function getTransactionNotExpiration($user_id, $start_date = null, $end_date = null) {
        if (!empty($start_date) || !empty($end_date)) {
            $this->db->select("*");
            $this->db->from("transaction");
            $this->db->where("user_id", $user_id);


            $this->db->where("created >=", $start_date);
            $this->db->where("created <=", $end_date);
            $query = $this->db->get();
            return $query->result();
        }else{
            return array();
        }
    }

}

?>
