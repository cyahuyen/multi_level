<?php

/*
  This model provides all interfaces for product management
 */

class Product_model extends CI_Model {

    public function listProduct($data, $limit = null, $start = null, $sort = null) {
        $this->db->select("*");
        $this->db->from("product");

        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( title LIKE '%" . $val . "%' OR code LIKE '%" . $val . "%' )";
                    $this->db->where($where);
                }else
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

    public function totalProduct($data) {
        $this->db->select("*");
        $this->db->from("product");

        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( title LIKE '%" . $val . "%' OR code LIKE '%" . $val . "%' )";
                    $this->db->where($where);
                }else
                    $this->db->where($key, $val);
            }
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getProductById($id) {
        $this->db->select("*");
        $this->db->from("product");
        $this->db->where('id', $id);

        $query = $this->db->get();
        $result = $query->result();
        return $result[0];
    }

    public function insert($data) {
      
        
        $this->db->insert('product', $data);

        $product_id = $this->db->insert_id();

        return $product_id;
    }

    public function update($data, $id) {
       
        $this->db->where('id', $id);
        $this->db->update('product', $data);
    }

    public function deactive($id) {
        $this->db->where('id', $id);
        $this->db->update('product', array('status' => 0));
    }
    public function active($id) {
        $this->db->where('id', $id);
        $this->db->update('product', array('status' => 1));
    }

}

?>
