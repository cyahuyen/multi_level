<?php

/**
 * Description of Transaction_model
 * @author ngoalongkt
 */

class Transaction_model extends CI_Model {
    
    public function upadateTransaction($data){
        $this->db->set('created', 'NOW()', FALSE);
        $this->db->insert('transaction', $data);
        return $this->db->insert_id();
    }
    
    public function checkTransactionExists($transaction) {
        $this->db->select("*");
        $this->db->from("transaction");
        $this->db->where("transaction_id", $transaction);

        $query = $this->db->get();
        $result = $query->result();
        if (empty($result))
            return FALSE;
        return TRUE;
    }
    
    function getTransactionNotExpiration($user_id, $start_date = null, $end_date = null) {
        if (!empty($start_date) || !empty($end_date)) {
            $this->db->select("*");
            $this->db->from("transaction");
            $this->db->where("user_id", $user_id);


            $this->db->where("created >=", $start_date);
            $this->db->where("created <=", $end_date);
            $this->db->where("status", 1);
            $query = $this->db->get();
            return $query->result();
        } else {
            return array();
        }
    }
    
}

?>
