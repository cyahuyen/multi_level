<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Library class encapsulating navigation providing navigation methods.
 * @author 	Dean Gleeson <dean.gleeson@pragmaticsystems.com.au>
 * @date	15/03/2013
 */
class Navigation {

    var $ci;
    var $menu_config_user_none = array('', '', '', '', '','');
    var $menu_config_user_home = array('active', '', '', '', '','');
    var $menu_config_user_user = array('', 'active', '', '', '','');
    var $menu_config_user_jobs = array('', '', 'active', '', '','');
    var $menu_config_user_staff = array('', '', '', 'active', '','');
    var $menu_config_user_timesheets = array('', '', '', '', 'active','');
    var $menu_config_user_reports = array('', '', '', '', '','active');
    var $menu_config_admin_none = array('', '', '');
    var $menu_config_admin_home = array('active', '', '');
    var $menu_config_admin_users = array('', 'active', '');
    var $menu_config_admin_reports = array('', '', 'active');
    var $navstack = null;

    function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->library('template');
    }

    public function loadSigninView($data = array()) {
        $data['title'] = 'Sign-in';
        $this->ci->template->load('public', 'signin', $data);
    }

    public function loadMyProfileView($data = array()) {
        $data['title'] = 'My Profile';

        $data['menu_config'] = $this->menu_config_user_none;
        $this->ci->template->load('user', 'myprofile', $data);
    }

    public function loadHomeView($data = array()) {
        $data['title'] = 'Home';

        $data['menu_config'] = $this->menu_config_user_home;
        $this->ci->template->load('user', 'home', $data);
    }
    public function loadManageUserView($data = array()) {
        $data['title'] = 'Manager User';

        $data['menu_config'] = $this->menu_config_user_user;
        $this->ci->template->load('user', 'user/manager', $data);
    }
    public function loadProfileUserView($data = array()) {
        $data['title'] = '';

        $data['menu_config'] = $this->menu_config_user_user;
        $this->ci->template->load('user', 'user/profile', $data);
    }
    public function loadJobsView($data = array()) {
        $data['title'] = '';
        $data['menu_config'] = $this->menu_config_user_jobs;
        $this->ci->template->load('user', 'job/manage', $data);
    }
    
    public function loadProfileJobsView($data = array()) {
        $data['title'] = '';
        $data['menu_config'] = $this->menu_config_user_jobs;
        $this->ci->template->load('user', 'job/profile', $data);
    }
    
    public function loadProductView($data = array()) {
        $data['title'] = '';
        $data['menu_config'] = $this->menu_config_user_jobs;
        $this->ci->template->load('user', 'product/manage', $data);
    }
    
    public function loadProfileProductView($data = array()) {
        $data['title'] = '';
        $data['menu_config'] = $this->menu_config_user_jobs;
        $this->ci->template->load('user', 'product/profile', $data);
    }
    
    public function loadStaffView($data = array()) {
        $data['title'] = '';
        $data['menu_config'] = $this->menu_config_user_staff;
        $this->ci->template->load('user', 'staff/manage', $data);
    }
    public function loadHistoryStaffView($data = array()) {
        $data['title'] = '';
        $data['menu_config'] = $this->menu_config_user_staff;
        $this->ci->template->load('user', 'staff/history', $data);
    }
    
    public function loadProfileStaffView($data = array()) {
        $data['title'] = '';
        $data['menu_config'] = $this->menu_config_user_staff;
        $this->ci->template->load('user', 'staff/profile', $data);
    }

    /** Helper and utility functions */
    private function getTemplateForUser($data = array()) {

        return "user";
    }

    private function userIsAdmin($data = array()) {
        if ((isset($data['usertype']) && $data['usertype'] == "Administrator")
                || (isset($data['user']) && $data['user'][0]->usertype == "Administrator"))
            return true;
        return false;
    }

}
