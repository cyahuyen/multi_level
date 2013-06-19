<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admintransfer extends MY_Controller {

    var $navstack = null;
    var $usertype = array('0' => 'Member', '1' => 'Silver', '2' => 'Gold');

    public function __construct() {
        parent::__construct();
        $this->load->model('transaction_model', 'transfer');
        $this->data['menu_config'] = $this->menu_config_6;
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
            'text' => 'Transaction History',
            'href' => site_url('admintransfer/index'),
            'separator' => ' :: '
        );

        $this->data['main_content'] = 'admintransfer/index';
        $this->load->view('administrator', $this->data);
    }

    public function listtransfer() {

        $posts = $this->input->post();
        $this->config->load('cya_config', TRUE);
        $dataWhere = array();
        if ($posts['type'] != '')
            $dataWhere['transaction.transaction_type'] = $posts['type'];
        $dataWhere['searchby'] = $posts['searchby'];
        $limit = $this->config->item('limit_page', 'my_config');
        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $sort = array();
        if (!empty($posts['asc'])) {
            $sort[$posts['sort']] = 'ASC';
        } else {
            $sort[$posts['sort']] = 'DESC';
        }

//       Begin pagination
        $this->load->library("pagination");
        $config = array();
        $config["total_rows"] = $this->transfer->totalTransfer($dataWhere);
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
        $json["links"] = $this->pagination->create_links();
//       End pagination
        $transfers = $this->transfer->getTransfers($dataWhere, $limit, $start, $sort);
        $this->data['transfers'] = array();
        foreach ($transfers as $transfer) {
            $this->data['transfers'][] = array(
                'username' => $transfer->username,
                'fees' => $transfer->fees,
                'total' => $transfer->total,
                'transaction_type' => $transfer->transaction_type,
                'transaction_source' => $transfer->transaction_source,
                'payment_status' => $transfer->payment_status,
                'created' => $transfer->created,
            );
        }

        $json['users'] = $this->load->view('admintransfer/listtransfer', $this->data, true);
        echo json_encode($json);
    }

}

?>