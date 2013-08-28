
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Confirm extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    function write_log($str) {
        $url = realpath(dirname(__FILE__)) . '/log.txt';
        $out = fopen($url, "a");
        fwrite($out, $this->aprint($str));
        fclose($out);
    }

    function aprint($arr, $return = true) {
        $wrap = '<div style=" white-space:pre; position:absolute; top:10px; left:10px; height:200px; width:100px; overflow:auto; z-index:5000;">';
        $wrap = '<pre>';
        $txt = preg_replace('/(\[.+\])\s+=>\s+Array\s+\(/msiU', '$1 => Array (', print_r($arr, true));

        if ($return)
            return $wrap . $txt . '</pre>';
        else
            echo $wrap . $txt . '</pre>';
    }

    public function aw_quickpay_process() {
        $posts = $this->input->post();
        $this->write_log($posts);
        if (!$posts)
            return FALSE;
        $payments_config = $this->configs->getConfigs('aw_quickpay');
        $money = $posts['Amount'];
        $tmp_id = $posts['MerchantReference'];
        $this->load->model('tmp_model');
        $info = $this->tmp_model->getTmp($tmp_id);
        $this->tmp_model->delete($tmp_id);

        if (empty($info))
            return FALSE;
        if ($posts['SiteName'] != $payments_config['site'] || $posts['SiteID'] != $payments_config['SiteID'])
            return FALSE;
        $deposit_info = json_decode(base64_decode($info['tmp_info']));
        if (!$deposit_info)
            return FALSE;

        $this->write_log($deposit_info);

        $entry_amount = $deposit_info->entry_amount;

        $checkAmount = $entry_amount + $this->config_data['transaction_fee'];

        $this->write_log($money);
        $this->write_log($checkAmount);
        if ($money != $checkAmount)
            return FALSE;


        $this->load->model('user_model', 'user');
        $this->load->model('transaction_model', 'transaction');
        $this->load->model('config_model', 'configs');
        $this->load->model('balance_model', 'balance');

        $user_id = $deposit_info->user_id;
        $user = $this->user->getUserById($user_id);
        $this->data['user'] = $user;

        $payments = $this->configs->listActivepayment();

//        $totalInMonth = $posts['entry_amount'] + $totalTransaction;

        if ($user->usertype == 1) {
            $transactions = $this->transaction->getTransactionNotExpiration($user_id);

            $from = new DateTime($user->created);
            $to = new DateTime(date("y-m-d h:i:s", time()));
            $totalMonth = $from->diff($to)->m + $from->diff($to)->y * 12 + 1;

            $totalTransaction = 0;

            if (!empty($transactions)) {
                foreach ($transactions as $transaction) {
                    $totalTransaction += $transaction->total - $transaction->fees;
                }
            }

            $max_entry_amount = $this->config_data['max_enrolment_silver_amount'] * $totalMonth - $totalTransaction;


            if (($deposit_info->entry_amount > $max_entry_amount) || ($deposit_info->entry_amount % 10 != 0)) {
                $error = array('error', 'darkred', 'Payment errors', 'Deposite Amount litter than $' . $max_entry_amount . ' and divisible for 10');
                $this->session->set_flashdata(array('usermessage' => $error));
                redirect('account/transaction');
            }
        } else {
            $startdate = date('Y-m-d h:i:s', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'));
            $enddate = date('Y-m-d h:i:s', strtotime('-1 second', strtotime('+1 month', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'))));
            //get transaction
            $transactions = $this->transaction->getTransactionNotExpiration($user_id, $startdate, $enddate);

            $totalTransaction = 0;
            if (!empty($transactions)) {
                foreach ($transactions as $transaction) {
                    $totalTransaction += $transaction->total - $transaction->fees;
                }
            }
            $max_entry_amount = $this->config_data['max_enrolment_entry_amount'] - $totalTransaction;
            $min_entry_amount = $this->config_data['min_enrolment_entry_amount'];

            if (($deposit_info->entry_amount > $max_entry_amount) || ($deposit_info->entry_amount < $min_entry_amount) || ($deposit_info->entry_amount % 100 != 0)) {
                $error = array('error', 'darkred', 'Payment errors', 'Deposite Amount litter than $' . $max_entry_amount . ', greater than $' . $min_entry_amount . ' and divisible for 100');
                $this->session->set_flashdata(array('usermessage' => $error));
                redirect('account/transaction');
            }
        }
        $checkExistsDeposit = $this->transaction->checkExistsDeposit($user->user_id);


//      BOF Update Balance
        $this->balance->updateAdminBalance($money, '+');

        $dataBalanceUpdate = array(
            'user_id' => $user->user_id,
            'balance' => $deposit_info->entry_amount,
        );
        $dataTransaction = $this->balance->updateBalance($dataBalanceUpdate);
        $this->activity->addActivity($user->main_id, 'Deposited to the account ' . $user->acount_number . ' with amount : $' . ($dataBalanceUpdate['balance']), '+', $dataBalanceUpdate['balance']);
//      EOF Update Balance
//      BOF Update Transaction
        $dataTransactionUpdate = array(
            'user_id' => $user->user_id,
            'main_user_id' => $user->main_id,
            'fees' => $this->config_data['transaction_fee'],
            'total' => $money,
            'payment_status' => 'Completed',
            'transaction_type' => 'deposit',
            'transaction_text' => '+',
            'transaction_source' => 'creditcard',
            'transaction_id' => $payment_status['transaction_id'],
            'status' => '1',
        );
        $this->transaction->upadateTransaction($dataTransactionUpdate);

//      EOF Update Transaction
        if ($user->usertype == 1) {
            $userReffering = $this->user->getUserByMainId($user->referring, 1);
            if (!empty($userReffering)) {
                if ($checkExistsDeposit) {
                    $refereFees = $dataBalanceUpdate['balance'] * $this->config_data['percent_referral_fees'] / 100;
                    $dataBalanceGoldRefferingUpdate = array(
                        'user_id' => $userReffering->user_id,
                        'balance' => $refereFees,
                    );
                    $this->balance->updateBalance($dataBalanceGoldRefferingUpdate);
                    //      BOF Update Balance
                    $this->balance->updateAdminBalance($refereFees, '-');
                    $this->activity->addActivity($userReffering->main_id, 'The account ' . $userReffering->acount_number . ' received a referral fee with amount : $' . ($refereFees), '+', $refereFees);

                    $dataTransactionUpdate = array(
                        'user_id' => $userReffering->user_id,
                        'main_user_id' => $userReffering->main_id,
                        'fees' => 0,
                        'total' => $refereFees,
                        'payment_status' => 'Completed',
                        'transaction_type' => 'refere',
                        'transaction_text' => '+',
                        'transaction_source' => 'system',
                        'status' => '0',
                    );
                    $this->transaction->upadateTransaction($dataTransactionUpdate);
                }
            }
        } else {
            // BOF First deposit
            if (!$checkExistsDeposit) {
                $total = $this->transaction->getAllBalanceByReferedDeposit($user->main_id);
                $referedAmount = $total * $this->config_data['referral_bonus_default'] / 100;

                $dataBalanceGoldRefferingUpdate = array(
                    'user_id' => $user->user_id,
                    'balance' => $referedAmount,
                );
                $this->balance->updateBalance($dataBalanceGoldRefferingUpdate);
                //      BOF Update Balance
                $this->balance->updateAdminBalance($referedAmount, '-');
                $this->activity->addActivity($user->main_id, 'The account ' . $user->acount_number . ' received a referral fee with amount : $' . ($referedAmount), '+', $referedAmount);

                $dataTransactionUpdate = array(
                    'user_id' => $user->user_id,
                    'main_user_id' => $user->main_id,
                    'fees' => 0,
                    'total' => $referedAmount,
                    'payment_status' => 'Completed',
                    'transaction_type' => 'refere',
                    'transaction_text' => '+',
                    'transaction_source' => 'system',
                    'status' => '0',
                    'description' => 'The user "' . $user->firstname . ' ' . $user->last_name . '" deposited $' . $referedAmount
                );
                $this->transaction->upadateTransaction($dataTransactionUpdate);
            }
            // EOF First deposit

            $userReffering = $this->user->getUserByMainId($user->referring, 2);
            if (!empty($userReffering)) {
                $refereFees = $this->getRefereAmount($posts['entry_amount'], $userReffering->main_id);
                $checkRefereExistsDeposit = $this->transaction->checkExistsDeposit($userReffering->user_id);
                if ($checkRefereExistsDeposit) {
                    $dataBalanceGoldRefferingUpdate = array(
                        'user_id' => $userReffering->user_id,
                        'balance' => $refereFees,
                    );
                    $this->balance->updateBalance($dataBalanceGoldRefferingUpdate);
                    //      BOF Update Balance
                    $this->balance->updateAdminBalance($refereFees, '-');
                    $this->activity->addActivity($userReffering->main_id, 'The account ' . $userReffering->acount_number . ' received a referral fee with amount : $' . ($refereFees), '+', $refereFees);

                    $dataTransactionUpdate = array(
                        'user_id' => $userReffering->user_id,
                        'main_user_id' => $userReffering->main_id,
                        'fees' => 0,
                        'total' => $refereFees,
                        'payment_status' => 'Completed',
                        'transaction_type' => 'refere',
                        'transaction_text' => '+',
                        'transaction_source' => 'system',
                        'status' => '0',
                        'description' => 'The user "' . $userReffering->firstname . ' ' . $userReffering->last_name . '" deposited $' . $refereFees
                    );
                    $this->transaction->upadateTransaction($dataTransactionUpdate);
                }
            }
        }


        $data['usermessage'] = array('success', 'green', 'Deposite Success', '');
        $this->session->set_flashdata('usermessage', $data['usermessage']);
        $adminHtml = 'Full Name: ' . $user->firstname . ' ' . $user->lastname . '<br>';
        $adminHtml .= 'Amount: ' . $money;

        $adminEmaildata['full_name'] = $user->firstname . ' ' . $user->lastname;
        $adminEmaildata['email'] = $user->email;
        $adminEmaildata['amount'] = $money;
        sendmailform(null, 'deposite', $adminEmaildata);
    }

}