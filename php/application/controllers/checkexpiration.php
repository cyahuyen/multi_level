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
    }

    public function index() {
        $this->data['title'] = 'Check Expiration';
        $expirations = $this->expiration_model->getUsers();
//        $currentDate = date("Y-m-d H:i:s");
        $currentDate = "2013-06-08 14:26:41";
        foreach ($expirations as $expiration) {
            if ($expiration->transaction_finish <= $currentDate && $expiration->usertype == 2) {
                $users_expirations = $this->expiration_model->getUsersLimit($currentDate, 2);
                $admins = $this->expiration_model->getAdmin();
                foreach ($users_expirations as $emails) {
                    $email_user = $emails->email;
                    $title = "Account Expiration!";
                    $content = "Your account has expired. Please log in and check your account";
                    $email_sent = "admin@mysite.com";
                    $name_sent = "Administrator";
                    // Sent email to user
                    sendmail($email_user, $title, $content, $email_sent, $name_sent, 'html');
                    $title_admin = "Users Expiration!";
                    $content_admin = "Member account '" . $emails->fullname . "'  has expired. Please log in and check information";
                    // Sent email to admin
                    sendmail($admins->email, $title_admin, $content_admin, 'admin@mysite.com', 'System', 'html');
                    $refereds = $this->expiration_model->getReferedsbyId($emails->user_id);
                    if (!empty($refereds)) {
                        $this->expiration_model->updateUser($emails->user_id, 1);
                    } else {
                        $this->expiration_model->updateUser($emails->user_id, 0);
                    }
                }
            }
        }
    }

    public function bonus() {
        $this->load->model('config_model', 'configs');
        $this->load->model('user_model', 'user');
        $this->load->model('balance_model', 'balance');
        $this->load->model('transaction_model', 'transaction');

        $referral = $this->configs->getConfigs('referral');
        $listSilver = $this->user->listUserBouns(1);

        if (!empty($listSilver)) {
            foreach ($listSilver as $silver) {
                $balance = $this->balance->getBalance($silver->user_id);
                $blanceFees = $balance->balance * $referral['percentage_silver'] / 100;
                $newBalance = $balance->balance + $blanceFees;
                $this->balance->update($silver->user_id, array('balance' => $newBalance));
                $this->user->updateDate($silver->user_id);
                $adminBalance = $this->balance->getAdminBalance();
                $this->balance->updateAdminBalance($adminBalance->balance - $blanceFees);
                $dataTransaction['user_id'] = $silver->user_id;
                $dataTransaction['fees'] = 0;
                $dataTransaction['status'] = 0;
                $dataTransaction['total'] = $blanceFees;
                $dataTransaction['transaction_id'] = '';
                $dataTransaction['payment_status'] = 'Completed';
                $dataTransaction['transaction_source'] = 'system';
                $dataTransaction['transaction_type'] = 'bonus';
                $this->transaction->insert($dataTransaction);
                $title = "Profit from " . $silver->transaction_start . " to " . $silver->transaction_finish;
                $content = "You have just received: $" . $blanceFees . 'from ' . $silver->transaction_start . ' to ' . $silver->transaction_finish;
                sendmail($silver->email, $title, $content);
            }
        }
        $listGold = $this->user->listUserBouns(2);

        if (!empty($listGold)) {
            foreach ($listGold as $gold) {
                $balance = $this->balance->getBalance($silver->user_id);
                $blanceFees = $balance->balance * $referral['percentage_gold'] / 100;
                $newBalance = $balance->balance + $blanceFees;
                $this->balance->update($gold->user_id, array('balance' => $newBalance));
                $this->user->updateDate($gold->user_id);
                $adminBalance = $this->balance->getAdminBalance();
                $this->balance->updateAdminBalance($adminBalance->balance - $blanceFees);

                $dataTransaction['user_id'] = $gold->user_id;
                $dataTransaction['fees'] = 0;
                $dataTransaction['total'] = $blanceFees;
                $dataTransaction['transaction_id'] = '';
                $dataTransaction['payment_status'] = 'Completed';
                $dataTransaction['transaction_source'] = 'system';
                $dataTransaction['transaction_type'] = 'bonus';
                $this->transaction->insert($dataTransaction);
                $title = "Profit from " . $gold->transaction_start . " to " . $gold->transaction_finish;
                $content = "You have just received: $" . $blanceFees . 'from ' . $gold->transaction_start . ' to ' . $gold->transaction_finish;
                sendmail($gold->email, $title, $content);
            }
        }
    }

}
