<?php
session_start();

//require_once('/usr/local/php/lib/vendor/autoload.php');
require_once('/usr/local/php/lib/vendor/autoload.php');

use GuzzleHttp;

$baseurl = 'http://71.176.66.122:5000';

$valid_ips = "192.168.1.2:127.0.0.1:45.61.54.203:71.176.66.122";

if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $origin = $_SERVER['HTTP_ORIGIN'];
}
else if (array_key_exists('HTTP_REFERER', $_SERVER)) {
    $origin = $_SERVER['HTTP_REFERER'];
} else {
    $origin = $_SERVER['REMOTE_ADDR'];
}
header("HTTP/1.1 200 OK");
function _request($suburl, $body)
{
    $client = new GuzzleHttp\Client();
    $body = json_encode($body);
    $ch = curl_init();
    $curlConfig = array(
        CURLOPT_URL            => 'http://71.176.66.122:5000'.'/'.$suburl,
        CURLOPT_POST           => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array('Content-Type:application/json', 'Content-Length: '. strlen($body)),
        CURLOPT_POSTFIELDS => $body,
        CURLOPT_FOLLOWLOCATION => true
    );
    curl_setopt_array($ch, $curlConfig);
    $result = curl_exec($ch);
    print_r($result);
    curl_close($ch);

    // format result
    $result = json_decode($result);
    $result->success = eval("return $result->success;");
    return $result;
}

if(strpos($valid_ips, $origin) != false) {

    echo 'trusted';
    return _request($_POST['$suburl'], $_POST['$body']);

}