<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    var $admin_id = 0;
    var $name = '';
    var $email = '';

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->lang->load('login');
        if ($this->session->userdata('admin_logged')) {
            redirect('account/index/', 'refresh');
        }
    }

    function logout() {
        $logout = $this->ion_auth->logout();

        redirect('login/index', 'refresh');
    }

    public function index() {
        $this->load->library('recaptcha');
        $this->lang->load('recaptcha');
        $this->load->helper('string');

        // Language
        $data['text_account'] = $this->lang->line('text_account');
        $data['text_password'] = $this->lang->line('text_password');
        $data['button_login'] = $this->lang->line('button_login');

        $this->_set_rules();

        $this->form_validation->set_rules('recaptcha_response_field', 'lang:recaptcha_field_name', 'required|callback_check_captcha');

        $this->_set_fields();

        $data['recaptcha'] = $this->recaptcha->get_html();

        if ($this->form_validation->run() == true) {

            //lam sach du lieu dau vao
            $user_name = trim($this->input->post('username'));

            if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'))) {
                $admin = $this->ion_auth->admin($user_name)->row();
                $this->session->set_userdata('admin_logged', $admin->id);
                redirect('account/index/', 'refresh');
            } else {
                $this->session->set_flashdata('message', 'The account number or password provided is incorrect. Please check your information and try again.');
                redirect('login/index/', 'refresh');
            }
        } else {
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $data['username'] = array('name' => 'username',
                'id' => 'username',
                'type' => 'text',
                'value' => $this->form_validation->set_value('username'),
                'class' => 'text requiredField',
            );
            $data['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => '"text requiredField"',
            );
            $this->load->view('login', $data);
        }
    }

    // set empty default form field values
    function _set_fields() {
        $this->form_data->username = '';
        $this->form_data->password = '';
    }

    function _set_rules() {
        //validate form input
        $this->form_validation->set_rules('username', 'User Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    }

    // date_validation callback
    function valid_date($str) {
        //match the format of the date
        if (preg_match("/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/", $str, $parts)) {
            //check weather the date is valid of not
            if (checkdate($parts[2], $parts[1], $parts[3]))
                return true;
            else
                return false;
        }
        else
            return false;
    }

    function check_captcha($val) {

        if ($this->recaptcha->check_answer($this->input->ip_address(), $this->input->post('recaptcha_challenge_field'), $val)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_captcha', $this->lang->line('recaptcha_incorrect_response'));
            return FALSE;
        }
    }

    function check_pin($p) {
        $this->load->model('admin_model', '', TRUE);

        if (!$this->admin_model->check($this->email, 'login_pin', $p)) {
            $this->form_validation->set_message('check_pin', "The login PIN is not valid. Please try again.");

            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function get_weight_types($name = FALSE) {
        $weight_types = array(
            'gram' => array('name' => 'Gram', 'conversion' => 1, 'symbol' => 'g'),
            'kilogram' => array('name' => 'Kilogram', 'conversion' => 1000, 'symbol' => 'kg'),
            'avoir_ounce' => array('name' => 'Avoir Ounce', 'conversion' => 28.3495, 'symbol' => 'oz'),
            'avoir_pound' => array('name' => 'Avoir Pound', 'conversion' => 453.5924, 'symbol' => 'lb'),
            'troy_ounce' => array('name' => 'Troy Ounce', 'conversion' => 31.1035, 'symbol' => 't oz'),
            'troy_pound' => array('name' => 'Troy Pound', 'conversion' => 373.2417, 'symbol' => 't lb'),
            'carat' => array('name' => 'Carat', 'conversion' => 0.2, 'symbol' => 'ct')
        );

        return (isset($weight_types[$name])) ? $weight_types[$name] : $weight_types;
    }

}