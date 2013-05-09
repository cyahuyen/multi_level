<?php
/**
 * The AuthorizeNet PHP SDK. Include this file in your project.
 *
 * @package AuthorizeNet
 */

define("AUTHORIZENET_SANDBOX",true);       // Set to false to test against production
define("TEST_REQUEST", "true");           // You may want to set to true if testing against production

require dirname(__FILE__) . '/lib/shared/AuthorizeNetRequest.php';
require dirname(__FILE__) . '/lib/shared/AuthorizeNetTypes.php';
require dirname(__FILE__) . '/lib/shared/AuthorizeNetXMLResponse.php';
require dirname(__FILE__) . '/lib/shared/AuthorizeNetResponse.php';
require dirname(__FILE__) . '/lib/AuthorizeNetAIM.php';
require dirname(__FILE__) . '/lib/AuthorizeNetARB.php';
require dirname(__FILE__) . '/lib/AuthorizeNetCIM.php';
require dirname(__FILE__) . '/lib/AuthorizeNetSIM.php';
require dirname(__FILE__) . '/lib/AuthorizeNetDPM.php';
require dirname(__FILE__) . '/lib/AuthorizeNetTD.php';
require dirname(__FILE__) . '/lib/AuthorizeNetCP.php';

if (class_exists("SoapClient")) {
    require dirname(__FILE__) . '/lib/AuthorizeNetSOAP.php';
}
/**
 * Exception class for AuthorizeNet PHP SDK.
 *
 * @package AuthorizeNet
 */
class AuthorizeNetException extends Exception
{
}

$transaction = new AuthorizeNetAIM('6Z2Kgs6W7m', '49yh68ESgd4Sd2Mw');
$transaction->amount = '9.99';
$transaction->card_num = '4007000000027';
$transaction->exp_date = '10/16';

$response = $transaction->authorizeAndCapture();

if ($response->approved) {
  echo "<h1>Success! The test credit card has been charged!</h1>";
  echo "Transaction ID: " . $response->transaction_id;
} else {
  echo $response->error_message;
}
