<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Currency Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Dong Hong
 * @email       donghp712@gmail.com
 */
// ------------------------------------------------------------------------

function format_calculation($number = 0, $decimals = 2, $sanitize = FALSE) {
    if ($sanitize) {
        // Remove any non numeric or decimal point characters.
        $number = trim(preg_replace('/([^0-9\.])/i', '', $number));
    }

    return round($number, $decimals);
}

/**
 * format_value
 * Returns a value formatted to a specified number of decimals using the set decimal and thousand separators.
 */
function format_currency($value = FALSE, $decimals = 2, $decimal_sepa = '.', $thousand_sepa = ',', $symbol_left, $symbol_right) {
    // Set decimals and remove any characters that are not number or decimal point (i.e. thousand comma separators).

    $value = format_calculation($value, $decimals);

    // Apply the current currencies decimal and thousand separator
    $value = number_format($value, $decimals, $decimal_sepa, $thousand_sepa);

    $value = $symbol_left . $value . $symbol_right;

    return $value;
}

?>