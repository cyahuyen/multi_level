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
        $this->load->model('user_model', 'user', TRUE);
        $this->load->model('transaction_model', 'transaction', TRUE);
        $this->data['menu_config'] = $this->menu_config_user_home;
        $user_session = $this->session->userdata('user');
        if (!$this->session->userdata('user')) {
            redirect('authentication', 'refresh');
        }
        $this->data['user_session'] = $this->session->userdata('user');
        $this->data['menu_config'] = $this->menu_config_2;
        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }


        if (!empty($user_session) && $user_session['permission'] == 'administrator') {
            redirect(admin_url('admin'));
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
        $user_session = $this->session->userdata('user');
        $this->data['acounts'] = $this->user->getAllbalanceAcountByMainId($user_session['main_id']);

        $user_session = $this->session->userdata('user');
        $this->data['breadcrumbs'][] = array(
            'text' => 'My Account',
            'href' => site_url('account/index'),
            'separator' => ' :: '
        );

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
        $this->load->model('country_model', 'country');
        $this->load->model('zones_model', 'zones');
        
        $this->data['countries'] = $this->country->getCountries();
        $this->data['title'] = 'Edit Account';
        $user_session = $this->session->userdata('user');
        $id = $user_session['main_id'];
        $this->data['userdata'] = $this->user->getMainUserByMainId($id);
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
            
            if(empty($posts['country'])){
                $validationErrors['country'] = "Country is Lastnamr cannot be blank";
            }
            if(empty($posts['state'])){
                $validationErrors['state'] = "State is Lastnamr cannot be blank";
            }
            if(empty($posts['zip_code'])){
                $validationErrors['zip_code'] = "Zipcode is Lastnamr cannot be blank";
            }
           
            $this->load->helper('email');
            if ($posts['email'] == '') {
                $validationErrors['email'] = "Email cannot be blank";
            } elseif (!valid_email($posts['email'])) {
                $validationErrors['email'] = "Email incorrect";
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
                    'address' => $posts['address'],
                    'country_id' => $posts['country'],
                    'state_id' => $posts['state'],
                    'address2' => $posts['address2'],
                    'zip_code' => $posts['zip_code'],
                    'city' => $posts['city'],
                );
                if ($this->user->updateMainAcount($id, $data)) {
                    $this->activity->addActivity($id, 'Updated profile');
                    $this->data['usermessage'] = array('success', 'green', 'Successfully saved', '');
                }

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
        $id = $user_session['main_id'];


        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        $this->data['posts'] = array();
        $posts = $this->input->post();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validationErrors = array();
            if (!empty($id) && empty($posts['password'])) {
                if (strlen(trim($posts['password'])) < 6) {
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
                $data = array('password' => md5(trim($posts['password'])));
                if ($this->user->updateMainAcount($id, $data)) {
                    $this->activity->addActivity($id, 'Changed password');
                    $this->data['usermessage'] = array('success', 'green', 'Successfully saved', '');
                }
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
        $id = $user_session['main_id'];
        $limit = $this->config->item('limit_page');
        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //       Begin pagination
        $this->load->library("pagination");
        $config = array();
        $user = $this->user->getMainUserByMainId($id);
        $config["total_rows"] = $this->user->totalRefered($id, $dataWhere);
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
        $this->data['refereds'] = $this->user->getRefereds($id, $dataWhere, $limit, $start);
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
        $id = $user_session['main_id'];

        $limit = $this->config->item('limit_page');
        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //       Begin pagination
        $this->load->library("pagination");
        $config = array();
        $search = array();
        if ($this->input->get('search')) {
            $search['transaction_type'] = $this->input->get('search');
        }
        $config["total_rows"] = $this->transaction->totalHistory($id, $search);
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
        $this->data['historys'] = $this->transaction->getHistorys($id, $search, $limit, $start);
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
        } elseif ($this->input->get('success') == 1) {
            $this->data['usermessage'] = array('success', 'green', 'Successfully saved', '');
            ;
        }

        $fielderrors = ($this->session->flashdata('field_errors'));
        if ($msg) {
            $this->data['fielderrors'] = (array) json_decode($fielderrors);
        }

        $payments = $this->configs->listActivepayment();
        $data['payments'] = array();
        foreach ($payments as $code => $config) {
            $dataConfig['config'] = $config;
            $this->data['payments'][$code] = $config['title'];
        }

        $this->data['post_data'] = (array) json_decode($this->session->flashdata('posts'));

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


        $posts = $this->input->post();
        if ($posts) {
            $this->data['post_data'] = $posts;
            $this->load->model('transaction_model', 'transaction');
            $this->load->model('user_model', 'user');

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
                $this->data['usermessage'] = array('error', 'darkred', 'Validation errors found', 'Please see below');
                $this->data['fielderrors'] = $validationErrors;
            } else {
                $deposit_info = array(
                    'user_id' => $posts['user_id'],
                    'entry_amount' => $posts['entry_amount'],
                );

                $this->session->set_userdata('deposit_info', base64_encode(json_encode($deposit_info)));
                redirect(site_url('account/' . $posts['payment']));
            }
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
            $this->session->set_flashdata('field_errors', json_encode($validationErrors));
            $this->session->set_flashdata('posts', json_encode($posts));
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
            if ($user->usertype == 1) {
                $transactions = $this->transaction->getTransactionNotExpiration($user_id);

                $from = new DateTime($user->created);
                $to = new DateTime(date("y-m-d h:i:s", time()));
//                $totalMonth = $from->diff($to)->m + $from->diff($to)->y * 12 + 1;
                $totalMonth = diffdate($user->created, date("y-m-d h:i:s", time()));
                $max_entry_amount = $this->config_data['max_enrolment_silver_amount'] * $totalMonth;
                $totalTransaction = 0;

                if (!empty($transactions)) {
                    foreach ($transactions as $transaction) {
                        $totalTransaction += $transaction->total - $transaction->fees;
                    }
                }
                $json['max_entry_amount'] = $max_entry_amount - $totalTransaction;
                $json['total_transaction'] = $totalTransaction;
            }

            if ($user->usertype == 2) {
                $transactions = $this->transaction->getTransactionNotExpiration($user_id, $startdate, $enddate);
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
            $this->activity->addActivity($user->main_id, 'Deposited to the account ' . $user->acount_number . ' with amount : $' . ($deposit_amount), '+', $deposit_amount);
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
                $this->activity->addActivity($userGoldReffering->main_id, 'Your account' . $userGoldReffering->acount_number . ' received a referral fee with amount : $' . ($refereFees), '+', $refereFees);
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
                    'description' => 'The user "' . $userGoldReffering->firstname . ' ' . $userGoldReffering->last_name . '" deposited $100'
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

        $this->data['acounts'] = $this->user->getAllAcountByMainId($user_session['main_id']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $posts = $this->input->post();


            $user_id = $posts['user_id'];
            $user = $this->user->getUserById($user_id);
            $validationErrors = array();
            if (empty($user)) {
                $this->data['usermessage'] = array('error', 'darkred', 'Validation errors found', 'You haven\'t yet select acount number');
                $this->data['fielderrors'] = $validationErrors;
            } else {
                $balance_info = $this->balance->getBalance($user_id);
                $balance = !empty($balance_info->balance) ? $balance_info->balance : 0;

                $withdrawal_min_amount = 0;
                $withdrawal_days = 0;



                if ($user->usertype == 1) {
                    $withdrawal_min_amount = $this->config_data['min_of_silver'];
                    $withdrawal_days = $this->config_data['days_space_silver'];
                }

                if ($user->usertype == 2) {
                    $withdrawal_min_amount = $this->config_data['min_of_gold'];
                    $withdrawal_days = $this->config_data['days_space_gold'];
                }

                if (!empty($user->withdrawal_date)) {
                    $withdrawal_date = date("Y-m-d", strtotime("+ {$withdrawal_days} day", strtotime($user->withdrawal_date)));
                    $jsons['withdrawal_date'] = $withdrawal_date;
                }

                $fees = $this->config_data['transaction_fee'];
                $jsons['fees'] = $fees;
                $max_balance = $balance - $withdrawal_min_amount;
                $jsons['max_balance'] = ($max_balance > 0) ? $max_balance : 0;
                $jsons['balance'] = $balance;

                $amount = $this->input->post('entry_amount');
                $total = $amount + $fees;


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
                    $data['user_id'] = $posts['user_id'];


                    $user = $this->user->getUserById($posts['user_id']);
                    $this->transaction->insertHistory($data);
                    $this->user->updateWithdrawalDate($posts['user_id']);

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
        }
        $this->data['main_content'] = 'account/withdrawal';
        $this->load->view('home', $this->data);
    }

    public function ajax_withdraw($user_id = 0) {
        $user_session = $this->data['user_session'];
        $jsons = array();
        $this->load->model('user_model', 'user');
        $this->load->model('transaction_model', 'transaction');
        $this->load->model('config_model', 'configs');
        $this->load->model('balance_model', 'balance');


        $user = $this->user->getUserById($user_id);
        if (!empty($user)) {
            $balance_info = $this->balance->getBalance($user_id);

            $balance = !empty($balance_info->balance) ? $balance_info->balance : 0;

            $withdrawal_min_amount = 0;
            $withdrawal_days = 0;
            if ($user->usertype == 1) {
                $withdrawal_min_amount = $this->config_data['min_of_silver'];
                $withdrawal_days = $this->config_data['days_space_silver'];
            }

            if ($user->usertype == 2) {
                $withdrawal_min_amount = $this->config_data['min_of_gold'];
                $withdrawal_days = $this->config_data['days_space_gold'];
            }

            if (!empty($user->withdrawal_date)) {
                $withdrawal_date = date("Y-m-d", strtotime("+ {$withdrawal_days} day", strtotime($user->withdrawal_date)));
                $jsons['withdrawal_date'] = $withdrawal_date;
            }

            $fees = $this->config_data['transaction_fee'];
            $jsons['fees'] = $fees;
            $max_balance = $balance - $withdrawal_min_amount;
            $jsons['max_balance'] = ($max_balance > 0) ? $max_balance : 0;
            $jsons['balance'] = $balance;
        }
        echo json_encode($jsons);
    }

    public function aw_quickpay() {
        $this->data['title'] = 'Allied Wallet';
        $this->data['menu_config'] = $this->menu_config_4;
        $deposit_info = $this->session->userdata['deposit_info'];

        if (!$deposit_info)
            redirect(site_url('account/transaction'));
        $this->load->model('tmp_model');
        $tmp_id = $this->tmp_model->insert(array('tmp_info' => $deposit_info));
        $this->data['tmp_id'] = $tmp_id;
        $deposit_info = json_decode(base64_decode($deposit_info));
        if (!$deposit_info)
            redirect(site_url('account/transaction'));
        $this->data['deposit_info'] = $deposit_info;


        $this->load->model('user_model', 'user');
        $this->load->model('transaction_model', 'transaction');
        $this->load->model('config_model', 'configs');
        $this->load->model('balance_model', 'balance');

        $user_id = $deposit_info->user_id;
        $user = $this->user->getUserById($user_id);
        $this->data['user'] = $user;

        $payments_config = $this->configs->getConfigs('aw_quickpay');
        $this->data['payments_config'] = $payments_config;

        $this->data['main_content'] = 'account/aw_quickpay';
        $this->load->view('home', $this->data);
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

    public function creditcard() {
        $this->data['title'] = 'Creditcard';
        $this->data['menu_config'] = $this->menu_config_4;
        $deposit_info = $this->session->userdata['deposit_info'];

        if (!$deposit_info)
            redirect(site_url('account/transaction'));
        $deposit_info = json_decode(base64_decode($deposit_info));
        if (!$deposit_info)
            redirect(site_url('account/transaction'));
        $this->data['deposit_info'] = $deposit_info;

        $this->load->model('user_model', 'user');
        $this->load->model('transaction_model', 'transaction');
        $this->load->model('config_model', 'configs');
        $this->load->model('balance_model', 'balance');

        $user_id = $deposit_info->user_id;
        $user = $this->user->getUserById($user_id);
        $this->data['user'] = $user;

        $this->data['main_content'] = 'account/creditcard';
        $this->load->view('home', $this->data);

        $posts = $this->input->post();
        if ($posts) {
            $this->load->helper('authorize');

            $user_session = $this->session->userdata('user');


            if ($deposit_info->entry_amount < 0) {
                $error = array('error', 'darkred', 'Register errors', 'Transaction fees litter 0');
                $this->session->set_flashdata(array('usermessage' => $error));
                redirect('account/transaction');
            }

            $payments = $this->configs->listActivepayment();

//        $totalInMonth = $posts['entry_amount'] + $totalTransaction;

            if ($user->usertype == 1) {
                $transactions = $this->transaction->getTransactionNotExpiration($user_id);

                $from = new DateTime($user->created);
                $to = new DateTime(date("y-m-d h:i:s", time()));
//                $totalMonth = $from->diff($to)->m + $from->diff($to)->y * 12 + 1;
                $totalMonth = diffdate($user->created, date("y-m-d h:i:s", time()));
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
            $money = $this->config_data['transaction_fee'] + $deposit_info->entry_amount;

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
                        if ($refereFees > 0) {
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
                }
            } else {
                // BOF First deposit
                if (!$checkExistsDeposit) {
                    $total = $this->transaction->getAllBalanceByReferedDeposit($user->main_id);
                    $referedAmount = $total * $this->config_data['referral_bonus_default'] / 100;
                    if ($referedAmount > 0) {
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

            redirect('account/transaction');
        }
    }

}
