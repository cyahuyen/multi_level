<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CheckExpiration extends CI_Controller {

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
        $currentDate = date("Y-m-d H:i:s");
//        $currentDate = "2013-05-06 05:37:22";
        foreach ($expirations as $expiration) {
            if ($expiration->transaction_finish <= $currentDate && $expiration->usertype == 2) {
                $users_expirations = $this->expiration_model->getUsersLimit($currentDate, 2);
                foreach ($users_expirations as $emails) {
                    $email_user = $emails->email;
                    $title = "Account Expiration!";
                    $content = "Your account has expired. Please log in and check your account";
                    $email_sent = "admin@mysite.com";
                    $name_sent = "Administrator";
                    sendmail($email_user, $title, $content, $email_sent, $name_sent, 'html');
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

}
