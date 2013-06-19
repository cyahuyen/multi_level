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
        $dataWhere = array();
        if ($this->input->get('search')) {
            $dataWhere['search'] = $this->input->get('search');
        }

        $user_session = $this->session->userdata('user');
        $id = $user_session['user_id'];
        $limit = $this->config->item('limit_page', 'my_config');
        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //       Begin pagination
        $this->load->library("pagination");
        $config = array();
        $user = $this->user_model->getUserById($id);
        $config["total_rows"] = $this->user_model->totalRefered($user->username, $dataWhere);
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
        $this->data['refereds'] = $this->user_model->getRefereds($user->username, $dataWhere, $limit, $start);
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
        $config["total_rows"] = $this->user_model->totalHistory($id, $this->input->get('search'));
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
        $this->data['historys'] = $this->user_model->getHistorys($id, $this->input->get('search'), $limit, $start);
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

        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }

        $fielderrors = $this->session->flashdata('field_errors');
        if ($msg) {
            $this->data['fielderrors'] = $fielderrors;
        }

        $this->data['post_data'] = $this->session->flashdata('posts');

        $user_session = $this->session->userdata('user');
        $main_id = $user_session['main_id'];
        $this->load->model('user_model', 'user');
        $this->load->model('transaction_model', 'transaction');
        $acounts = $this->user->getAllAcountByMainId($main_id);
        $this->data['acounts'] = $acounts;

        $dataConfig['return'] = site_url('account/paypal_return');
        $dataConfig['cancel_return'] = site_url('account/cancel_return');
        $dataConfig['notify_url'] = site_url('home');
        $dataConfig['title'] = 'Deposite';

        $startdate = date('Y-m-d h:i:s', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'));
        $enddate = date('Y-m-d h:i:s', strtotime('-1 second', strtotime('+1 month', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'))));


        $payments = $this->configs->listActivepayment();
        $data['payments'] = array();
        foreach ($payments as $code => $config) {
            $dataConfig['config'] = $config;
            $this->data['config'][$code] = $config;
            $this->data['payments'][$code] = $this->load->view('payment/' . $code, $dataConfig, true);
        }

//        $this->data['refereds'] = $this->user_model->getRefereds($id);
        $this->data['main_content'] = 'account/transaction';
        $this->load->view('home', $this->data);
    }

    public function confirm_transaction() {
        $posts = $this->input->post();
        $validationErrors = array();
        $this->data['posts'] = $posts;

        if (empty($posts['user_id'])) {
            $validationErrors['user_id'] = "You haven\'t yet selected acountnumber";
        }
        $entry_amount = (int) $posts['entry_amount'];
        if (empty($entry_amount)) {
            $validationErrors['entry_amount'] = "You haven\'t yet add deposit amout";
        }

        if (empty($posts['payment'])) {
            $validationErrors['payment'] = "You haven\'t yet select payment mothod";
        }

        $this->load->model('transaction_model', 'transaction');
        $this->load->model('user_model', 'user');

        $user = $this->user->getUserById($posts['user_id']);
        $this->data['user'] = $user;
        if (empty($user)) {
            $validationErrors['user_id'] = "Acount has been deleted";
        } else {
            $startdate = date('Y-m-d h:i:s', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'));
            $enddate = date('Y-m-d h:i:s', strtotime('-1 second', strtotime('+1 month', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'))));

            $transactions = $this->transaction->getTransactionNotExpiration($posts['user_id'], $startdate, $enddate);


            if ($user->usertype == 1)
                $max_entry_amount = $this->config_data['max_enrolment_silver_amount'];
            if ($user->usertype == 2)
                $max_entry_amount = $this->config_data['max_enrolment_entry_amount'];

            $totalTransaction = 0;
            if (!empty($transactions)) {
                foreach ($transactions as $transaction) {
                    $totalTransaction += $transaction->total - $transaction->fees;
                }
            }

            $max_amount = $max_entry_amount - $totalTransaction;

            if ($max_amount < $entry_amount) {
                $validationErrors['entry_amount'] = "deposit amout greater than max transaction amount";
            } elseif (($user->usertype == 1) && ($entry_amount % 10 != 0)) {
                $validationErrors['entry_amount'] = "deposit amout divisible for 10";
            } elseif (($user->usertype == 2) && ($entry_amount % 100 != 0)) {
                $validationErrors['entry_amount'] = "deposit amout divisible for 100";
            }
        }

        if (!empty($validationErrors)) {
            $error = array('error', 'darkred', 'Validation errors found', 'Please see below');
            $this->session->set_flashdata(array('usermessage' => $error));
            $this->session->set_flashdata('usermessage', $error);
            $this->session->set_flashdata('field_errors', $validationErrors);
            $this->session->set_flashdata('posts', $posts);
            redirect('account/transaction');
        }

        $dataConfig['return'] = site_url('account/paypal_return');
        $dataConfig['cancel_return'] = site_url('account/cancel_return');
        $dataConfig['notify_url'] = site_url('home');
        $dataConfig['title'] = 'Deposite';

        $payments = $this->configs->listActivepayment();
        $data_config['config'] = $payments[$posts['payment']];
        $data_config['return'] = site_url('account/paypal_return');
        $data_config['cancel_return'] = site_url('account/cancel_return');
        $data_config['notify_url'] = site_url('home');
        $data_config['title'] = 'Deposite';
        $data_config['title'] = 'Deposite';
        $data_config['paypal_amount'] = $entry_amount + $this->config_data['transaction_fee'];
        $this->data['payment'] = $this->load->view('payment/' . $posts['payment'], $data_config, true);
        if ($posts['payment'] == 'paypal') {
            if ($payments['paypal']['sandbox'] == 1)
                $this->data['href_link'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
            else
                $this->data['href_link'] = 'https://www.paypal.com/cgi-bin/webscr';
        }

        if ($posts['payment'] == 'creditcard')
            $this->data['href_link'] = site_url('account/creditcard');
        $this->data['main_content'] = 'account/confirm_transaction';
        $this->load->view('home', $this->data);
    }

    public function ajax_transaction($user_id = 0) {
        //get transaction
        $this->load->model('transaction_model', 'transaction');
        $this->load->model('user_model', 'user');
        $user = $this->user->getUserById($user_id);

        $json = array();
        $json['max_entry_amount'] = 0;
        $json['total_transaction'] = 0;
        if (!empty($user)) {
            $startdate = date('Y-m-d h:i:s', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'));
            $enddate = date('Y-m-d h:i:s', strtotime('-1 second', strtotime('+1 month', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'))));

            $transactions = $this->transaction->getTransactionNotExpiration($user_id, $startdate, $enddate);

            if ($user->usertype == 1)
                $max_entry_amount = $this->config_data['max_enrolment_silver_amount'];
            if ($user->usertype == 2)
                $max_entry_amount = $this->config_data['max_enrolment_entry_amount'];

            $totalTransaction = 0;
            if (!empty($transactions)) {
                foreach ($transactions as $transaction) {
                    $totalTransaction += $transaction->total - $transaction->fees;
                }
            }
            $json['max_entry_amount'] = $max_entry_amount - $totalTransaction;
            $json['total_transaction'] = $totalTransaction;
        }
        echo json_encode($json);
    }

    public function paypal_return() {
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
            redirect('account/transaction');

        $posts = $this->input->post();
        $user_session = $this->session->userdata('user');
        $post_data_list = explode('|', $posts['custom']);
        $post_data = array();
        foreach ($post_data_list as $list) {
            $list_arr = explode('=', $list);
            if (!empty($list_arr[1]))
                $post_data[$list_arr[0]] = $list_arr[1];
        }
        $id = $post_data['user_id'];
        $this->load->model('user_model', 'user');
        $this->load->model('transaction_model', 'transaction');
        $this->load->model('config_model', 'configs');
        $this->load->model('balance_model', 'balance');
        $user = $this->user->getUserById($id);

        $payments = $this->configs->listActivepayment();

        $startdate = date('Y-m-d h:i:s', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'));
        $enddate = date('Y-m-d h:i:s', strtotime('-1 second', strtotime('+1 month', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'))));
        //get transaction
        $transactions = $this->transaction->getTransactionNotExpiration($id, $startdate, $enddate);

        $max_entry_amount = $this->config_data['max_enrolment_entry_amount'];
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


            if ($this->transaction->checkTransactionExists($posts['txn_id'])) {
                $data['usermessage'] = array('success', 'green', 'Deposite Success', '');
                $this->session->set_flashdata('usermessage', $data['usermessage']);
                redirect('account/transaction');
            }


            //      BOF Update Balance
            $this->balance->updateAdminBalance($posts['mc_gross'], '+');

            $deposit_amount = $posts['mc_gross'] - $this->config_data['transaction_fee'];
            $dataBalanceUpdate = array(
                'user_id' => $user->user_id,
                'balance' => $deposit_amount,
            );
            $dataTransaction = $this->balance->updateBalance($dataBalanceUpdate);
            $this->activity->addActivity($user->main_id, 'Add deposit amount your acount ' . $user->acount_number . ' with amount : $' . ($deposit_amount), '+', $deposit_amount);
//      EOF Update Balance
//      BOF Update Transaction
            $dataTransactionUpdate = array(
                'user_id' => $user->user_id,
                'main_user_id' => $user->main_id,
                'fees' => $this->config_data['transaction_fee'],
                'total' => $posts['mc_gross'],
                'payment_status' => 'Completed',
                'transaction_type' => 'deposit',
                'transaction_text' => '+',
                'transaction_source' => 'paypal',
                'transaction_id' => $posts['txn_id'],
                'status' => '1',
            );
            $this->transaction->upadateTransaction($dataTransactionUpdate);

//      EOF Update Transaction

            $userGoldReffering = $this->user->getUserByMainId($user->referring, 2);
            if (!empty($userGoldReffering)) {
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

        $balance_info = $this->balance->getBalance($user_session['user_id']);
        $user = $this->user->getUserById($user_session['user_id']);
        $this->data['user'] = $user;


        $balance = !empty($balance_info->balance) ? $balance_info->balance : 0;

        $withdrawal_config = $this->configs->getConfigs('withdrawal');
        $withdrawal_min_amount = 0;
        $withdrawal_days = 0;
        if ($user->usertype == 1) {
            $withdrawal_min_amount = $withdrawal_config['min_of_silver'];
            $withdrawal_days = $withdrawal_config['days_space_silver'];
        }

        if ($user->usertype == 2) {
            $withdrawal_min_amount = $withdrawal_config['min_of_gold'];
            $withdrawal_days = $withdrawal_config['days_space_gold'];
        }

        if (!empty($user->withdrawal_date)) {
            $withdrawal_date = date("Y-m-d", strtotime("+ {$withdrawal_days} day", strtotime($user->withdrawal_date)));
            $this->data['withdrawal_date'] = $withdrawal_date;
        }

        $transaction_config = $this->configs->getConfigs('transaction_fees');
        $fees = $transaction_config['transaction_fee'];
        $this->data['fees'] = $fees;

        $max_balance = $balance - $withdrawal_min_amount;
        $this->data['max_balance'] = $max_balance;
        $this->data['balance'] = $balance;


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $amount = $this->input->post('entry_amount');
            $total = $amount + $fees;
            $validationErrors = array();
            if (floatval($total) > $max_balance) {
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
            } elseif (empty($withdrawal_date) || (!empty($withdrawal_date) && ($withdrawal_date > date('Y-m-d')))) {
                $this->data['usermessage'] = array('error', 'darkred', 'Validation errors found', 'You don\'t to the date of withdrawal');
                $this->data['fielderrors'] = array();
            } else {
                $data['email_paypal'] = $this->input->post('email_paypal');
                $data['total'] = $total;
                $data['fees'] = $fees;
                $data['user_id'] = $user_session['user_id'];

                $user = $this->user->getUserById($user_session['user_id']);
                $this->transaction->insertHistory($data);
                $this->user->updateWithdrawalDate($user_session['user_id']);

                $adminEmaildata['fullname'] = $user->firstname . ' ' . $user->lastname;
                $adminEmaildata['username'] = $user->username;
                $adminEmaildata['email'] = $user->email;
                $adminEmaildata['email_paypal'] = $data['email_paypal'];
                $adminEmaildata['amount'] = $total;
                sendmailform(null, 'admin_withdrawal', $adminEmaildata);

                $userEmaildata['fullname'] = $user->firstname . ' ' . $user->lastname;
                $userEmaildata['email'] = $user->email;
                $userEmaildata['email_paypal'] = $data['email_paypal'];
                $userEmaildata['amount'] = $total - $fees;
                $userEmaildata['fees'] = $fees;
                $userEmaildata['total'] = $total;
                sendmailform($user->email, 'user_withdrawal', $userEmaildata);

                $this->data['usermessage'] = array('success', 'green', 'Withdrawal Request Success', '');
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
        $posts = $this->input->post();
        $this->load->helper('authorize');
        $user_session = $this->session->userdata('user');
        $id = $posts['user_id'];
        $this->load->model('user_model', 'user');
        $this->load->model('transaction_model', 'transaction');
        $this->load->model('balance_model', 'balance');
        $user = $this->user->getUserById($id);

        if ($posts['entry_amount'] < 0) {
            $error = array('error', 'darkred', 'Register errors', 'Transaction fees litter 0');
            $this->session->set_flashdata(array('usermessage' => $error));
            redirect('account/transaction');
        }

        $payments = $this->configs->listActivepayment();

        $startdate = date('Y-m-d h:i:s', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'));
        $enddate = date('Y-m-d h:i:s', strtotime('-1 second', strtotime('+1 month', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'))));
        //get transaction
        $transactions = $this->transaction->getTransactionNotExpiration($id, $startdate, $enddate);

        $max_entry_amount = $this->config_data['max_enrolment_entry_amount'];
        $totalTransaction = 0;
        if (!empty($transactions)) {
            foreach ($transactions as $transaction) {
                $totalTransaction += $transaction->total - $transaction->fees;
            }
        }
        $this->data['max_entry_amount'] = $max_entry_amount - $totalTransaction;

        $money = $this->config_data['transaction_fee'] + $posts['entry_amount'];

        $totalInMonth = $posts['entry_amount'] + $totalTransaction;
        if ($user->usertype == 1) {
            if (($posts['entry_amount'] < $this->config_data['max_enrolment_silver_amount']) && ($totalInMonth % 10 != 0)) {
                $error = array('error', 'darkred', 'Payment errors', 'Deposite Amount litter than $' . $transaction_config['max_enrolment_silver_amount'] . ' and divisible for 10 or greater than $' . $transaction_config['min_enrolment_entry_amount'] . ' and divisible for 100');
                $this->session->set_flashdata(array('usermessage' => $error));
                redirect('account/transaction');
            } elseif ($posts['entry_amount'] > $this->config_data['max_enrolment_silver_amount'] && ($posts['entry_amount'] < $this->config_data['min_enrolment_entry_amount'] || ($totalInMonth > $this->config_data['max_entry_amount']) || ($posts['entry_amount'] % 100 != 0))) {
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



//      BOF Update Balance
        $this->balance->updateAdminBalance($money, '+');

        $dataBalanceUpdate = array(
            'user_id' => $user->user_id,
            'balance' => $posts['entry_amount'],
        );
        $dataTransaction = $this->balance->updateBalance($dataBalanceUpdate);
        $this->activity->addActivity($user->main_id, 'Add deposit amount your acount ' . $user->acount_number . ' with amount : $' . ($dataBalanceUpdate['balance']), '+', $dataBalanceUpdate['balance']);
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

        $userGoldReffering = $this->user->getUserByMainId($user->referring, 2);
        if (!empty($userGoldReffering)) {
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

        $data['usermessage'] = array('success', 'green', 'Deposite Success', '');
        $this->session->set_flashdata('usermessage', $data['usermessage']);
        $adminHtml = 'Full Name: ' . $user->firstname . ' ' . $user->lastname . '<br>';
        $adminHtml .= 'Amount: ' . $money;

        $adminEmaildata['full_name'] = $user->firstname . ' ' . $user->lastname;
        $adminEmaildata['email'] = $user->email;
        $adminEmaildata['amount'] = $money;
        sendmailform(null, 'deposite', $adminEmaildata);

        redirect('account/transaction');
    }

}
