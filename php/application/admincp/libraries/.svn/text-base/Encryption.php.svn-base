<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Encryption {

    public function encrypt_password($plain) {
        $password = '';
        for ($i = 0; $i < 10; $i++) {
            $password .= rand();
        }

        $salt = substr(md5($password), 0, 2);

        $password = md5($salt . $plain) . ':' . $salt;

        return $password;
    }

    function tep_not_null($value) {
        if (is_array($value)) {
            if (sizeof($value) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            if (($value != '') && (strtolower($value) != 'null') && (strlen(trim($value)) > 0)) {
                return true;
            } else {
                return false;
            }
        }
    }

    // This funstion validates a plain text password with an
    function validate_password($plain, $encrypted) {
        if ($this->tep_not_null($plain) && $this->tep_not_null($encrypted)) {
            $stack = explode(':', $encrypted);

            if (sizeof($stack) != 2)
                return false;

            if (md5($stack[1] . $plain) == $stack[0]) {
                return true;
            }
        }

        return false;
    }

}

?>
