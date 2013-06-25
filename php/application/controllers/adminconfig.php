<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Adminconfig
 *
 * @author ngoalongkt
 */
class Adminconfig extends MY_Controller {

    
    var $navstack = null;
    var $emails = 'Email Config';
    var $transaction_fees = 'Transaction Fees';
    var $referral = 'Referral';
    var $timeconfig = 'Time Config';
    var $referraldefault = 'Referral Default Config';
    var $withdrawal = 'Withdrawal Config';
    var $levelupdate = 'Level Update Config';

    public function __construct() {

        parent::__construct();

        $this->load->model('user_model', 'user');
        $this->load->model('config_model', 'configs');
        $this->data['menu_config'] = $this->menu_config_3;
        $user_session = $this->session->userdata('user');
        if (empty($user_session) || $user_session['permission'] != 'administrator') {
            redirect(site_url('home'));
        }
        $this->data['user_session'] = $user_session;
    }
    
    public function withdrawal(){
        $this->data['title'] = 'Config Emails';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => site_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Configuration',
            'href' => site_url('adminconfig'),
            'separator' => ' :: '
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Withdrawal',
            'href' => site_url('adminconfig/withdrawal'),
            'separator' => ' :: '
        );
        $this->data['data_configs'] = $this->configs->getConfigs('withdrawal');
        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = $this->input->post();
            unset($posts['save-btn']);
            $posts['group'] = 'config';
            $this->configs->editConfigs('withdrawal', 'config', $posts);
            $data['usermessage'] = array('success', 'green', 'Successfully saved ', '');
            $this->session->set_flashdata(array('usermessage' => $data['usermessage']));
            redirect('adminconfig/withdrawal');
        }
        $this->data['main_content'] = 'adminconfig/withdrawal';
        $this->load->view('administrator', $this->data);
    }

    public function index() {
        $this->data['title'] = 'Configuration';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => site_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Configuration',
            'href' => site_url('adminconfig'),
            'separator' => ' :: '
        );
        $class_methods = get_class_methods($this);
        $f_reflect = new ReflectionObject($this);
        foreach ($f_reflect->getMethods() as $method) {
            if ($method->isPublic() && !in_array($method->name, array('__construct', 'index', 'get_instance'))) {
                $method_name = $method->name;
                $method_data = array(
                    'key' => $method_name,
                    'name' => $this->$method_name,
                    'status' => $this->configs->isActived($method_name)
                );

                $this->data['configs'][] = $method_data;
            }
        }

        $this->data['main_content'] = 'adminconfig/index';
        $this->load->view('administrator', $this->data);
    }

    public function emails() {
        $this->data['title'] = 'Config Emails';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => site_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Configuration',
            'href' => site_url('adminconfig'),
            'separator' => ' :: '
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Emails',
            'href' => site_url('adminconfig/emails'),
            'separator' => ' :: '
        );
        $this->data['data_configs'] = $this->configs->getConfigs('emails');
        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = $this->input->post();
            unset($posts['save-btn']);
            $posts['group'] = 'config';
            $this->configs->editConfigs('emails', 'config', $posts);
            $data['usermessage'] = array('success', 'green', 'Successfully saved ', '');
            $this->session->set_flashdata(array('usermessage' => $data['usermessage']));
            redirect('adminconfig/emails');
        }
        $this->data['main_content'] = 'adminconfig/emails';
        $this->load->view('administrator', $this->data);
    }

    public function transaction_fees() {
        $code = 'transaction_fees';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => site_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Configuration',
            'href' => site_url('adminconfig'),
            'separator' => ' :: '
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Transaction Fee',
            'href' => site_url('adminconfig/transaction_fees'),
            'separator' => ' :: '
        );
        $this->data['title'] = 'Config Transaction Fees';
        $this->data['data_configs'] = $this->configs->getConfigs($code);
        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = $this->input->post();
            unset($posts['save-btn']);
            $posts['group'] = 'config';
            $this->configs->editConfigs($code, 'config', $posts);
            $data['usermessage'] = array('success', 'green', 'Successfully saved ', '');
            $this->session->set_flashdata(array('usermessage' => $data['usermessage']));
            redirect('adminconfig/' . $code);
        }

        $this->data['main_content'] = 'adminconfig/transaction_fees';
        $this->load->view('administrator', $this->data);
    }

    public function referral() {
        $code = 'referral';
        $this->data['title'] = 'Config Referral';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => site_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Configuration',
            'href' => site_url('adminconfig'),
            'separator' => ' :: '
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Referral',
            'href' => site_url('adminconfig/referral'),
            'separator' => ' :: '
        );
        $this->data['data_configs'] = $this->configs->getConfigs($code);
        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = $this->input->post();
            unset($posts['save-btn']);
            $this->configs->editConfigs($code, 'config', $posts);
            $data['usermessage'] = array('success', 'green', 'Successfully saved ', '');
            $this->session->set_flashdata(array('usermessage' => $data['usermessage']));
            redirect('adminconfig/' . $code);
        }

        $this->data['main_content'] = 'adminconfig/referral';
        $this->load->view('administrator', $this->data);
    }

    public function timeconfig() {
        $code = 'timeconfig';
        $this->data['title'] = 'Time config';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => site_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Configuration',
            'href' => site_url('adminconfig'),
            'separator' => ' :: '
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Date/Time',
            'href' => site_url('adminconfig/timeconfig'),
            'separator' => ' :: '
        );
        $this->data['data_configs'] = $this->configs->getConfigs($code);
        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = $this->input->post();
            unset($posts['save-btn']);
            $this->configs->editConfigs($code, 'config', $posts);
            $data['usermessage'] = array('success', 'green', 'Successfully saved ', '');
            $this->session->set_flashdata(array('usermessage' => $data['usermessage']));
            redirect('adminconfig/' . $code);
        }

        $this->data['main_content'] = 'adminconfig/timeconfig';
        $this->load->view('administrator', $this->data);
    }
    
    public function referraldefault(){
        $code = 'referraldefault';
        $this->data['title'] = 'Referral Default Config';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => site_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Configuration',
            'href' => site_url('adminconfig'),
            'separator' => ' :: '
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Referral Default Config',
            'href' => site_url('adminconfig/referraldefault'),
            'separator' => ' :: '
        );
        $this->data['data_configs'] = $this->configs->getConfigs($code);
        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = $this->input->post();
            unset($posts['save-btn']);
            $this->configs->editConfigs($code, 'config', $posts);
            $data['usermessage'] = array('success', 'green', 'Successfully saved ', '');
            $this->session->set_flashdata(array('usermessage' => $data['usermessage']));
            redirect('adminconfig/' . $code);
        }

        $this->data['main_content'] = 'adminconfig/referraldefault';
        $this->load->view('administrator', $this->data);
    }
    
    public function levelupdate(){
        $code = 'levelupdate';
        $this->data['title'] = 'Level Update Config';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => site_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Configuration',
            'href' => site_url('adminconfig'),
            'separator' => ' :: '
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Referral Default Config',
            'href' => site_url('adminconfig/referraldefault'),
            'separator' => ' :: '
        );
        $this->data['data_configs'] = $this->configs->getConfigs($code);
        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = $this->input->post();
            unset($posts['save-btn']);
            $this->configs->editConfigs($code, 'config', $posts);
            $data['usermessage'] = array('success', 'green', 'Successfully saved ', '');
            $this->session->set_flashdata(array('usermessage' => $data['usermessage']));
            redirect('adminconfig/' . $code);
        }

        $this->data['main_content'] = 'adminconfig/levelupdate';
        $this->load->view('administrator', $this->data);
    }

}

?>
