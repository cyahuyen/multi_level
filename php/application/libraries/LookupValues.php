<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Library class to provide access to application lookup values.
 * @author	Dean Gleeson <dean.gleeson@pragmaticsystems.com.au>
 * @date	15/03/2013
 */
class LookupValues {

    var $ci;
    
    var $config = get_config();
    
    var $config['propertyType'] = array(
    		'm' => 'Male',
    		'f' => 'Female'
    );

    function __construct() {
        $this->ci = & get_instance();
    }

    /**
     * Get the arrays from configs
     * @param string $data
     * @param string $firstRow
     * @return array
     * @example controller $this->lookupValues->getArray('gender', 'Select Gender');
     */
    public function getArray($data = null, $firstRow = null) {
        if ($data == null)
            return array();

        if ($firstRow != null)
            $returnVal[' '] = $firstRow;
        else
            $returnVal = array();

        $config = get_config();
       
        if (isset($config[$data])) {
            if (is_array($config[$data])) {
                $returnVal = $returnVal + $config[$data];
            }
        }

        return $returnVal;
    }

    public function getKey($array, $value) {
        $returnVal = false;

        $config = get_config();
        if (isset($config[$array])) {
            if (is_array($config[$array])) {
                foreach ($config[$array] as $key => $val) {
                    if (strtolower($key) == strtolower($value) || strtolower($val) == strtolower($value)) {
                        $returnVal = $key;
                    }
                }
            }
        }
       
        return $returnVal;
    }

}