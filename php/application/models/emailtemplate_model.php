<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of emailtemplate_model
 *
 * @author ngoalongkt
 */
class Emailtemplate_model extends CI_Model {

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('email_template', $data);
    }

    public function listEmail($data, $limit = null, $start = null, $sort = null) {
        $this->db->select("*");
        $this->db->from("email_template");
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( code LIKE '%" . $val . "%' OR subject LIKE '%" . $val . "%' )";
                    $this->db->where($where);
                }
                else
                    $this->db->where($key, $val);
            }
        }

        if ($limit)
            $this->db->limit((int) $limit);

        if ($limit && $start)
            $this->db->limit((int) $limit, (int) $start);

        if (!empty($sort)) {
            foreach ($sort as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function totalEmail($data) {
        $this->db->select("*");
        $this->db->from("email_template");

        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( code LIKE '%" . $val . "%' OR subject LIKE '%" . $val . "%' )";
                    $this->db->where($where);
                }
                else
                    $this->db->where($key, $val);
            }
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getEmailById($id) {
        $this->db->select("*");
        $this->db->from("email_template");

        $this->db->where('id', $id);

        $query = $this->db->get();
        $result = $query->result();
        return !empty($result) ? $result[0] : array();
    }

    public function getEmailByCode($code) {
        $this->db->select("*");
        $this->db->from("email_template");

        $this->db->where('code', $code);

        $query = $this->db->get();
        $result = $query->result();
        return !empty($result) ? $result[0] : array();
    }

    public function insert($data) {
        $this->db->insert('email_template', $data);
        return $this->db->insert_id();
    }

}

?>
