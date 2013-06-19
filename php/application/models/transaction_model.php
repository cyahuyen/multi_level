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
    
}

?>
