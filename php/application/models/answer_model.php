<?php

class Question_model extends CI_Model {

    public function addQuestion($data) {
        $this->db->set('created', 'NOW()', FALSE);
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

}