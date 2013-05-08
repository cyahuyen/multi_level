<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Home page controller
 * @author	Dean Gleeson <dean.gleeson@pragmaticsystems.com.au>
 * @date	21/04/2013
 */
class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) {
            redirect('authentication');
        } else {
            $this->load->model('user_model', 'user');
        }
    }

    public function index() {
        
    }

    public function manage() {
        $data['user'] = $this->user->getSessionUserDetails();

        if ($data['user'][0]->usertype != 'Administrator')
            redirect(site_url('home'));


        $this->navigation->loadManageUserView($data);
    }

    public function profile($id = 0) {
        $data['user'] = $this->user->getSessionUserDetails();
        if (!empty($id))
            $data['userdata'] = $this->user->getUserById($id);
        if ($data['user'][0]->usertype != 'Administrator')
            redirect(site_url('home'));

        $data['posts'] = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = $this->input->post();
            $validationErrors = array();
            if ($posts['fullname'] == '') {
                $validationErrors['fullname'] = "Your name is Fullname cannot be blank";
            }
            if ($posts['email'] == '') {
                $validationErrors['email'] = "Email cannot be blank";
            }
            if (!empty($id) && !empty($posts['password'])) {
                if ($posts['password'] < 6) {
                    $validationErrors['password'] = "password greater than 6 character";
                }

                if ($posts['password'] != $posts['repassword']) {
                    $validationErrors['repassword'] = "password wrong";
                }
            }
            if (empty($id)) {
                if (strlen($posts['password']) < 6) {
                    $validationErrors['password'] = "password greater than 6 character";
                }

                if ($posts['password'] != $posts['repassword']) {
                    $validationErrors['repassword'] = "password wrong";
                }
            }

            $data['posts'] = $posts;
            foreach ($posts as $key => $val) {
                $data['userdata']->$key = $val;
            }


            if (count($validationErrors) != 0) {
                $data['usermessage'] = array('error', 'darkred', 'Validation errors found', 'Please see below');
                $data['fielderrors'] = $validationErrors;
            } else {
                $id = (int) $id;
                if (empty($id)) {
                    $id = $this->user->insert($posts);
                    $data['usermessage'] = array('success', 'green', 'Successfully saved ', '');
                    $this->session->set_flashdata(array('usermessage' => $data['usermessage']));
                    redirect(site_url('user/profile/' . $id));
                } else {
                    $this->user->update($posts, $id);
                    $data['usermessage'] = array('success', 'green', 'Successfully saved', '');
                    $this->session->set_flashdata(array('usermessage' => $data['usermessage']));
                    redirect(site_url('user/profile/' . $id));
                }
            }
        }
        $this->navigation->loadProfileUserView($data);
    }

    public function userlist($status = null) {

        $data['user'] = $this->user->getSessionUserDetails();
        $posts = $this->input->post();
        $this->config->load('cya_config', TRUE);
        $dataWhere['status'] = 1;
        $dataWhere['searchby'] = $posts['searchby'];
        $limit = $this->config->item('limit_page', 'my_config');
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
        $data['users'] = $this->user->listUser($dataWhere, $limit, $start, $sort);
        $json['users'] = $this->load->view('user/userlist', $data, true);
        echo json_encode($json);
    }

    public function deactive() {
        $id = $this->input->post('id');
        $this->user->deactive($id);
    }

}

?>