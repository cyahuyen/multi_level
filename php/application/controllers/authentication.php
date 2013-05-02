<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Provides interface methods for user authentication
 * @author	Dean Gleeson <dean.gleeson@pragmaticsystems.com.au>
 * @date	21/04/2012
 */
class Authentication extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'user');
    }

    public function index() {
        $this->data['title'] = 'Sign-in';
        $this->data['main_content'] = 'authentication/index';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $validationErrors = array();

            /* check username val */
            if ($username == null || trim($username) == "")
                $validationErrors["username"] = "Sign-in name is required for sign-in authentication";

            /* check password val */
            if ($password == null || trim($password) == "") {
                $this->data['usermessage'] = array('error', 'darkred', 'Password is required for sign-in authentication', 'Please see below');
                $validationErrors["password"] = "Password is required for sign-in authentication";
            }

            if (count($validationErrors) == 0) {
                $usersForCreds = $this->user->verifySignin($username, $password);
                if (empty($usersForCreds)) {
                    $this->data['usermessage'] = array('error', 'darkred', 'Sign-in name / password could not be verified', 'Please see below');
                    $validationErrors["username"] = "Sign-in name / password could not be verified";
                } else {
                    foreach ($usersForCreds[0] as $key => $data) {
                        $sessiondata[$key] = $data;
                    }
                    $this->session->set_userdata(array('user' => $sessiondata));
                    if($sessiondata['permission'] == 'administrator')
                        redirect (site_url('admin'));
                    redirect(site_url('home'));
                }
            }
            $this->data['fielderrors'] = $validationErrors;
        }


        $this->load->View('signin', $this->data);
    }

    public function signin() {
        
    }

    public function signout() {
        $this->session->sess_destroy();
        $this->navigation->loadSigninView(array(
            'usermessage' => array('success', 'green', 'Successful sign-out', 'We hope you enjoyed your experience')
        ));
    }

    public function resetpassword() {
        $signinName = $this->input->post('reset-username');
        $resetPassword = $this->user->resetPassword($signinName);
        if ($resetPassword == 'error') {
            $this->navigation->loadSigninView(array(
                'usermessage' => array('error', 'darkred', 'Password reset unsuccessful', 'Invalid sign-in name'),
                'fielderrors' => array('resetusername' => 'Invalid sign-in name')
            ));
        } else {
            /*
              $this->load->library('email');
              $this->email->from('abhishek@gmail.com', 'Abhishek');
              $this->email->to($this->input->post('signin-reset-name'));
              $this->email->subject('New Password');
              $this->email->message("your new password is $resetPassword");
              $this->email->send();
             */
            $this->navigation->loadSigninView(array(
                'usermessage' => array('success', 'green', 'Password reset successful', 'Reset password sent, please check your email')
            ));
        }
    }

}