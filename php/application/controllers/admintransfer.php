<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admintransfer extends MY_Controller {

    private $data;
    var $menu_config_0 = array('', '', '', '', '', '');
    var $menu_config_1 = array('active', '', '', '', '', '');
    var $menu_config_2 = array('', 'active', '', '', '', '');
    var $menu_config_3 = array('', '', 'active', '', '', '');
    var $menu_config_4 = array('', '', '', 'active', '', '');
    var $menu_config_5 = array('', '', '', '', 'active', '');
    var $menu_config_6 = array('', '', '', '', '', 'active');
    var $menu_config_7 = array('', '', '', '', '', '', 'active');
    var $navstack = null;
    var $usertype = array('0' => 'Member', '1' => 'Silver', '2' => 'Gold');

    public function __construct() {
        parent::__construct();
        $this->load->model('transaction_model', 'transfer');
        $this->data['menu_config'] = $this->menu_config_7;
        $user_session = $this->session->userdata('user');
        if (empty($user_session) || $user_session['permission'] != 'administrator') {
            redirect(site_url('home'));
        }
        $this->data['user_session'] = $user_session;
    }

    public function index() {
        $this->data['title'] = 'Manager Transaction';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => site_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Transfer',
            'href' => site_url('admintransfer/index'),
            'separator' => ' :: '
        );
        $posts = $this->input->post();
        $this->config->load('my_config', TRUE);
        $limit = $this->config->item('limit_page', 'my_config');
        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

//       Begin pagination
        $this->load->library("pagination");
        $config = array();
        $config["total_rows"] = $this->transfer->totalTransfer();
        $config["base_url"] = site_url('admintransfer/index');
        $config["per_page"] = $limit;
        $page = $start;
        $config["uri_segment"] = 3;
        $config['num_links'] = 2;
        $config['first_link'] = "<img src=" . base_url() . "/img/datalist/nav_first.jpg />";
        $config['first_tag_open'] = '<div class="nav-button">';
        $config['first_tag_close'] = '</div>';
        $config['last_link'] = "<img src=" . base_url() . "/img/datalist/nav_last.jpg />";
        $config['last_tag_open'] = '<div class="nav-button">';
        $config['last_tag_close'] = '</div>';
        $config['cur_tag_open'] = "<div class='nav-button'><div class='nav-page nav-page-selected'>";
        $config['cur_tag_close'] = '</div></div>';
        $config['num_tag_open'] = "<div class='nav-button'><div class='nav-page'>";
        $config['num_tag_close'] = '</div></div>';
        $config['prev_tag_open'] = "<div class='nav-button'>";
        $config['prev_link'] = "<img src=" . base_url() . "/img/datalist/nav_prev.jpg />";
        $config['prev_tag_close'] = '</div>';
        $config['next_link'] = "<img src=" . base_url() . "/img/datalist/nav_next.jpg />";
        $config['next_tag_open'] = "<div class='nav-button'>";
        $config['next_tag_close'] = '</div>';
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
//       End pagination
        $transfers = $this->transfer->getTransfers($limit, $start);
        $this->data['transfers'] = array();
        foreach ($transfers as $transfer) {
            $username = $this->transfer->getUser($transfer->user_id);
            $this->data['transfers'][] = array(
                'fullname' => $username,
                'fees' => $transfer->fees,
                'total' => $transfer->total,
                'transaction_type' => $transfer->transaction_type,
                'transaction_source' => $transfer->transaction_source,
                'payment_status' => $transfer->payment_status,
                'created' => $transfer->created,
            );
        }
        $this->data['main_content'] = 'admintransfer/index';
        $this->load->view('administrator', $this->data);
    }

}

?>