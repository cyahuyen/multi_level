<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Home page controller
 * @author	Dean Gleeson <dean.gleeson@pragmaticsystems.com.au>
 * @date	21/04/2013
 */
class Home extends MY_Controller {

    var $menu_config_user_none = array('', '', '', '', '', '');
    var $menu_config_user_home = array('active', '', '', '', '', '');
    var $menu_config_user_user = array('', 'active', '', '', '', '');
    var $menu_config_user_jobs = array('', '', 'active', '', '', '');
    var $menu_config_user_staff = array('', '', '', 'active', '', '');
    var $menu_config_user_timesheets = array('', '', '', '', 'active', '');
    var $menu_config_user_reports = array('', '', '', '', '', 'active');
    var $menu_config_admin_none = array('', '', '');
    var $menu_config_admin_home = array('active', '', '');
    var $menu_config_admin_users = array('', 'active', '');
    var $menu_config_admin_reports = array('', '', 'active');

    public function __construct() {

        parent::__construct();
//        if (!$this->session->userdata('is_logged_in')) 
//        {
//            redirect('authentication');
//        } 
//        else 
//        {
        $this->load->model('user_model', 'user');
//        }
    }

    public function index() {
        $data['title'] = 'Job Management | William Loud Australia PTY LTD';
        $data['main_content'] = 'includes/main_content.php';
        $data['menu_config'] = $this->menu_config_user_home;
        $data['user'] = $this->user->getSessionUserDetails();
        $this->load->View('home', $data);
    }

}

?>