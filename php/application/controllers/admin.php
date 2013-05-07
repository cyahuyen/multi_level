<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Home page controller
 * @author	Dean Gleeson <dean.gleeson@pragmaticsystems.com.au>
 * @date	21/04/2013
 */
class Admin extends MY_Controller {
    
    private $data;
    
    var $menu_config_0 = array('', '', '', '', '','');
    var $menu_config_1 = array('active', '', '', '', '','');
    var $menu_config_2 = array('', 'active', '', '', '','');
    var $menu_config_3 = array('', '', 'active', '', '','');
    var $menu_config_4 = array('', '', '', 'active', '','');
    var $menu_config_5 = array('', '', '', '', 'active','');
    var $menu_config_6 = array('', '', '', '', '','active');
    var $navstack = null;
    public function __construct() {

        parent::__construct();
        
        $this->load->model('user_model', 'user');
        $this->data['menu_config'] = $this->menu_config_1;
        
        $user_session = $this->session->userdata('user');
        if (empty($user_session) || $user_session['permission'] != 'administrator') {
            redirect(site_url('home'));
        }
        $this->data['user_session'] = $user_session;
    }   

    public function index() {
        $this->data['main_content'] = 'includes/main_content.php';
        $this->data['title'] = 'Job Management | William Loud Australia PTY LTD';
        $this->load->View('administrator', $this->data);
    }

}

?>