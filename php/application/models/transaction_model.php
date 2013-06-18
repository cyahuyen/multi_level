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
    
    public function upadateTransaction($data){
        $this->db->set('created', 'NOW()', FALSE);
        $this->db->insert('transaction', $data);
        return $this->db->insert_id();
    }
    
}

?>
