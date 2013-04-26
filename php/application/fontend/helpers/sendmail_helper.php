<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('sendmail')) {

    function sendmail($emailTo, $subject, $content, $emailFrom = null, $name = null, $mailtype = 'html') {
        $CI = & get_instance();

        $config = Array(
            'protocol' => $CI->config->item('protocol'),
            'smtp_host' => $CI->config->item('smtp_host'),
            'smtp_port' => $CI->config->item('smtp_port'),
            'smtp_user' => $CI->config->item('smtp_user'),
            'smtp_pass' => $CI->config->item('smtp_pass'),
            'mailtype' => $mailtype,
            'starttls' => true,
            'newline' => $CI->config->item('newline'),
            'charset' => $CI->config->item('charset'),
            'smtp_timeout' => $CI->config->item('smtp_timeout'),
        );
        $CI->load->library('email', $config);
        $CI->email->clear();
        $CI->email->from($config['smtp_user'], $CI->config->item('email_name'));
        if ($emailFrom)
            $CI->email->reply_to($emailFrom, $name);
        if (!$emailTo)
            $CI->email->to($CI->config->item('email_to'));
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