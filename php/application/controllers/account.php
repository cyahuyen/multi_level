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
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('recaptcha');
        $this->lang->load('recaptcha');
        $this->load->model('user_model', '', TRUE);
        $this->data['menu_config'] = $this->menu_config_user_home;
        $this->data['user_session'] = $this->session->userdata('user');
        if (!$this->session->userdata('user')) {
            redirect('authentication', 'refresh');
        }

        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
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
        $open_fees = $this->user_model->getSumOpen($id, $infors->transaction_start, $infors->transaction_finish);
        $total_fees = $this->user_model->getSumTotal($id, $infors->transaction_start, $infors->transaction_finish);
        $this->data['amout'] = $total_fees - $open_fees;
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
            if ($posts['fullname'] == '') {
                $validationErrors['fullname'] = "Your name is Fullname cannot be blank";
            }
            if ($posts['email'] != $posts['old_email']) {
                if ($posts['email'] == '' || !($this->checkEmail($posts['email']))) {
                    $validationErrors['email'] = "Email cannot be blank";
                }
            } else {
                if ($posts['email'] == '') {
                    $validationErrors['email'] = "Email cannot be blank";
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
                $data = array(
                    'fullname' => $posts['fullname'],
                    'address' => $posts['address'],
                    'phone' => $posts['phone'],
                    'email' => $posts['email'],
                    'fax' => $posts['fax'],
                    'birthday' => $posts['birthday']
                );
                if ($this->user_model->update($id, $data))
                    $this->data['usermessage'] = array('success', 'green', 'Successfully saved', '');
                else
                    $this->data['usermessage'] = array('error', 'darkred', 'Error saved', '');
                $this->session->set_flashdata(array('usermessage' => $this->data['usermessage']));
                redirect(site_url('account/edit/' . $id));
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = $this->input->post();
            $validationErrors = array();
            if (!$this->checkPassword($posts['cu_password'])) {
                $validationErrors['cu_password'] = "Current Pass cannot be blank";
            }
            if (!empty($posts['password'])) {
                if (strlen($posts['password']) < 6) {
                    $validationErrors['password'] = "Password must greater than 6 characters";
                }
                if ($posts['password'] != $posts['repassword']) {
                    $validationErrors['repassword'] = "Password wrong";
                }
            } else {
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
                unset($posts['cu_password']);
                unset($posts['save-btn']);
                if (empty($posts['password'])) {
                    unset($posts['password']);
                } else {
                    $posts['password'] = $posts['password'];
                }
                $data = array(
                    'password' => $posts['password']
                );
                if ($this->user_model->updatePassword($id, $data))
                    $this->data['usermessage'] = array('success', 'green', 'Successfully saved', '');
                else
                    $this->data['usermessage'] = array('error', 'darkred', 'Error saved', '');
                $this->session->set_flashdata(array('usermessage' => $this->data['usermessage']));
                redirect(site_url('account/changepass/' . $id));
            }
        }
        $this->data['main_content'] = 'account/changepass';
        $this->load->view('home', $this->data);
    }

    function refered() {
        $this->data['title'] = 'Refered Members';

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => site_url('account'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => 'Refered Members',
            'href' => site_url('account/refered'),
            'separator' => ' :: '
        );

        $user_session = $this->session->userdata('user');
        $id = $user_session['user_id'];
        $limit = $this->config->item('per_page', 'cya_config');
        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //       Begin pagination
        $this->load->library("pagination");
        $config = array();
        $config["total_rows"] = $this->user_model->totalRefered($id);
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
        $this->data['refereds'] = $this->user_model->getRefereds($id, $limit, $start);
        $this->data['main_content'] = 'account/refered';
        $this->load->view('home', $this->data);
    }

    function history() {
        $posts = $this->input->post();
        $this->data['title'] = 'History';
        $this->data['breadcrumbs'] = array();

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

        $limit = $this->config->item('per_page', 'cya_config');
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
        $dataConfig['title'] = 'Register';

        $payments = $this->configs->listActivepayment();

        //get transaction
        $transactions = $this->transaction->getTransactionNotExpiration($id, $user->transaction_start, $user->transaction_finish);
        $max_entry_amount = $transaction_config['max_enrolment_entry_amount'];
        $totalTransaction = 0;
        if (!empty($transactions)) {
            foreach ($transactions as $transaction) {
                $totalTransaction += $transaction->total_fees - $transaction->open_fees;
            }
        }
        $this->data['max_entry_amount'] = $max_entry_amount - $totalTransaction;

        $payments = $this->configs->listActivepayment();
        $data['payments'] = array();
        foreach ($payments as $code => $config) {
            $dataConfig['config'] = $config;
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

        //get transaction
        $transactions = $this->transaction->getTransactionNotExpiration($id, $user->transaction_start, $user->transaction_finish);
        $max_entry_amount = $transaction_config['max_enrolment_entry_amount'];
        $totalTransaction = 0;
        if (!empty($transactions)) {
            foreach ($transactions as $transaction) {
                $totalTransaction += $transaction->total_fees - $transaction->open_fees;
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
            $dataTransaction['open_fees'] = $transaction_fees['transaction_fee'];
            $dataTransaction['total_fees'] = $posts['mc_gross'];
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
            $this->transaction->insert($dataTransaction);
            $this->balance->updateBalance($id, $current_fees);
            $this->balance->updateAdminBalance($dataTransaction['total_fees']);

            if (empty($transactions)) {
                $this->user->updateTransaction($id);
            }
            $data['usermessage'] = array('success', 'green', 'Deposite Success', '');
            $this->session->set_flashdata('usermessage', $data['usermessage']);
            $adminHtml = 'Full Name: ' . $user->fullname . '<br>';
            $adminHtml .= 'Amount: ' . $posts['mc_gross'];
            sendmail(null, 'Have just new member deposite', $adminHtml);


            redirect('account/transaction');
        }
    }

}
