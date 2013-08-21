<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Adminmodule
 *
 * @author ngoalongkt
 */
class Module extends MY_Controller {

    var $navstack = null;
    var $paypal = 'Paypal';
    var $credit_card = 'Credit Cart Payment';

    public function __construct() {

        parent::__construct();

        $this->load->model('user_model', 'user');
        $this->load->model('config_model', 'configs');
        $this->data['menu_config'] = $this->menu_config_4;
        $user_session = $this->session->userdata('user');

        if (empty($user_session) || $user_session['permission'] != 'administrator') {
            redirect(site_url('home'));
        }
    }

    public function index() {
        
    }

    public function payment() {
        $this->data['title'] = 'Manager Config';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => admin_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Manager Config',
            'href' => admin_url('module/payment'),
            'separator' => ' :: '
        );
        $this->data['list_payment'] = $this->configs->listPayment();

        $this->data['main_content'] = 'module/payment';
        $this->load->view('administrator', $this->data);
    }

    public function paypal() {

        $this->data['title'] = 'Config Paypal';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => admin_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Config Paypal',
            'href' => admin_url('module/paypal'),
            'separator' => ' :: '
        );
        $this->data['data_configs'] = $this->configs->getConfigs('paypal');
        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = $this->input->post();
            unset($posts['save-btn']);

            $this->configs->editConfigs('paypal', 'payment', $posts);
            $data['usermessage'] = array('success', 'green', 'Successfully saved ', '');
            $this->session->set_flashdata(array('usermessage' => $data['usermessage']));
            redirect(admin_url('module/paypal'));
        }
        $this->view('admin/module/paypal', 'admin');
    }

    public function creditcard() {
        $code = 'creditcard';
        $this->data['title'] = 'Config Referral';
        $this->data['data_configs'] = $this->configs->getConfigs($code);
        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = $this->input->post();
            unset($posts['save-btn']);

            $this->configs->editConfigs($code, 'payment', $posts);
            $data['usermessage'] = array('success', 'green', 'Successfully saved ', '');
            $this->session->set_flashdata(array('usermessage' => $data['usermessage']));
            redirect(admin_url('module/' . $code));
        }

        $this->view('admin/module/credit_card', 'admin');
    }

}

?>
