<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Adminconfig
 *
 * @author ngoalongkt
 */
class Config extends MY_Controller {

    
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
            'href' => admin_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Configuration',
            'href' => admin_url('config'),
            'separator' => ' :: '
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Withdrawal',
            'href' => admin_url('config/withdrawal'),
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
            redirect(admin_url('config/withdrawal'));
        }
        $this->view('admin/config/withdrawal', 'admin');
    }

    public function index() {
        $this->data['title'] = 'Configuration';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => admin_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Configuration',
            'href' => admin_url('config'),
            'separator' => ' :: '
        );
        $class_methods = get_class_methods($this);
        $f_reflect = new ReflectionObject($this);
        foreach ($f_reflect->getMethods() as $method) {
            if ($method->isPublic() && !in_array($method->name, array('__construct', 'index', 'get_instance','view'))) {
                $method_name = $method->name;
                $method_data = array(
                    'key' => $method_name,
                    'name' => $this->$method_name,
                    'status' => $this->configs->isActived($method_name)
                );

                $this->data['configs'][] = $method_data;
            }
        }

        $this->data['main_content'] = 'config/index';
        
        $this->view('admin/config/index','admin');  
    }

    public function emails() {
        $this->data['title'] = 'Config Emails';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => admin_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Configuration',
            'href' => admin_url('config'),
            'separator' => ' :: '
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Emails',
            'href' => admin_url('config/emails'),
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
            redirect(admin_url('config/emails'));
        }
        $this->view('admin/config/emails', 'admin');
    }

    public function transaction_fees() {
        $code = 'transaction_fees';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => admin_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Configuration',
            'href' => admin_url('config'),
            'separator' => ' :: '
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Transaction Fee',
            'href' => admin_url('config/transaction_fees'),
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
            redirect(admin_url('config/' . $code));
        }

        $this->view('admin/config/transaction_fees', 'admin');
    }

    public function referral() {
        $code = 'referral';
        $this->data['title'] = 'Config Referral';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => admin_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Configuration',
            'href' => admin_url('config'),
            'separator' => ' :: '
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Referral',
            'href' => admin_url('config/referral'),
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
            redirect(admin_url('config/referral'));
        }

        $this->view('admin/config/referral', 'admin');
    }

    public function timeconfig() {
        $code = 'timeconfig';
        $this->data['title'] = 'Time config';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => admin_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Configuration',
            'href' => admin_url('config'),
            'separator' => ' :: '
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Date/Time',
            'href' => admin_url('config/timeconfig'),
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
            redirect('config/' . $code);
        }

        $this->view('admin/config/timeconfig', 'admin');
    }
    
    public function referraldefault(){
        $code = 'referraldefault';
        $this->data['title'] = 'Referral Default Config';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => admin_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Configuration',
            'href' => admin_url('config'),
            'separator' => ' :: '
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Referral Default Config',
            'href' => admin_url('config/referraldefault'),
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
            redirect(admin_url('config/' . $code));
        }

        $this->view('admin/config/referraldefault', 'admin');
    }
    
    public function levelupdate(){
        $code = 'levelupdate';
        $this->data['title'] = 'Level Update Config';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => admin_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Configuration',
            'href' => admin_url('config'),
            'separator' => ' :: '
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Referral Default Config',
            'href' => admin_url('config/referraldefault'),
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
            redirect(admin_url('config/' . $code));
        }

        $this->view('admin/config/levelupdate', 'admin');
    }

}

?>
