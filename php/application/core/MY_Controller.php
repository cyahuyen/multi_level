<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * A base controller for all controllers, here we set various variables and tasks to avoid redundantly doing it throughout codebase
 *
 * @author 		Dean Gleeson <dean.gleeson@pragmaticsystems.com.au>
 * @date 		14/12/2012
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

    public function __construct() {
        parent::__construct();

    }

}