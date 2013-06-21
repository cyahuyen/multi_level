<?php

/**
 * Description of Transaction_model
 * @author ngoalongkt
 */
class Transaction_model extends CI_Model {

    public function upadateTransaction($data) {
        $this->db->set('created', 'NOW()', FALSE);
        $this->db->insert('transaction', $data);
        return $this->db->insert_id();
    }

    public function checkTransactionExists($transaction) {
        $this->db->select("*");
        $this->db->from("transaction");
        $this->db->where("transaction_id", $transaction);

        $query = $this->db->get();
        $result = $query->result();
        if (empty($result))
            return FALSE;
        return TRUE;
    }

    function getTransactionNotExpiration($user_id, $start_date = null, $end_date = null) {
        if (!empty($start_date) || !empty($end_date)) {
            $this->db->select("*");
            $this->db->from("transaction");
            $this->db->where("user_id", $user_id);


            $this->db->where("created >=", $start_date);
            $this->db->where("created <=", $end_date);
            $this->db->where("status", 1);
            $query = $this->db->get();
            return $query->result();
        } else {
            return array();
        }
    }

    public function totalHistory($id, $search = null) {
        $this->db->select("*");
        $this->db->from("transaction");
        $this->db->join("user", "user.user_id = transaction.user_id");
        $this->db->join("user_main", "user_main.main_id = transaction.main_user_id");
        if ($search) {
            foreach ($search as $key => $val)
                $this->db->where($key, $val);
        }
        $this->db->where('transaction.main_user_id', $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getHistorys($id, $search = null, $limit = null, $start = null) {
        $this->db->select("*");
        $this->db->from("transaction");
        $this->db->join("user", "user.user_id = transaction.user_id");
        $this->db->join("user_main", "user_main.main_id = transaction.main_user_id");

        if ($id) {
            $this->db->where('transaction.main_user_id', $id);
        }
        if ($search) {
            foreach ($search as $key => $val)
                $this->db->where($key, $val);
        }
        if ($limit)
            $this->db->limit((int) $limit);

        if ($limit && $start) {
            $this->db->limit((int) $limit, (int) $start);
        }
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function totalTransfer($data) {
        $this->db->select("*");
        $this->db->from("transaction");
        $this->db->join("user", 'user.user_id = transaction.user_id');
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( user.acount_number LIKE '%" . $val . "%')";
                    $this->db->where($where);
                }
                else
                    $this->db->where($key, $val);
            }
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function getTransfers($data, $limit = null, $start = null, $sort = null) {
        $this->db->select("*");
        $this->db->from("transaction");
        $this->db->join("user", 'user.user_id = transaction.user_id');
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( user.acount_number LIKE '%" . $val . "%')";
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

}

?>
