<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cyaconfig {

    protected $ci;

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->model('setting_model');


        $settings = $this->ci->setting_model->getSettings();
        foreach ($settings as $setting) {
            defined($setting->configuration_key) || define($setting->configuration_key, $setting->configuration_value);
        }
    }

}

?>
