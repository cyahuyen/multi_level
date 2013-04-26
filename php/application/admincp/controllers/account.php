<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Account extends CI_Controller {

    var $admin_id;
    var $name;
    var $active;
    var $admin;
    var $data;

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('document');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->lang->load('account');
        $this->load->model('admin_model', '', TRUE);
        $posts = $this->input->post();
        $this->load->library('user_login');
        $module_name = $this->router->fetch_class();
        $action_name = $this->router->fetch_method();

        if (!$this->user_login->hasPermission($module_name, $action_name)) {
            $this->session->set_flashdata('permission', 'You do not have permission to access this page, please refer to your system administrator.');
            redirect('home');
        }

        if ((!$this->session->userdata('admin_logged')) || (!$this->ion_auth->logged_in())) {
            redirect('login/index/', 'refresh');
        }
    }

    public function index() {

        $this->document->setTitle($this->lang->line('account_title'));
        $this->data['title'] = $this->document->getTitle();
        $this->data['account_title'] = $this->lang->line('account_title');
        $this->data['colum_username'] = $this->lang->line('colum_username');
        $this->data['colum_contact_name'] = $this->lang->line('colum_contact_name');
        $this->data['colum_email'] = $this->lang->line('colum_email');
        $this->data['colum_action'] = $this->lang->line('colum_action');

        $admins = $this->admin_model->getAdmins();

        $this->data['admins'] = array();

        $this->data['id_logged'] = $this->session->userdata('admin_id');

        $this->data['delete'] = site_url('account/delete');
        $session = $this->session->flashdata('message');
        if (isset($session)) {
            $this->data['success'] = $session;
        } else {
            $this->data['success'] = '';
        }

        foreach ($admins as $admin) {
            if ($admin->id) {
                $edit = site_url('account/update/' . $admin->id);
            }
            $this->data['add_new'] = site_url('account/insert');

            $this->data['admins'][] = array(
                'id' => $admin->id,
                'username' => $admin->username,
                'contactname' => $admin->contactname,
                'email' => $admin->email,
                'edit' => $edit,
                'selected' => isset($this->input->post['selected']) && in_array($admin->id, $this->input->post['selected']),
            );
        }
        $this->data['main_content'] = 'account/index.php';

        $this->load->view('main_board', $this->data);
    }

    public function insert() {

        if (($this->input->server('REQUEST_METHOD') === 'POST') && $this->validateForm()) {

            $this->admin_model->save($this->input->post());

            $this->session->set_flashdata('message', $this->lang->line('text_successa'));

            redirect('account/index');
        }
        $this->getForm();
    }

    public function update() {


        if (($this->input->server('REQUEST_METHOD') === 'POST') && $this->validateForm()) {

            $this->admin_model->update($this->uri->segment(3), $this->input->post());

            $this->session->set_flashdata('message', $this->lang->line('text_successa'));

            redirect('account/index');
        }
        $this->getForm();
    }

    public function getForm() {

        $this->document->setTitle($this->lang->line('account_title'));

        $this->data['title'] = $this->document->getTitle();

        $this->data['account_title'] = $this->lang->line('account_title');
        $this->data['text_username'] = $this->lang->line('text_username');
        $this->data['text_contact_name'] = $this->lang->line('text_contact_name');
        $this->data['text_email'] = $this->lang->line('text_email');
        $this->data['text_password'] = $this->lang->line('text_password');
        $this->data['text_con_password'] = $this->lang->line('text_con_password');
        $this->data['text_group'] = $this->lang->line('text_group');
        $this->data['text_select'] = $this->lang->line('text_select');
        $this->data['button_save'] = $this->lang->line('button_save');
        $this->data['button_cancel'] = $this->lang->line('button_cancel');

        $id = $this->uri->segment(3);

        if ($id) {
            $this->data['action'] = site_url('account/update/' . $id);
        } else {
            $this->data['action'] = site_url('account/insert');
        }

        $this->data['cancel'] = site_url('account/index');

        if (isset($id)) {
            $admin_info = $this->admin_model->getAdmin($id);
        }
        $admin_groups = $this->admin_model->getGroups();

        foreach ($admin_groups as $admin_group) {
            $this->data['groups'][] = array(
                'group_id' => $admin_group['group_id'],
                'name' => $admin_group['name'],
            );
        }

        if (isset($posts['username'])) {
            $this->data['username'] = $posts['username'];
        } elseif (!empty($admin_info)) {
            $this->data['username'] = $admin_info->username;
        } else {
            $this->data['username'] = '';
        }
        if (isset($posts['email'])) {
            $this->data['email'] = $posts['email'];
        } elseif (!empty($admin_info)) {
            $this->data['email'] = $admin_info->email;
        } else {
            $this->data['email'] = '';
        }
        if (isset($posts['contactname'])) {
            $this->data['contactname'] = $posts['contactname'];
        } elseif (!empty($admin_info)) {
            $this->data['contactname'] = $admin_info->contactname;
        } else {
            $this->data['contactname'] = '';
        }
        if (isset($posts['group_id'])) {
            $this->data['group_id'] = $posts['group_id'];
        } elseif (!empty($admin_info)) {
            $this->data['group_id'] = $admin_info->group_id;
        } else {
            $this->data['group_id'] = '';
        }
        if (isset($posts['password'])) {
            $this->data['password'] = $posts['password'];
        } else {
            $this->data['password'] = '';
        }


        $this->data['main_content'] = 'account/form.php';

        $this->load->view('main_board', $this->data);
    }

    public function delete() {
        $select = $this->input->post('selected');
        if (!empty($select)) {
            foreach ($select as $id) {
                $this->admin_model->deleteAdmin($id);
            }
            $this->session->set_flashdata('message', $this->lang->line('text_successa'));
        } else {
            $this->session->set_flashdata('message', $this->lang->line('text_no_check'));
        }
        redirect('account');
    }

    private function validateForm() {
        if ($this->uri->segment(3)) {
            if ($this->input->post('old_username') != $this->input->post('username')) {
                $this->form_validation->set_rules('username', 'lang:error_user', 'required|trim|xss_clean|min_length[6]|callback_check_user');
            }
            if ($this->input->post('old_password') != $this->input->post('password')) {
                $this->form_validation->set_rules('password', 'lang:error_password', 'required|xss_clean|valid_password2|max_length[64]');
                $this->form_validation->set_rules('password2', 'lang:error_con_password', 'required|trim|xss_clean|matches[password]');
            }
            if ($this->input->post('old_email') != $this->input->post('email')) {
                $this->form_validation->set_rules('email', 'lang:error_email', 'required|xss_clean|valid_email|max_length[64]|callback_check_email');
            }
            $this->form_validation->set_rules('contactname', 'lang:error_contact', 'required|trim|xss_clean');
            $this->form_validation->set_rules('group_id', 'lang:text_group', 'callback_group_validate');
        } else {
            $this->form_validation->set_rules('group_id', 'lang:text_group', 'callback_group_validate');
            $this->form_validation->set_rules('username', 'lang:error_user', 'required|trim|xss_clean|min_length[6]||callback_check_user');
            $this->form_validation->set_rules('contactname', 'lang:error_contact', 'required|trim|xss_clean');
            $this->form_validation->set_rules('password', 'lang:error_password', 'required|xss_clean|valid_password2|max_length[64]');
            $this->form_validation->set_rules('password2', 'lang:error_con_password', 'required|trim|xss_clean|matches[password]');
            $this->form_validation->set_rules('email', 'lang:error_email', 'required|xss_clean|valid_email|max_length[64]||callback_check_email');
        }

        if ($this->form_validation->run() == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function group_validate($selectValue) {
        // 'none' is the first option and the text says something like "-Choose one-"
        if ($selectValue == 'none') {
            $this->form_validation->set_message('group_validate', 'Please select the group of user admin.');
            return false;
        } else { // user picked something
            return true;
        }
    }

    public function check_email($email) {
        if ($this->admin_model->check_email($email)) {
            $this->form_validation->set_message('check_email', 'E-mail already. Please add new email');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function check_user($username) {
        if ($this->admin_model->check_user($username)) {
            $this->form_validation->set_message('check_user', ' User name already exists. Please choose a new name');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}