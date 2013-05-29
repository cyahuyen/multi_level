<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CheckExpiration extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('expiration_model', '', TRUE);
        $this->load->model('config_model', 'configs');
        $this->load->model('user_model', 'user');
        $this->load->model('balance_model', 'balance');
        $this->load->model('balance_history_model', 'balance_history');
        $this->load->model('transaction_model', 'transaction');
    }

    public function index() {
        $transaction_config = $this->configs->getConfigs('transaction_fees');
        $referral_config = $this->configs->getConfigs('referral');

        $bonus_gold_percentage = $referral_config['bonus_percentage_gold'];
        $bonus_silver_percentage = $referral_config['bonus_percentage_silver'];
        $date = date('Y-m', strtotime(date('m', strtotime('-1 month')) . '/01/' . date('Y') . ' 00:00:00'));

        //get all gold user
        $userGolds = $this->user->listUser(array('usertype' => 2));
        $adminBounusAmount = 0;
        foreach ($userGolds as $user) {

            $balanceAmount = $this->balance->getBalance($user->user_id);
            $balanceHistiory = $this->balance_history->getBalanceHistory($user->user_id, $date);

            $amount_history = !empty($balanceHistiory->balance) ? $balanceHistiory->balance : 0;
            $amount_current = !empty($balanceAmount->balance) ? $balanceAmount->balance : 0;

            $bonus_amount = $amount_history * $bonus_gold_percentage / 100;
            $total_amount = $amount_current + $bonus_amount;
            $dataBalanceHistory = array(
                'user_id' => $user->user_id,
                'date' => date('Y') . '-' . date('m'),
                'balance' => $total_amount,
            );
            $this->balance_history->updateBalanceHistory($dataBalanceHistory);

            $adminBounusAmount += $bonus_amount;
            if ($amount_history > 0) {

                $dataProfit = array(
                    'month' => date('m', strtotime('-1 month')),
                    'blance_fees' => '$' . $bonus_amount,
                );
                sendmailform($user->email, 'profit', $dataProfit);

                $dataTransaction['user_id'] = $user->user_id;
                $dataTransaction['fees'] = 0;
                $dataTransaction['total'] = $bonus_amount;
                $dataTransaction['transaction_id'] = '';
                $dataTransaction['payment_status'] = 'Completed';
                $dataTransaction['transaction_source'] = 'system';
                $dataTransaction['transaction_type'] = 'bonus';
                $this->transaction->insert($dataTransaction);

                $dataAdmin[$user->user_id] = array(
                    'fullname' => $user->firstname . '' . $user->lastname,
                    'amount' => $amount_history
                );
            }

            $this->balance->updateBalanceByUserId($user->user_id, $total_amount);
        }

        $userSilvers = $this->user->listUser(array('usertype' => 1));
        foreach ($userSilvers as $user) {
            $balanceAmount = $this->balance->getBalance($user->user_id);
            $balanceHistiory = $this->balance_history->getBalanceHistory($user->user_id, $date);

            $amount_history = !empty($balanceHistiory->balance) ? $balanceHistiory->balance : 0;
            $amount_current = !empty($balanceAmount->balance) ? $balanceAmount->balance : 0;

            $bonus_amount = $amount_history * $bonus_silver_percentage / 100;
            $total_amount = $amount_current + $bonus_amount;

            $dataBalanceHistory = array(
                'user_id' => $user->user_id,
                'date' => date('Y') . '-' . date('m'),
                'balance' => $total_amount,
            );
            $this->balance_history->updateBalanceHistory($dataBalanceHistory);

            $adminBounusAmount += $bonus_amount;
            if ($amount_history > 0) {

                $dataProfit = array(
                    'month' => date('m', strtotime('-1 month')),
                    'blance_fees' => '$' . $bonus_amount,
                );
                sendmailform($user->email, 'profit', $dataProfit);

                $dataTransaction['user_id'] = $user->user_id;
                $dataTransaction['fees'] = 0;
                $dataTransaction['total'] = $bonus_amount;
                $dataTransaction['transaction_id'] = '';
                $dataTransaction['payment_status'] = 'Completed';
                $dataTransaction['transaction_source'] = 'system';
                $dataTransaction['transaction_type'] = 'bonus';
                $this->transaction->insert($dataTransaction);

                $dataAdmin[$user->user_id] = array(
                    'fullname' => $user->firstname . '' . $user->lastname,
                    'amount' => $amount_history
                );
            }

            $this->balance->updateBalanceByUserId($user->user_id, $total_amount);
        }
        $adminBalance = $this->balance->getAdminBalance();
        $this->balance->updateAdminBalance($adminBalance->balance - $adminBounusAmount);
        if (!empty($dataAdmin)) {
            $content = '';
            foreach ($dataAdmin as $data) {
                $content .= $data['fullname'] . ': ' . $data['amount'] . '<br>';
            }
            sendmail(null, 'Profit', $content);
        }
    }

    public function bonus() {
//        $this->load->model('config_model', 'configs');
//        $this->load->model('user_model', 'user');
//        $this->load->model('balance_model', 'balance');
//        $this->load->model('transaction_model', 'transaction');
//
//        $referral = $this->configs->getConfigs('referral');
//        $listSilver = $this->user->listUserBouns(1);
//        $dataAdmin = array();
//        if (!empty($listSilver)) {
//            foreach ($listSilver as $silver) {
//                $balance = $this->balance->getBalance($silver->user_id);
//                $blanceFees = $balance->balance * $referral['percentage_silver'] / 100;
//                $newBalance = $balance->balance + $blanceFees;
//                $this->balance->update($silver->user_id, array('balance' => $newBalance));
//                $this->user->updateDate($silver->user_id);
//                $adminBalance = $this->balance->getAdminBalance();
//                $this->balance->updateAdminBalance($adminBalance->balance - $blanceFees);
//                $dataTransaction['user_id'] = $silver->user_id;
//                $dataTransaction['fees'] = 0;
//                $dataTransaction['status'] = 0;
//                $dataTransaction['total'] = $blanceFees;
//                $dataTransaction['transaction_id'] = '';
//                $dataTransaction['payment_status'] = 'Completed';
//                $dataTransaction['transaction_source'] = 'system';
//                $dataTransaction['transaction_type'] = 'bonus';
//                $this->transaction->insert($dataTransaction);
//                $title = "Profit from " . $silver->transaction_start . " to " . $silver->transaction_finish;
//                $content = "You have just received: $" . $blanceFees . 'from ' . $silver->transaction_start . ' to ' . $silver->transaction_finish;
//
//                $dataProfit = array(
//                    'transaction_start' => $silver->transaction_start,
//                    'transaction_finish' => $silver->transaction_finish,
//                    'blance_fees' => '$'.$blanceFees,
//                );
//                sendmailform($silver->email, 'profit', $dataProfit);
//                
//                $dataAdmin[$silver->user_id] = array(
//                    'fullname' => $silver->fullname,
//                    'amount' => $blanceFees
//                );
//            }
//        }
//        $listGold = $this->user->listUserBouns(2);
//
//        if (!empty($listGold)) {
//            foreach ($listGold as $gold) {
//                $balance = $this->balance->getBalance($silver->user_id);
//                $blanceFees = $balance->balance * $referral['percentage_gold'] / 100;
//                $newBalance = $balance->balance + $blanceFees;
//                $this->balance->update($gold->user_id, array('balance' => $newBalance));
//                $this->user->updateDate($gold->user_id);
//                $adminBalance = $this->balance->getAdminBalance();
//                $this->balance->updateAdminBalance($adminBalance->balance - $blanceFees);
//
//                $dataTransaction['user_id'] = $gold->user_id;
//                $dataTransaction['fees'] = 0;
//                $dataTransaction['total'] = $blanceFees;
//                $dataTransaction['transaction_id'] = '';
//                $dataTransaction['payment_status'] = 'Completed';
//                $dataTransaction['transaction_source'] = 'system';
//                $dataTransaction['transaction_type'] = 'bonus';
//                $this->transaction->insert($dataTransaction);
//                $title = "Profit from " . $gold->transaction_start . " to " . $gold->transaction_finish;
//                $content = "You have just received: $" . $blanceFees . 'from ' . $gold->transaction_start . ' to ' . $gold->transaction_finish;
//                $dataProfit = array(
//                    'transaction_start' => $gold->transaction_start,
//                    'transaction_finish' => $gold->transaction_finish,
//                    'blance_fees' => '$'.$blanceFees,
//                );
//                sendmailform($silver->email, 'profit', $dataProfit);
//                $dataAdmin[$gold->user_id] = array(
//                    'fullname' => $gold->fullname,
//                    'amount' => $blanceFees
//                );
//            }
//        }
//        if (!empty($dataAdmin)) {
//            $content = '';
//            foreach ($dataAdmin as $data) {
//                $content .= $data['fullname'] . ': ' . $data['amount'] . '<br>';
//            }
//            sendmail(null, 'Profit', $content);
//        }
    }

}
