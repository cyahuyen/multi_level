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

}