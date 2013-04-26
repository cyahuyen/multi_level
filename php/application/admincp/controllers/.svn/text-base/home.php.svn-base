<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('document');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->lang->load('home');
        $this->load->model('admin_model', '', TRUE);

        if ((!$this->session->userdata('admin_logged')) || (!$this->ion_auth->logged_in())) {
            redirect('login/index', 'refresh');
        }
    }

    public function index() {
        $this->document->setTitle($this->lang->line('site_title'));

        $data['title'] = $this->document->getTitle();

        $session = $this->session->flashdata('permission');
        if (isset($session)) {
            $data['notice_permission'] = $this->session->flashdata('permission');
        } else {
            $data['notice_permission'] = '';
        }

        $data['main_content'] = 'includes/main_content.php';

        $this->load->view('main_board', $data);
    }

}