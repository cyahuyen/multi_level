<?php

/**
 * The AuthorizeNet PHP SDK. Include this file in your project.
 *
 * @package AuthorizeNet
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$CI = & get_instance();
$CI->load->model('config_model', 'configs');

$payments_config = $CI->configs->getConfigs('creditcard');

//if (!empty($payments_config['sandbox'])) {
//    define("AUTHORIZENET_SANDBOX", true);
//    define("TEST_REQUEST", "true");
//}
//// Set to false to test against production
//else {
//    define("AUTHORIZENET_SANDBOX", false);
//    define("TEST_REQUEST", "false");
//}
//// You may want to set to true if testing against production
//
//require dirname(__FILE__) . '/anet_php_sdk/lib/shared/AuthorizeNetRequest.php';
//require dirname(__FILE__) . '/anet_php_sdk/lib/shared/AuthorizeNetTypes.php';
//require dirname(__FILE__) . '/anet_php_sdk/lib/shared/AuthorizeNetXMLResponse.php';
//require dirname(__FILE__) . '/anet_php_sdk/lib/shared/AuthorizeNetResponse.php';
//require dirname(__FILE__) . '/anet_php_sdk/lib/AuthorizeNetAIM.php';
//require dirname(__FILE__) . '/anet_php_sdk/lib/AuthorizeNetARB.php';
//require dirname(__FILE__) . '/anet_php_sdk/lib/AuthorizeNetCIM.php';
//require dirname(__FILE__) . '/anet_php_sdk/lib/AuthorizeNetSIM.php';
//require dirname(__FILE__) . '/anet_php_sdk/lib/AuthorizeNetDPM.php';
//require dirname(__FILE__) . '/anet_php_sdk/lib/AuthorizeNetTD.php';
//require dirname(__FILE__) . '/anet_php_sdk/lib/AuthorizeNetCP.php';
//
//if (class_exists("SoapClient")) {
//    require dirname(__FILE__) . '/anet_php_sdk/lib/AuthorizeNetSOAP.php';
//}


if (!function_exists('payment_creditcard')) {

    function payment_creditcard($data) {
        $CI = & get_instance();
        $CI->load->model('config_model', 'configs');

        $payments_config = $CI->configs->getConfigs('creditcard');
        $transaction = new AuthorizeNetAIM($payments_config['login_id'], $payments_config['transaction']);
        $transaction->amount = $data['amount'];
        $transaction->card_num = $data['card_num'];
        $transaction->exp_date = $data['exp_date'];
        $response = $transaction->authorizeAndCapture();

        if ($response->approved) {
            $dataReturn['message'] = 'success';
            $dataReturn['transaction_id'] = $response->transaction_id;
        } else {
            $dataReturn['message'] = 'error';
            $dataReturn['error'] = $response->error_message;
        }
        return $dataReturn;
    }

    function payment_creditcard_authorize($dataControl) {
        $CI = & get_instance();
        $CI->load->model('config_model', 'configs');

        $payments_config = $CI->configs->getConfigs('creditcard');

        if (empty($payments_config['sandbox'])) {
            $url = 'https://secure.authorize.net/gateway/transact.dll';
        } else {
            $url = 'https://test.authorize.net/gateway/transact.dll';
        }


        $data['x_login'] = $payments_config['login_id'];
        $data['x_tran_key'] = $payments_config['transaction'];
        $data['x_version'] = '3.1';
        $data['x_delim_data'] = 'true';
        $data['x_delim_char'] = ',';
        $data['x_encap_char'] = '"';
        $data['x_amount'] = $dataControl['amount'];
        $data['x_currency_code'] = 'USD';
        $data['x_method'] = 'CC';
        $data['x_type'] = 'AUTH_CAPTURE';//($payments_config('authorizenet_aim_method') == 'capture') ? 'AUTH_CAPTURE' : 'AUTH_ONLY';
        $data['x_card_num'] = str_replace(' ', '', $dataControl['card_num']);
        $data['x_exp_date'] = $dataControl['exp_date'];
        $data['x_card_code'] = $dataControl['cc_cvv2'];

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_PORT, 443);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));

        $response = curl_exec($curl);
        $json = array();

        if (curl_error($curl)) {
            $json['error'] = 'CURL ERROR: ' . curl_errno($curl) . '::' . curl_error($curl);
            $dataReturn['message'] = 'error';
            $dataReturn['error'] = 'CURL ERROR: ' . curl_errno($curl) . '::' . curl_error($curl);
        } elseif ($response) {
            $i = 1;

            $response_info = array();

            $results = explode(',', $response);

            foreach ($results as $result) {
                $response_info[$i] = trim($result, '"');

                $i++;
            }

            if ($response_info[1] == '1') {
                $message = '';

                if (isset($response_info['5'])) {
                    $message .= 'Authorization Code: ' . $response_info['5'] . "\n";
                }

                if (isset($response_info['6'])) {
                    $message .= 'AVS Response: ' . $response_info['6'] . "\n";
                }

                if (isset($response_info['7'])) {
                    $message .= 'Transaction ID: ' . $response_info['7'] . "\n";
                }

                if (isset($response_info['39'])) {
                    $message .= 'Card Code Response: ' . $response_info['39'] . "\n";
                }

                if (isset($response_info['40'])) {
                    $message .= 'Cardholder Authentication Verification Response: ' . $response_info['40'] . "\n";
                }


                $json['success'] = $response_info['7'];
                $dataReturn['message'] = 'success';
                $dataReturn['transaction_id'] = $response_info['7'];
            } else {
                $json['error'] = $response_info[4];
                $dataReturn['message'] = 'error';
                $dataReturn['error'] = $response_info[4];
            }
        } else {
            $json['error'] = 'Empty Gateway Response';
            $dataReturn['message'] = 'error';
            $dataReturn['error'] = 'Empty Gateway Response';
        }

        return $dataReturn;
    }

}
