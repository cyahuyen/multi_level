<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Admin User page controller
 * @author	KhiemPham <khiemktqd@gmail.com>
 * @date	02/05/2013
 */
class User extends MY_Controller {

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
        $this->data['main_content'] = 'user/manager';
        $this->view('admin/user/manager', 'admin');
    }

    public function userlist($start = null) {
        $posts = $this->input->post();
        $this->config->load('cya_config', TRUE);
        $this->session->set_userdata(array('userlist' => $posts));
        if ($posts['status'] != 'all')
            $dataWhere['status'] = $posts['status'];
        $dataWhere['searchby'] = $posts['searchby'];

        if (isset($posts['usertype']) && $posts['usertype'] != 'all') {
            $dataWhere['user.usertype'] = $posts['usertype'];
        }
        $limit = $this->config->item('limit_page');
        if (!empty($posts['asc'])) {
            $sort[$posts['sort']] = 'ASC';
        } else {
            $sort[$posts['sort']] = 'DESC';
        }
//       Begin pagination
        $this->load->library("pagination");
        $config = array();
        $config["total_rows"] = $this->user->totalMainUser($dataWhere);
        $config["base_url"] = admin_url('user/userlist');
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

        $this->data['users'] = $this->user->listMainUser($dataWhere, $limit, $start, $sort);
        $json['users'] = $this->load->view('admin/user/userlist', $this->data, true);
        echo json_encode($json);
    }

    public function profile($id = 0) {
        $this->data['title'] = 'Manager User';
        if (!empty($id))
            $this->data['userdata'] = $this->user->getMainUserByMainId($id);
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
                $postsData = $posts;
                $id = (int) $id;
                if (empty($id)) {
//      BOF Create Main Account
                    $password = hash_hmac('crc32b', time() . $this->config->item('prefix_key'), 'secret');
                    $dataMainUser = array(
                        'firstname' => $postsData['firstname'],
                        'lastname' => $postsData['lastname'],
                        'email' => $postsData['email'],
                        'password' => md5($password),
                        'phone' => $postsData['phone'],
                        'address' => $postsData['address'],
                    );
                    $id = $this->user->createMainAcount($dataMainUser);
                    $this->activity->addActivity($id, 'Registed');
//      EOF Create Main Account
//      BOF Check/Create Gold Account
                    $dataGoldAcount = array(
                        'main_user_id' => $id,
                        'acount_number' => 'G' . time(),
                    );
                    $gold_user_id = $this->user->createGoldAcount($dataGoldAcount);
                    $this->activity->addActivity($id, 'Created gold account number ' . $dataGoldAcount['acount_number']);

//      EOF Check/Create Gold Account
                    if (!empty($id)) {
                        $userEmailData['entry_amount'] = 0;
                        $userEmailData['fees'] = 0;
                        $userEmailData['password'] = $password;
                        $userEmailData['email'] = $postsData['email'];
                        sendmailform($dataMainUser['email'], 'register', $userEmailData);
                    }


                    else
                        $this->data['usermessage'] = array('error', 'darkred', 'Error saved', '');
                    $this->session->set_flashdata(array('usermessage' => $this->data['usermessage']));
                    redirect(admin_url('user/profile/' . $id));
                } else {

                    if ($this->user->updateMainAcount($id, $posts))
                        $this->data['usermessage'] = array('success', 'green', 'Successfully saved', '');
                    else
                        $this->data['usermessage'] = array('error', 'darkred', 'Error saved', '');
                    $this->session->set_flashdata(array('usermessage' => $this->data['usermessage']));
                    redirect(admin_url('user/profile/' . $id));
                }
            }
        }
        $this->data['main_content'] = 'user/profile';
        $this->view('admin/user/profile', 'admin');
    }

}

?>