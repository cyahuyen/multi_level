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

if (!empty($payments_config['sandbox'])) {
    define("AUTHORIZENET_SANDBOX", true);
    define("TEST_REQUEST", "true");
}
// Set to false to test against production
else {
    define("AUTHORIZENET_SANDBOX", false);
    define("TEST_REQUEST", "false");
}
// You may want to set to true if testing against production

require dirname(__FILE__) . '/anet_php_sdk/lib/shared/AuthorizeNetRequest.php';
require dirname(__FILE__) . '/anet_php_sdk/lib/shared/AuthorizeNetTypes.php';
require dirname(__FILE__) . '/anet_php_sdk/lib/shared/AuthorizeNetXMLResponse.php';
require dirname(__FILE__) . '/anet_php_sdk/lib/shared/AuthorizeNetResponse.php';
require dirname(__FILE__) . '/anet_php_sdk/lib/AuthorizeNetAIM.php';
require dirname(__FILE__) . '/anet_php_sdk/lib/AuthorizeNetARB.php';
require dirname(__FILE__) . '/anet_php_sdk/lib/AuthorizeNetCIM.php';
require dirname(__FILE__) . '/anet_php_sdk/lib/AuthorizeNetSIM.php';
require dirname(__FILE__) . '/anet_php_sdk/lib/AuthorizeNetDPM.php';
require dirname(__FILE__) . '/anet_php_sdk/lib/AuthorizeNetTD.php';
require dirname(__FILE__) . '/anet_php_sdk/lib/AuthorizeNetCP.php';

if (class_exists("SoapClient")) {
    require dirname(__FILE__) . '/anet_php_sdk/lib/AuthorizeNetSOAP.php';
}


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

}
