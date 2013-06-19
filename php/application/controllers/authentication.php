<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Authentication extends MY_Controller {

    var $menu_config_0 = array('', '', '', '', '', '');
    var $menu_config_1 = array('active', '', '', '', '', '');
    var $menu_config_2 = array('', 'active', '', '', '', '');
    var $menu_config_3 = array('', '', 'active', '', '', '');
    var $menu_config_4 = array('', '', '', 'active', '', '');
    var $menu_config_5 = array('', '', '', '', 'active', '');
    var $menu_config_6 = array('', '', '', '', '', 'active');
    var $navstack = null;

    function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'user');
        $this->data['menu_config'] = $this->menu_config_3;
    }

    public function index() {
        $user_session = $this->session->userdata('user');

        if (!empty($user_session) && $user_session['permission'] != 'administrator') {
            redirect(site_url('home'));
        } elseif (!empty($user_session) && $user_session['permission'] == 'administrator') {
            redirect(site_url('admin'));
        }
        $this->data['title'] = 'Sign-in';
        $this->data['main_content'] = 'authentication/index';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $validationErrors = array();

            /* check email val */
            if ($email == null || trim($email) == "")
                $validationErrors["email"] = "Sign-in Email is required for sign-in authentication";

            /* check password val */
            if ($password == null || trim($password) == "") {
                $this->data['usermessage'] = array('error', 'darkred', 'Password is required for sign-in authentication', 'Please see below');
                $validationErrors["password"] = "Password is required for sign-in authentication";
            }

            if (count($validationErrors) == 0) {
                $usersForCreds = $this->user->verifySignin($email, $password);
                if (empty($usersForCreds)) {
                    $this->data['usermessage'] = array('error', 'darkred', 'Sign-in name / password could not be verified', 'Please see below');
                    $validationErrors["email"] = "Sign-in name / password could not be verified";
                } else {
                    $data = array(
                        'main_id' => $usersForCreds['main_id'],
                        'firstname' => $usersForCreds['firstname'],
                        'lastname' => $usersForCreds['lastname'],
                        'email' => $usersForCreds['email'],
                        'status' => $usersForCreds['status'],
                        'permission' => $usersForCreds['permission'],
                    );
                    $this->session->set_userdata(array('user' => $data));
                    if ($usersForCreds['permission'] == 'administrator')
                        redirect(site_url('admin'));
                    redirect(site_url('home'));
                }
            }
            $this->data['fielderrors'] = $validationErrors;
        }

        $this->data['main_content'] = 'authentication/index';

        $this->load->view('home', $this->data);
    }

    public function signout() {

        $this->session->sess_destroy();
        redirect('home');
    }

}