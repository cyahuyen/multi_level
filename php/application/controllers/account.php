<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Account extends MY_Controller {

    var $menu_config_user_home = array('active', '', '', '', '', '');
    var $menu_config_user_user = array('', 'active', '', '', '', '');
    var $menu_config_user_jobs = array('', '', 'active', '', '', '');
    var $menu_config_user_staff = array('', '', '', 'active', '', '');
    var $menu_config_user_timesheets = array('', '', '', '', 'active', '');
    var $menu_config_user_reports = array('', '', '', '', '', 'active');
    var $menu_config_admin_none = array('', '', '');
    var $menu_config_admin_home = array('active', '', '');
    var $menu_config_admin_users = array('', 'active', '');
    var $menu_config_admin_reports = array('', '', 'active');

    function __construct() {

        parent::__construct();

        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->library('recaptcha');
        $this->lang->load('recaptcha');
        $this->load->model('user_model', '', TRUE);
        $this->data['menu_config'] = $this->menu_config_user_home;


        if (!$this->session->userdata('user')) {
            redirect('authentication', 'refresh');
        }
        $this->data['user_session'] = $this->session->userdata('user');
        $this->data['menu_config'] = $this->menu_config_2;
        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }

        $user_session = $this->session->userdata('user');
        if (!empty($user_session) && $user_session['permission'] == 'administrator') {
            redirect(site_url('admin'));
        }
    }

    public function index() {
        $this->data['title'] = 'My Profile';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => site_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'My Account',
            'href' => site_url('account/index'),
            'separator' => ' :: '
        );
        $user_session = $this->session->userdata('user');
        $id = $user_session['user_id'];
        $infors = $this->user_model->getAccount($id);
        $this->data['inforcheck'] = $infors;
        $this->data['amout'] = $this->user_model->getBalance($id);
        if ($infors) {
            if ($infors->usertype == 2) {
                $this->data['usertype'] = "Gold";
            } elseif ($infors->usertype == 1) {
                $this->data['usertype'] = "Silver";
            } else {
                $this->data['usertype'] = "Member";
            }
            $this->data['transaction_start'] = $infors->transaction_start;
            $this->data['transaction_finish'] = $infors->transaction_finish;
        }
        $this->data['main_content'] = 'account/index';
        $this->load->view('home', $this->data);
    }

    public function edit() {
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => site_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'My Account',
            'href' => site_url('account/index'),
            'separator' => ' :: '
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Edit Account',
            'href' => site_url('account/edit'),
            'separator' => ' :: '
        );
        $this->data['title'] = 'Edit Account';
        $user_session = $this->session->userdata('user');
        $id = $user_session['user_id'];
        $this->data['userdata'] = $this->user_model->getAccount($id);
        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        $this->data['posts'] = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = $this->input->post();
            $validationErrors = array();

            if ($posts['firstname'] == '') {
                $validationErrors['firstname'] = "Your name is FirstName cannot be blank";
            }
            if ($posts['lastname'] == '') {
                $validationErrors['firstname'] = "Your name is Lastnamr cannot be blank";
            }
            if ($posts['email'] == '') {
                $validationErrors['email'] = "Email cannot be blank";
            } elseif ($this->user_model->checkEmailExists($posts['email'], $id) == true) {
                $validationErrors['email'] = "Email is exists";
            }

            $this->data['posts'] = $posts;
            foreach ($posts as $key => $val) {
                $this->data['userdata']->$key = $val;
            }
            if (count($validationErrors) != 0) {
                $this->data['usermessage'] = array('error', 'darkred', 'Validation errors found', 'Please see below');
                $this->data['fielderrors'] = $validationErrors;
            } else {
                unset($posts['save-btn']);
                $data = array(
                    'firstname' => $posts['firstname'],
                    'lastname' => $posts['lastname'],
                    'phone' => $posts['phone'],
                    'email' => $posts['email'],
                );
                if ($this->user_model->update($id, $data))
                    $this->data['usermessage'] = array('success', 'green', 'Successfully saved', '');
                else
                    $this->data['usermessage'] = array('error', 'darkred', 'Error saved', '');
                $this->session->set_flashdata(array('usermessage' => $this->data['usermessage']));
                redirect(site_url('account/edit/'));
            }
        }
        $this->data['main_content'] = 'account/edit';
        $this->load->view('home', $this->data);
    }

    function changepassword() {
        $this->data['title'] = 'Change Password';

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => site_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'My Account',
            'href' => site_url('account/index'),
            'separator' => ' :: '
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Change Password',
            'href' => site_url('account/changepassword'),
            'separator' => ' :: '
        );
        $user_session = $this->session->userdata('user');
        $id = $user_session['user_id'];


        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        $this->data['posts'] = array();
        $posts = $this->input->post();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validationErrors = array();
            if (!empty($id) && empty($posts['password'])) {
                if (strlen($posts['password']) < 6) {
                    $validationErrors['password'] = "Password must greater than 6 characters";
                }

                if ($posts['password'] != $posts['repassword']) {
                    $validationErrors['repassword'] = "Password wrong";
                }
            }
            if (empty($id)) {
                if (strlen($posts['password']) < 6) {
                    $validationErrors['password'] = "Password must greater than 6 characters";
                } elseif ($posts['password'] != $posts['repassword']) {
                    $validationErrors['repassword'] = "Password wrong";
                }
            }

            $this->data['posts'] = $posts;
            foreach ($posts as $key => $val) {
                $this->data['userdata']->$key = $val;
            }
            if (count($validationErrors) != 0) {
                $this->data['usermessage'] = array('error', 'darkred', 'Validation errors found', 'Please see below');
                $this->data['fielderrors'] = $validationErrors;
            } else {
                unset($posts['save-btn']);
                unset($posts['repassword']);
                $data = array('password' => md5($posts['password']));
                if ($this->user_model->updatePassword($id, $data))
                    $this->data['usermessage'] = array('success', 'green', 'Successfully saved', '');
                else
                    $this->data['usermessage'] = array('error', 'darkred', 'Error saved', '');
                $this->session->set_flashdata(array('usermessage' => $this->data['usermessage']));
            }
        }
        $this->data['main_content'] = 'account/changepass';
        $this->load->view('home', $this->data);
    }

    function refered() {
        $this->data['title'] = 'Referred Members';

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => site_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'My Account',
            'href' => site_url('account/index'),
            'separator' => ' :: '
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Referred Members',
            'href' => site_url('account/refered'),
            'separator' => ' :: '
        );

        $user_session = $this->session->userdata('user');
        $id = $user_session['user_id'];
        $limit = $this->config->item('limit_page', 'my_config');
        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //       Begin pagination
        $this->load->library("pagination");
        $config = array();
        $user = $this->user_model->getUserById($id);
        $config["total_rows"] = $this->user_model->totalRefered($user->username);
        $config["base_url"] = site_url('account/refered');
        $config["per_page"] = $limit;
        $page = $start;
        $config["uri_segment"] = 3;
        $config['num_links'] = 2;

        $config['first_link'] = "<img src=" . base_url() . "/img/datalist/nav_first.jpg />";
        $config['first_tag_open'] = '<div class="nav-button">';
        $config['first_tag_close'] = '</div>';
        $config['last_link'] = "<img src=" . base_url() . "/img/datalist/nav_last.jpg />";
        $config['last_tag_open'] = '<div class="nav-button">';
        $config['last_tag_close'] = '</div>';
        $config['cur_tag_open'] = "<div class='nav-button'><div class='nav-page nav-page-selected'>";
        $config['cur_tag_close'] = '</div></div>';
        $config['num_tag_open'] = "<div class='nav-button'><div class='nav-page'>";
        $config['num_tag_close'] = '</div></div>';
        $config['prev_tag_open'] = "<div class='nav-button'>";
        $config['prev_link'] = "<img src=" . base_url() . "/img/datalist/nav_prev.jpg />";
        $config['prev_tag_close'] = '</div>';
        $config['next_link'] = "<img src=" . base_url() . "/img/datalist/nav_next.jpg />";
        $config['next_tag_open'] = "<div class='nav-button'>";
        $config['next_tag_close'] = '</div>';
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
        //       End pagination
        $this->data['refereds'] = $this->user_model->getRefereds($user->username, $limit, $start);
        $this->data['main_content'] = 'account/refered';
        $this->load->view('home', $this->data);
    }

    function history() {
        $posts = $this->input->post();
        $this->data['title'] = 'History';
        $this->data['breadcrumbs'] = array();
        $this->data['menu_config'] = $this->menu_config_3;
        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => site_url('account'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => 'History',
            'href' => site_url('account/history'),
            'separator' => ' :: '
        );
        $user_session = $this->session->userdata('user');
        $id = $user_session['user_id'];

        $limit = $this->config->item('limit_page', 'my_config');
        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //       Begin pagination
        $this->load->library("pagination");
        $config = array();
        $config["total_rows"] = $this->user_model->totalHistory($id);
        $config["base_url"] = site_url('account/history');
        $config["per_page"] = $limit;
        $page = $start;
        $config["uri_segment"] = 3;
        $config['num_links'] = 2;

        $config['first_link'] = "<img src=" . base_url() . "/img/datalist/nav_first.jpg />";
        $config['first_tag_open'] = '<div class="nav-button">';
        $config['first_tag_close'] = '</div>';
        $config['last_link'] = "<img src=" . base_url() . "/img/datalist/nav_last.jpg />";
        $config['last_tag_open'] = '<div class="nav-button">';
        $config['last_tag_close'] = '</div>';
        $config['cur_tag_open'] = "<div class='nav-button'><div class='nav-page nav-page-selected'>";
        $config['cur_tag_close'] = '</div></div>';
        $config['num_tag_open'] = "<div class='nav-button'><div class='nav-page'>";
        $config['num_tag_close'] = '</div></div>';
        $config['prev_tag_open'] = "<div class='nav-button'>";
        $config['prev_link'] = "<img src=" . base_url() . "/img/datalist/nav_prev.jpg />";
        $config['prev_tag_close'] = '</div>';
        $config['next_link'] = "<img src=" . base_url() . "/img/datalist/nav_next.jpg />";
        $config['next_tag_open'] = "<div class='nav-button'>";
        $config['next_tag_close'] = '</div>';
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
        //       End pagination
        $this->data['historys'] = $this->user_model->getHistorys($id, $limit, $start);
        $this->data['main_content'] = 'account/history';
        $this->load->view('home', $this->data);
    }

    public function checkPassword($password) {
        if (!$this->user_model->checkPassword($password)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function isEmail($email) {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
    }

    public function checkEmail($email) {
        if ($this->user_model->checkEmail($email)) {
            return FALSE;
        } else {
            return TRUE;
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

    public function transaction() {
        $this->data['title'] = 'Deposite Amount';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => site_url('account'),
            'separator' => false
        );
        $this->data['menu_config'] = $this->menu_config_4;
        $this->data['breadcrumbs'][] = array(
            'text' => 'Deposite Amount',
            'href' => site_url('account/transaction'),
            'separator' => ' :: '
        );
        $user_session = $this->session->userdata('user');
        $id = $user_session['user_id'];
        $this->load->model('user_model', 'user');
        $this->load->model('transaction_model', 'transaction');
        $this->load->model('config_model', 'configs');
        $user = $this->user->getUserById($id);
        $this->data['user'] = $user;
        $transaction_config = $this->configs->getConfigs('transaction_fees');
        $this->data['transaction_fees'] = $transaction_config;

        $dataConfig['return'] = site_url('account/paypal_return');
        $dataConfig['cancel_return'] = site_url('account/cancel_return');
        $dataConfig['notify_url'] = site_url('home');
        $dataConfig['title'] = 'Deposite';

        $payments = $this->configs->listActivepayment();
        $startdate = date('Y-m-d h:i:s', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'));
        $enddate = date('Y-m-d h:i:s', strtotime('-1 second', strtotime('+1 month', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'))));
        //get transaction
        $transactions = $this->transaction->getTransactionNotExpiration($id, $startdate, $enddate);

        $max_entry_amount = $transaction_config['max_enrolment_entry_amount'];
        $totalTransaction = 0;
        if (!empty($transactions)) {
            foreach ($transactions as $transaction) {
                $totalTransaction += $transaction->total - $transaction->fees;
            }
        }
        $this->data['max_entry_amount'] = $max_entry_amount - $totalTransaction;
        $this->data['total_transaction'] = $totalTransaction;

        $payments = $this->configs->listActivepayment();
        $data['payments'] = array();
        foreach ($payments as $code => $config) {
            $dataConfig['config'] = $config;
            $this->data['config'][$code] = $config;
            $this->data['payments'][$code] = $this->load->view('payment/' . $code, $dataConfig, true);
        }

        $this->data['refereds'] = $this->user_model->getRefereds($id);
        $this->data['main_content'] = 'account/transaction';
        $this->load->view('home', $this->data);
    }

    public function paypal_return() {
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
            redirect('account/transaction');

        $user_session = $this->session->userdata('user');

        $id = $user_session['user_id'];
        $this->load->model('user_model', 'user');
        $this->load->model('transaction_model', 'transaction');
        $this->load->model('config_model', 'configs');
        $this->load->model('balance_model', 'balance');
        $user = $this->user->getUserById($id);
        $transaction_config = $this->configs->getConfigs('transaction_fees');
        $this->data['transaction_fees'] = $transaction_config;

        $this->load->model('config_model', 'configs');
        $transaction_fees = $this->configs->getConfigs('transaction_fees');
        $paypal = $this->configs->getConfigs('paypal');

        $payments = $this->configs->listActivepayment();

        $startdate = date('Y-m-d h:i:s', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'));
        $enddate = date('Y-m-d h:i:s', strtotime('-1 second', strtotime('+1 month', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'))));
        //get transaction
        $transactions = $this->transaction->getTransactionNotExpiration($id, $startdate, $enddate);

        $max_entry_amount = $transaction_config['max_enrolment_entry_amount'];
        $totalTransaction = 0;
        if (!empty($transactions)) {
            foreach ($transactions as $transaction) {
                $totalTransaction += $transaction->total - $transaction->fees;
            }
        }
        $this->data['max_entry_amount'] = $max_entry_amount - $totalTransaction;

        $url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        $url_parsed = parse_url($url);
        $fp = fsockopen($url_parsed['host'], "80", $err_num, $err_str, 30);
        if (!$fp) {
            $error = array('error', 'darkred', 'Register errors', 'Connection to ' . $url_parsed['host'] . " failed.fsockopen error no. $errnum: $errstr");
            $this->session->set_flashdata(array('usermessage' => $error));
            redirect('register');
        } else {
            $posts = $this->input->post();
            $dataTransaction['user_id'] = $id;
            $dataTransaction['fees'] = $transaction_fees['transaction_fee'];
            $dataTransaction['total'] = $posts['mc_gross'];
            $dataTransaction['transaction_id'] = $posts['txn_id'];
            $dataTransaction['payment_status'] = $posts['payment_status'];
            $dataTransaction['transaction_source'] = 'paypal';
            $dataTransaction['transaction_type'] = 'deposit';
            if ($this->transaction->checkTransactionExists($posts['txn_id'])) {
                $data['usermessage'] = array('success', 'green', 'Deposite Success', '');
                $this->session->set_flashdata('usermessage', $data['usermessage']);
                redirect('account/transaction');
            }

            $current_fees = $posts['mc_gross'] - $transaction_fees['transaction_fee'];

            $totalInMonth = $current_fees + $totalTransaction;

            $this->transaction->insert($dataTransaction);
            $balance_amount = !empty($balance_user) ? $balance_user->balance : 0;
            $balance_amount = $balance_amount + $current_fees;
            $this->balance->updateBalanceByUserId($id, $balance_amount);

            $this->user->updateTransaction($id, $current_fees);

            $referral_config = $this->configs->getConfigs('referral');
            //referral fee
            $referring = 0;
            $user_refferral = $this->user->getUserByReferral($user->referring);

            if ($user_refferral) {
                if ($user_refferral->usertype == 2 && $current_fees >= 100) {
                    $referring = $referral_config['percentage_gold'] * $current_fees / 100;
                    $this->transaction->updateRefereFees($user->referring, $referring);
                    $this->balance->updateBalance($user->referring, $referring);

                    $referringEmaildata['fullname'] = $user_refferral->firstname . ' ' . $user_refferral->lastname;
                    $referringEmaildata['user_fullname'] = $user->firstname . ' ' . $user->lastname;
                    $referringEmaildata['amount'] = $referring;
                    sendmailform($user_refferral->email, 'referring_deposit', $referringEmaildata);
                }
            }

            $admin_amount = $posts['mc_gross'] - $referring;
            $this->balance->updateAdminBalance($admin_amount);


            $data['usermessage'] = array('success', 'green', 'Deposite Success', '');
            $this->session->set_flashdata('usermessage', $data['usermessage']);
            $adminHtml = 'Full Name: ' . $user->firstname . ' ' . $user->lastname . '<br>';
            $adminHtml .= 'Amount: ' . $posts['mc_gross'];

            $adminEmaildata['full_name'] = $user->firstname . ' ' . $user->lastname;
            $adminEmaildata['email'] = $user->email;
            $adminEmaildata['amount'] = $posts['mc_gross'];
            sendmailform(null, 'deposite', $adminEmaildata);


            redirect('account/transaction');
        }
    }

    public function withdrawal() {
        $this->data['title'] = 'Withdrawal';
        $this->data['menu_config'] = $this->menu_config_5;
        $user_session = $this->data['user_session'];

        $this->load->model('user_model', 'user');
        $this->load->model('transaction_model', 'transaction');
        $this->load->model('config_model', 'configs');
        $this->load->model('balance_model', 'balance');
        $this->data['balance'] = $this->transaction->getTotalTransfer($user_session['user_id']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $amount = $this->input->post('entry_amount');
            if (floatval($amount) > $this->data['balance']) {
                $validationErrors['entry_amount'] = "Amount litter than max amount";
            } elseif (floatval($amount) < 0) {
                $validationErrors['entry_amount'] = "Amount greater than 0";
            }

            $this->load->helper('email');
            $email = $this->input->post('email_paypal');
            if (!valid_email($email)) {
                $validationErrors['email_paypal'] = "email is not valid";
            }
            if (count($validationErrors) != 0) {
                $this->data['usermessage'] = array('error', 'darkred', 'Validation errors found', 'Please see below');
                $this->data['fielderrors'] = $validationErrors;
            } else {
                $data['email_paypal'] = $this->input->post('email_paypal');
                $data['balance'] = $amount;
                $data['user_id'] = $user_session['user_id'];

                $user = $this->user->getUserById($user_session['user_id']);
                $this->transaction->insertHistory($data);

                $adminEmaildata['fullname'] = $user->firstname . ' ' . $user->lastname;
                $adminEmaildata['email'] = $user->email;
                $adminEmaildata['email_paypal'] = $data['email_paypal'];
                $adminEmaildata['amount'] = $amount;
                sendmailform(null, 'withdrawal', $adminEmaildata);

                $this->data['usermessage'] = array('success', 'green', 'Withdrawal Success', '');
                $this->session->set_flashdata(array('usermessage' => $this->data['usermessage']));
                redirect('account/withdrawal');
            }
        }

        $this->data['main_content'] = 'account/withdrawal';
        $this->load->view('home', $this->data);
    }

    public function creditcard() {
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
            redirect('account/transaction');
        $this->load->helper('authorize');
        $user_session = $this->session->userdata('user');
        $id = $user_session['user_id'];
        $this->load->model('user_model', 'user');
        $this->load->model('transaction_model', 'transaction');
        $this->load->model('config_model', 'configs');
        $this->load->model('balance_model', 'balance');
        $user = $this->user->getUserById($id);
        $transaction_config = $this->configs->getConfigs('transaction_fees');
        $this->data['transaction_fees'] = $transaction_config;

        $posts = $this->input->post();

        if ($posts['entry_amount'] < 0) {
            $error = array('error', 'darkred', 'Register errors', 'Transaction fees litter 0');
            $this->session->set_flashdata(array('usermessage' => $error));
            redirect('account/transaction');
        }

        $this->load->model('config_model', 'configs');
        $transaction_fees = $this->configs->getConfigs('transaction_fees');

        $payments = $this->configs->listActivepayment();

        $startdate = date('Y-m-d h:i:s', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'));
        $enddate = date('Y-m-d h:i:s', strtotime('-1 second', strtotime('+1 month', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'))));
        //get transaction
        $transactions = $this->transaction->getTransactionNotExpiration($id, $startdate, $enddate);


        $max_entry_amount = $transaction_config['max_enrolment_entry_amount'];
        $totalTransaction = 0;
        if (!empty($transactions)) {
            foreach ($transactions as $transaction) {
                $totalTransaction += $transaction->total - $transaction->fees;
            }
        }
        $this->data['max_entry_amount'] = $max_entry_amount - $totalTransaction;



        $money = $transaction_fees['transaction_fee'] + $posts['entry_amount'];

        $totalInMonth = $posts['entry_amount'] + $totalTransaction;
        if ($user->usertype == 1) {
            if (($posts['entry_amount'] < $transaction_config['max_enrolment_silver_amount']) && ($totalInMonth % 10 != 0)) {
                $error = array('error', 'darkred', 'Payment errors', 'Deposite Amount litter than $' . $transaction_config['max_enrolment_silver_amount'] . ' and divisible for 10 or greater than $' . $transaction_config['min_enrolment_entry_amount'] . ' and divisible for 100');
                $this->session->set_flashdata(array('usermessage' => $error));
                redirect('account/transaction');
            } elseif ($posts['entry_amount'] > $transaction_config['max_enrolment_silver_amount'] && ($posts['entry_amount'] < $transaction_config['min_enrolment_entry_amount'] || ($totalInMonth > $this->data['max_entry_amount']) || ($posts['entry_amount'] % 100 != 0))) {
                $error = array('error', 'darkred', 'Payment errors', 'Deposite Amount litter than $' . $this->data['max_entry_amount'] . ', greater than $' . $transaction_config['min_enrolment_entry_amount'] . ' and divisible for 100');
                $this->session->set_flashdata(array('usermessage' => $error));
                redirect('account/transaction');
            }
        }

        $dataTransactionFees = array(
            'card_num' => $posts['card_num'],
            'cc_owner' => $posts['cc_owner'],
            'exp_date' => $posts['exp_date'],
            'amount' => $money,
            'cc_cvv2' => $posts['cc_cvv2'],
        );


        $payment_status = payment_creditcard_authorize($dataTransactionFees);
        if ($payment_status['message'] == 'error') {
            $error = array('error', 'darkred', 'Payment errors', $payment_status['error']);
            $this->session->set_flashdata(array('usermessage' => $error));
            redirect('account/transaction');
        }

        $dataTransaction['user_id'] = $id;
        $dataTransaction['fees'] = $transaction_fees['transaction_fee'];
        $dataTransaction['total'] = $money;
        $dataTransaction['transaction_id'] = $payment_status['transaction_id'];
        $dataTransaction['payment_status'] = 'Completed';
        $dataTransaction['transaction_source'] = 'creditcard';
        $dataTransaction['transaction_type'] = 'deposit';

        $current_fees = $posts['entry_amount'];
        $this->transaction->insert($dataTransaction);
        $balance_user = $this->balance->getBalance($id);
        $balance_amount = !empty($balance_user) ? $balance_user->balance : 0;
        $balance_amount = $balance_amount + $current_fees;
        $this->balance->updateBalanceByUserId($id, $balance_amount);

        $this->user->updateTransaction($id, $posts['entry_amount']);

        $referral_config = $this->configs->getConfigs('referral');
        //referral fee
        $referring = 0;
        $user_refferral = $this->user->getUserByReferral($user->referring);
        $user->fullname = $user->firstname . ' ' . $user->lastname;
        if ($user_refferral) {
            if ($user_refferral->usertype == 2 && $posts['entry_amount'] >= 100) {
                $referring = $referral_config['percentage_gold'] * $current_fees / 100;
                $this->transaction->updateRefereFees($user->referring, $referring);
                $this->balance->updateBalance($user->referring, $referring);

                $referringEmaildata['fullname'] = $user_refferral->fullname;
                $referringEmaildata['user_fullname'] = $user->fullname;
                $referringEmaildata['amount'] = $referring;
                sendmailform($user_refferral->email, 'referring_deposit', $referringEmaildata);
            }
        }
        $admin_amount = $money - $referring;
        $this->balance->updateAdminBalance($admin_amount);

        $data['usermessage'] = array('success', 'green', 'Deposite Success', '');
        $this->session->set_flashdata('usermessage', $data['usermessage']);
        $adminHtml = 'Full Name: ' . $user->firstname . ' ' . $user->lastname . '<br>';
        $adminHtml .= 'Amount: ' . $money;

        $adminEmaildata['full_name'] = $user->firstname . ' ' . $user->lastname;
        $adminEmaildata['email'] = $user->email;
        $adminEmaildata['amount'] = $money;
        sendmailform(null, 'deposite', $adminEmaildata);


        redirect('account/transaction');


        redirect('account/transaction');
    }

}
