<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Adminconfig
 *
 * @author ngoalongkt
 */
class Adminconfig extends MY_Controller {

    private $data;
    var $menu_config_0 = array('', '', '', '', '', '');
    var $menu_config_1 = array('active', '', '', '', '', '');
    var $menu_config_2 = array('', 'active', '', '', '', '');
    var $menu_config_3 = array('', '', 'active', '', '', '');
    var $menu_config_4 = array('', '', '', 'active', '', '');
    var $menu_config_5 = array('', '', '', '', 'active', '');
    var $menu_config_6 = array('', '', '', '', '', 'active');
    var $navstack = null;
    var $emails = 'Email Config';
    var $transaction_fees = 'Transaction Fees';
    var $referral = 'Referral';

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

    public function index() {
        $this->data['title'] = 'Manager Config';
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
        $this->data['data_configs'] = $this->configs->getConfigs('emails');
        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = $this->input->post();
            unset($posts['save-btn']);
            $posts['group'] = 'config';
            $this->configs->editConfigs('emails','config', $posts);
            $data['usermessage'] = array('success', 'green', 'Successfully saved ', '');
            $this->session->set_flashdata(array('usermessage' => $data['usermessage']));
            redirect('adminconfig/emails');
        }
        $this->data['main_content'] = 'adminconfig/emails';
        $this->load->view('administrator', $this->data);
    }

    public function transaction_fees() {
        $code = 'transaction_fees';
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
            $this->configs->editConfigs($code,'config', $posts);
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
        $this->data['data_configs'] = $this->configs->getConfigs($code);
        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = $this->input->post();
            unset($posts['save-btn']);
            $this->configs->editConfigs($code,'config', $posts);
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

}

?>