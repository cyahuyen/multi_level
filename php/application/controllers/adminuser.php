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
    var $menu_config_0 = array('', '', '', '', '', '');
    var $menu_config_1 = array('active', '', '', '', '', '');
    var $menu_config_2 = array('', 'active', '', '', '', '');
    var $menu_config_3 = array('', '', 'active', '', '', '');
    var $menu_config_4 = array('', '', '', 'active', '', '');
    var $menu_config_5 = array('', '', '', '', 'active', '');
    var $menu_config_6 = array('', '', '', '', '', 'active');
    var $navstack = null;

    public function __construct() {

        parent::__construct();

        $this->load->model('user_model', 'user');
        $this->data['menu_config'] = $this->menu_config_2;
        $user_session = $this->session->userdata('user');
        if (!$user_session || $user_session['permission'] != 'administrator') {
            redirect(site_url('home'));
        }
        $this->data['user_session'] = $user_session;
    }

    public function index() {
        
    }

    public function manager() {
        $this->data['title'] = 'Manager User';
        $this->data['main_content'] = 'adminuser/manager';
        $this->load->view('administrator', $this->data);
    }
    
    
    public function userlist($status = null) {

        $posts = $this->input->post();

        $this->config->load('cya_config', TRUE);

        $this->session->set_userdata(array('userlist' => $posts));
        if ($posts['status'] != 'all')
            $dataWhere['status'] = $posts['status'] ;
        $dataWhere['searchby'] = $posts['searchby'];

        $limit = $this->config->item('per_page', 'cya_config');
        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if (!empty($posts['asc'])) {
            $sort[$posts['sort']] = 'ASC';
        } else {
            $sort[$posts['sort']] = 'DESC';
        }
        
//       Begin pagination
        $this->load->library("pagination");
        $config = array();
        $config["total_rows"] = $this->user->totalUser($dataWhere);
        $config["base_url"] = site_url('user/manage');
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
        
        $this->data['users'] = $this->user->listUser($dataWhere, $limit, $start, $sort);
        $json['users'] = $this->load->view('adminuser/userlist', $this->data, true);
        echo json_encode($json);
    }

}

?>