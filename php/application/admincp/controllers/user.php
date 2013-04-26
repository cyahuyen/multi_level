<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    var $user_id;
    var $name;
    var $active;
    var $user;
    var $data;

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('encryption');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->library('document');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->lang->load('user');
        $this->load->library('pagination');
        $this->load->model('user_model', '', TRUE);
        $this->load->library('user_login');
        $posts = $this->input->post();
        if ((!$this->session->userdata('admin_logged')) || (!$this->ion_auth->logged_in())) {
            redirect('login/index/', 'refresh');
        }
    }

    public function index() {
        $p = $this->uri->segment(3);
        if (isset($p)) {
            $page = $this->uri->segment(3);
        } else {
            $page = 1;
        }

        $session = $this->session->flashdata('message');
        if (isset($session)) {
            $this->data['success'] = $session;
        } else {
            $this->data['success'] = '';
        }

        $this->document->setTitle($this->lang->line('user_title'));

        $this->data['title'] = $this->document->getTitle();

        $post = $this->input->post();

        $data = array(
            'start' => ($page - 1) * 5,
            'limit' => 5
        );
        $total_users = $this->user_model->totalUsers();

        $users = $this->user_model->getUsers($data);

        $this->data['users'] = array();

        $this->data['delete'] = site_url('user/delete');

        foreach ($users as $user) {
            if ($user->user_id) {
                $edit = site_url('user/update/' . $user->user_id);
            }
            $this->data['add_new'] = site_url('user/insert');
            if ($user->usertype == 1) {
                $usertype = "Silver";
            } elseif ($user->usertype == 2) {
                $usertype = "Gold";
            } else {
                $usertype = "Member";
            }
            $this->data['users'][] = array(
                'id' => $user->user_id,
                'username' => $user->username,
                'address' => $user->address,
                'email' => $user->email,
                'phone' => $user->phone,
                'usertype' => $usertype,
                'created_on' => $user->created_on,
                'edit' => $edit,
                'selected' => isset($this->input->post['selected']) && in_array($user->user_id, $this->input->post['selected']),
            );
        }
        $pagination = $this->pagination;
        $pagination->total = $total_users;
        $pagination->page = $page;
        $pagination->limit = 5;
        $pagination->url = site_url('user/index/' . '{page}');

        $this->data['pagination'] = $pagination->render();

        $this->data['main_content'] = 'user/index.php';

        $this->load->view('main_board', $this->data);
    }

    public function insert() {

        if (($this->input->server('REQUEST_METHOD') === 'POST') && $this->validateForm()) {

            $this->user_model->save($this->input->post());

            $this->session->set_flashdata('message', $this->lang->line('text_successa'));

            redirect('user/index');
        }
        $this->getForm();
    }

    public function update() {
        if (($this->input->server('REQUEST_METHOD') === 'POST') && $this->validateForm()) {
            $this->user_model->update($this->uri->segment(3), $this->input->post());

            $this->session->set_flashdata('message', $this->lang->line('text_successuser'));

            redirect('user/index');
        }
        $this->getForm();
    }

    public function getForm() {

        $this->document->setTitle($this->lang->line('user_title'));

        $this->data['title'] = $this->document->getTitle();

        $id = $this->uri->segment(3);

        if ($id) {
            $this->data['action'] = site_url('user/update/' . $id);
        } else {
            $this->data['action'] = site_url('user/insert/');
        }

        $this->data['cancel'] = site_url('user/index');

        if (isset($id) && ( $this->input->server('REQUEST_METHOD') != 'POST')) {
            $user_info = $this->user_model->getUser($id);
        }

        if (isset($posts['username'])) {
            $this->data['username'] = $posts['username'];
        } elseif (!empty($user_info)) {
            $this->data['username'] = $user_info->username;
        } else {
            $this->data['username'] = '';
        }
        if (isset($posts['password'])) {
            $this->data['password'] = $posts['password'];
        } else {
            $this->data['password'] = '';
        }
        if (isset($posts['address'])) {
            $this->data['address'] = $posts['address'];
        } elseif (!empty($user_info)) {
            $this->data['address'] = $user_info->address;
        } else {
            $this->data['address'] = '';
        }
        if (isset($posts['phone'])) {
            $this->data['phone'] = $posts['phone'];
        } elseif (!empty($user_info)) {
            $this->data['phone'] = $user_info->phone;
        } else {
            $this->data['phone'] = '';
        }
        if (isset($posts['email'])) {
            $this->data['email'] = $posts['email'];
        } elseif (!empty($user_info)) {
            $this->data['email'] = $user_info->email;
        } else {
            $this->data['email'] = '';
        }
        if (isset($posts['fax'])) {
            $this->data['fax'] = $posts['fax'];
        } elseif (!empty($user_info)) {
            $this->data['fax'] = $user_info->fax;
        } else {
            $this->data['fax'] = '';
        }
        if (isset($posts['birthday'])) {
            $this->data['birthday'] = $posts['birthday'];
        } elseif (!empty($user_info)) {
            $this->data['birthday'] = $user_info->birthday;
        } else {
            $this->data['birthday'] = '';
        }
        if (isset($posts['referring'])) {
            $this->data['referring'] = $posts['referring'];
        } elseif (!empty($user_info)) {
            $this->data['referring'] = $user_info->referring;
        } else {
            $this->data['referring'] = '';
        }
        if (isset($posts['usertype'])) {
            $this->data['usertype'] = $posts['usertype'];
        } elseif (!empty($user_info)) {
            $this->data['usertype'] = $user_info->usertype;
        } else {
            $this->data['usertype'] = '';
        }
        if (isset($posts['status'])) {
            $this->data['status'] = $posts['status'];
        } elseif (!empty($user_info)) {
            $this->data['status'] = $user_info->status;
        } else {
            $this->data['status'] = '';
        }

        $this->data['main_content'] = 'user/form.php';

        $this->load->view('main_board', $this->data);
    }

    public function delete() {
        $select = $this->input->post('selected');
        if (!empty($select)) {
            foreach ($select as $id) {
                $this->user_model->delete($id);
            }
            $this->session->set_flashdata('message', $this->lang->line('text_successa'));
        } else {
            $this->session->set_flashdata('message', $this->lang->line('text_no_check'));
        }
        redirect('user');
    }

    private function validateForm() {
        if ($this->uri->segment(3)) {
            if ($this->input->post('username') != $this->input->post('old_username')) {
                $this->form_validation->set_rules('username', 'User Name', 'required|trim|xss_clean|max_length[50]|callback_checkUser');
            }
            if ($this->input->post('old_password') != $this->input->post('password')) {
                $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|max_length[50]|valid_repassword');
            }
            if ($this->input->post('old_email') != $this->input->post('email')) {
                $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email|max_length[64]|callback_checkEmail');
            }
            $this->form_validation->set_rules('address', 'Address', 'required|trim|xss_clean|max_length[150]');
            $this->form_validation->set_rules('phone', 'Phone', 'required|trim|xss_clean|numeric|max_length[12]');
            $this->form_validation->set_rules('fax', 'Fax', 'required|trim|xss_clean|numeric|max_length[12]');
            $this->form_validation->set_rules('birthday', 'Birthday', 'required|trim|xss_clean|max_length[15]|callback_valid_date');
        } else {
            $this->form_validation->set_rules('username', 'User Name', 'required|trim|xss_clean|max_length[50]|callback_checkUser');
            $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|max_length[50]|valid_repassword');
            $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email|max_length[64]|callback_checkEmail');
            $this->form_validation->set_rules('address', 'Address', 'required|trim|xss_clean|max_length[150]');
            $this->form_validation->set_rules('phone', 'Phone', 'required|trim|xss_clean|numeric|max_length[12]');
            $this->form_validation->set_rules('fax', 'Fax', 'required|trim|xss_clean|numeric|max_length[12]');
            $this->form_validation->set_rules('birthday', 'Birthday', 'required|trim|xss_clean|max_length[15]|callback_valid_date');
        }
        if ($this->form_validation->run() == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function valid_date($date) {
        $ddmmyyy = '/^(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)[0-9]{2}$/';
        if (preg_match($ddmmyyy, $date)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('valid_date', 'Please enter mm-dd-yyyy');
            return FALSE;
        }
    }

    public function checkEmail($email) {
        if ($this->user_model->checkEmail($email)) {
            $this->form_validation->set_message('checkEmail', 'This e-mail is already registered in our system. Please use a different one.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function checkUser($username) {
        if ($this->user_model->checkUser($username)) {
            $this->form_validation->set_message('checkUser', ' This User is already registered in our system. Please use a different one.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}