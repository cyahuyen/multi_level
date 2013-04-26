<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->lang->load('home');
        $this->load->library('document');
    }

    public function index() {
        $this->document->setTitle('Register Member');
        $data['title'] = $this->document->getTitle();
        $data['quick_payment'] = $this->lang->line('quick_payment');
        $data['quick_content'] = $this->lang->line('quick_content');
        $data['text_join'] = $this->lang->line('text_join');
        $data['text_already'] = $this->lang->line('text_already');
        $data['text_signin'] = $this->lang->line('text_signin');
        $data['text_fast'] = $this->lang->line('text_fast');
        $data['text_private'] = $this->lang->line('text_private');
        $data['text_unique'] = $this->lang->line('text_unique');
        $data['text_making_payment'] = $this->lang->line('text_making_payment');
        $data['text_active_security'] = $this->lang->line('text_active_security');
        $data['text_stop_account'] = $this->lang->line('text_stop_account');
        $data['text_live_chat'] = $this->lang->line('text_live_chat');
        $data['text_have_question'] = $this->lang->line('text_have_question');
        $data['text_private_mess'] = $this->lang->line('text_private_mess');
        $data['text_sending_payment'] = $this->lang->line('text_sending_payment');
        $data['text_email_mess'] = $this->lang->line('text_email_mess');
        $data['text_fees_no'] = $this->lang->line('text_fees_no');
        $data['text_low_fee'] = $this->lang->line('text_low_fee');
        $data['text_no_charge'] = $this->lang->line('text_no_charge');
        $data['text_api'] = $this->lang->line('text_api');
        $data['text_most_advanced'] = $this->lang->line('text_most_advanced');

        $data['main_content'] = 'includes/main_content.php';

        $this->load->view('home', $data);
    }

}