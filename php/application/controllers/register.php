<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends CI_Controller {

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
        $this->load->model('register_model', '', TRUE);
    }

    public function index() {
        $this->data['title'] = 'Sign Up';
        $posts = $this->input->post();
        $session = $this->session->flashdata('message');
        if (isset($session)) {
            $this->data['success'] = $session;
        } else {
            $this->data['success'] = '';
        }
        if (isset($posts['username'])) {
            $this->data['username'] = $posts['username'];
        } else {
            $this->data['username'] = '';
        }
        if (isset($posts['fullname'])) {
            $this->data['fullname'] = $posts['fullname'];
        } else {
            $this->data['fullname'] = '';
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
        if (isset($posts['fax'])) {
            $this->data['fax'] = $posts['fax'];
        } else {
            $this->data['fax'] = '';
        }
        if (isset($posts['birthday'])) {
            $this->data['birthday'] = $posts['birthday'];
        } else {
            $this->data['birthday'] = '';
        }
        if (isset($posts['referring'])) {
            $this->data['referring'] = $posts['referring'];
        } else {
            $this->data['referring'] = '';
        }
        $this->form_validation->set_rules('recaptcha_response_field', 'Captcha', 'required|callback_check_captcha');
        $this->data['recaptcha'] = $this->recaptcha->get_html();
        if (($this->input->server('REQUEST_METHOD') === 'POST') && $this->validateForm()) {

            $this->register_model->save($this->input->post());
            sendmail($this->data['email'], 'Thank you for registering', 'You just sign up at. Please login to check your account', 'admin@website.com', 'Admin Manager', 'html');
            if (!empty($posts['referring'])) {
                $email_referring = $this->register_model->getEmailbyUser($posts['referring']);
                sendmail($email_referring, 'Your referring member', 'Your referring member just sign up at.', 'admin@website.com', 'Admin Manager', 'html');
            }
            $this->session->set_flashdata('message', 'Thank you for registering!');

            redirect('home', 'refresh');
        }
        $this->data['menu_config'] = $this->menu_config_user_home;
        $this->data['main_content'] = 'register/register.php';

        $this->load->view('home', $this->data);
    }

    function get_suggest() {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->register_model->get_auto($q);
        }
    }

    public function forgot() {

        $data['menu_config'] = $this->menu_config_user_home;
        $data['title'] = 'Forgot password';
        $step = 0 + $this->input->post('step', TRUE);
        if ($step <= 1) {
            $this->form_validation->set_rules('email', 'E-mail', 'required|xss_clean|valid_email|max_length[64]|callback_check_email');
            $this->form_validation->set_message('valid_email', 'The %s field must contain a valid email address.');
            $this->form_validation->set_rules('recaptcha_response_field', 'Captcha', 'required|callback_check_captcha');
            $data['recaptcha'] = $this->recaptcha->get_html();
            if ($this->form_validation->run() == FALSE) {
                $data['main_content'] = 'register/reset_pass_step1.php';
                $this->load->view('home', $data);
            } else {
                $email_to = $this->input->post('email', TRUE);
                $user_email = $this->register_model->getEmmail($email_to);
                $data['email'] = $email_to;
                $id = $user_email->user_id;
                $data['forget_code'] = random_string('numeric', 10);
                $this->session->set_flashdata('step', 2);
                $data['main_content'] = 'register/reset_pass_step2.php';
                $this->register_model->update($id, array('forgotten_password_code' => $data['forget_code']));
                //======================= Send Email ====================================
                $title = "Forget Password";
                $content = "Code forget Password: '" . $data['forget_code'] . "'";
                sendmail($email_to, $title, $content, 'admin@website.com', 'Admin Manager', 'html');
                $this->load->view('home', $data);
                //==========================End send mail====================
            }
        } else if ($step == 2) {
            $email = $this->input->post('email', TRUE);
            $this->email = $email;
            $user_email = $this->register_model->getEmmail($email);
            $id = $user_email->user_id;
            $fp = $user_email->forgotten_password_code;
            if ($this->input->post('email')) {
                $data['email'] = $this->input->post('email');
            } else {
                $data['email'] = "";
            }
            $this->form_validation->set_rules('reset_code', 'Reset Code', 'required|trim|xss_clean|numeric|exact_length[10]|callback_checkResetcode');
            if ($this->form_validation->run() == FALSE) {
                $data['main_content'] = 'register/reset_pass_step2.php';
                $this->load->view('home', $data);
            } else {
                $data['main_content'] = 'register/reset_pass_step3.php';
                $this->load->view('home', $data);
            }
        } else if ($step == 3) {

            $data['email'] = $this->input->post('email', TRUE);
            $this->email = $data['email'];
            $email_user = $this->register_model->getEmmail($data['email']);
            $id = $email_user->user_id;
            $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|min_length[6]');
            $this->form_validation->set_rules('repassword', 'Second Password', 'required|trim|matches[password]');
            if ($this->form_validation->run() == FALSE) {
                $data['main_content'] = 'register/reset_pass_step3.php';
                $this->load->view('home', $data);
            } else {
                $new_pass = $this->input->post('password', TRUE);
                $password = md5($new_pass);
                $update_data = array('password' => $password);
                $this->register_model->update($id, $update_data);
                $data['main_content'] = 'register/reset_pass_step4.php';
                $this->load->view('home', $data);
            }
        }
        else
            redirect('register/index/', 'refresh');
    }

    public function checkEmail($email) {
        if ($this->register_model->checkEmail($email)) {
            $this->form_validation->set_message('checkEmail', 'This e-mail is already registered in our system. Please use a different one.');
            return FALSE;
        } else {
            return TRUE;
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

    public function checkUser($username) {
        if ($this->register_model->checkUser($username)) {
            $this->form_validation->set_message('checkUser', ' This User is already registered in our system. Please use a different one.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function validateForm() {
        $this->form_validation->set_rules('fullname', 'Full Name', 'required|trim|xss_clean|max_length[150]');
        $this->form_validation->set_rules('username', 'User Name', 'required|trim|xss_clean|max_length[50]|callback_checkUser');
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

}
