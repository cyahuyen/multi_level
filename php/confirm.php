<?php

function write_log($str) {
    $url = realpath(dirname(__FILE__)) . '/log.txt';
    $out = fopen($url, "a");
    fwrite($out, aprint($str));
    fclose($out);
}

function aprint($arr, $return = true) {
    $wrap = '<div style=" white-space:pre; position:absolute; top:10px; left:10px; height:200px; width:100px; overflow:auto; z-index:5000;">';
    $wrap = '<pre>';
    $txt = preg_replace('/(\[.+\])\s+=>\s+Array\s+\(/msiU', '$1 => Array (', print_r($arr, true));

    if ($return)
        return $wrap . $txt . '</pre>';
    else
        echo $wrap . $txt . '</pre>';
}

$posts = $_REQUEST;
write_log($posts);