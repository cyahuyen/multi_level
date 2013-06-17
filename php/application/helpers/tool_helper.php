
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('getStartAndEndDate')) {

    function getStartAndEndDateByWeek($week, $year) {
        $date_string = $year . 'W' . sprintf('%02d', $week);
        
        $return[0] = date('Y-m-d h:i:s', strtotime($date_string . '0'));
        $return[1] = date('Y-m-d h:i:s', strtotime($date_string . '6'));
        return $return;
    }

}
if (!function_exists('getStartAndEndDateByMonth')) {
    function getStartAndEndDateByMonth($month, $year) {
        $return[0] = $year . '-' . $month .'-01 00:00:00';
        $return[1] = date('Y-m-d h:i:s', strtotime('-1 second',strtotime('+1 month',strtotime($month.'/01/'.$year.' 00:00:00'))));
        return $return;
    }

}