<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends CI_Controller {

    var $menu_config_0 = array('', '', '', '', '','');
    var $menu_config_1 = array('active', '', '', '', '','');
    var $menu_config_2 = array('', 'active', '', '', '','');
    var $menu_config_3 = array('', '', 'active', '', '','');
    var $menu_config_4 = array('', '', '', 'active', '','');
    var $menu_config_5 = array('', '', '', '', 'active','');
    var $menu_config_6 = array('', '', '', '', '','active');
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
        if (isset($posts['entry_amount'])) {
            $this->data['entry_amount'] = $posts['entry_amount'];
        } else {
            $this->data['entry_amount'] = '';
        }
        $this->data['main_content'] = 'register/register.php';

        $this->load->view('home', $this->data);
    }

    function get_suggest() {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->register_model->get_auto($q);
        }
    }

    public function paypal_return() {
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



            if ($posts['mc_gross'] > $transaction_fees['open_fee'])
                $postsData['usertype'] = 2;
//                $postsData['transaction_start'] = 2;
            else
                $postsData['usertype'] = 0;
            
            if (!empty($postsData['referring'])) {
                $userReferring = $this->user->getUserById($postsData['referring']);
                if (!$userReferring) {
                    unset($postsData['referring']);
                }
            }

            $user_id = $this->register_model->save($postsData);

            $dataTransaction['user_id'] = $user_id;
            $dataTransaction['open_fees'] = $transaction_fees['open_fee'];
            $dataTransaction['total_fees'] = $posts['mc_gross'];
            $dataTransaction['transaction_id'] = $posts['txn_id'];
            $dataTransaction['payment_status'] = $posts['payment_status'];
            $dataTransaction['transaction_source'] = 'paypal';
            $this->transaction->insert($dataTransaction);

            $current_fees = $dataTransaction['total_fees'] - $dataTransaction['open_fees'];
            $this->balance->updateBalance($user_id, $current_fees);



            if ($posts['mc_gross'] > $transaction_fees['open_fee']) {
                $this->user->updateTransaction($user_id);
            }

            $userHtml = '
                Thank you for registering <br>
                You just sign up at. Please login to check your account';
            $userHtml .= 'Acount Type: ' . $this->usertype[$postsData['usertype']]. '<br>';
            if ($posts['mc_gross'] > $transaction_fees['open_fee']) {
                $userHtml .= 'Payment :' . $posts['mc_gross'] - $transaction_fees['open_fee'] . '<br>';
                
            }

            sendmail($postsData['email'], 'Thank you for registering', $userHtml, null, 'Admin Manager', 'html');

            $adminHtml = 'Have just new member register<br>';
            $adminHtml .= 'Full name: ' . $postsData['fullname'] . '<br>';
            $adminHtml .= 'Address: ' . $postsData['address'] . '<br>';
            $adminHtml .= 'Phone: ' . $postsData['phone'] . '<br>';
            $adminHtml .= 'Email: ' . $postsData['email'] . '<br>';
            $adminHtml .= 'Birthday: ' . $postsData['birthday'] . '<br>';
            $adminHtml .= 'Birthday: ' . $postsData['birthday'] . '<br>';
            $adminHtml .= 'payment: ' . $posts['mc_gross'] . '<br>';
            $adminHtml .= 'Type: ' . $this->usertype[$postsData['usertype']] . '<br>';

            sendmail(null, 'Have just new member register', $adminHtml);

            if (!empty($postsData['referring'])) {
                $email_referring = $this->register_model->getEmailbyUser($postsData['referring']);
                $this->user->updateUserType($postsData['referring']);
                $this->transaction->updateRefereFees($postsData['referring']);
                $userReferring = $this->user->getUserById($postsData['referring']);
                if ($userReferring) {
                    $referral_config = $this->configs->getConfigs('referral');
                    $total_fees = 0;
                    if ($userReferring->usertype == 1)
                        $total_fees = $referral_config['silver_fees'];
                    elseif ($userReferring->usertype == 2)
                        $total_fees = $referral_config['gold_fees'];
                    $this->balance->updateBalance($postsData['referring'], $total_fees);
                }


                $referringHtml = 'Your referring member ' . $postsData['fullname'] . ' just sign up at.';
                sendmail($email_referring, 'Your referring member', $referringHtml, null, null, 'html');
            }
            $data['usermessage'] = array('success', 'green', 'Thank you for registering!', '');
            $this->session->set_flashdata('usermessage', $data['usermessage']);
        }
        redirect('home');
    }

    public function cancel_return() {
        $error = array('error', 'darkred', 'Transaction is cancel', '');
        $this->session->set_flashdata(array('usermessage' => $error));
        redirect('register');
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
                $this->register_model->update(array('forgotten_password_code' => $data['forget_code']),$id);
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
                $this->register_model->update($update_data, $id);
                $data['main_content'] = 'register/reset_pass_step4.php';
                $this->load->view('home', $data);
            }
        }
        else
            redirect('register/index/', 'refresh');
    }

    public function checkEmail() {
        $email = $this->input->get('email');
        if ($this->register_model->checkEmail($email)) {
//            $this->form_validation->set_message('checkEmail', 'This e-mail is already registered in our system. Please use a different one.');
//            return FALSE;
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

}