<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Faq page controller
 * @author	Khiem Pham <khiemktqd@gmail.com>
 * @date	20/06/2013
 */
class Faq extends MY_Controller {
    
    public function __construct() {
        parent::__construct();

        $this->load->model('user_model', 'user');
        $this->data['menu_config'] = $this->menu_config_6;
        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        if (!$this->session->userdata('user')) {
            redirect('authentication', 'refresh');
        }
        $this->data['user_session'] = $this->session->userdata('user');
        $user_session = $this->session->userdata('user');
        if (!empty($user_session) && $user_session['permission'] == 'administrator') {
            redirect(site_url('admin'));
        }
    }
    
    public function question(){
        $this->data['main_content'] = 'faq/question';
        $this->data['title'] = 'Question';
        $this->load->View('home', $this->data);
    }
    
    public function answer(){
        $this->data['main_content'] = 'faq/answer';
        $this->data['title'] = 'Answer';
        $this->load->View('home', $this->data);
    }

}