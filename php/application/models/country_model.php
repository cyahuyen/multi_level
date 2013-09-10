<?php

class Country_model extends CI_Model {

    public function getCountries($dataWhere = array(), $limit = null, $start = null, $sort = null) {

        $this->db->select("*");
        $this->db->from('country');


        if (!empty($dataWhere)) {
            foreach ($dataWhere as $key => $where)
                $this->db->where($key, $where);
        }
        if ($limit)
            $this->db->limit((int) $limit);

        if ($limit && $start) {
            $this->db->limit((int) $limit, (int) $start);
        }

        if (!empty($sort))
            foreach ($sort as $key => $val)
                $this->db->order_by($key, $val);

        $query = $this->db->get();
        return $query->result();
    }

}