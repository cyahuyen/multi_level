<?php

/*
  This model provides all interfaces for user management
 */

class Tmp_model extends CI_Model {

    public function getTmp($id) {
        $this->db->select("*");
        $this->db->from("tmp_info");
        $this->db->where('id', $id);

        $query = $this->db->get();
        $results = $query->result_array();

        return $results ? $results[0] : array();
    }
    
    public function insert($data){
        $this->db->insert('tmp_info', $data);
        return $this->db->insert_id();
    }
    
    public function delete($id){
        $this->db->delete('tmp_info', array('id' => $id));
    }

}