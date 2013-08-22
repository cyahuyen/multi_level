<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * A base controller for all controllers, here we set various variables and tasks to avoid redundantly doing it throughout codebase
 *
 * @author 		Khiem Pham<khiemktqd@gmail.com>
 * @date 		01/06/2013
 */
class MY_Controller extends CI_Controller {

    protected $transaction_type = array('register', 'refere', 'deposit', 'withdraw', 'bonus');
    var $menu_config_0 = array('', '', '', '', '', '', '', '', '', '');
    var $menu_config_1 = array('active', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
    var $menu_config_2 = array('', 'active', '', '', '', '', '', '', '', '', '', '', '', '', '');
    var $menu_config_3 = array('', '', 'active', '', '', '', '', '', '', '', '', '', '', '', '');
    var $menu_config_4 = array('', '', '', 'active', '', '', '', '', '', '', '', '', '', '', '');
    var $menu_config_5 = array('', '', '', '', 'active', '', '', '', '', '', '', '', '', '', '');
    var $menu_config_6 = array('', '', '', '', '', 'active', '', '', '', '', '', '', '', '', '');
    var $menu_config_7 = array('', '', '', '', '', '', 'active', '', '', '', '', '', '', '', '');
    var $menu_config_8 = array('', '', '', '', '', '', '', 'active', '', '', '', '', '', '', '');
    var $menu_config_9 = array('', '', '', '', '', '', '', '', 'active', '', '', '', '', '', '');
    var $menu_config_10 = array('', '', '', '', '', '', '', '', '', 'active', '', '', '', '', '');
    var $menu_config_11 = array('', '', '', '', '', '', '', '', '', '', 'active', '', '', '', '');
    var $menu_config_12 = array('', '', '', '', '', '', '', '', '', '', '', 'active', '', '', '');
    var $menu_config_13 = array('', '', '', '', '', '', '', '', '', '', '', '', 'active', '', '');
    var $menu_config_14 = array('', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '');
    var $menu_config_15 = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active');
    protected $config_data;
    protected $data;

    public function __construct() {
        parent::__construct();
        $this->load->model('config_model', 'configs');
        $this->load->model('activity_model', 'activity');
        $this->config_data = $this->configs->getAllConfigs();
        $this->data['config_data'] = $this->config_data;
    }

    public function view($view, $template = 'default') {
        $this->data['body_html'] = $this->load->view($view, $this->data, true);
        $this->load->view('templates/' . $template, $this->data);
    }

    public function getRefereAmount($amount, $main_id) {
        $referral_bonus = $this->config_data['referral_bonus'];
        $totalReferal = $this->user->totalRefered($main_id);

        $percent = 0;
        foreach ($referral_bonus as $referral) {
            $min = !empty($referral['min']) ? $referral['min'] : 0;
            $max = !empty($referral['max']) ? $referral['max'] : 0;

            if ($referral) {
                if (empty($max)) {
                    if ($totalReferal > $min) {
                        $percent = !empty($referral['refere']) ? $referral['refere'] : 0;
                    }
                } else {
                    if ($totalReferal >= $min && $totalReferal <= $max) {
                        $percent = !empty($referral['refere']) ? $referral['refere'] : 0;
                    }
                }
            }
        }

        return ($percent * $amount / 100);
    }

}