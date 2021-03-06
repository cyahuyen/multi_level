<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tool extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['menu_config'] = $this->menu_config_9;

        $this->load->model('user_model', 'user');
        $this->load->model('config_model', 'configs');

        $user_session = $this->session->userdata('user');
        $this->data['user_session'] = $user_session;
        if (empty($user_session) || $user_session['permission'] != 'administrator') {
            redirect(site_url('home'));
        }
    }

    public function index() {
        
    }

    public function sent_mail() {
        $this->data['title'] = 'Send Message';
        $this->data['main_content'] = 'tool/sent_mail';
        

        $posts = $this->input->post();
        if ($posts) {

            $validationErrors = array();
            if ($posts['subject'] == '') {
                $validationErrors['subject'] = "Subject cannot be blank";
            }
            if ($posts['content'] == '') {
                $validationErrors['content'] = "Content cannot be blank";
            }

            if (empty($posts['user_list'])) {
                $validationErrors['user'] = "User cannot be blank";
            }
            if (count($validationErrors) != 0) {
                $this->data['usermessage'] = array('error', 'darkred', 'Validation errors found', 'Please see below');
                $this->data['fielderrors'] = $validationErrors;
            } else {

                $subject = $posts['subject'];
                $content = $posts['content'];

                foreach ($posts['user_list'] as $user) {
                    switch ($user) {
                        case 'all':
                            $data_where = array(
                                'usertype !=' => '-1'
                            );
                            $user_list = $this->user->listUser($data_where);
                            foreach ($user_list as $user) {
                                $content = replace_data($content, array('fullname' => $user->firstname . ' ' . $user->lastname));
                                sendmail($user->email, $subject, $content);
                            }
                            $this->data['usermessage'] = array('success', 'green', 'Mail was sent', '');
                            break;
                        case 'gold':
                            $data_where = array(
                                'usertype' => '2',
                            );
                            $user_list = $this->user->listUser($data_where);
                            foreach ($user_list as $user) {
                                $content = replace_data($content, array('fullname' => $user->firstname . ' ' . $user->lastname));
                                sendmail($user->email, $subject, $content);
                            }
                            $this->data['usermessage'] = array('success', 'green', 'Mail was sent', '');
                            break;
                        case 'silver':
                            $data_where = array(
                                'usertype !=' => '1'
                            );
                            $user_list = $this->user->listUser($data_where);
                            foreach ($user_list as $user) {
                                $content = replace_data($content, array('fullname' => $user->firstname . ' ' . $user->lastname));
                                sendmail($user->email, $subject, $content);
                            }
                            $this->data['usermessage'] = array('success', 'green', 'Mail was sent', '');
                            break;

                        default:
                            $user = $this->user->getMainUserByMainId($user);
                            $content = replace_data($content, array('fullname' => $user->firstname . ' ' . $user->lastname));
                            sendmail($user->email, $subject, $content);
                            $this->data['usermessage'] = array('success', 'green', 'Mail was sent', '');
                            break;
                    }
                }
            }
        }
        $this->view('admin/tool/sent_mail', 'admin');
    }

    public function user_ajax() {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $users = $this->user->listMainUser(array('term' => $q));
            $results = array(
                'all' => 'All',
                'silver' => 'Silver',
                'gold' => 'Gold'
            );

            foreach ($users as $row) {
                if ($row->email != 'admin@gmail.com')
                    $results[$row->main_id] = $row->firstname .' ' .$row->lastname;
            }
            echo json_encode($results);
        }
    }

}