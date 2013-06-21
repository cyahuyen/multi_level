<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Admin User page controller
 * @author	KhiemPham <khiemktqd@gmail.com>
 * @date	02/05/2013
 */
class Adminuser extends MY_Controller {

    var $navstack = null;
    var $usertype = array('0' => 'Member', '1' => 'Silver', '2' => 'Gold');

    public function __construct() {

        parent::__construct();
        $this->load->model('user_model', 'user');
        $this->data['menu_config'] = $this->menu_config_2;
        $user_session = $this->session->userdata('user');
        
        if (empty($user_session) || $user_session['permission'] != 'administrator') {
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
            $dataWhere['status'] = $posts['status'];
        $dataWhere['searchby'] = $posts['searchby'];
        
        if(isset($posts['usertype']) && $posts['usertype'] != 'all'){
            $dataWhere['usertype'] = $posts['usertype'];
        }
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
        $config["base_url"] = site_url('user/userlist');
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

    public function profile($id = 0) {
        $this->data['title'] = 'Manager User';
        if (!empty($id))
            $this->data['userdata'] = $this->user->getUserById($id);
        $this->data['usertype'] = $this->usertype;

        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        $this->data['posts'] = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = $this->input->post();
            $validationErrors = array();
            if ($posts['firstname'] == '') {
                $validationErrors['firstname'] = "Your name is FirstName cannot be blank";
            }
            if ($posts['lastname'] == '') {
                $validationErrors['firstname'] = "Your name is Lastnamr cannot be blank";
            }
            if ($posts['email'] == '') {
                $validationErrors['email'] = "Email cannot be blank";
            } elseif ($this->user->checkEmailExists($posts['email'], $id) == true) {
                $validationErrors['email'] = "Email is exists";
            }

            $this->data['posts'] = $posts;
            foreach ($posts as $key => $val) {
                $this->data['userdata']->$key = $val;
            }
            if (count($validationErrors) != 0) {
                $this->data['usermessage'] = array('error', 'darkred', 'Validation errors found', 'Please see below');
                $this->data['fielderrors'] = $validationErrors;
            } else {
                $posts['status'] = 1;
                unset($posts['save-btn']);

                $id = (int) $id;
                if (empty($id)) {
                    $posts['usertype'] = 0;
                    $posts['username'] = 'U' . time();
                    $pass = hash_hmac('crc32b', $postsData['username'] . $this->config->item('prefix_key'), 'secret');
                    $posts['password'] = md5($pass);
                    $id = $this->user->insert($posts);
                    if (!empty($id)) {
                        $this->data['usermessage'] = array('success', 'green', 'Successfully saved ', '');
                        
                        $userEmailData['user_type'] = $this->usertype[$posts['usertype']];
                        $userEmailData['entry_amount'] = $posts['entry_amount'];
                        $userEmailData['username'] = $posts['username'];
                        $userEmailData['password'] = $pass;
                        
                        sendmailform($posts['email'], 'register', $userEmailData, null, 'Admin Manager', 'html');
                    }

                    else
                        $this->data['usermessage'] = array('error', 'darkred', 'Error saved', '');
                    $this->session->set_flashdata(array('usermessage' => $this->data['usermessage']));
                    redirect(site_url('adminuser/profile/' . $id));
                } else {

                    if ($this->user->update($id, $posts))
                        $this->data['usermessage'] = array('success', 'green', 'Successfully saved', '');
                    else
                        $this->data['usermessage'] = array('error', 'darkred', 'Error saved', '');
                    $this->session->set_flashdata(array('usermessage' => $this->data['usermessage']));
                    redirect(site_url('adminuser/profile/' . $id));
                }
            }
        }
        $this->data['main_content'] = 'adminuser/profile';
        $this->load->view('administrator', $this->data);
    }

}

?>