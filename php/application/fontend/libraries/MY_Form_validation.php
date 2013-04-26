<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class MY_Form_validation extends CI_Form_validation {

    function MY_Form_validation($config = array()) {
        parent::__construct($config);
    }

    public function check_user($str) {
        return (!preg_match("/^([-a-z0-9 _-])+$/i", $str)) ? FALSE : TRUE;
    }

    public function specical_chars($str) {
        return ( preg_match('/[\"\'^£$%&*()}{@#~?><>,|=_+¬-]/', $str)) ? FALSE : TRUE;
    }

    public function check_address($str) {
        return ( preg_match('/[\"\'^£$%&*()}{@#~?><>|=+¬]/', $str)) ? FALSE : TRUE;
    }

}

?>