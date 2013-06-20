<?php

class Activity_model extends CI_Model {

    public function addActivity($main_user_id, $activity, $status = null, $amount = null) {
        $this->db->set('created', 'NOW()', FALSE);
        $data = array(
            'main_user_id' => $main_user_id,
            'description' => $activity,
            'status' => $status,
            'amount' => $amount
        );
        $this->db->insert('activity', $data);
        return $this->db->insert_id();
    }

    public function getActivities($dataWhere, $limit = null, $start = null) {
        $this->db->select("*");
        $this->db->from('activity');


        if (!empty($dataWhere)) {
            foreach ($dataWhere as $key => $where)
                $this->db->where($key, $where);
        }
        if ($limit)
            $this->db->limit((int) $limit);

        if ($limit && $start) {
            $this->db->limit((int) $limit, (int) $start);
        }
        $this->db->order_by('created', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function totalActivities($dataWhere) {
        $this->db->select("*");
        $this->db->from('activity');


        if (!empty($dataWhere)) {
            foreach ($dataWhere as $key => $where)
                $this->db->where($key, $where);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

}