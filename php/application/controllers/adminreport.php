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
        $this->data['date'] = $date;
        $data_month = array(
            'created_on >=' => $date_month[0],
            'created_on <=' => $date_month[1]
        );

        $dataSilverMonth = array_merge($data_month, array('usertype' => 1));
        $dataGoldMonth = array_merge($data_month, array('usertype' => 2));
        $dataUserMonth = array_merge($data_month, array('usertype' => 0));

        $dataSilverTotalPaidMonth = array(
            'start_date' => $date_month[0],
            'end_date' => $date_month[1],
            'transaction_type' => array('refere', 'bonus'),
            'usertype' => 1,
        );
        $dataGoldTotalPaidMonth = array(
            'start_date' => $date_month[0],
            'end_date' => $date_month[1],
            'transaction_type' => array('refere', 'bonus'),
            'usertype' => 1,
        );
        $dataTotalDividendsPaidMonth = array(
            'start_date' => $date_month[0],
            'end_date' => $date_month[1],
            'transaction_type' => array('refere', 'bonus'),
        );
        $dataTotalReferralpaid = array(
            'start_date' => $date_month[0],
            'end_date' => $date_month[1],
            'transaction_type' => array('refere'),
        );

        $this->data['user_count_month'] = $this->user->totalUser($data_month);
        $this->data['silver_count_month'] = $this->user->totalUser($dataSilverMonth);
        $this->data['gold_count_month'] = $this->user->totalUser($dataGoldMonth);
        $this->data['silver_total_paid_amount'] = $this->transaction->getTotalAmountPaid($dataSilverTotalPaidMonth);
        $this->data['gold_total_paid_amount'] = $this->transaction->getTotalAmountPaid($dataGoldTotalPaidMonth);
        $this->data['total_dividends_paid_amount'] = $this->transaction->getTotalAmountPaid($dataTotalDividendsPaidMonth);
        $this->data['total_referral_paid'] = $this->transaction->getTotalAmountPaid($dataTotalReferralpaid);

        
        
        
        
        $data_week = array(
            'created_on >=' => $date_week[0],
            'created_on <=' => $date_week[1]
        );

        $dataSilverWeek = array_merge($date_week, array('usertype' => 1));
        $dataGoldWeek = array_merge($date_week, array('usertype' => 2));
        $dataUserWeek = array_merge($date_week, array('usertype' => 0));
        
        $dataSilverTotalPaidWeek = array(
            'start_date' => $date_week[0],
            'end_date' => $date_week[1],
            'transaction_type' => array('refere'),
            'usertype' => 1,
        );
        $dataGoldTotalPaidWeek = array(
            'start_date' => $date_week[0],
            'end_date' => $date_week[1],
            'transaction_type' => array('refere', 'bonus'),
            'usertype' => 1,
        );
        

        $this->data['user_count_week'] = $this->user->totalUser($dataUserWeek);
        $this->data['silver_count_week'] = $this->user->totalUser($dataSilverWeek);
        $this->data['gold_count_week'] = $this->user->totalUser($dataGoldWeek);
        $this->data['silver_total_paid_amount_week'] = $this->transaction->getTotalAmountPaid($dataSilverTotalPaidWeek);
        $this->data['gold_total_paid_amount_week'] = $this->transaction->getTotalAmountPaid($dataGoldTotalPaidWeek);

        
        
        $this->data['main_content'] = 'adminreport/index';
        $this->load->view('administrator', $this->data);
    }

}

?>
