<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Admin User page controller
 * @author	KhiemPham <khiemktqd@gmail.com>
 * @date	02/05/2013
 */
class Adminuser extends MY_Controller {
    
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
        $this->data['user'] = $this->user->getSessionUserDetails();
    }   

    public function index() {
        $this->data['title'] = 'Job Management | William Loud Australia PTY LTD';
        $this->load->View('home', $this->data);
    }

}

?>