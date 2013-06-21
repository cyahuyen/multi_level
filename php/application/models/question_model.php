<?php

class Question_model extends CI_Model {

    public function addQuestion($data) {
        $this->db->set('created', 'NOW()', FALSE);
        $this->db->insert('question', $data);
        return $this->db->insert_id();
    }

    public function updateQuestion($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('question', $data);
    }

    public function getQuestions($dataWhere = array(), $limit = null, $start = null, $sort = null) {

        $this->db->select("*");
        $this->db->from('question');
        $this->db->join('user_main', 'user_main.main_id = question.main_user_id');


        if (!empty($dataWhere)) {
            foreach ($dataWhere as $key => $where)
                $this->db->where('question.' . $key, $where);
        }
        if ($limit)
            $this->db->limit((int) $limit);

        if ($limit && $start) {
            $this->db->limit((int) $limit, (int) $start);
        }

        if (!empty($sort))
            foreach ($sort as $key => $val)
                $this->db->order_by('question.' . $key, $val);
        else
            $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function totalQuestion($dataWhere) {
        $this->db->select("*");
        $this->db->from('question');


        if (!empty($dataWhere)) {
            foreach ($dataWhere as $key => $where)
                $this->db->where($key, $where);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getQuestionById($id) {
        $this->db->select("*");
        $this->db->from('question');
        $this->db->join('user_main', 'user_main.main_id = question.main_user_id');
        $this->db->where('question.id', $id);

        $result = $this->db->get()->result();
        return !empty($result[0]) ? $result[0] : array();
    }

}