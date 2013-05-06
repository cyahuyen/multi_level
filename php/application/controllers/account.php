<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Account extends CI_Controller {

    var $menu_config_user_none = array('', '', '', '', '', '');
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
        $this->load->model('account_model', '', TRUE);
        $this->data['menu_config'] = $this->menu_config_user_home;
        $this->data['user_session'] = $this->session->userdata('user');
    }

    public function index() {
        $this->data['title'] = 'Sign Up';
        $this->data['main_content'] = 'account/index';
        $this->load->view('home', $this->data);
    }

    public function edit() {
        $this->data['title'] = 'Edit Account';
        $user_session = $this->session->userdata('user');
        $id = $user_session['user_id'];
        $account = $this->account_model->getAccount($id);
        $posts = $this->input->post();
        if (!empty($account)) {
            $this->data['username'] = $account->username;
            $this->data['fullname'] = $account->fullname;
            $this->data['address'] = $account->address;
            $this->data['phone'] = $account->phone;
            $this->data['email'] = $account->email;
            $this->data['fax'] = $account->fax;
            $this->data['birthday'] = $account->birthday;
        } else {
            $this->data['username'] = $posts['username'];
            $this->data['fullname'] = $posts['fullname'];
            $this->data['address'] = $posts['address'];
            $this->data['phone'] = $posts['phone'];
            $this->data['email'] = $posts['email'];
            $this->data['fax'] = $posts['fax'];
            $this->data['birthday'] = $posts['birthday'];
        }
        if (($this->input->server('REQUEST_METHOD') === 'POST') && $this->validateForm()) {
            $this->account_model->update($id, $this->input->post());
            redirect('account');
        }
        $this->data['main_content'] = 'account/edit';
        $this->load->view('home', $this->data);
    }

    function changepassword() {
        $this->data['title'] = 'Change Password';
        $user_session = $this->session->userdata('user');
        $id = $user_session['user_id'];
        if ($this->input->post('cu_password')) {
            $this->data['cu_password'] = $this->input->post('cu_password');
        } else {
            $this->data['cu_password'] = '';
        }
        if ($this->input->post('password')) {
            $this->data['password'] = $this->input->post('password');
        } else {
            $this->data['password'] = '';
        }
        if ($this->input->post('repassword')) {
            $this->data['repassword'] = $this->input->post('repassword');
        } else {
            $this->data['repassword'] = '';
        }
        $this->form_validation->set_rules('cu_password', 'Current Password', 'required|xss_clean|max_length[50]|callback_checkPassword');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|max_length[50]|valid_repassword');
        $this->form_validation->set_rules('repassword', 'Re-Password', 'required|trim|xss_clean|matches[password]');
        if ($this->form_validation->run() == TRUE) {
            $this->account_model->updatePassword($id, $this->input->post());
            redirect('account');
        } else {
            $this->data['main_content'] = 'account/changepass';
        }
        $this->data['main_content'] = 'account/changepass';
        $this->load->view('home', $this->data);
    }

    function refered() {
        $this->data['title'] = 'Refered Members';
        $user_session = $this->session->userdata('user');
        $id = $user_session['user_id'];
        $this->data['refereds'] = $this->account_model->getRefereds($id);
        $this->data['main_content'] = 'account/refered';
        $this->load->view('home', $this->data);
    }

    function history() {
        $this->data['title'] = 'History';
        $user_session = $this->session->userdata('user');
        $id = $user_session['user_id'];
//        $this->data['historys'] = $this->account_model->getHistorys($id);
        $this->data['main_content'] = 'account/history';
        $this->load->view('home', $this->data);
    }

    function validateForm() {
        if ($this->input->post('email') != $this->input->post('old_email')) {
            $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email|max_length[64]|callback_checkEmail');
        } else {
            $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email|max_length[64]');
        }
        $this->form_validation->set_rules('fullname', 'Full Name', 'required|trim|xss_clean|max_length[150]');
        $this->form_validation->set_rules('address', 'Address', 'required|trim|xss_clean|max_length[150]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim|xss_clean|numeric|max_length[12]');
        $this->form_validation->set_rules('fax', 'Fax', 'required|trim|xss_clean|numeric|max_length[12]');
        $this->form_validation->set_rules('birthday', 'Birthday', 'required|trim|xss_clean|max_length[15]|callback_valid_date');
        if ($this->form_validation->run() == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($password) {
        if (!$this->account_model->checkPassword($password)) {
            $this->form_validation->set_message('checkPassword', 'Current password not math. Please try again.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function checkEmail($email) {
        if ($this->account_model->checkEmail($email)) {
            $this->form_validation->set_message('checkEmail', 'This e-mail is already registered in our system. Please use a different one.');
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

}
