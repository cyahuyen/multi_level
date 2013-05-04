<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of test
 *
 * @author ngoalongkt
 */
$debug_log = realpath(dirname(__FILE__)) .'/paypal_ipn_logs.txt'; // Debug log file name
$options_login = array(
    'api_secret_word',
    'rest_api_url',
    'rest_api_port'
);

$options = array(
    'paypal_rate',
    
);

class paypal_ipn_handler {

    var $last_error;                 // holds the last error encountered
    var $ipn_log;                    // bool: log IPN results to text file?
    var $ipn_log_file;               // filename of the IPN log
    var $ipn_response;               // holds the IPN response from paypal
    var $ipn_data = array();         // array contains the POST values for IPN
    var $fields = array();           // array holds the fields to submit to paypal
    var $options_login;
    var $options;

    function paypal_ipn_handler($url, $file, $options_login, $options) {
        $this->paypal_url = $url;
        $this->last_error = '';
        $this->ipn_log_file = $file;
        $this->ipn_response = '';
        $this->options_login = $options_login;
        $this->options = $options;
    }

    function validate_ipn() {
        //get_currentuserinfo();
        //$this->debug_log('URL: '.$this->paypal_url,true);
        // parse the paypal URL
        $url_parsed = parse_url($this->paypal_url);

        // generate the post string from the _POST vars aswell as load the _POST vars into an arry
        $post_string = '';
        foreach ($_POST as $field => $value) {
            $this->ipn_data["$field"] = $value;
            $post_string .= $field . '=' . urlencode(stripslashes($value)) . '&';
        }

        $this->post_string = $post_string;
        $this->debug_log('Post string : ' . $this->post_string, true);

        $post_string.="cmd=_notify-validate"; // append ipn command
        // open the connection to paypal
        $fp = fsockopen($url_parsed['host'], "80", $err_num, $err_str, 30);
        if (!$fp) {
            // could not open the connection.  If loggin is on, the error message
            // will be in the log.
            $this->debug_log('Connection to ' . $url_parsed['host'] . " failed.fsockopen error no. $errnum: $errstr", false);
            return false;
        } else {
            // Post the data back to paypal
            fputs($fp, "POST $url_parsed[path] HTTP/1.1\r\n");
            fputs($fp, "Host: $url_parsed[host]\r\n");
            fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
            fputs($fp, "Content-length: " . strlen($post_string) . "\r\n");
            fputs($fp, "Connection: close\r\n\r\n");
            fputs($fp, $post_string . "\r\n\r\n");

            // loop through the response from the server and append to variable
            while (!feof($fp)) {
                $this->ipn_response .= fgets($fp, 1024);
            }

            fclose($fp); // close connection

            $this->debug_log('Connection to ' . $url_parsed['host'] . ' successfuly completed.', true);
        }
        $this->debug_log('URL: '.$this->ipn_response,true);  
        
        if (eregi("VERIFIED", $this->ipn_response)) {
            // Valid IPN transaction.
            $datas = explode('|', $_POST['custom']);
            $user_ID = $datas[1];
            $this->debug_log('User ID: ' . $user_ID, true);
            //$curl_post_data = array("serect_word" => md5($options['api_secret_word']), account_number => '88888888');
            //$data_return = cyafun_login_restapi($options['rest_api_url'], $options['rest_api_port'], 'check_account_number', $curl_post_data);
            //$this->debug_log('Post string : ' . $data_return->status, true);
            //insert into cyagames_user_balances table            
            $rate = $this->options['paypal_rate'];
            $coins = $datas[0];
            $amount = $this->ipn_data['mc_gross'];//Amout
            $amount_text = $datas[2];
            $deposit_currency = $this->ipn_data['mc_currency'];
            $transaction_return_value = $this->ipn_data['txn_id'];//Transaction id
            $deposit_rate = $datas[3];
            $deposit_fee = $datas[4];
            $deposit_fee_text = $datas[5];
            $deposit_status = $this->ipn_data['payment_status'];// Payment Status

            
            $this->debug_log('IPN successfully verified.', true);
            return true;
        } else {
            // Invalid IPN transaction.  Check the log for details.
            $this->debug_log('IPN validation failed.', false);
            return false;
        }
    }

    function log_ipn_results($success) {
        if (!$this->ipn_log)
            return;  // is logging turned off?
        // Timestamp
        $text = '[' . date('m/d/Y g:i A') . '] - ';

        // Success or failure being logged?
        if ($success)
            $text .= "SUCCESS!\n";
        else
            $text .= 'FAIL: ' . $this->last_error . "\n";

        // Log the POST variables
        $text .= "IPN POST Vars from Paypal:\n";
        foreach ($this->ipn_data as $key => $value) {
            $text .= "$key=$value, ";
        }

        // Log the response from the paypal server
        $text .= "\nIPN Response from Paypal Server:\n " . $this->ipn_response;

        // Write to log
        $fp = fopen($this->ipn_log_file, 'a');
        fwrite($fp, $text . "\n\n");

        fclose($fp);  // close file
    }

    function debug_log($message, $success, $end = false) {

        if (!$this->ipn_log)
            return;  // is logging turned off?
        // Timestamp
        $text = '[' . date('m/d/Y g:i A') . '] - ' . (($success) ? 'SUCCESS :' : 'FAILURE :') . $message . "\n";

        if ($end) {
            $text .= "\n------------------------------------------------------------------\n\n";
        }

        // Write to log
        $fp = fopen($this->ipn_log_file, 'a');
        fwrite($fp, $text);
        fclose($fp);  // close file
    }

}

$url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
$ipn_handler_instance = new paypal_ipn_handler($url, $debug_log, $options_login, $options);

$debug_enabled = true; //get_option('wp_cart_enable_debug');

if ($debug_enabled) {
    echo 'Debug is enabled. Check the ' . $debug_log . ' file for debug output.';
    $ipn_handler_instance->ipn_log = true;
    $ipn_handler_instance->ipn_log_file = $debug_log;
}


$ipn_handler_instance->debug_log('Paypal Class Initiated by ' . $_SERVER['REMOTE_ADDR'], true);
// Validate the IPN
if ($ipn_handler_instance->validate_ipn()) {
    $ipn_handler_instance->debug_log('Creating prodcut Information to send.', true);
}
$ipn_handler_instance->debug_log('Paypal class finished.', true, true);
?>
