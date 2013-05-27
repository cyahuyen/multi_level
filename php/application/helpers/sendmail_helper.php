<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('sendmail')) {

    function sendmail($emailTo, $subject, $content, $emailFrom = null, $name = null, $mailtype = 'html') {
        $CI = & get_instance();




        $CI->load->library('email');
        $CI->load->model('config_model', 'configs');
        $CI->email->clear();
        $emailConfig = $CI->configs->getConfigs('emails');
        $CI->email->from($emailConfig['smtp_user'], $emailConfig['email_admin']);



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
        if ($emailConfig['protocol'] == 'mail') {
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
        }
        $headers = '';
        if ($mailtype == 'html') {
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        }
        $headers .= 'From: ' . $emailConfig['email_admin'] . "\r\n" .
                'Reply-To: ' . $emailConfig['email_admin'] . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        return mail($emailTo, $subject, $content, $headers);
    }

}

if (!function_exists('sendmailform')) {

    function sendmailform($emailTo, $code, $data, $emailFrom = null, $name = null, $mailtype = 'html') {
        $CI = & get_instance();
        $CI->load->model('emailtemplate_model', 'emailtemplate');

        $email = $CI->emailtemplate->getEmailByCode($code);

        if ($email) {
            $subject = replace_data($email->subject, $data);
            $content = replace_data($email->content, $data);

            sendmail($emailTo, $subject, $content, $emailFrom = null, $name = null, $mailtype = 'html');
        }
    }

}

if (!function_exists('replace_data')) {

    function replace_data($string, $data) {
//        preg_match_all('/{{(.*?)}}/is', $string, $matches);
//        foreach($matches[1] as $code){
//        }
        foreach ($data as $code => $str_relpace) {
            $string = str_replace('{{' . $code . '}}', $str_relpace, $string);
        }
        return $string;
    }

}


