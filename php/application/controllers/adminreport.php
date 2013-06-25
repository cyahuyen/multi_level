<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of adminreport
 *
 * @author ngoalongkt
 */
class Adminreport extends MY_Controller {

    var $navstack = null;
    var $usertype = array('0' => 'Member', '1' => 'Silver', '2' => 'Gold');

    public function __construct() {

        parent::__construct();

        $this->load->model('user_model', 'user');
        $this->load->model('balance_model', 'balance');
        $this->load->model('transaction_model', 'transaction');
        $this->data['menu_config'] = $this->menu_config_5;
        $user_session = $this->session->userdata('user');
        if (empty($user_session) || $user_session['permission'] != 'administrator') {
            redirect(site_url('home'));
        }
        $this->data['user_session'] = $user_session;
    }

    public function index() {
        $this->data['main_content'] = 'includes/main_content.php';
        $this->data['title'] = 'Report';



        if ($this->input->get('date'))
            $date = $this->input->get('date');
        else
            $date = date('Y-m-d', time());
        $date_week = getStartAndEndDateByWeek(date('W', strtotime($date)), date('Y', strtotime($date)));
        $date_month = getStartAndEndDateByMonth(date('m', strtotime($date)), date('Y', strtotime($date)));
        $day_of_last_week = date('Y-m-d h:i:s', strtotime('-1 second', strtotime($date_week[0])));
        $last_week = getStartAndEndDateByWeek(date('W', strtotime($day_of_last_week)), date('Y', strtotime($day_of_last_week)));
        $this->data['date'] = $date;
        $this->data['date_week'] = $date_week;
        $this->data['date_month'] = $date_month;

        $dataWhereUserMonth = array(
            'user_main.created_on >=' => $date_month[0],
            'user_main.created_on <=' => $date_month[1],
        );
        $this->data['totalUserByMonth'] = $this->user->totalMainUser($dataWhereUserMonth);
        $this->data['listAllUserByMonth'] = $this->user->listMainUser($dataWhereUserMonth);

        $dataWhereUserWeek = array(
            'user_main.created_on >=' => $date_week[0],
            'user_main.created_on <=' => $date_week[1],
        );
        $this->data['totalUserByWeek'] = $this->user->totalMainUser($dataWhereUserWeek);
        $this->data['listAllUserByWeek'] = $this->user->listMainUser($dataWhereUserWeek);

        $dataWhereListUserWeek = array(
            'user_main.created_on >=' => $date_week[0],
            'user_main.created_on <=' => $date_week[1],
        );
        $this->data['listUserByWeek'] = $this->user->listReferes($dataWhereListUserWeek);

        $dataWhereTransactionGoldMonth = array(
            'transaction.created >=' => $date_month[0],
            'transaction.created <=' => $date_month[1],
            'user.usertype' => 2,
            'transaction.transaction_type IN("register","refere","bonus","deposit")' => null,
        );
        $this->data['totalTransactionGoldMonth'] = $this->transaction->totalAmountTransfer($dataWhereTransactionGoldMonth);
        $this->data['listTransactionGoldMonth'] = $this->transaction->getTransfers($dataWhereTransactionGoldMonth);


        $dataWhereTransactionGoldWeek = array(
            'transaction.created >=' => $date_week[0],
            'transaction.created <=' => $date_week[1],
            'user.usertype' => 2,
            'transaction.transaction_type IN("register","refere","deposit")' => null,
        );
        $this->data['totalTransactionGoldWeek'] = $this->transaction->totalAmountTransfer($dataWhereTransactionGoldWeek);
        $this->data['listTransactionGoldWeek'] = $this->transaction->getTransfers($dataWhereTransactionGoldWeek);

        $dataWhereTransactionSilverMonth = array(
            'transaction.created >=' => $date_month[0],
            'transaction.created <=' => $date_month[1],
            'user.usertype' => 1,
            'transaction.transaction_type IN("register","refere","bonus","deposit")' => null,
        );
        $this->data['totalTransactionSilverMonth'] = $this->transaction->totalAmountTransfer($dataWhereTransactionSilverMonth);
        $this->data['listTransactionSilverMonth'] = $this->transaction->getTransfers($dataWhereTransactionSilverMonth);

        $dataWhereTransactionSilverWeek = array(
            'transaction.created >=' => $date_week[0],
            'transaction.created <=' => $date_week[1],
            'user.usertype' => 1,
            'transaction.transaction_type IN("register","refere","deposit")' => null,
        );
        $this->data['totalTransactionSilverWeek'] = $this->transaction->totalAmountTransfer($dataWhereTransactionSilverWeek);
        $this->data['listTransactionSilverWeek'] = $this->transaction->getTransfers($dataWhereTransactionSilverWeek);

        $dataWhereTransactionRefereMonth = array(
            'transaction.created >=' => $date_month[0],
            'transaction.created <=' => $date_month[1],
            'transaction.transaction_type' => 'refere',
        );
        $this->data['totalTransactionRefereMonth'] = $this->transaction->totalAmountTransfer($dataWhereTransactionRefereMonth);
        $this->data['listTransactionRefereMonth'] = $this->transaction->getTransfers($dataWhereTransactionRefereMonth);
        
        
        
        $dataWhereTransactionRefereWeek = array(
            'transaction.created >=' => $date_week[0],
            'transaction.created <=' => $date_week[1],
            'transaction.transaction_type' => 'refere',
        );
        $this->data['totalTransactionRefereWeek'] = $this->transaction->totalAmountTransfer($dataWhereTransactionRefereWeek);
        $this->data['listTransactionRefereWeek'] = $this->transaction->getTransfers($dataWhereTransactionRefereWeek);


        $dataWhereTransactionAmountMemberMonth = array(
            'transaction.created >=' => $date_month[0],
            'transaction.created <=' => $date_month[1],
            'transaction.transaction_type IN("register","refere","bonus","deposit")' => null,
        );
        $this->data['totalTransactionAmountMemberMonth'] = $this->transaction->totalAmountTransfer($dataWhereTransactionAmountMemberMonth);
        $this->data['listTransactionAmountMemberMonth'] = $this->transaction->getTransfers($dataWhereTransactionAmountMemberMonth);

        $dataWhereTransactionAmountMemberWeek = array(
            'transaction.created >=' => $date_week[0],
            'transaction.created <=' => $date_week[1],
            'transaction.transaction_type' => 'refere',
            'transaction.transaction_type IN("register","refere","deposit")' => null,
        );
        $this->data['totalTransactionAmountMemberWeek'] = $this->transaction->totalAmountTransfer($dataWhereTransactionAmountMemberWeek);
        $this->data['listTransactionAmountMemberWeek'] = $this->transaction->getTransfers($dataWhereTransactionAmountMemberWeek);

        $dataWhereTransactionAmountMemberLastWeek = array(
            'transaction.created >=' => $last_week[0],
            'transaction.created <=' => $last_week[1],
            'transaction.transaction_type' => 'refere',
            'transaction.transaction_type IN("register","refere","deposit")' => null,
        );
        $this->data['totalTransactionAmountMemberLastWeek'] = $this->transaction->totalAmountTransfer($dataWhereTransactionAmountMemberLastWeek);
        $this->data['listTransactionAmountMemberLastWeek'] = $this->transaction->getTransfers($dataWhereTransactionAmountMemberLastWeek);

        $totalWeek = !empty($this->data['totalTransactionAmountMemberLastWeek']) ? $this->data['totalTransactionAmountMemberLastWeek'] : 1;
        $this->data['percenter'] = ($this->data['totalTransactionAmountMemberWeek'] - $this->data['totalTransactionAmountMemberLastWeek']) / $totalWeek * 100;



        $this->data['main_content'] = 'adminreport/index';
        $this->load->view('administrator', $this->data);
    }

}

?>
