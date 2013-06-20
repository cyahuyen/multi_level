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
        $userGolds = $this->user->listUserByType(2);
        $adminBounusAmount = 0;
        foreach ($userGolds as $user) {

            $balanceAmount = $this->balance->getBalance($user->user_id);
            $balanceHistiory = $this->balance_history->getBalanceHistory($user->user_id, $date);

            $amount_history = !empty($balanceHistiory->balance) ? $balanceHistiory->balance : 0;
            $amount_current = !empty($balanceAmount->balance) ? $balanceAmount->balance : 0;

            $bonus_amount = $amount_history * $bonus_gold_percentage / 100;

//      BOF Update Balance History
            $total_amount = $amount_current + $bonus_amount;
            $dataBalanceHistory = array(
                'user_id' => $user->user_id,
                'date' => date('Y') . '-' . date('m'),
                'balance' => $total_amount,
            );
            $this->balance_history->updateBalanceHistory($dataBalanceHistory);
//      EOF Update Balance History

            if ($amount_history > 0) {


//      BOF Update Balance
                $this->balance->updateAdminBalance($bonus_amount, '-');

                $dataBalanceUpdate = array(
                    'user_id' => $user->user_id,
                    'balance' => $bonus_amount,
                );
                $dataTransaction = $this->balance->updateBalance($dataBalanceUpdate);
                $this->activity->addActivity($user->main_id, 'Add bonus amount your acount ' . $user->acount_number . ' with amount : $' . ($dataBalanceUpdate['balance']), '+', $dataBalanceUpdate['balance']);
//      EOF Update Balance
//      BOF Update Transaction
                $dataTransactionUpdate = array(
                    'user_id' => $user->user_id,
                    'main_user_id' => $user->main_id,
                    'fees' => 0,
                    'total' => $bonus_amount,
                    'payment_status' => 'Completed',
                    'transaction_type' => 'bonus',
                    'transaction_text' => '+',
                    'transaction_source' => 'system',
                    'transaction_id' => '',
                    'status' => '0',
                );
                $this->transaction->upadateTransaction($dataTransactionUpdate);

//      EOF Update Transaction

                $dataProfit = array(
                    'month' => date('m', strtotime('-1 month')),
                    'acount_number' => $user->acount_number,
                    'blance_fees' => '$' . $bonus_amount,
                );
                sendmailform($user->email, 'profit', $dataProfit);

                $dataAdmin[$user->user_id] = array(
                    'fullname' => $user->firstname . '' . $user->lastname,
                    'acount_number' => $user->acount_number,
                    'amount' => $amount_history
                );
            }
        }

        $userSilvers = $this->user->listUserByType(1);
        foreach ($userSilvers as $user) {
            $balanceAmount = $this->balance->getBalance($user->user_id);
            $balanceHistiory = $this->balance_history->getBalanceHistory($user->user_id, $date);

            $amount_history = !empty($balanceHistiory->balance) ? $balanceHistiory->balance : 0;
            $amount_current = !empty($balanceAmount->balance) ? $balanceAmount->balance : 0;

            $bonus_amount = $amount_history * $bonus_silver_percentage / 100;
            //      BOF Update Balance History
            $total_amount = $amount_current + $bonus_amount;
            $dataBalanceHistory = array(
                'user_id' => $user->user_id,
                'date' => date('Y') . '-' . date('m'),
                'balance' => $total_amount,
            );
            $this->balance_history->updateBalanceHistory($dataBalanceHistory);
//      EOF Update Balance History

            if ($amount_history > 0) {


//      BOF Update Balance
                $this->balance->updateAdminBalance($bonus_amount, '-');

                $dataBalanceUpdate = array(
                    'user_id' => $user->user_id,
                    'balance' => $bonus_amount,
                );
                $dataTransaction = $this->balance->updateBalance($dataBalanceUpdate);
                $this->activity->addActivity($user->main_id, 'Add bonus amount your acount ' . $user->acount_number . ' with amount : $' . ($dataBalanceUpdate['balance']), '+', $dataBalanceUpdate['balance']);
//      EOF Update Balance
//      BOF Update Transaction
                $dataTransactionUpdate = array(
                    'user_id' => $user->user_id,
                    'main_user_id' => $user->main_id,
                    'fees' => 0,
                    'total' => $bonus_amount,
                    'payment_status' => 'Completed',
                    'transaction_type' => 'bonus',
                    'transaction_text' => '+',
                    'transaction_source' => 'system',
                    'transaction_id' => '',
                    'status' => '0',
                );
                $this->transaction->upadateTransaction($dataTransactionUpdate);

//      EOF Update Transaction

                $dataProfit = array(
                    'month' => date('m', strtotime('-1 month')),
                    'acount_number' => $user->acount_number,
                    'blance_fees' => '$' . $bonus_amount,
                );
                sendmailform($user->email, 'profit', $dataProfit);

                $dataAdmin[$user->user_id] = array(
                    'fullname' => $user->firstname . '' . $user->lastname,
                    'acount_number' => $user->acount_number,
                    'amount' => $amount_history
                );
            }
        }
        if (!empty($dataAdmin)) {
            $content = '';
            foreach ($dataAdmin as $data) {
                $content .= 'Acount number: '. $data['acount_number']. '<br>';
                $content .= $data['fullname'] . ': ' . $data['amount'] . '<br><br><br>';
            }
            sendmailform(null, 'admin_profit', array('content' => $content));
        }
    }

    public function bonus() {

    }

}
