<?php

/* * ************ Cyasoft Company ****************
  ------ Author : NgocLC - CYASOFT Developer -----
  ------ Email  : ngoclc@cyasoft.com -------------
  ------ Date   : 07/2012 ------------------------
 * ********************************************* */

$lang['headding_title'] = 'Payment Form and Button Generator';
$lang['text_notice1'] = 'The most simple code that will allow you to accept payments is: https://sci.libertyreserve.com/en?EG_acc=U123456. Make sure to replace U123456 with your EG account!';
$lang['text_notice2'] = 'For more advanced code please answer the following questions. This will generate a HTML code that can be incorporated into your website to allow members to send payments to your EG account.';
$lang['text_step1'] = 'Enter you account number (required). Examples: 12345678, 11113333.';
$lang['text_step2'] = 'Enter customers account number (leave blank to allow anyone to send you funds). Examples: u1234567, x3214567.';
$lang['text_step3'] = 'Amount (leave blank to allow your customers to send any amount). Examples: 5, 5.55.';
$lang['text_step4'] = 'Enter forced comment that will be included with the payment (leave blank to allow customers to specify their own memo). Maximum 100 characters. ';
$lang['text_step5'] = 'Enter merchant reference code (you can leave it empty). Maximum 20 characters. Example: HGF44556756.';
$lang['text_step6'] = 'Enter the page you wish your customers to go after a successful payment (leaving this field blank will make your customers return to the original page on your website or to the URL specified in the SCI store settings (if you choose to use one in the advanced options)). Examples: http://www.example.com/success.html.';
$lang['text_step7'] = 'Select the method the transaction data will be sent to the success URL with (this will override the SCI store settings).';
$lang['text_step8'] = 'Enter the page you wish your customers to go after a failed/canceled payment (leaving this field blank will make your customers return to the original page on your website or to the URL specified in the SCI store settings (if you choose to use one in the advanced options)). Examples: http://www.example.com/fail.html.';
$lang['text_step9'] = 'Select the method the transaction data will be sent to the fail URL with (this will override the SCI store settings).';
$lang['text_adv_title'] = 'Advanced Options';
$lang['text_adv_notice'] = 'The following options allow you to authenticate the EG response and make sure that the transaction was made exactly as you requested. In order to use these advanced options you will have to create a SCI store inside your account: login to your account, go to Merchant Tools, select Create new store and fill all the appropriate fields.';
$lang['text_adv_step2'] = 'Enter the store name.';
$lang['text_adv_step3'] = 'Override the status URL that was specified in your store settings. You may enter URL or email link. Examples: http://www.example.com/status.aspx, mailto:mymail@example.com.';
$lang['text_adv_step4'] = 'Override the HTTP method of data transmission to status URL.';
$lang['text_baggage'] = 'Baggage Fields (optional)';
$lang['text_baggage_notice'] = 'You may send additional passthrough information that will be returned to you and will not be stored anywhere in our system. This may include order numbers, customer user names or any other data. You will need to specify the field name and the field value. You can enter up to 10 different fields with information limited to 50 characters.';
$lang['text_request_method'] = 'Request Method';
$lang['text_get'] = 'GET';
$lang['text_post'] = 'POST';
$lang['text_link'] = 'LINK';
$lang['button_generate'] = 'Generate';
$lang['button_reset'] = 'Reset';
$lang['text_sci'] = 'SCI Link';
$lang['text_url'] = 'URL';
$lang['text_html'] = 'HTML';
$lang['text_button'] = 'SCI Buttons';

?>
