<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends MY_Controller {

    var $menu_config_0 = array('', '', '', '', '', '');
    var $menu_config_1 = array('active', '', '', '', '', '');
    var $menu_config_2 = array('', 'active', '', '', '', '');
    var $menu_config_3 = array('', '', 'active', '', '', '');
    var $menu_config_4 = array('', '', '', 'active', '', '');
    var $menu_config_5 = array('', '', '', '', 'active', '');
    var $menu_config_6 = array('', '', '', '', '', 'active');
    var $usertype = array('0' => 'Member', '1' => 'Silver', '2' => 'Gold');

    function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('recaptcha');
        $this->lang->load('recaptcha');
        $this->load->model('register_model', '', TRUE);
        $this->load->model('transaction_model', 'transaction', TRUE);
        $this->data['user_session'] = $this->session->userdata('user');
        $this->data['menu_config'] = $this->menu_config_2;



        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
    }

    public function index() {
        $this->data['title'] = 'Sign Up';
        $posts = $this->input->post();
        $this->load->model('config_model', 'configs');
        $dataConfig['return'] = site_url('register/paypal_return');
        $dataConfig['cancel_return'] = site_url('register/cancel_return');
        $dataConfig['notify_url'] = site_url('home');
        $dataConfig['transaction_fees'] = $this->configs->getConfigs('transaction_fees');
        $dataConfig['title'] = 'Register';
        $this->data['transaction_fees'] = $dataConfig['transaction_fees'];
        $payments = $this->configs->listActivepayment();
        $data['payments'] = array();
        foreach ($payments as $code => $config) {
            $dataConfig['config'] = $config;
            $this->data['payments'][$code] = $this->load->view('payment/' . $code, $dataConfig, true);
        }
        $session = $this->session->flashdata('message');
        if (isset($session)) {
            $this->data['success'] = $session;
        } else {
            $this->data['success'] = '';
        }

        if (isset($posts['firstname'])) {
            $this->data['firstname'] = $posts['firstname'];
        } else {
            $this->data['firstname'] = '';
        }
        if (isset($posts['lastname'])) {
            $this->data['lastname'] = $posts['lastname'];
        } else {
            $this->data['lastname'] = '';
        }
        if (isset($posts['password'])) {
            $this->data['password'] = $posts['password'];
        } else {
            $this->data['password'] = '';
        }
        if (isset($posts['address'])) {
            $this->data['address'] = $posts['address'];
        } else {
            $this->data['address'] = '';
        }
        if (isset($posts['phone'])) {
            $this->data['phone'] = $posts['phone'];
        } else {
            $this->data['phone'] = '';
        }
        if (isset($posts['email'])) {
            $this->data['email'] = $posts['email'];
        } else {
            $this->data['email'] = '';
        }


        if (isset($posts['referring'])) {
            $this->data['referring'] = $posts['referring'];
        } else {
            $this->data['referring'] = '';
        }
        if (isset($posts['entry_amount'])) {
            $this->data['entry_amount'] = $posts['entry_amount'];
        } else {
            $this->data['entry_amount'] = '';
        }
        $this->data['main_content'] = 'register/register.php';

        $this->load->view('home', $this->data);
    }

    public function paypal_return_old() {
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
            redirect('register');
        $this->load->model('config_model', 'configs');
        $this->load->model('user_model', 'user');
        $this->load->model('balance_model', 'balance');
        $transaction_fees = $this->configs->getConfigs('transaction_fees');
        $paypal = $this->configs->getConfigs('paypal');

        $url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        $url_parsed = parse_url($url);
        $fp = fsockopen($url_parsed['host'], "80", $err_num, $err_str, 30);
        if (!$fp) {
            $error = array('error', 'darkred', 'Register errors', 'Connection to ' . $url_parsed['host'] . " failed.fsockopen error no. $errnum: $errstr");
            $this->session->set_flashdata(array('usermessage' => $error));
            redirect('register');
        } else {
            $posts = $this->input->post();
            if ($posts['mc_gross'] < $transaction_fees['open_fee']) {
                $error = array('error', 'darkred', 'Register errors', 'Transaction fees litter than open fees');
                $this->session->set_flashdata(array('usermessage' => $error));
                redirect('register');
            }

            $custom = $posts['custom'];
            $custom_list = explode('|', $custom);
            $postsData = array();
            foreach ($custom_list as $val) {
                $custom_post = explode('=', $val);
                $postsData[$custom_post[0]] = $custom_post[1];
            }
            if ($posts['business'] != $paypal['business']) {
                $error = array('error', 'darkred', 'Register errors', 'Transaction email error');
                $this->session->set_flashdata(array('usermessage' => $error));
                redirect('register');
            }

            if ($this->transaction->checkTransactionExists($posts['txn_id'])) {
                $data['usermessage'] = array('success', 'green', 'Thank you for registering!', '');
                $this->session->set_flashdata('usermessage', $data['usermessage']);
                redirect('home');
            }

            if ($posts['mc_gross'] > $transaction_fees['open_fee'])
                $postsData['usertype'] = 2;
//                $postsData['transaction_start'] = 2;
            else
                $postsData['usertype'] = 0;

            if (!empty($postsData['referring'])) {
                $userReferring = $this->user->getUserByReferral($postsData['referring']);
                if (!$userReferring) {
                    unset($postsData['referring']);
                }
            }

            $reffing_default_config = $this->configs->getConfigs('referraldefault');
            $postsData['username'] = 'U' . time();
            $postsData['password'] = hash_hmac('crc32b', $postsData['username'] . $this->config->item('prefix_key'), 'secret');
            $dataUserInsert = $postsData;
            if (empty($dataUserInsert['referring'])) {
                $dataUserInsert['referring'] = !empty($reffing_default_config['default_referral_user']) ? $reffing_default_config['default_referral_user'] : 0;
            }

            $user_id = $this->user->save($dataUserInsert);

            $open_fees = $transaction_fees['open_fee'];
            if ($posts['mc_gross'] > $open_fees) {
                $open_fees += $transaction_fees['transaction_fee'];
            }

            $dataTransaction['user_id'] = $user_id;
            $dataTransaction['fees'] = $open_fees;
            $dataTransaction['total'] = $posts['mc_gross'];
            $dataTransaction['transaction_id'] = $posts['txn_id'];
            $dataTransaction['payment_status'] = $posts['payment_status'];
            $dataTransaction['transaction_source'] = 'paypal';
            $dataTransaction['transaction_type'] = 'register';
            $this->transaction->insert($dataTransaction);

            $current_fees = $dataTransaction['total'] - $open_fees;
            $this->balance->updateBalanceByUserId($user_id, $current_fees);

            $adminBalance = $dataTransaction['total'];
            if ($posts['mc_gross'] > $open_fees) {
                $this->user->updateTransaction($user_id, $adminBalance);
            }

            $userHtml = '
                Thank you for registering <br>
                You just sign up at. Please login to check your account';
            $userHtml .= 'Acount Type: ' . $this->usertype[$postsData['usertype']] . '<br>';
            if ($posts['mc_gross'] > $open_fees) {
                $userHtml .= 'Payment :' . $posts['mc_gross'] - $open_fees . '<br>';
            }

            $userEmailData['user_type'] = $this->usertype[$postsData['usertype']];
            $userEmailData['entry_amount'] = $posts['mc_gross'];
            $userEmailData['username'] = $postsData['username'];
            $userEmailData['password'] = $postsData['password'];
            sendmailform($postsData['email'], 'register', $userEmailData, null, 'Admin Manager', 'html');

            $adminEmailData = array(
                'full_name' => $postsData['firstname'] . ' ' . $postsData['lastname'],
                'address' => $postsData['address'],
                'phone' => $postsData['phone'],
                'email' => $postsData['email'],
                'payment' => $posts['mc_gross'],
                'user_type' => $this->usertype[$postsData['usertype']],
            );

            sendmailform(null, 'new_member', $adminEmailData);

            if (empty($postsData['referring'])) {
                $postsData['referring'] = $reffing_default_config['default_referral_user'];
            }

            $adminBalance = $this->updateReffering($postsData, $posts['mc_gross']);

            $this->balance->updateAdminBalance($adminBalance);

            $data['usermessage'] = array('success', 'green', 'Thank you for registering!', '');
            $this->session->set_flashdata('usermessage', $data['usermessage']);
        }
        redirect('home');
    }

    public function paypal_return() {
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
            redirect('register');
        $this->load->model('user_model', 'user');
        $this->load->model('balance_model', 'balance');

//      BOF get data from paypal
        $url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        $url_parsed = parse_url($url);
        $fp = fsockopen($url_parsed['host'], "80", $err_num, $err_str, 30);
        if (!$fp) {
            $error = array('error', 'darkred', 'Register errors', 'Connection to ' . $url_parsed['host'] . " failed.fsockopen error no. $errnum: $errstr");
            $this->session->set_flashdata(array('usermessage' => $error));
            redirect('register');
        }

        $posts = $this->input->post();
        if ($posts['mc_gross'] < $this->config_data['open_fee']) {
            $error = array('error', 'darkred', 'Register errors', 'Transaction fees litter than open fees');
            $this->session->set_flashdata(array('usermessage' => $error));
            redirect('register');
        }

        $custom = $posts['custom'];
        $custom_list = explode('|', $custom);
        $postsData = array();
        foreach ($custom_list as $val) {
            $custom_post = explode('=', $val);
            $postsData[$custom_post[0]] = $custom_post[1];
        }

        if ($posts['business'] != $this->config_data['business']) {
            $error = array('error', 'darkred', 'Register errors', 'Transaction email error');
            $this->session->set_flashdata(array('usermessage' => $error));
            redirect('register');
        }
//      EOF get data from paypal
//      Duplicate transaction  
        if ($this->transaction->checkTransactionExists($posts['txn_id'])) {
            $data['usermessage'] = array('success', 'green', 'Thank you for registering!', '');
            $this->session->set_flashdata('usermessage', $data['usermessage']);
            redirect('home');
        }

//      BOF Create Main Account
        $password = hash_hmac('crc32b', time() . $this->config->item('prefix_key'), 'secret');
        $dataMainUser = array(
            'firstname' => $postsData['firstname'],
            'lastname' => $postsData['lastname'],
            'email' => $postsData['email'],
            'password' => md5($password),
            'phone' => $postsData['phone'],
            'address' => $postsData['address'],
        );
        $main_user_id = $this->user->createMainAcount($dataMainUser);
        $this->activity->addActivity($main_user_id, 'Registed');
//      EOF Create Main Account
//      Update Admin Balance
        $this->balance->updateAdminBalance($posts['mc_gross'], '+');

//      BOF Check/Create Gold Account
        $min_enrolment_entry_amount = $this->config_data['min_enrolment_entry_amount'] + $this->config_data['open_fee'] + $this->config_data['transaction_fee'];
        $open_fees = $this->config_data['open_fee'];
        $dataGoldAcount = array(
            'main_user_id' => $main_user_id,
            'acount_number' => 'G' . time(),
        );
        $gold_user_id = $this->user->createGoldAcount($dataGoldAcount);
        $this->activity->addActivity($main_user_id, 'Created gold account number ' . $dataGoldAcount['acount_number']);

        if (($posts['mc_gross'] >= $min_enrolment_entry_amount)) {
            $open_fees += $this->config_data['transaction_fee'];

//      Update Balance 
            $balance_user_amount = $posts['mc_gross'] - ($this->config_data['open_fee'] + $this->config_data['transaction_fee']);
            $dataBalanceUpdate = array(
                'user_id' => $gold_user_id,
                'balance' => $balance_user_amount,
            );
            $dataTransaction = $this->balance->updateBalance($dataBalanceUpdate);
            $this->activity->addActivity($main_user_id, 'Add Deposit to your acount ' . $dataGoldAcount['acount_number'] . ' with amount : $' . ($dataBalanceUpdate['balance']), '+', $posts['balance']);
//      Update Widthdraw date
            $this->user->updateWithdrawalDate($gold_user_id);
        }
//      EOF Check/Create Gold Account
//      BOF Update Transaction
        $dataTransactionUpdate = array(
            'user_id' => !empty($gold_user_id) ? $gold_user_id : NULL,
            'main_user_id' => $main_user_id,
            'fees' => $open_fees,
            'total' => $posts['mc_gross'],
            'transaction_id' => $posts['txn_id'],
            'payment_status' => $posts['payment_status'],
            'transaction_type' => 'register',
            'transaction_text' => '+',
            'transaction_source' => 'paypal',
            'status' => '1',
        );
        $this->transaction->upadateTransaction($dataTransactionUpdate);

//      EOF Update Transaction
//      BOF Check Reffering Member
        if ($postsData['referring']) {
            $mainUser = $this->user->getMainUserByEmail($postsData['referring']);
        }
        if (!empty($mainUser)) {
            $userSilverReffering = $this->user->getUserByEmail($postsData['referring'], 1);
            if (empty($userSilverReffering)) {
                $dataSilverAcount = array(
                    'main_user_id' => $mainUser->main_id,
                    'acount_number' => 'S' . time(),
                );
                $rsilver_user_id = $this->user->createSilverAcount($dataSilverAcount);
                $userSilverReffering = $this->user->getMainUserById($rsilver_user_id);
                $this->activity->addActivity($mainUser->main_id, 'Created silver account number ' . $userSilverReffering->acount_number);
            }
            $this->user->updateMainAcount($main_user_id, array('referring' => $mainUser->main_id));
        } else {
            $referringUserConfig = $this->config_data['default_referral_user'];
            $mainUser = $this->user->getMainUserByEmail($referringUserConfig);
            if (!empty($mainUser)) {
                $userSilverReffering = $this->user->getUserByEmail($this->config_data['default_referral_user'], 1);
                if (empty($userSilverReffering)) {
                    $dataSilverAcount = array(
                        'main_user_id' => $mainUser->main_id,
                        'acount_number' => 'S' . time(),
                    );
                    $rsilver_user_id = $this->user->createSilverAcount($dataSilverAcount);
                    $userSilverReffering = $this->user->getMainUserById($rsilver_user_id);
                    $this->activity->addActivity($mainUser->main_id, 'Created silver account number ' . $userSilverReffering->acount_number);
                }
                $this->user->updateMainAcount($main_user_id, array('referring' => $mainUser->main_id));
            }
        }


        if (!empty($userSilverReffering)) {

//      BOF Update Balance
            $this->balance->updateAdminBalance($this->config_data['referral_fees'], '-');

            $dataBalanceSilverReferralUpdate = array(
                'user_id' => $userSilverReffering->user_id,
                'balance' => $this->config_data['referral_fees'],
            );
            $dataTransaction = $this->balance->updateBalance($dataBalanceSilverReferralUpdate);
            $this->activity->addActivity($userSilverReffering->main_id, 'Add refere fees your acount ' . $userSilverReffering->acount_number . ' with amount : $' . ($this->config_data['referral_fees']), '+', $this->config_data['referral_fees']);
//      EOF Update Balance
//      BOF Update Transaction
            $dataTransactionUpdate = array(
                'user_id' => $userSilverReffering->user_id,
                'main_user_id' => $userSilverReffering->main_id,
                'fees' => 0,
                'total' => $this->config_data['referral_fees'],
                'payment_status' => 'Completed',
                'transaction_type' => 'refere',
                'transaction_text' => '+',
                'transaction_source' => 'system',
                'status' => '0',
            );
            $this->transaction->upadateTransaction($dataTransactionUpdate);

//      Update Widthdraw date
            if (empty($userSilverReffering->withdrawal_date)) {
                $this->user->updateWithdrawalDate($userSilverReffering->user_id);
            }

//      EOF Update Transaction
        }

        if (!empty($gold_user_id) && !empty($mainUser)) {
            $userGoldReffering = $this->user->getUserByEmail($postsData['referring'], 2);
            if (!empty($userGoldReffering)) {

                //              get banlane gold account
                $balanceGoldAcount = $this->balance->getBalance($userGoldReffering->user_id);
                if (!empty($balanceGoldAcount->balance) && $balanceGoldAcount->balance > 0 && ($posts['entry_amount'] >= $this->config_data['min_enrolment_entry_amount'])) {
                    $refereFees = $dataBalanceUpdate['balance'] * $this->config_data['percentage_gold'] / 100;
                    //      BOF Update Balance
                    $this->balance->updateAdminBalance($refereFees, '-');

                    $dataBalanceGoldRefferingUpdate = array(
                        'user_id' => $userGoldReffering->user_id,
                        'balance' => $refereFees,
                    );
                    $this->balance->updateBalance($dataBalanceGoldRefferingUpdate);
                    $this->activity->addActivity($userGoldReffering->main_id, 'Add refere fees your acount ' . $userGoldReffering->acount_number . ' with amount : $' . ($refereFees), '+', $refereFees);
                    //      EOF Update Balance
                    //      BOF Update Transaction
                    $dataTransactionUpdate = array(
                        'user_id' => $userGoldReffering->user_id,
                        'main_user_id' => $userGoldReffering->main_id,
                        'fees' => 0,
                        'total' => $refereFees,
                        'payment_status' => 'Completed',
                        'transaction_type' => 'refere',
                        'transaction_text' => '+',
                        'transaction_source' => 'system',
                        'status' => '0',
                    );
                    $this->transaction->upadateTransaction($dataTransactionUpdate);

                    //      EOF Update Transaction
                }
            }
        }


//      EOF Check Reffering Member
//      BOF Send Mail

        $userEmailData['entry_amount'] = !empty($balance_user_amount) ? $balance_user_amount : 0;
        $userEmailData['fees'] = $open_fees;
        $userEmailData['password'] = $password;
        $userEmailData['email'] = $postsData['email'];
        sendmailform($postsData['email'], 'register', $userEmailData, null, 'Admin Manager', 'html');


        $adminEmailData = array(
            'fullname' => $postsData['firstname'] . ' ' . $postsData['lastname'],
            'address' => $postsData['address'],
            'phone' => $postsData['phone'],
            'email' => $postsData['email'],
            'payment' => $posts['mc_gross'],
        );

        sendmailform(null, 'admin_register', $adminEmailData);

        if (!empty($userReffering)) {
            $referringEmailData = array(
                'fullname' => $postsData['firstname'] . ' ' . $postsData['lastname'],
                'email' => $postsData['email']
            );
            sendmailform($userReffering->email, 'referring', $referringEmailData);
        }
//      EOF Send Mail
        $data['usermessage'] = array('success', 'green', 'Thank you for registering!', '');
        $this->session->set_flashdata('usermessage', $data['usermessage']);
        redirect('home');
    }

    public function creditcard() {
        $posts = $this->input->post();

        $this->load->model('user_model', 'user');
        $this->load->model('balance_model', 'balance');


        if (!$posts) {
            redirect(site_url('register'));
        }


//      BOF  Transaction
        $open_fees = $this->config_data['open_fee'];
        if ($posts['entry_amount'] > 0) {
            $open_fees += $this->config_data['transaction_fee'];
        }

        $money = $open_fees + $posts['entry_amount'];

        $dataTransactionFees = array(
            'card_num' => $posts['card_num'],
            'cc_owner' => $posts['cc_owner'],
            'exp_date' => $posts['exp_date'],
            'amount' => $money,
            'cc_cvv2' => $posts['cc_cvv2'],
        );

        $this->load->helper('authorize');
        $payment_status = payment_creditcard_authorize($dataTransactionFees);

        if ($payment_status['message'] == 'error') {
            $error = array('error', 'darkred', 'Register errors', $payment_status['error']);
            $this->session->set_flashdata(array('usermessage' => $error));
            redirect(site_url('register'));
        }

//      Duplicate transaction  
        if ($this->transaction->checkTransactionExists($payment_status['transaction_id'])) {
            $data['usermessage'] = array('success', 'green', 'Thank you for registering!', '');
            $this->session->set_flashdata('usermessage', $data['usermessage']);
            redirect('home');
        }
//      EOF Transaction
//      BOF Create Main Account
        $password = hash_hmac('crc32b', time() . $this->config->item('prefix_key'), 'secret');
        $dataMainUser = array(
            'firstname' => $posts['firstname'],
            'lastname' => $posts['lastname'],
            'email' => $posts['email'],
            'password' => md5($password),
            'phone' => $posts['phone'],
            'address' => $posts['address'],
        );
        $main_user_id = $this->user->createMainAcount($dataMainUser);
        $this->activity->addActivity($main_user_id, 'Registed');
//      EOF Create Main Account
//      Update Admin Balance
        $this->balance->updateAdminBalance($money, '+');

//      BOF Check/Create Gold Account
        $dataGoldAcount = array(
            'main_user_id' => $main_user_id,
            'acount_number' => 'G' . time(),
        );
        $gold_user_id = $this->user->createGoldAcount($dataGoldAcount);
        $this->activity->addActivity($main_user_id, 'Created gold account number ' . $dataGoldAcount['acount_number']);

        if (($posts['entry_amount'] >= $this->config_data['min_enrolment_entry_amount'])) {

//      Update Balance 
            $dataBalanceUpdate = array(
                'user_id' => $gold_user_id,
                'balance' => $posts['entry_amount'],
            );
            $dataTransaction = $this->balance->updateBalance($dataBalanceUpdate);
            $this->activity->addActivity($main_user_id, 'Add Deposit to your acount ' . $dataGoldAcount['acount_number'] . ' with amount : $' . ($posts['entry_amount']), '+', $posts['entry_amount']);
        }
//      EOF Check/Create Gold Account
//      BOF Update Transaction
        $dataTransactionUpdate = array(
            'user_id' => !empty($gold_user_id) ? $gold_user_id : NULL,
            'main_user_id' => $main_user_id,
            'fees' => $open_fees,
            'total' => $money,
            'transaction_id' => $payment_status['transaction_id'],
            'payment_status' => 'Completed',
            'transaction_type' => 'register',
            'transaction_text' => '+',
            'transaction_source' => 'creditcard',
            'status' => '1',
        );
        $this->transaction->upadateTransaction($dataTransactionUpdate);
//      Update Widthdraw date
        $this->user->updateWithdrawalDate($gold_user_id);
//      EOF Update Transaction
//      BOF Check Reffering Member
        $postsData = $posts;
        if ($postsData['referring']) {
            $mainUser = $this->user->getMainUserByEmail($postsData['referring']);
        }
        if (!empty($mainUser)) {
            $userSilverReffering = $this->user->getUserByEmail($postsData['referring'], 1);
            if (empty($userSilverReffering)) {
                $dataSilverAcount = array(
                    'main_user_id' => $mainUser->main_id,
                    'acount_number' => 'S' . time(),
                );
                $rsilver_user_id = $this->user->createSilverAcount($dataSilverAcount);
                $userSilverReffering = $this->user->getMainUserById($rsilver_user_id);
                $this->activity->addActivity($mainUser->main_id, 'Created silver account number ' . $userSilverReffering->acount_number);
            }
            $this->user->updateMainAcount($main_user_id, array('referring' => $mainUser->main_id));
        } else {
            $referringUserConfig = $this->config_data['default_referral_user'];
            $mainUser = $this->user->getMainUserByEmail($referringUserConfig);
            if (!empty($mainUser)) {
                $userSilverReffering = $this->user->getUserByEmail($this->config_data['default_referral_user'], 1);
                if (empty($userSilverReffering)) {
                    $dataSilverAcount = array(
                        'main_user_id' => $mainUser->main_id,
                        'acount_number' => 'S' . time(),
                    );
                    $rsilver_user_id = $this->user->createSilverAcount($dataSilverAcount);
                    $userSilverReffering = $this->user->getMainUserById($rsilver_user_id);
                    $this->activity->addActivity($mainUser->main_id, 'Created silver account number ' . $userSilverReffering->acount_number);
                }
                $this->user->updateMainAcount($main_user_id, array('referring' => $mainUser->main_id));
            }
        }


        if (!empty($userSilverReffering)) {

//      BOF Update Balance
            $this->balance->updateAdminBalance($this->config_data['referral_fees'], '-');

            $dataBalanceSilverReferralUpdate = array(
                'user_id' => $userSilverReffering->user_id,
                'balance' => $this->config_data['referral_fees'],
            );
            $dataTransaction = $this->balance->updateBalance($dataBalanceSilverReferralUpdate);
            $this->activity->addActivity($userSilverReffering->main_id, 'Add refere fees your acount ' . $userSilverReffering->acount_number . ' with amount : $' . ($this->config_data['referral_fees']), '+', $this->config_data['referral_fees']);
//      EOF Update Balance
//      BOF Update Transaction
            $dataTransactionUpdate = array(
                'user_id' => $userSilverReffering->user_id,
                'main_user_id' => $userSilverReffering->main_id,
                'fees' => 0,
                'total' => $this->config_data['referral_fees'],
                'payment_status' => 'Completed',
                'transaction_type' => 'refere',
                'transaction_text' => '+',
                'transaction_source' => 'system',
                'status' => '0',
            );
            $this->transaction->upadateTransaction($dataTransactionUpdate);

            //      Update Widthdraw date
            if (empty($userSilverReffering->withdrawal_date)) {
                $this->user->updateWithdrawalDate($userSilverReffering->user_id);
            }

//      EOF Update Transaction
        }

        if (!empty($gold_user_id) && !empty($mainUser)) {
            $userGoldReffering = $this->user->getUserByEmail($postsData['referring'], 2);
            if (!empty($userGoldReffering)) {

//              get banlane gold account
                $balanceGoldAcount = $this->balance->getBalance($userGoldReffering->user_id);
                if (!empty($balanceGoldAcount->balance) && $balanceGoldAcount->balance > 0 && ($posts['entry_amount'] >= $this->config_data['min_enrolment_entry_amount'])) {
                    $refereFees = $dataBalanceUpdate['balance'] * $this->config_data['percentage_gold'] / 100;
                    //      BOF Update Balance
                    $this->balance->updateAdminBalance($refereFees, '-');

                    $dataBalanceGoldRefferingUpdate = array(
                        'user_id' => $userGoldReffering->user_id,
                        'balance' => $refereFees,
                    );
                    $this->balance->updateBalance($dataBalanceGoldRefferingUpdate);
                    $this->activity->addActivity($userGoldReffering->main_id, 'Add refere fees your acount ' . $userGoldReffering->acount_number . ' with amount : $' . ($refereFees), '+', $refereFees);
                    //      EOF Update Balance
                    //      BOF Update Transaction
                    $dataTransactionUpdate = array(
                        'user_id' => $userGoldReffering->user_id,
                        'main_user_id' => $userGoldReffering->main_id,
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
                //      EOF Update Transaction
            }
        }


//      EOF Check Reffering Member
//      BOF Send Mail

        $userEmailData['entry_amount'] = !empty($posts['entry_amount']) ? $posts['entry_amount'] : 0;
        $userEmailData['fees'] = $open_fees;
        $userEmailData['password'] = $password;
        $userEmailData['email'] = $postsData['email'];
        sendmailform($postsData['email'], 'register', $userEmailData, null, 'Admin Manager', 'html');


        $adminEmailData = array(
            'fullname' => $posts['firstname'] . ' ' . $posts['lastname'],
            'address' => $postsData['address'],
            'phone' => $postsData['phone'],
            'email' => $postsData['email'],
            'payment' => $money,
        );

        sendmailform(null, 'admin_register', $adminEmailData);

        if (!empty($userReffering)) {
            $referringEmailData = array(
                'fullname' => $postsData['firstname'] . ' ' . $postsData['lastname'],
                'email' => $postsData['email']
            );
            sendmailform($userReffering->email, 'referring', $referringEmailData);
        }
//      EOF Send Mail
        $data['usermessage'] = array('success', 'green', 'Thank you for registering!', '');
        $this->session->set_flashdata('usermessage', $data['usermessage']);
        redirect('home');
    }

    public function cancel_return() {
        $error = array('error', 'darkred', 'Transaction is cancel', '');
        $this->session->set_flashdata(array('usermessage' => $error));
        redirect('register');
    }

    public function forgot() {

        $this->load->model('user_model', 'user');

        $this->data['title'] = 'Forgot password';
        $step = 0 + $this->input->post('step', TRUE);
        if ($step <= 1) {
            $this->form_validation->set_rules('email', 'E-mail', 'required|xss_clean|valid_email|max_length[64]|callback_check_email');
            $this->form_validation->set_message('valid_email', 'The %s field must contain a valid email address.');
            $this->form_validation->set_rules('recaptcha_response_field', 'Captcha', 'required|callback_check_captcha');
            $this->data['recaptcha'] = $this->recaptcha->get_html();
            if ($this->form_validation->run() == FALSE) {
                $this->data['main_content'] = 'register/reset_pass_step1.php';
                $this->load->view('home', $this->data);
            } else {
                $email_to = $this->input->post('email', TRUE);
                $user_email = $this->user->getEmmail($email_to);
                $this->data['email'] = $email_to;
                $id = $user_email->main_id;
                $this->data['forget_code'] = random_string('numeric', 10);
                $this->session->set_flashdata('step', 2);
                $this->data['main_content'] = 'register/reset_pass_step2.php';
                $this->user->updateMainAcount($id, array('forgotten_password_code' => $this->data['forget_code']));
                //======================= Send Email ====================================
                $contentEmail['forget_code'] = $this->data['forget_code'];
                sendmailform($email_to, 'forgot_password', $contentEmail, 'admin@website.com', 'Admin Manager', 'html');
                $this->load->view('home', $this->data);
                //==========================End send mail====================
            }
        } else if ($step == 2) {

            $email = $this->input->post('email', TRUE);
            $this->email = $email;
            $user_email = $this->user->getEmmail($email);
            $id = $user_email->main_id;
            $fp = $user_email->forgotten_password_code;
            if ($this->input->post('email')) {
                $this->data['email'] = $this->input->post('email');
            } else {
                $this->data['email'] = "";
            }

            $this->form_validation->set_rules('reset_code', 'Reset Code', 'required|trim|xss_clean|numeric|exact_length[10]|callback_checkResetcode');
            if (($this->email != $this->input->post('email')) || ($fp != $this->input->post('reset_code'))) {
                $this->data['main_content'] = 'register/reset_pass_step2.php';
                $this->load->view('home', $this->data);
            } else {
                $this->data['main_content'] = 'register/reset_pass_step3.php';
                $this->load->view('home', $this->data);
            }
        } else if ($step == 3) {

            $this->data['email'] = $this->input->post('email', TRUE);
            $this->email = $this->data['email'];
            $email_user = $this->user->getEmmail($this->data['email']);
            $id = $email_user->main_id;
            $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|min_length[6]');
            $this->form_validation->set_rules('repassword', 'Second Password', 'required|trim|matches[password]');
            if ($this->form_validation->run() == FALSE) {
                $this->data['main_content'] = 'register/reset_pass_step3.php';
                $this->load->view('home', $this->data);
            } else {
                $new_pass = $this->input->post('password', TRUE);

                $password = md5($new_pass);
                $update_data = array('password' => $password);
                $this->user->updateMainAcount($id, $update_data);
                redirect('authentication/');
            }
        }
        else
            redirect('register/index/', 'refresh');
    }

    public function checkEmail() {
        $email = $this->input->get('email');
        if ($this->register_model->checkEmail($email)) {
            echo 'false';
            exit();
        } else {
            echo 'true';
            exit();
        }
    }

    public function check_email($email) {
        if (!$this->register_model->checkEmail($email)) {
            $this->form_validation->set_message('check_email', 'This e-mail is Not registered in our system. Please use a different one.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function checkResetcode($code) {
        if (!$this->register_model->check_reset($this->email, $code)) {
            $this->form_validation->set_message('check_resetcode', "The reset code doesn't match one sent to you. Please check your information and try again.");
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function validateForm() {
        $this->form_validation->set_rules('fullname', 'Full Name', 'required|trim|xss_clean|max_length[150]');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|max_length[50]|valid_repassword');
        $this->form_validation->set_rules('repassword', 'Re-Password', 'required|trim|xss_clean|matches[password]');
        $this->form_validation->set_rules('address', 'Address', 'required|trim|xss_clean|max_length[150]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim|xss_clean|numeric|max_length[12]');
        $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email|max_length[64]|callback_checkEmail');
        $this->form_validation->set_rules('fax', 'Fax', 'required|trim|xss_clean|numeric|max_length[12]');
        $this->form_validation->set_rules('birthday', 'Birthday', 'required|trim|xss_clean|max_length[15]|callback_valid_date');
        if ($this->form_validation->run() == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function valid_date($date) {
        $ddmmyyy = '/^(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)[0-9]{2}$/';
        if (preg_match($ddmmyyy, $date)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('valid_date', 'Please enter mm-dd-yyyy');
            return FALSE;
        }
    }

    public function ajax_search() {
        $this->load->model('user_model', 'user');
        $user = $_GET['term'];
        $data = $this->user->searchUser($user);

        $results = array();
        foreach ($data as $sub) {
            $results[$sub->email] = $sub->email;
        }
        echo json_encode($results);
    }

}