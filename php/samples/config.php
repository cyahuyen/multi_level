<?php
/**
 * This file contains config info for the sample app.
 */

// Adjust this to point to the Authorize.Net PHP SDK
require_once 'anet_php_sdk/AuthorizeNet.php';


$METHOD_TO_USE = "AIM";
// $METHOD_TO_USE = "DIRECT_POST";         // Uncomment this line to test DPM


define("AUTHORIZENET_API_LOGIN_ID","959MxRrx6");    // Add your API LOGIN ID
define("AUTHORIZENET_TRANSACTION_KEY","2KZ3b429WZ3e92tN"); // Add your API transaction key
define("AUTHORIZENET_SANDBOX",true);       // Set to false to test against production
define("TEST_REQUEST", "true");           // You may want to set to true if testing against production


// You only need to adjust the two variables below if testing DPM
define("AUTHORIZENET_MD5_SETTING","");                // Add your MD5 Setting.
$site_root = "http://YOURDOMAIN/samples/your_store/"; // Add the URL to your site


$transaction = new AuthorizeNetAIM(AUTHORIZENET_API_LOGIN_ID, AUTHORIZENET_TRANSACTION_KEY);
$transaction->amount = '9.99';
$transaction->card_num = '4222222222222';
$transaction->exp_date = '1234';

$response = $transaction->authorizeAndCapture();

if ($response->approved) {
  echo "<h1>Success! The test credit card has been charged!</h1>";
  echo "Transaction ID: " . $response->transaction_id;
} else {
  echo $response->error_message;
}


if (AUTHORIZENET_API_LOGIN_ID == "") {
    die('Enter your merchant credentials in config.php before running the sample app.');
}
