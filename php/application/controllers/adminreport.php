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
        
        
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $this->data['start_date']= $start_date;
        $this->data['end_date']= $end_date;
        $data = array();
        
        $data['permission'] = null;
        if(!empty($start_date))
            $data['created_on >='] = $start_date .' 00:00:00'; 
        if(!empty($end_date))
            $data['created_on <='] = $end_date .' 23:59:59'; 
        $dataSilver = array_merge($data,array('usertype' => 1));
        $dataGold = array_merge($data,array('usertype' => 2));
        $dataUser = array_merge($data,array('usertype' => 0));
        
        $this->data['user_count'] = $this->user->totalUser($data);
        $this->data['silver_count'] = $this->user->totalUser($dataSilver);
        $this->data['gold_count'] = $this->user->totalUser($dataGold);
        $this->data['member_count'] = $this->user->totalUser($dataUser);
        $this->data['balance'] = $this->balance->getAdminBalance();
        $this->data['main_content'] = 'adminreport/index';
        $this->load->view('administrator', $this->data);
        
        
    }

}

?>
