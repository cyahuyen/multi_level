<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



if (!function_exists('tep_cfg_select_option')) {

    function tep_cfg_select_option($select_array, $key_value, $key = '') {
        $string = '';

        for ($i = 0, $n = sizeof($select_array); $i < $n; $i++) {
            $name = ((tep_not_null($key)) ? 'configuration[' . $key . ']' : 'configuration_value');

            $string .= '<input type="radio" name="' . $name . '" value="' . $select_array[$i] . '"';

            if ($key_value == $select_array[$i])
                $string .= ' CHECKED';

            $string .= '> ' . $select_array[$i];
        }
        return $string;
    }

}

function tep_not_null($value) {
    if (is_array($value)) {
        if (sizeof($value) > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        if (($value != '') && (strtolower($value) != 'null') && (strlen(trim($value)) > 0)) {
            return true;
        } else {
            return false;
        }
    }
}

