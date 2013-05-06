<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('sendmail')) {

    function sendmail($emailTo, $subject, $content, $emailFrom = null, $name = null, $mailtype = 'html') {
        $CI = & get_instance();

        
        
        
        $CI->load->library('email', $config);
        $CI->load->model('config_model', 'configs');
        $CI->email->clear();
        $CI->email->from($config['smtp_user'], $CI->config->item('email_name'));
        
        $emailConfig = $CI->configs->getConfigs('emails');
        
        $config = Array(
            'protocol' => $emailConfig['protocol'],
            'smtp_host' => $emailConfig['smtp_host'],
            'smtp_port' => $emailConfig['smtp_port'],
            'smtp_user' => $emailConfig['smtp_user'],
            'smtp_pass' => $emailConfig['smtp_pass'],
            'mailtype' => $mailtype,
            'starttls' => true,
            'newline' => '\r\n',
            'charset' => 'utf-8',
            'smtp_timeout' => $emailConfig['smtp_timeout'],
            'email_admin' => $emailConfig['email_admin']
        );
        
        if ($emailFrom)
            $CI->email->reply_to($emailFrom, $name);
        if (!$emailTo)
            $CI->email->to($emailConfig['email_admin']);
        else
            $CI->email->to($emailTo);
        $CI->email->subject($subject);
        $CI->email->message($content);
        if ($CI->email->send())
            return true;
        return FALSE;
//        echo($CI->email->print_debugger());
//        die;
    }

}