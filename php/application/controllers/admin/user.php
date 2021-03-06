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

    public function manager($referring_id = 0) {
        $this->data['title'] = 'Manager User';
        $this->data['main_content'] = 'user/manager';
        $this->data['referring_id'] = $referring_id;
        $user = $this->user->getMainUserByMainId($referring_id);
        $this->data['user'] = $user;

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

        if (!empty($posts['referring_id'])) {
            $dataWhere['referring'] = $posts['referring_id'];
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
        if (!empty($id)) {
            $userdata = $this->user->getMainUserByMainId($id);
            $this->data['userdata'] = $userdata;
        }
        $this->load->model('country_model', 'country');
        $this->load->model('zones_model', 'zones');

        $this->data['countries'] = $this->country->getCountries();

        $this->data['usertype'] = $this->usertype;

        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        $this->data['posts'] = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = $this->input->post();
            $validationErrors = array();
            if (strlen(trim($posts['username'])) < 6) {
                $validationErrors['firstname'] = "Username greater than 6 character";
            } else {
                $dataCheck = array(
                    'username' => $posts['username']
                );
                if (!empty($userdata->main_id)) {
                    $dataCheck['main_id !='] = $userdata->main_id;
                }
                $userCheck = $this->user->getMainUser($dataCheck);
                if ($userCheck) {
                    $validationErrors['username'] = "Username is Exists";
                }
            }
            if ($posts['firstname'] == '') {
                $validationErrors['firstname'] = "Your name is FirstName cannot be blank";
            }
            if (empty($posts['country'])) {
                $validationErrors['country'] = "Country is FirstName cannot be blank";
            }
            if (empty($posts['state'])) {
                $validationErrors['state'] = "State is FirstName cannot be blank";
            }
            if (empty($posts['zip_code'])) {
                $validationErrors['zip_code'] = "Postal/zip code is FirstName cannot be blank";
            }

            if ($posts['lastname'] == '') {
                $validationErrors['firstname'] = "Your name is Lastnamr cannot be blank";
            }
            $this->load->helper('email');
            if ($posts['email'] == '') {
                $validationErrors['email'] = "Email cannot be blank";
            } elseif (!valid_email($posts['email'])) {
                $validationErrors['email'] = "Email incorrect";
            }

            if (empty($userdata->main_id)) {
                if (strlen(trim($posts['password'])) < 6) {
                    $validationErrors['password'] = "password greater than 6 character";
                } elseif ($posts['password'] != $posts['repassword']) {
                    $validationErrors['repassword'] = "Repassword incorect";
                }
            } else {
                if (strlen(trim($posts['password'])) > 0) {
                    if (strlen(trim($posts['password'])) < 6) {
                        $validationErrors['password'] = "password greater than 6 character";
                    } elseif ($posts['password'] != $posts['repassword']) {
                        $validationErrors['repassword'] = "Repassword incorect";
                    }
                }
            }

            $this->data['posts'] = $posts;
            foreach ($posts as $key => $val) {
                $userdata->$key = $val;
            }
            $this->data['userdata'] = $userdata;
            if (count($validationErrors) != 0) {
                $this->data['usermessage'] = array('error', 'darkred', 'Validation errors found', 'Please see below');
                $this->data['fielderrors'] = $validationErrors;
            } else {
                $posts['status'] = 1;
                unset($posts['save-btn']);
                $postsData = $posts;
                $id = (int) $id;
                if (empty($userdata->main_id)) {
//      BOF Create Main Account
                    $password = $posts['password'];
                    $dataMainUser = array(
                        'username' => $postsData['username'],
                        'firstname' => $postsData['firstname'],
                        'lastname' => $postsData['lastname'],
                        'email' => $postsData['email'],
                        'password' => md5($password),
                        'phone' => $postsData['phone'],
                        'address' => $postsData['address'],
                        'country_id' => $postsData['country'],
                        'state_id' => $postsData['state'],
                        'address2' => $postsData['address2'],
                        'zip_code' => $postsData['zip_code'],
                        'city' => $postsData['city'],
                        'safe_card' => $postsData['safe_card'],
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

                    $dataMainUser = array(
                        'username' => $posts['username'],
                        'firstname' => $posts['firstname'],
                        'lastname' => $posts['lastname'],
                        'email' => $posts['email'],
                        'phone' => $posts['phone'],
                        'address' => $posts['address'],
                        'country_id' => $postsData['country'],
                        'state_id' => $postsData['state'],
                        'address2' => $postsData['address2'],
                        'zip_code' => $postsData['zip_code'],
                        'city' => $postsData['city'],
                        'safe_card' => $postsData['safe_card'],
                    );
                    if (!empty($posts['password'])) {
                        $password = $posts['password'];
                        $dataMainUser['password'] = md5($password);
                    }

                    if ($this->user->updateMainAcount($userdata->main_id, $dataMainUser))
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