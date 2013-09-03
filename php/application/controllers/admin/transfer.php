<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transfer extends MY_Controller {

    var $navstack = null;
    var $usertype = array('0' => 'Member', '1' => 'Silver', '2' => 'Gold');

    public function __construct() {
        parent::__construct();
        $this->load->model('transaction_model', 'transfer');
        $this->load->model('user_model', 'user');
        $this->data['menu_config'] = $this->menu_config_6;
        $user_session = $this->session->userdata('user');
        if (empty($user_session) || $user_session['permission'] != 'administrator') {
            redirect(site_url('home'));
        }
        $this->data['user_session'] = $user_session;
    }

    public function index($user_id = 0) {
        $this->data['title'] = 'Manager Transaction';
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => admin_url('account'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Transaction History',
            'href' => admin_url('transfer/index'),
            'separator' => ' :: '
        );
        $user = $this->user->getMainUserByMainId($user_id);
        $this->data['user'] = $user;
        $this->data['user_id'] = $user_id;

        $this->data['main_content'] = 'transfer/index';
        $this->view('admin/transfer/index', 'admin');
    }

    public function listtransfer($start = 0) {

        $posts = $this->input->post();
        $this->config->load('cya_config', TRUE);
        $dataWhere = array();
        if ($posts['type'] != '')
            $dataWhere['transaction.transaction_type'] = $posts['type'];
        if(!empty($posts['user_id'])){
            $dataWhere['transaction.main_user_id'] = $posts['user_id'];
        }
        $dataWhere['searchby'] = $posts['searchby'];
        $limit = $this->config->item('limit_page');
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
        $config["base_url"] = admin_url('transfer/listtransfer');
        $config["per_page"] = $limit;
        $page = $start;
        $config["uri_segment"] = 4;
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
                'acount_number' => $transfer->acount_number,
                'username' => $transfer->username,
                'fees' => $transfer->fees,
                'total' => $transfer->total,
                'transaction_type' => $transfer->transaction_type,
                'transaction_source' => $transfer->transaction_source,
                'payment_status' => $transfer->payment_status,
                'created' => $transfer->created,
                'description' => $transfer->description,
            );
        }

        $json['users'] = $this->load->view('admin/transfer/listtransfer', $this->data, true);
        echo json_encode($json);
    }

}

?>