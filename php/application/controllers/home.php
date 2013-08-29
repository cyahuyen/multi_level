<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Home page controller
 * @author	Khiem Pham <khiemktqd@gmail.com>
 * @date	21/04/2013
 */
class Home extends MY_Controller {

    var $navstack = null;

    public function __construct() {
        parent::__construct();

        $this->load->model('user_model', 'user');
        $this->data['menu_config'] = $this->menu_config_1;
        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }elseif($this->input->get('success') == 1){
            $this->data['usermessage'] = array('success', 'green', 'Thank you for registering!', '');;
        }

        $this->data['user_session'] = $this->session->userdata('user');
        $user_session = $this->session->userdata('user');
        if (!empty($user_session) && $user_session['permission'] == 'administrator') {
            redirect(admin_url('admin'));
        }
    }

    public function index() {
        $user = $this->session->userdata('user');
        $this->load->model('activity_model', 'activity');

        if (!empty($this->data['user_session'])) {
            $dataWhere['main_user_id'] = $user['main_id'];

            $limit = $this->config->item('limit_page');
            $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

//       Begin pagination
            $this->load->library("pagination");
            $config = array();
            $config["total_rows"] = $this->activity->totalActivities($dataWhere);
            $config["base_url"] = site_url('home/index/');
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

            $this->data['activities'] = $this->activity->getActivities($dataWhere, $limit, $start);

            $this->data['main_content'] = 'home/index';
            $this->data['title'] = 'Multi Level Marketing';
            $this->load->View('home', $this->data);
        } else {
            $this->data['main_content'] = 'includes/main_content.php';
            $this->data['title'] = 'Multi Level Marketing';
            $this->load->View('home', $this->data);
        }
    }

}

?>