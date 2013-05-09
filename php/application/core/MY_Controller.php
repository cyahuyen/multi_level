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
    var $menu_config_1 = array('active', '', '', '', '', '', '', '', '', '');
    var $menu_config_2 = array('', 'active', '', '', '', '', '', '', '', '');
    var $menu_config_3 = array('', '', 'active', '', '', '', '', '', '', '');
    var $menu_config_4 = array('', '', '', 'active', '', '', '', '', '', '');
    var $menu_config_5 = array('', '', '', '', 'active', '', '', '', '', '');
    var $menu_config_6 = array('', '', '', '', '', 'active', '', '', '', '');
    var $menu_config_7 = array('', '', '', '', '', '', 'active', '', '', '');
    var $menu_config_8 = array('', '', '', '', '', '', '', 'active', '', '');
    var $menu_config_9 = array('', '', '', '', '', '', '', '', 'active', '');
    var $menu_config_10 = array('', '', '', '', '', '', '', '', '', 'active');
    
    public function __construct() {
        parent::__construct();

//		$this->load->library('navigation');
        // $this->load->library('lookupValues');
        //$urlBase = base_url();
        //$urlBaseArray = explode("/", $urlBase);
        //$urlReferer = $_SERVER['HTTP_REFERER'];
        //$urlRefererArray = explode("/", $urlReferer);
        //$urlCurrent = current_url();
        //$urlCurrentArray = explode("/", $urlCurrent);
        //var_dump($urlBaseArray);
        //var_dump($urlRefererArray);
        //var_dump($urlCurrentArray);
        //var_dump(index_page());	
        //$urlReferer = $_SERVER['HTTP_REFERER'];
        //$urlRefererArray = explode("/", $urlReferer);
        /*
          $indexPage = index_page();
          if ($indexPage != null && $indexPage != "")
          {
          $significantSegments = array();
          $collectSegments = false;
          foreach ($urlRefererArray as $urlRefererSegment)
          {
          if ($collectSegments)
          {
          $significantSegments[] = $urlRefererSegment;
          }
          else if (!$collectSegments && $urlRefererSegment == $indexPage)
          {
          $collectSegments = true;
          }
          }
          var_dump($significantSegments);
          }
          else // http re=write going on, use base_url()
          {
          }
         */
    }

}