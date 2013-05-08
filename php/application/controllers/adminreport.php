<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of adminreport
 *
 * @author ngoalongkt
 */
class Adminreport extends MY_Controller {

    private $data;
    var $menu_config_0 = array('', '', '', '', '', '');
    var $menu_config_1 = array('active', '', '', '', '', '');
    var $menu_config_2 = array('', 'active', '', '', '', '');
    var $menu_config_3 = array('', '', 'active', '', '', '');
    var $menu_config_4 = array('', '', '', 'active', '', '');
    var $menu_config_5 = array('', '', '', '', 'active', '');
    var $menu_config_6 = array('', '', '', '', '', 'active');
    var $navstack = null;
    var $usertype = array('0' => 'Member', '1' => 'Silver', '2' => 'Gold');

    public function __construct() {

        parent::__construct();

        $this->load->model('user_model', 'user');
        $this->load->model('balance_model', 'balance');
        $this->load->model('transaction_model', 'transaction');
        $this->data['menu_config'] = $this->menu_config_5;
        $user_session = $this->session->userdata('user');
        if (empty($user_session) || $user_session['permission'] != 'administrator') {
            redirect(site_url('home'));
        }
        $this->data['user_session'] = $user_session;
    }
    
    public function index(){
        $this->data['main_content'] = 'includes/main_content.php';
        $this->data['title'] = 'Report';
        
        $this->data['main_content'] = 'adminreport/index';
        $this->load->view('administrator', $this->data);
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        if(!empty($start_date))
        $user_count = $this->user->totalUser();
        
        
    }

}

?>
