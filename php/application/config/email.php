<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
/* 
| ------------------------------------------------------------------- 
| EMAIL CONFING 
| ------------------------------------------------------------------- 
| Configuration of outgoing mail server. 
| */   
$config['protocol']='smtp';  
$config['smtp_host']='serveraddress';  
$config['smtp_port']='25';  
$config['smtp_timeout']='30';  
$config['smtp_user']='test@server.com';  
$config['smtp_pass']='password';  
$config['charset']='utf-8';  
$config['mailtype'] = 'html';
$config['newline']="\r\n";  
  
/* End of file email.php */  
/* Location: ./system/application/config/email.php */  