<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('isSelling')) {

    function isSelling($id) {
        $CI = & get_instance();
        $CI->load->model('customer_model', 'customer');
        return $CI->customer->isSelling($id);
    }

}
if (!function_exists('isLandlor')) {

    function isLandlor($id) {
        $CI = & get_instance();
        $CI->load->model('customer_model', 'customer');
        return $CI->customer->isLandlor($id);
    }

}

