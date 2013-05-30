<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Admin User page controller
 * @author	KhiemPham <khiemktqd@gmail.com>
 * @date	02/05/2013
 */
class Adminwithdrawal extends MY_Controller {

    private $data;
    var $navstack = null;
    var $wallists = 'Withdrawal Config';

    public function __construct() {

        parent::__construct();

        $this->load->model('transaction_model', 'transaction');
        $this->load->model('balance_model', 'balance');


        $user_session = $this->session->userdata('user');
        $this->data['user_session'] = $user_session;
        if (empty($user_session) || $user_session['permission'] != 'administrator') {
            redirect(site_url('home'));
        }

        $this->data['menu_config'] = $this->menu_config_8;
        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
    }

    public function manager() {
        $this->data['title'] = 'Manager Withdrawal';
        $this->data['main_content'] = 'adminwithdrawal/manager';
        $this->load->view('administrator', $this->data);
    }

    public function payment_sucess($id = 0) {
        if ($this->transaction->updateHistory(array('payment_status' => 1), $id)) {
            $history = $this->transaction->getHistoryById($id);
            $data['total'] = $history->total;
            $data['fees'] = $history->fees;
            $data['user_id'] = $history->user_id;
            $data['payment_status'] = 'Completed';
            $data['transaction_type'] = 'withdrawal';
            $data['transaction_text'] = '-';
            $data['transaction_source'] = 'system';
            $data['status'] = 0;

            $this->transaction->insert($data);

            $balance_info = $this->balance->getBalance($history->user_id);
            $amount_current = !empty($balance_info->balance) ? $balance_info->balance : 0;

            $balance = $amount_current - $history->total;

            $this->balance->updateBalanceByUserId($history->user_id, $balance);

            $adminBalance = $history->fees - $history->total;
            
            $this->balance->updateAdminBalance($adminBalance);

            $email['amount'] = $history->total - $history->fees;
            $email['fullname'] = $history->firstname . ' ' . $history->lastname;

            sendmailform($history->email, 'payment_sucess', $email);

            $this->data['usermessage'] = array('success', 'green', 'Withdrawal Success', '');
            $this->session->set_flashdata(array('usermessage' => $this->data['usermessage']));
            redirect('adminwithdrawal/manager');
        } else {
            $error = array('error', 'darkred', 'Withdrawal errors', '');


            $this->session->set_flashdata(array('usermessage' => $error));
            redirect('adminwithdrawal/manager');
        }
    }

    public function payment_cancel($id = 0) {
        $this->transaction->updateHistory(array('payment_status' => 2), $id);
        $this->data['usermessage'] = array('success', 'green', 'Withdrawal Cancel Success', '');
        $this->session->set_flashdata(array('usermessage' => $this->data['usermessage']));

        $history = $this->transaction->getHistoryById($id);
        if ($history) {
            $data['amount'] = $history->total - $history->fees;
            $data['fullname'] = $history->firstname . ' ' . $history->lastname;

            sendmailform($history->email, 'payment_cancel', $data);
        }

        redirect('adminwithdrawal/manager');
    }

    public function withdrawallist($status = null) {
        $posts = $this->input->post();
        $this->config->load('cya_config', TRUE);

        $dataWhere['searchby'] = $posts['searchby'];
        $limit = $this->config->item('limit_page', 'my_config');

        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if (!empty($posts['asc'])) {
            $sort[$posts['sort']] = 'ASC';
        } else {
            $sort[$posts['sort']] = 'DESC';
        }
//       Begin pagination
        $this->load->library("pagination");
        $config = array();
        $config["total_rows"] = $this->transaction->totalWithdrawal($dataWhere);
        $config["base_url"] = site_url('user/manage');
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

        $this->data['wallists'] = $this->transaction->listWithdrawal($dataWhere, $limit, $start, $sort);
        $json['wallists'] = $this->load->view('adminwithdrawal/withdrawal', $this->data, true);
        echo json_encode($json);
    }

    public function profile($id = 0) {
        $this->data['title'] = 'Manager Withdrawal';
        if (!empty($id))
            $this->data['emaildata'] = $this->transaction->getEmailById($id);

        $msg = $this->session->flashdata('usermessage');
        if ($msg) {
            $this->data['usermessage'] = $msg;
        }
        $this->data['posts'] = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = $this->input->post();
            $validationErrors = array();
            if ($posts['code'] == '') {
                $validationErrors['code'] = "Code cannot be blank";
            }
            if ($posts['subject'] == '') {
                $validationErrors['subject'] = "Subject cannot be blank";
            }

            $this->data['posts'] = $posts;
            foreach ($posts as $key => $val) {
                $this->data['emaildata']->$key = $val;
            }
            if (count($validationErrors) != 0) {
                $this->data['usermessage'] = array('error', 'darkred', 'Validation errors found', 'Please see below');
                $this->data['fielderrors'] = $validationErrors;
            } else {
                unset($posts['save-btn']);
                unset($posts['repassword']);
                $id = (int) $id;
                if (empty($id)) {
                    $id = $this->transaction->insert($posts);
                    if (!empty($id))
                        $this->data['usermessage'] = array('success', 'green', 'Successfully saved ', '');
                    else
                        $this->data['usermessage'] = array('error', 'darkred', 'Error saved', '');
                    $this->session->set_flashdata(array('usermessage' => $this->data['usermessage']));
                    redirect(site_url('adminwithdrawal/profile/' . $id));
                } else {

                    if ($this->transaction->update($id, $posts))
                        $this->data['usermessage'] = array('success', 'green', 'Successfully saved', '');
                    else
                        $this->data['usermessage'] = array('error', 'darkred', 'Error saved', '');
                    $this->session->set_flashdata(array('usermessage' => $this->data['usermessage']));
                    redirect(site_url('adminwithdrawal/profile/' . $id));
                }
            }
        }
        $this->data['main_content'] = 'adminwithdrawal/profile';
        $this->load->view('administrator', $this->data);
    }

}

?>
