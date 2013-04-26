<?php

// Database variables
$host = "localhost"; //database location
$user = ""; //database username
$pass = ""; //database password
$db_name = ""; //database name
// PayPal settings
$paypal_email = 'paypal@example.com';
$return_url = 'http://example.com/payment-successful.htm';
$cancel_url = 'http://example.com/payment-cancelled.htm';
$notify_url = 'http://example.com/paypal/payments.php';

$item_name = 'Test Item';
$item_amount = 5.00;

// Include Functions
include("functions.php");

//Database Connection
$link = mysql_connect($host, $user, $pass);
mysql_select_db($db_name);

// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])) {

    // Firstly Append paypal account to querystring
    $querystring .= "?business=" . urlencode($paypal_email) . "&";

    // Append amount& currency (£) to quersytring so it cannot be edited in html
    //The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
    $querystring .= "item_name=" . urlencode($item_name) . "&";
    $querystring .= "amount=" . urlencode($item_amount) . "&";

    //loop for posted values and append to querystring
    foreach ($_POST as $key => $value) {
        $value = urlencode(stripslashes($value));
        $querystring .= "$key=$value&";
    }

    // Append paypal return addresses
    $querystring .= "return=" . urlencode(stripslashes($return_url)) . "&";
    $querystring .= "cancel_return=" . urlencode(stripslashes($cancel_url)) . "&";
    $querystring .= "notify_url=" . urlencode($notify_url);

    // Append querystring with custom field
    //$querystring .= "&custom=".USERID;
    // Redirect to paypal IPN
    header('location:https://www.sandbox.paypal.com/cgi-bin/webscr' . $querystring);
    exit();
} else {
    // Response from PayPal
}
