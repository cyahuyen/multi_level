<?php

class Answer_model extends CI_Model {

    public function addAnswer($data) {
        $this->db->insert('answer', $data);
        return $this->db->insert_id();
    }

    public function getAnswersByquestionId($id){
        $this->db->select("*");
        $this->db->from('answer');
        $this->db->where('question_id', $id);
        
        $results = $this->db->get()->result();
        return $results;
    }
    
    public function updateAnswer($id,$data){
        $this->db->where('question_id', $id);
        return $this->db->update('answer', $data);
    }

}