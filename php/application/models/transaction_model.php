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

        $id = $this->db->insert_id();
        return $id;
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

    public function updateRefereFees($referring, $total_fees) {
        $this->db->set('created', 'NOW()', FALSE);

        $this->load->model('config_model', 'configs');
        $referral = $this->configs->getConfigs('referral');

        $this->load->model('user_model', 'user');
        $user = $this->user->getUserByReferral($referring);
        if (!empty($user)) {
            if ($user->usertype < 2)
                return FALSE;

            $data['total'] = $total_fees;
            $data['payment_status'] = 'Completed';
            $data['transaction_type'] = 'refere';
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

    public function getTotalTransfer($user_id) {
        $totalPaymentRequest = $this->getTotalPaymentRequest($user_id);
        $totalPaymentTransaction = $this->getTotalTransactionPayment($user_id);
        $totalWithdrawTransaction = $this->getTotalWithdrawPayment($user_id);

        $totalTransfer = $totalPaymentTransaction - $totalPaymentRequest - $totalWithdrawTransaction;

        return $totalTransfer;
    }

    public function getTotalTransactionPayment($user_id) {
        $this->db->select("(SUM(`transaction`.total) - SUM(`transaction`.fees)) as total_payment");
        $this->db->from("transaction");
        $this->db->where("user_id", $user_id);
        $this->db->where_in("transaction_type", array('bonus', 'refere'));

        $query = $this->db->get();
        $result = $query->result();
        return !empty($result) ? $result[0]->total_payment : 0;
    }

    public function getTotalWithdrawPayment($user_id) {
        $this->db->select("(SUM(`transaction`.total) - SUM(`transaction`.fees)) as total_payment");
        $this->db->from("transaction");
        $this->db->where("user_id", $user_id);
        $this->db->where_in("transaction_type", array('withdraw'));

        $query = $this->db->get();
        $result = $query->result();
        return !empty($result) ? $result[0]->total_payment : 0;
    }

    public function getTotalPaymentRequest($user_id) {
        $this->db->select("SUM(balance) as total_request");
        $this->db->from("payment_history");
        $this->db->where("user_id", $user_id);
        $this->db->where("payment_status", 0);

        $query = $this->db->get();
        $result = $query->result();
        return !empty($result) ? $result[0]->total_request : 0;
    }

    public function insertHistory($data) {
        $this->db->set('created', 'NOW()', FALSE);
        $this->db->insert('payment_history', $data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function getHistoryById($id) {
        $this->db->select("*");
        $this->db->from("payment_history");
        $this->db->join("user", 'payment_history.user_id = user.user_id');
        $this->db->where("id", $id);

        $query = $this->db->get();
        $result = $query->result();
        return !empty($result) ? $result[0] : array();
    }

    public function updateHistory($data, $id) {
        $this->db->where("id", $id);
        $this->db->set('confirm_date', 'NOW()', FALSE);
        return $this->db->update('payment_history', $data);
    }

    public function totalTransfer() {
        $this->db->select("*");
        $this->db->from("transaction");
        $query = $this->db->get();
        return $query->num_rows();
    }

    function getUser($id) {
        $sql = $this->db->query("SELECT CONCAT(firstname,' ', lastname) as fullname, username FROM user WHERE user_id='" . (int) $id . "' ")->result();
        if ($sql)
            return $sql[0]->username;
        else {
            return 0;
        }
    }

    public function listWithdrawal($data, $limit = null, $start = null, $sort = null) {
        $this->db->select("*");
        $this->db->from("payment_history");
        $this->db->join("user", 'payment_history.user_id = user.user_id');
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( payment_history.email_paypal LIKE '%" . $val . "%' OR user.email LIKE '%" . $val . "%')";
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

    public function totalWithdrawal($data) {
        $this->db->select("*");
        $this->db->from("payment_history");
        $this->db->join("user", 'payment_history.user_id = user.user_id');

        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( payment_history.email_paypal LIKE '%" . $val . "%' OR user.email LIKE '%" . $val . "%' )";
                    $this->db->where($where);
                }
                else
                    $this->db->where($key, $val);
            }
        }

        $query = $this->db->get();
        return $query->num_rows();
    }
    
    
    

}

?>
