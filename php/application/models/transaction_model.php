<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of reansaction_model
 *
 * @author ngoalongkt
 */
class Transaction_model extends CI_Model {

    public function insert($data) {
        $this->db->set('created', 'NOW()', FALSE);
        $this->db->insert('transaction', $data);

        $user_id = $this->db->insert_id();
        return $user_id;
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

    public function updateRefereFees($user_id) {
        $this->db->set('created', 'NOW()', FALSE);

        $this->load->model('config_model', 'configs');
        $referral = $this->configs->getConfigs('referral');

        $this->load->model('user_model', 'user');
        $user = $this->user->getUserById($user_id);

        if (!empty($user)) {
            if ($user->usertype == 1)
                $data['total'] = $referral['silver_fees'];
            elseif ($user->usertype == 2)
                $data['total'] = $referral['gold_fees'];

            $data['payment_status'] = 'Completed';
            $data['status'] = 0;
            $data['transaction_source'] = 'system';
            $data['user_id'] = $user->user_id;

            $this->db->insert('transaction', $data);

            $id = $this->db->insert_id();
            return $id;
        }
        return 0;
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

    public function getTransfers($limit = null, $start = null) {
        $this->db->select("*");
        $this->db->from("transaction");
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

    public function totalTransfer() {
        $this->db->select("*");
        $this->db->from("transaction");
        $query = $this->db->get();
        return $query->num_rows();
    }

    function getUser($id) {
        $sql = $this->db->query("SELECT fullname FROM user WHERE user_id='" . (int) $id . "' ")->result();
        if ($sql)
            return $sql[0]->fullname;
        else {
            return 0;
        }
    }

}

?>
