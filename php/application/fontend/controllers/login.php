<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    var $user_id = 0;
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
        $this->load->model('logs_model', '', TRUE);
        if ($this->session->userdata('token_login')) {
            $this->session->unset_userdata('user_logged');
        }
        if ($this->session->userdata('user_logged')) {
            redirect('account/index/', 'refresh');
        }
        $this->data['token_login'] = $this->session->userdata('token_login');
    }

    public function index() {
        $this->load->library('recaptcha');
        $this->lang->load('recaptcha');
        $this->load->helper('string');

        // Language
        $data['step1_title'] = $this->lang->line('step1_title');
        $data['sep1_note'] = $this->lang->line('sep1_note');
        $data['sep1_note2'] = $this->lang->line('sep1_note2');
        $data['text_account_number'] = $this->lang->line('text_account_number');
        $data['text_forgot'] = $this->lang->line('text_forgot');
        $data['text_remember_me'] = $this->lang->line('text_remember_me');
        $data['text_pass'] = $this->lang->line('text_pass');
        $data['text_enter_capt'] = $this->lang->line('text_enter_capt');
        $data['text_note_capt'] = $this->lang->line('text_note_capt');
        $data['text_no_account'] = $this->lang->line('text_no_account');
        $data['text_register'] = $this->lang->line('text_register');
        $data['button_next'] = $this->lang->line('button_next');
        $data['button_cancel'] = $this->lang->line('button_cancel');

        $data['action_register'] = site_url('user/index');

        $datasent = $this->session->userdata('token_sci');
        $data['eg_acc_from'] = isset($datasent['eg_acc_from']) ? $datasent['eg_acc_from'] : '';
        $this->_set_rules();
        $this->form_validation->set_rules('recaptcha_response_field', 'lang:recaptcha_field_name', 'required|callback_check_captcha');
        $this->form_validation->set_rules('acc_number', 'Account number', 'callback_check_block');

        $this->_set_fields();
        $data['link_cancel'] = $this->session->userdata('link_cancel_fail');
        if ($data['link_cancel']) {
            $datas = $this->session->userdata('token_sci');
            $data['eg_fail_url_method'] = $datas['eg_fail_url_method'];
            $data['eg_fail_url'] = $datas['eg_fail_url'];
            $data['url_return_fail'] = $data['link_cancel'];
            $data['dataposts'] = $this->session->userdata('token_sci');
        }
        $data['cancel'] = site_url('home');
        $data['recaptcha'] = $this->recaptcha->get_html();
        $data['main_content'] = 'login/login_step01.php';
        if ($this->form_validation->run() == TRUE) {
            //check for "remember me"
            $remember = (bool) $this->input->post('remember');
            if ($this->ion_auth->login($this->input->post('acc_number'), $this->input->post('password'), $remember)) {
                $this->session->set_flashdata('step', 2);
                redirect('login/login_confim/', 'refresh');
            } else {
                $this->session->set_flashdata('message', 'The account number or password provided is incorrect. Please check your information and try again.');
                redirect('login/index/', 'refresh');
            }
        } else {
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $data['acc_number'] = array('name' => 'acc_number',
                'id' => 'acc_number',
                'type' => 'text',
                'value' => $this->form_validation->set_value('acc_number'),
                'class' => 'text requiredField',
            );
            $data['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => '"text requiredField"',
            );
            $this->session->unset_userdata('link_cancel_fail');
            $this->load->view('login', $data);
        }
    }

    public function login_confim() {
        if ($this->ion_auth->logged_in() && ($this->session->flashdata('step') == 2)) {
            $this->load->model('user_model', '', TRUE);
            $data['step2_title'] = $this->lang->line('step2_title');
            $data['text_welcom'] = $this->lang->line('text_welcom');
            $data['text_hello'] = $this->lang->line('text_hello');
            $data['text_remember_me'] = $this->lang->line('text_remember_me');
            $data['text_welcome_mess'] = $this->lang->line('text_welcome_mess');
            $data['text_close'] = $this->lang->line('text_close');
            $data['button_continue'] = $this->lang->line('button_continue');
            $data['button_cancel'] = $this->lang->line('button_cancel');

            $user = $this->ion_auth->user()->row();
            $data['welcome_message'] = $user->welcome_message;
            $data['step'] = 3;
            $data['main_content'] = 'login/login_step02.php';
            $this->load->view('login', $data);
        }
        else
            redirect('login/index/', 'refresh');
    }

    public function step3() {

        $confirm = $this->input->post('Confirm', TRUE);

        $step = 0 + $this->input->post('step', TRUE);

        $data['step3_title'] = $this->lang->line('step3_title');
        $data['step3_notice'] = $this->lang->line('step3_notice');
        $data['step3_notice2'] = $this->lang->line('step3_notice2');
        $data['text_account_balance'] = $this->lang->line('text_account_balance');
        $data['step3_notice3'] = $this->lang->line('step3_notice3');
        $data['button_login_pin'] = $this->lang->line('button_login_pin');
        $data['button_one_pin'] = $this->lang->line('button_one_pin');
        $data['button_cancel'] = $this->lang->line('button_cancel');

        if ($this->ion_auth->logged_in() && ($step == 3) && ($confirm)) {
            $user = $this->ion_auth->user()->row();
            $data['name'] = $user->first_name;
            $this->load->model('currencies_model', '', TRUE);
            $this->load->model('balance_model', '', TRUE);

            $currencies = $this->currencies_model->getCurrencies(1);
            foreach ($currencies as $currencie) {
                $confirm["title"] = $currencie->title;
                $confirm["blance"] = $this->balance_model->getBalaceById($user->id, $currencie->code);

                $confirm = array(
                    "title" => $currencie->title,
                    "blance" => $currencie->symbol_left . $this->balance_model->getBalaceById($user->id, $currencie->code) . $currencie->symbol_right,
                );
                $data['currencies'][] = (object) $confirm;
            }

            $data['step'] = 4;
            $data['main_content'] = 'login/login_step03.php';
            $this->session->set_flashdata('is_first', true);
            $this->load->view('login', $data);
        }
        else
            redirect('login/index/', 'refresh');
    }

    public function login_pin() {
        $this->load->helper('string');

        $data['button_cancel'] = $this->lang->line('button_cancel');
        $data['button_login'] = $this->lang->line('button_login');
        $data['step4_note'] = $this->lang->line('step4_note');
        $data['text_login_pin'] = $this->lang->line('text_login_pin');
        $data['step4_title'] = $this->lang->line('step4_title');

        $step = 0 + $this->input->post('step', TRUE);
        if ($this->ion_auth->logged_in() && ($step == 4)) {
            $user = $this->ion_auth->user()->row();
            $this->email = $user->email;
            $posts = $this->input->post();
            if (($this->input->server('REQUEST_METHOD') === 'POST') && isset($posts['pin'])) {
                $this->form_validation->set_rules('pin', 'Login Pin', 'required|is_numeric|exact_length[5]|callback_check_pin');
                if ($this->form_validation->run() == FALSE) {
                    $logs = array(
                        'account_number' => $this->session->userdata('account_number'),
                        'date_creater' => gmdate('Y-m-d H:i:s', $this->session->userdata('last_activity')),
                        'description' => 'Login Fail step 3',
                        'ip_address' => $this->session->userdata('ip_address'),
                    );
                    if ($this->session->flashdata('is_first')) {
                        $this->logs_model->save($logs);
                    }
                    $this->session->set_flashdata('is_first', false);
                } else {
                    $this->session->set_userdata('user_logged', $user->id);
                    if ($this->data['token_login']) {
                        redirect('transfer/sci/');
                    } else {
                        redirect('account/index/', 'refresh');
                    }
                }
            }
            $data['step'] = 4;
            $data['main_content'] = 'login/login_step04.php';
            $this->load->view('login', $data);
        }
        else
            redirect('login/index/', 'refresh');
    }

    function logout() {
        $logout = $this->ion_auth->logout();

        redirect('login/index', 'refresh');
    }

    // set empty default form field values
    function _set_fields() {
        $this->form_data->acc_number = '';
        $this->form_data->password = '';
    }

    function _set_rules() {
        //validate form input
        $this->form_validation->set_rules('acc_number', 'Account number', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    }

    function check_captcha($val) {

        if ($this->recaptcha->check_answer($this->input->ip_address(), $this->input->post('recaptcha_challenge_field'), $val)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_captcha', $this->lang->line('recaptcha_incorrect_response'));
            return FALSE;
        }
    }

    function check_pin($pin) {
        $this->load->model('user_model', '', TRUE);

        if (!$this->user_model->check_more($this->email, 'login_pin', $pin)) {
            $this->form_validation->set_message('check_pin', "The login PIN is not valid. Please try again.");

            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function check_block($acc_number) {
        $this->load->model('user_model', '', TRUE);
        if ($this->user_model->check_block($acc_number)) {
            $this->form_validation->set_message('check_block', 'This account is blocked.');
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