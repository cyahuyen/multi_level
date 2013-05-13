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
    
    var $navstack = null;
    public function __construct() {

        parent::__construct();
        
        $this->load->model('user_model', 'user');
        $this->data['menu_config'] = $this->menu_config_6;
        
       
        $user_session = $this->session->userdata('user');
        $this->data['user_session'] = $user_session;
        if (empty($user_session) || $user_session['permission'] != 'administrator') {
            redirect(site_url('home'));
        }
    }   

    public function index() {
        $this->data['main_content'] = 'includes/main_content.php';
        $this->data['title'] = 'Job Management | William Loud Australia PTY LTD';
        $this->load->View('administrator', $this->data);
    }

}

?>