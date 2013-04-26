<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ion_auth {

    protected $ci;

    /**
     * account status ('not_activated', etc ...)
     *
     * @var string
     * */
    protected $status;

    /**
     * extra where
     *
     * @var array
     * */
    public $_extra_where = array();

    /**
     * extra set
     *
     * @var array
     * */
    public $_extra_set = array();

    /**
     * __construct
     *
     * @return void
     * @author Ben
     * */
    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->config('ion_auth', TRUE);
        $this->ci->load->library('email');
        $this->ci->load->library('session');
        $this->ci->lang->load('ion_auth');
        $this->ci->load->model('ion_auth_model');
        $this->ci->load->helper('cookie');

        //auto-login the admin if they are remembered
        if (!$this->logged_in() && get_cookie('identity') && get_cookie('remember_code')) {
            $this->ci->ion_auth = $this;
            $this->ci->ion_auth_model->login_remembered_admin();
        }

        $this->ci->ion_auth_model->trigger_events('library_constructor');
    }

    public function __call($method, $arguments) {
        if (!method_exists($this->ci->ion_auth_model, $method)) {
            throw new Exception('Undefined method Ion_auth::' . $method . '() called');
        }

        return call_user_func_array(array($this->ci->ion_auth_model, $method), $arguments);
    }

    public function forgotten_password($identity) {
    //changed $email to $identity
        if ($this->ci->ion_auth_model->forgotten_password($identity)) {   //changed
            // Get admin information
            $admin = $this->where($this->ci->config->item('identity', 'ion_auth'), $identity)->admins()->row();  //changed to get_admin_by_identity from email

            if ($admin) {
                $data = array(
                    'identity' => $admin->{$this->ci->config->item('identity', 'ion_auth')},
                    'forgotten_password_code' => $admin->forgotten_password_code
                );

                if (!$this->ci->config->item('use_ci_email', 'ion_auth')) {
                    $this->set_message('forgot_password_successful');
                    return $data;
                } else {
                    $message = $this->ci->load->view($this->ci->config->item('email_templates', 'ion_auth') . $this->ci->config->item('email_forgot_password', 'ion_auth'), $data, true);
                    $this->ci->email->clear();
                    $this->ci->email->set_newline("\r\n");
                    $this->ci->email->from($this->ci->config->item('admin_email', 'ion_auth'), $this->ci->config->item('site_title', 'ion_auth'));
                    $this->ci->email->to($admin->email);
                    $this->ci->email->subject($this->ci->config->item('site_title', 'ion_auth') . ' - Forgotten Password Verification');
                    $this->ci->email->message($message);

                    if ($this->ci->email->send()) {
                        $this->set_message('forgot_password_successful');
                        return TRUE;
                    } else {
                        $this->set_error('forgot_password_unsuccessful');
                        return FALSE;
                    }
                }
            } else {
                $this->set_error('forgot_password_unsuccessful');
                return FALSE;
            }
        } else {
            $this->set_error('forgot_password_unsuccessful');
            return FALSE;
        }
    }

    /**
     * forgotten_password_complete
     *
     * @return void
     * @author Mathew
     * */
    public function forgotten_password_complete($code) {
        $this->ci->ion_auth_model->trigger_events('pre_password_change');

        $identity = $this->ci->config->item('identity', 'ion_auth');
        $profile = $this->where('forgotten_password_code', $code)->admins()->row(); //pass the code to profile

        if (!is_object($profile)) {
            $this->ci->ion_auth_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
            $this->set_error('password_change_unsuccessful');
            return FALSE;
        }

        $new_password = $this->ci->ion_auth_model->forgotten_password_complete($code, $profile->salt);

        if ($new_password) {
            $data = array(
                'identity' => $profile->{$identity},
                'new_password' => $new_password
            );
            if (!$this->ci->config->item('use_ci_email', 'ion_auth')) {
                $this->set_message('password_change_successful');
                $this->ci->ion_auth_model->trigger_events(array('post_password_change', 'password_change_successful'));
                return $data;
            } else {
                $message = $this->ci->load->view($this->ci->config->item('email_templates', 'ion_auth') . $this->ci->config->item('email_forgot_password_complete', 'ion_auth'), $data, true);

                $this->ci->email->clear();
                $this->ci->email->set_newline("\r\n");
                $this->ci->email->from($this->ci->config->item('admin_email', 'ion_auth'), $this->ci->config->item('site_title', 'ion_auth'));
                $this->ci->email->to($profile->email);
                $this->ci->email->subject($this->ci->config->item('site_title', 'ion_auth') . ' - New Password');
                $this->ci->email->message($message);

                if ($this->ci->email->send()) {
                    $this->set_message('password_change_successful');
                    $this->ci->ion_auth_model->trigger_events(array('post_password_change', 'password_change_successful'));
                    return TRUE;
                } else {
                    $this->set_error('password_change_unsuccessful');
                    $this->ci->ion_auth_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
                    return FALSE;
                }
            }
        }

        $this->ci->ion_auth_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
        return FALSE;
    }

    /**
     * register
     *
     * @return void
     * @author Mathew
     * */
    public function register($username, $password, $email, $additional_data = array(), $group_name = array()) { //need to test email activation
        $this->ci->ion_auth_model->trigger_events('pre_account_creation');

        $email_activation = $this->ci->config->item('email_activation', 'ion_auth');

        if (!$email_activation) {
            $id = $this->ci->ion_auth_model->register($username, $password, $email, $additional_data, $group_name);
            if ($id !== FALSE) {
                $this->set_message('account_creation_successful');
                $this->ci->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful'));
                return $id;
            } else {
                $this->set_error('account_creation_unsuccessful');
                $this->ci->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
                return FALSE;
            }
        } else {
            $id = $this->ci->ion_auth_model->register($username, $password, $email, $additional_data, $group_name);

            if (!$id) {
                $this->set_error('account_creation_unsuccessful');
                return FALSE;
            }

            $deactivate = $this->ci->ion_auth_model->deactivate($id);

            if (!$deactivate) {
                $this->set_error('deactivate_unsuccessful');
                $this->ci->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
                return FALSE;
            }

            $activation_code = $this->ci->ion_auth_model->activation_code;
            $identity = $this->ci->config->item('identity', 'ion_auth');
            $admin = $this->ci->ion_auth_model->admin($id)->row();

            $data = array(
                'identity' => $admin->{$identity},
                'id' => $admin->id,
                'email' => $email,
                'activation' => $activation_code,
            );
            if (!$this->ci->config->item('use_ci_email', 'ion_auth')) {
                $this->ci->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
                $this->set_message('activation_email_successful');
                return $data;
            } else {
                $message = $this->ci->load->view($this->ci->config->item('email_templates', 'ion_auth') . $this->ci->config->item('email_activate', 'ion_auth'), $data, true);

                $this->ci->email->clear();
                $this->ci->email->set_newline("\r\n");
                $this->ci->email->from($this->ci->config->item('admin_email', 'ion_auth'), $this->ci->config->item('site_title', 'ion_auth'));
                $this->ci->email->to($email);
                $this->ci->email->subject($this->ci->config->item('site_title', 'ion_auth') . ' - Account Activation');
                $this->ci->email->message($message);

                if ($this->ci->email->send() == TRUE) {
                    $this->ci->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
                    $this->set_message('activation_email_successful');
                    return $id;
                }
            }

            $this->ci->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful', 'activation_email_unsuccessful'));
            $this->set_error('activation_email_unsuccessful');
            return FALSE;
        }
    }

    /**
     * logout
     *
     * @return void
     * @author Mathew
     * */
    public function logout() {
        $this->ci->ion_auth_model->trigger_events('logout');

        $identity = $this->ci->config->item('identity', 'ion_auth');
        $this->ci->session->unset_userdata($identity);
        $this->ci->session->unset_userdata('id');
        $this->ci->session->unset_userdata('admin_id');

        //delete the remember me cookies if they exist
        if (get_cookie('identity')) {
            delete_cookie('identity');
        }
        if (get_cookie('remember_code')) {
            delete_cookie('remember_code');
        }

        $this->ci->session->sess_destroy();

        $this->set_message('logout_successful');
        return TRUE;
    }

    public function logged_in() {
        $this->ci->ion_auth_model->trigger_events('logged_in');

        $identity = $this->ci->config->item('identity', 'ion_auth');

        return (bool) $this->ci->session->userdata($identity);
    }

    /**
     * is_admin
     *
     * @return bool
     * @author Ben Edmunds
     * */
    public function is_admin() {
        $this->ci->ion_auth_model->trigger_events('is_admin');

        $admin_group = $this->ci->config->item('admin_group', 'ion_auth');

        return $this->in_group($admin_group);
    }

    /**
     * in_group
     *
     * @return bool
     * @author Phil Sturgeon
     * */
    public function in_group($check_group, $id = false) {
        $this->ci->ion_auth_model->trigger_events('in_group');

        $admins_groups = $this->ci->ion_auth_model->get_admins_groups($id)->result();
        $groups = array();
        foreach ($admins_groups as $group) {
            $groups[] = $group->name;
        }

        if (is_array($check_group)) {
            foreach ($check_group as $key => $value) {
                if (in_array($value, $groups)) {
                    return TRUE;
                }
            }
        } else {
            if (in_array($check_group, $groups)) {
                return TRUE;
            }
        }

        return FALSE;
    }

    /**
     * Get admin
     *
     * @return object admin
     * @author DongHP
     * */
    public function get_admin($id = false) {
        return $this->ci->ion_auth_model->get_admin($id)->row();
    }

}