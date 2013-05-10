<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Adminmodule
 *
 * @author ngoalongkt
 */
class Adminmodule extends MY_Controller {

    private $data;
   
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
            'href' => site_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Manager Config',
            'href' => site_url('adminmodule/payment'),
            'separator' => ' :: '
        );
        $this->data['list_payment'] = $this->configs->listPayment();

        $this->data['main_content'] = 'adminmodule/payment';
        $this->load->view('administrator', $this->data);
    }

    public function paypal() {

        $this->data['title'] = 'Config Paypal';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => site_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Config Paypal',
            'href' => site_url('adminmodule/paypal'),
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
            redirect('adminmodule/paypal');
        }
        $this->data['main_content'] = 'adminmodule/paypal';
        $this->load->view('administrator', $this->data);
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
            redirect('adminmodule/' . $code);
        }

        $this->data['main_content'] = 'adminmodule/credit_card';
        $this->load->view('administrator', $this->data);
    }

}

?>
