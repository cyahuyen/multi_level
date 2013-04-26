<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Provides interface methods for my profile view
 * @author	Dean Gleeson <dean.gleeson@pragmaticsystems.com.au>
 * @date	16/03/2013
 */
class MyProfile extends MY_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) {
            redirect('auth');
        } else {
            $this->load->model('user_model', 'user');
        }
    }

    public function index() {
        $userResults = $this->user->loadUser($this->session->userdata('userid'));

        if ($userResults->num_rows() != 1) {
            /* return to sign-in page with error */
            $this->session->sess_destroy();
            $this->navigation->loadSigninView(array(
                'usermessage' => array('error', 'darkred', 'Reload unsuccessful', 'Your session has expired, please sign-in and try again')));
        } else {
            $userData = $userResults->row();

            $name = $userData->fullname;
            $usertype = $this->session->userdata('usertype');
            $username = $userData->username;
            $email = $userData->email;
            $phone = $userData->phone;
            $mobile = $userData->mobile;

            $data = array(
                'name' => $name,
                'usertype' => $usertype,
                'username' => $username,
                'email' => $email,
                'phone' => $phone,
                'mobile' => $mobile,
                'password' => '',
                'passwordnew' => '',
                'passwordconf' => '');
            $this->navigation->loadMyProfileView($data);
        }
    }

    /**
     * Save user data submitted from view.
     */
    public function save() {
        if (!$this->session->userdata('is_logged_in'))
            redirect('auth');
        else {
            $userId = $this->session->userdata('userid');
            $usertype = $this->session->userdata('usertype');
            $name = $this->input->post('myprofile-name');
            $username = $this->input->post('myprofile-signin');
            $email = $this->input->post('myprofile-email');
            $phone = $this->input->post('myprofile-phone');
            $mobile = $this->input->post('myprofile-mobile');
            $password_curr = $this->input->post('myprofile-password-curr');
            $password_new = $this->input->post('myprofile-password-new');
            $password_conf = $this->input->post('myprofile-password-conf');

            $validationErrors = array(); {
                if ($name == "")
                    $validationErrors['myprofile-name'] = "Your name is required";
                else {
                    $currentUsername = $this->session->userdata('name');
                    if ($username != $currentUsername) {
                        $this->load->model('user_model');
                        $usernameAvailable = $this->user_model->usernameAvailable($username, $userId);
                        if (!$usernameAvailable)
                            $validationErrors['myprofile-signin'] = "Sign-in name unavailable";
                    }
                }

                if ($username == "")
                    $validationErrors['myprofile-signin'] = "A sign-in name is required";

                if ($email == "")
                    $validationErrors['myprofile-email'] = "An email address is required";

                if ($password_curr != "" || $password_new != "" || $password_conf != "") {
                    $this->load->model('user_model');
                    $passwordMatches = $this->user_model->passwordMatches($userId, $password_curr);
                    if (!$passwordMatches)
                        $validationErrors['myprofile-password-curr'] = "Entered password does not match your current password";

                    if ($password_new == "")
                        $validationErrors['myprofile-password-new'] = "New password cannot be blank";

                    if ($password_conf == "")
                        $validationErrors['myprofile-password-conf'] = "Confirm password cannot be blank";
                    else if ($password_conf != $password_new) {
                        $validationErrors['myprofile-password-new'] = "Confirm password must match your new password";
                        $validationErrors['myprofile-password-conf'] = "Confirm password must match your new password";
                    }
                }
            }

            if (count($validationErrors) != 0) {
                $data = array(
                    'usermessage' => array('error', 'darkred', 'Validation errors found', 'Please see below'),
                    'fielderrors' => $validationErrors,
                    'name' => $name,
                    'usertype' => $usertype,
                    'username' => $username,
                    'email' => $email,
                    'phone' => $phone,
                    'mobile' => $mobile,
                    'password' => '',
                    'passwordnew' => '',
                    'passwordconf' => '');
                $this->navigation->loadMyProfileView($data);
            } else {
                $this->load->model('user_model');

                $userdata = array(
                    'id' => $userId,
                    'name' => $name,
                    'username' => $username,
                    'email' => $email,
                    'phone' => $phone,
                    'mobile' => $mobile);

                $this->user_model->save($userdata);
                if ($password_new != "")
                    $this->user_model->updatePassword($userId, $password_new);

                $data = array(
                    'usermessage' => array('success', 'green', 'Save successful', 'Your changes have been saved'),
                    'name' => $name,
                    'usertype' => $usertype,
                    'username' => $username,
                    'email' => $email,
                    'phone' => $phone,
                    'mobile' => $mobile,
                    'password' => '',
                    'passwordnew' => '',
                    'passwordconf' => '');
                $this->navigation->loadMyProfileView($data);
            }
        }
    }

    public function reload() {
        $this->load->model('user_model');

        $userResults = $this->user_model->loadUser(
                $this->session->userdata('userid'));

        if ($userResults->num_rows() != 1) {
            /* return to sign-in page with error */
            $this->session->sess_destroy();
            $this->navigation->loadSigninView(array(
                'usermessage' => array('error', 'darkred', 'Reload unsuccessful', 'Your session has expired, please sign-in and try again')));
        } else {
            $usertype = $this->session->userdata('usertype');

            $userData = $userResults->row();

            $name = $userData->fullname;
            $username = $userData->username;
            $email = $userData->email;
            $phone = $userData->phone;
            $mobile = $userData->mobile;

            $data = array(
                'usermessage' => array('info', '#0000a0', 'Reload successful', 'Your profile information was reloaded'),
                'name' => $name,
                'usertype' => $usertype,
                'username' => $username,
                'email' => $email,
                'phone' => $phone,
                'mobile' => $mobile,
                'password' => '',
                'passwordnew' => '',
                'passwordconf' => '');
            $this->navigation->loadMyProfileView($data);
        }
    }

}