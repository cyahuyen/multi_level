<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Job management controller
 * @author	Dean Gleeson <dean.gleeson@pragmaticsystems.com.au>
 * @date	21/04/2013
 */
class Staff extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) {
            redirect('authentication');
        } else {
            $this->load->model('staff_model', 'staff');
            $this->load->model('job_model', 'job');
            $this->load->model('user_model', 'user');
        }
    }

    public function index() {
        $data['user'] = $this->user->getSessionUserDetails();
        $this->navigation->loadJobsView($data);
    }

    public function manage() {
        $data['user'] = $this->user->getSessionUserDetails();

        if (!in_array($data['user'][0]->usertype, array('StaffManager', 'Administrator')))
            redirect(site_url('home'));


        $this->navigation->loadStaffView($data);
    }

    public function history($id = 0) {
        $data['user'] = $this->user->getSessionUserDetails();

        if (!in_array($data['user'][0]->usertype, array('StaffManager', 'Administrator')))
            redirect(site_url('home'));
        $data['staff_id'] = $id;

        $this->navigation->loadHistoryStaffView($data);
    }

    public function historylist($status = null) {

        $data['user'] = $this->user->getSessionUserDetails();

        $posts = $this->input->post();

        $this->config->load('cya_config', TRUE);

        $status = $posts['status'];
        if ($status != 'all' && !empty($status))
            $dataWhere['job.status'] = $status;
        $dataWhere['searchby'] = $posts['searchby'];
        $dataWhere['staff.id'] = $posts['staff_id'];

        $limit = $this->config->item('per_page', 'cya_config');
        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        if (!empty($posts['asc'])) {
            $sort[$posts['sort']] = 'ASC';
        } else {
            $sort[$posts['sort']] = 'DESC';
        }
//       Begin pagination
        $this->load->library("pagination");
        $config = array();
        $config["total_rows"] = $this->staff->totalStaffHistory($dataWhere);
        $config["base_url"] = site_url('staff/history');
        $config["per_page"] = $limit;
        $page = $start;
        $config["uri_segment"] = 3;
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
        $data['staffs'] = $this->staff->listStaffHistory($dataWhere, $limit, $start, $sort);
        $json['staffs'] = $this->load->view('staff/historylist', $data, true);
        echo json_encode($json);
    }

    public function profile($id = 0) {
        $data['user'] = $this->user->getSessionUserDetails();
        $msg = $this->session->flashdata('usermessage');
        if($msg){
            $data['usermessage'] = $msg;
        }
        if (!empty($id))
            $data['staffdata'] = $this->staff->getStaffById($id);
        if (!in_array($data['user'][0]->usertype, array('StaffManager', 'Administrator')))
            redirect(site_url('home'));


        $data['posts'] = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = $this->input->post();
            $validationErrors = array();

            if ($posts['name'] == '') {
                $validationErrors['name'] = "Staff name cannot be blank";
            }

            $data['posts'] = $posts;
            foreach ($posts as $key => $val) {
                $data['staffdata']->$key = $val;
            }


            if (count($validationErrors) != 0) {
                $data['usermessage'] = array('error', 'darkred', 'Validation errors found', 'Please see below');
                $data['fielderrors'] = $validationErrors;
            } else {
                unset($posts['save-btn']);
                unset($posts['id']);
                if (!empty($posts['dob'])) {
                    $posts['dob'] = date('Y-m-d', strtotime(str_replace('/', '-', $posts['dob'])));
                }
                $id = (int) $id;
                if (empty($id)) {
                    $id = $this->staff->insert($posts);
                    $data['usermessage'] = array('success', 'green', 'Successfully saved ', '');
                    $this->session->set_flashdata(array('usermessage' => $data['usermessage']));
                    redirect(site_url('staff/profile/'.$id));
                } else {
                    $this->staff->update($posts, $id);
                    $data['usermessage'] = array('success', 'green', 'Successfully saved', '');
                    $this->session->set_flashdata(array('usermessage' => $data['usermessage']));
                    redirect(site_url('staff/profile/'.$id));
                }
            }
        }
        $this->navigation->loadProfileStaffView($data);
    }

    public function stafflist($status = null) {

        $data['user'] = $this->user->getSessionUserDetails();

        $posts = $this->input->post();

        $this->config->load('cya_config', TRUE);

        $status = $posts['status'];
        if ($status != 'all')
            $dataWhere['status'] = $status;
        $dataWhere['searchby'] = $posts['searchby'];

        $limit = $this->config->item('per_page', 'cya_config');
        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        if (!empty($posts['asc'])) {
            $sort[$posts['sort']] = 'ASC';
        } else {
            $sort[$posts['sort']] = 'DESC';
        }
//       Begin pagination
        $this->load->library("pagination");
        $config = array();
        $config["total_rows"] = $this->staff->totalStaff($dataWhere);
        $config["base_url"] = site_url('staff/manage');
        $config["per_page"] = $limit;
        $page = $start;
        $config["uri_segment"] = 3;
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
        $data['staffs'] = $this->staff->listStaff($dataWhere, $limit, $start, $sort);
        $json['staffs'] = $this->load->view('staff/stafflist', $data, true);
        echo json_encode($json);
    }

    private function getDatalistParams() {
        $datalistParams = $this->session->staffdata('job_datalist_params');
        if ($datalistParams == null) {
            $datalistParams = array(
                'searchValue' => '',
                'filter' => 'open',
                'sortField' => 'id',
                'sortOrder' => 'desc',
                'pagenum' => 0
            );
            $this->session->staffdata['job_datalist_params'] = $datalistParams;
        }
        return $datalistParams;
    }

    public function deactive() {
        $id = $this->input->post('id');
        $this->staff->deactive($id);
    }
    public function history_deactive() {
        $id = $this->input->post('id');
        $this->staff->history_deactive($id);
    }

    public function active() {
        $id = $this->input->post('id');
        $this->staff->active($id);
    }

}

?>