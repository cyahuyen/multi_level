<?php

class User_Login {

    private $id;
    private $username;
    private $permission = array();

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->config('ion_auth', TRUE);
        $this->ci->load->library('email');
        $this->ci->load->library('session');
        $this->ci->lang->load('permission');
        $this->ci->load->model('permission_model');
        $this->ci->load->model('admin_model');
        $this->ci->load->helper('cookie');
        $this->ci->load->database();

        if (isset($this->ci->session->userdata['admin_logged'])) {
            $user_query = $this->ci->admin_model->getAdmin($this->ci->session->userdata['admin_logged']);
            if ($user_query) {
                $this->id = $user_query->id;
                $this->username = $user_query->username;
                $this->group_id = $user_query->group_id;
                $this->ci->admin_model->updateLogin($this->id);
                $user_group_query = $this->ci->admin_model->getPermission($this->group_id);
                $permissions = unserialize($user_group_query->permission);
                if (is_array($permissions)) {
                    foreach ($permissions as $key => $value) {
                        $this->permission[$key] = $value;
                    }
                }
            } else {
                redirect('auth/logout');
            }
        }
    }

    public function hasPermission($module, $action) {
        if (isset($this->permission[$module]) && isset($this->permission[$module][$action]) && $this->permission[$module][$action]) {
            return true;
        } else {
            return false;
        }
    }

}

?>