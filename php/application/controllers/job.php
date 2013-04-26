<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Job management controller
 * @author	Dean Gleeson <dean.gleeson@pragmaticsystems.com.au>
 * @date	21/04/2013
 */
class Job extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) {
            redirect('authentication');
        } else {
            $this->load->model('user_model', 'user');
            $this->load->model('job_model', 'job');
            $this->load->model('product_model', 'product');
            $this->load->model('staff_model', 'staff');
        }
    }

    public function index() {
        $data['user'] = $this->user->getSessionUserDetails();
        $this->navigation->loadJobsView($data);
    }

    public function manage() {
        $data['user'] = $this->user->getSessionUserDetails();
        $data['datalistParams'] = $this->getDatalistParams();
        $this->navigation->loadJobsView($data);
    }

    public function joblist() {
        $data['user'] = $this->user->getSessionUserDetails();

        $posts = $this->input->post();

        $this->config->load('cya_config', TRUE);

        $status = $posts['status'];
        if ($status != 'all')
            $dataWhere['job.status'] = $status;

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
        $config["total_rows"] = $this->job->totalJob($dataWhere);
        $config["base_url"] = site_url('job/manage');
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
        $data['jobs'] = $this->job->listjob($dataWhere, $limit, $start, $sort);
        $json['jobs'] = $this->load->view('job/joblist', $data, true);
        echo json_encode($json);
    }

    public function profile($id = 0) {
        $data['user'] = $this->user->getSessionUserDetails();
        $data['datalistParams'] = $this->getDatalistParams();
        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $data['usermessage'] = $msg;
        }
        if (!empty($id)) {
            $data['jobdata'] = $this->job->getJobById($id);
            $data['listProducts'] = $this->job->getProductByJobId($id);
            $data['listStaffs'] = $this->job->getStaffByJobId($id);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $posts = $this->input->post();

            $validationErrors = array();
            if ($posts['title'] == '') {
                $validationErrors['title'] = "Job name cannot be blank";
            }
            if ($posts['customer'] == '') {
                $validationErrors['customer'] = "Customer name cannot be blank";
            }

            if (!empty($posts['start_date'])) {
                $posts['start_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $posts['start_date'])));
            }

            $data['posts'] = $posts;
            foreach ($posts as $key => $val) {
                $data['productdata']->$key = $val;
            }
            if (!empty($posts['staff_id'])) {
                $data['listStaffs'] = $this->job->getStaffByListStaffId($posts['staff_id']);
            }
            $data['listProducts'] = array();
            if (!empty($posts['product'])) {
                foreach ($posts['product'] as $product) {
                    $objProduct = null;
                    foreach ($product as $key => $val) {
                        $objProduct->$key = $val;
                    }
                    $data['listProducts'][] = $objProduct;
                }
            }
            if (count($validationErrors) != 0) {
                $data['usermessage'] = array('error', 'darkred', 'Validation errors found', 'Please see below');
                $data['fielderrors'] = $validationErrors;
            } else {
                unset($posts['save-btn']);
                $id = (int) $id;

                if (empty($id)) {
                    if (!in_array($data['user'][0]->usertype, array('StaffManager')))
                        redirect(site_url('job/manage'));
                    $job_id = $this->job->insert($posts);
                    $data['usermessage'] = array('success', 'green', 'Successfully saved ', '');
                    $this->session->set_flashdata(array('usermessage' => $data['usermessage']));
                    redirect(site_url('job/profile/' . $job_id));
                } else {
                    $this->job->update($posts, $id);
                    $data['usermessage'] = array('success', 'green', 'Successfully saved', '');
                    $this->session->set_flashdata(array('usermessage' => $data['usermessage']));
                    redirect(site_url('job/profile/' . $id));
                }
            }
        }

        $data['allProducts'] = $this->product->listProduct(array('status' => 1));
        $data['allStaffs'] = $this->staff->listStaff(array('status' => 1));
        $this->navigation->loadProfileJobsView($data);
    }

    public function deactive() {
        $id = $this->input->post('id');
        $this->job->deactive($id);
    }

    public function active() {
        $id = $this->input->post('id');
        $this->job->active($id);
    }

    private function getDatalistParams() {
        $datalistParams = $this->session->userdata('job_datalist_params');
        if ($datalistParams == null) {
            $datalistParams = array(
                'searchValue' => '',
                'filter' => 'open',
                'sortField' => 'id',
                'sortOrder' => 'desc',
                'pagenum' => 0
            );
            $this->session->userdata['job_datalist_params'] = $datalistParams;
        }
        return $datalistParams;
    }

    public function get_staff($id = 0) {

        $data['staff'] = $this->staff->getStaffById($id);
        $this->load->view('job/get_staff', $data);
    }

    public function get_product($id = 0) {
        $data['product'] = $this->job->getProductByProductId($id);
        $this->load->view('job/get_product', $data);
    }

    public function get_customer() {
        $name = $this->input->get('name');
        $customers = $this->job->getCustomer($name);
        $results = array();
        if (!empty($customers)) {
            foreach ($customers as $customer) {
                $results[$customer->customer] = $customer->customer;
            }
        }
        echo json_encode($results);
    }

}

?>