<?php

/*
  This model provides all interfaces for user management
 */

class Config_model extends CI_Model {

    

    public function isActived($method_name) {
        $this->db->select("*");
        $this->db->from("config");

        $this->db->where('code', $method_name);

        $query = $this->db->get();
        $result = $query->result();
        if (!empty($result))
            return TRUE;
        return FALSE;
    }

    public function getConfigs($code) {
        $this->db->select("*");
        $this->db->from("config");

        $this->db->where('code', $code);

        $query = $this->db->get();
        $results = $query->result();
        $data = array();
        foreach ($results as $result) {
            if (!$result->serialized) {
                $data[$result->key] = $result->value;
            } else {
                $data[$result->key] = unserialize($result->value);
            }
        }

        return $data;
    }
    
    public function getAllConfigs(){
        $this->db->select("*");
        $this->db->from("config");
        $query = $this->db->get();
        $results = $query->result();
        $data = array();
        foreach ($results as $result) {
            if (!$result->serialized) {
                $data[$result->key] = $result->value;
            } else {
                $data[$result->key] = unserialize($result->value);
            }
        }

        return $data;
    }


    public function listPayment(){
        $this->db->select("code");
        $this->db->select("value");
        $this->db->from("config");

        $this->db->where('group', 'payment');
        $this->db->where('key', 'active');

        $query = $this->db->get();
        $results = $query->result();

        return $results;
    }
    
    public function listActivepayment(){
        $payments = $this->listPayment();
        $listActivePayments = array();
        foreach($payments as $payment){
            if($payment->value == 1){
                $listActivePayments[$payment->code] = $this->getConfigs($payment->code);
            }
        }
        
        return ($listActivePayments);
    }

    public function deleteConfigs($code) {
        $this->db->delete('config', array('code' => $code));
    }

    public function editConfigs($code, $group, $data) {
        $this->deleteConfigs($code);
        $dataConfig['code'] = $code;
        $dataConfig['group'] = $group;
        foreach ($data as $key => $value) {
            $dataConfig['key'] = $key;
            if (!is_array($value)) {
                $dataConfig['value'] = $value;
            } else {
                $dataConfig['value'] = serialize($value);
                $dataConfig['serialized'] = 1;
            }
            $this->db->insert('config', $dataConfig);
        }
    }

    public function insert($data) {
        $data['created_on'] = 'NOW()';
        $this->db->insert('user', $data);

        $user_id = $this->db->insert_id();

        return $user_id;
    }

}