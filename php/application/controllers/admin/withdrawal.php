<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Admin User page controller
 * @author	KhiemPham <khiemktqd@gmail.com>
 * @date	02/05/2013
 */
class Withdrawal extends MY_Controller {

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
        $this->data['main_content'] = 'withdrawal/manager';
        $this->view('admin/withdrawal/manager', 'admin');
    }

    public function payment_sucess($id = 0) {
        if ($this->transaction->updateHistory(array('payment_status' => 1), $id)) {
            $history = $this->transaction->getHistoryById($id);

            $balance_user_amount = $history->total - $history->fees;
            $this->balance->updateAdminBalance($balance_user_amount, '-');
            $dataBalanceUpdate = array(
                'user_id' => $history->user_id,
                'balance' => $balance_user_amount,
            );
            $dataTransaction = $this->balance->updateBalance($dataBalanceUpdate);
            $this->activity->addActivity($history->main_id, 'Withdrawal from the acount ' . $history->acount_number . ' with amount : $' . ($dataBalanceUpdate['balance']), '-', $dataBalanceUpdate['balance']);

//      EOF Check/Create Gold Account
//      BOF Update Transaction
            $dataTransactionUpdate = array(
                'user_id' => !empty($history->user_id) ? $history->user_id : NULL,
                'main_user_id' => $history->main_id,
                'fees' => $history->fees,
                'total' => $history->total,
                'transaction_id' => '',
                'payment_status' => 'Completed',
                'transaction_type' => 'withdrawal',
                'transaction_text' => '-',
                'transaction_source' => '',
                'status' => '0',
            );
            $this->transaction->upadateTransaction($dataTransactionUpdate);

//      EOF Update Transaction
            $email['amount'] = $history->total - $history->fees;
            $email['fullname'] = $history->firstname . ' ' . $history->lastname;

            sendmailform($history->email, 'payment_sucess', $email);

            $this->data['usermessage'] = array('success', 'green', 'Withdrawal Success', '');
            $this->session->set_flashdata(array('usermessage' => $this->data['usermessage']));
            redirect(admin_url('withdrawal/manager'));
        } else {
            $error = array('error', 'darkred', 'Withdrawal errors', '');


            $this->session->set_flashdata(array('usermessage' => $error));
            redirect(admin_url('withdrawal/manager'));
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

        redirect(admin_url('withdrawal/manager'));
    }

    public function withdrawallist($start = 0) {
        $posts = $this->input->post();
        $this->config->load('cya_config', TRUE);

        $dataWhere['searchby'] = $posts['searchby'];
        if ($posts['payment_status'] != 'all')
            $dataWhere['payment_status'] = $posts['payment_status'];
        $limit = $this->config->item('limit_page');

        if (!empty($posts['asc'])) {
            $sort[$posts['sort']] = 'ASC';
        } else {
            $sort[$posts['sort']] = 'DESC';
        }
//       Begin pagination
        $this->load->library("pagination");
        $config = array();
        $config["total_rows"] = $this->transaction->totalWithdrawal($dataWhere);
        $config["base_url"] = admin_url('withdrawal/withdrawallist');
        $config["per_page"] = $limit;
        $page = $start;
        $config["uri_segment"] = 4;
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
        $json['wallists'] = $this->load->view('admin/withdrawal/withdrawal', $this->data, true);
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
                    redirect(admin_url('withdrawal/profile/' . $id));
                } else {

                    if ($this->transaction->update($id, $posts))
                        $this->data['usermessage'] = array('success', 'green', 'Successfully saved', '');
                    else
                        $this->data['usermessage'] = array('error', 'darkred', 'Error saved', '');
                    $this->session->set_flashdata(array('usermessage' => $this->data['usermessage']));
                    redirect(admin_url('withdrawal/profile/' . $id));
                }
            }
        }
        $this->data['main_content'] = 'withdrawal/profile';
        $this->view('admin/withdrawal/profile', $this->data);
    }

}

?>
