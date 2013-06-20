<?php

class Answer_model extends CI_Model {

    public function addAnswer($data) {
        $this->db->set('created', 'NOW()', FALSE);
        $this->db->insert('question', $data);
        return $this->db->insert_id();
    }

    public function getQuestions($dataWhere = array(), $limit = null, $start = null) {

        $this->db->select("*");
        $this->db->from('question');


        if (!empty($dataWhere)) {
            foreach ($dataWhere as $key => $where)
                $this->db->where($key, $where);
        }
        if ($limit)
            $this->db->limit((int) $limit);

        if ($limit && $start) {
            $this->db->limit((int) $limit, (int) $start);
        }
        $this->db->order_by('main_id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }
    
    public function getQuestionById($id){
        $this->db->select("*");
        $this->db->from('question');
        $this->db->where('id', $id);
        
        $result = $this->db->get()->result();
        return !empty($result[0]) ? $result[0] : array();
    }

}