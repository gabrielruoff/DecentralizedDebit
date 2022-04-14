<?php
//require_once('/usr/local/php/lib/vendor/autoload.php');
require_once('/usr/local/php/lib/vendor/autoload.php');

use GuzzleHttp;

$client = new GuzzleHttp\Client();
$baseurl = 'http://71.176.66.122:5000';

function _request($suburl, $body)
{
    $body = json_encode($body);
    $ch = curl_init();
    echo 'http://71.176.66.122:5000'.'/'.$suburl;
    $curlConfig = array(
        CURLOPT_URL            => 'http://71.176.66.122'.'/'.$suburl,
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

$params = ["session_id" => $_SESSION['sessionid']];
$body = ['suburl' => 'Account/apitest', 'body' => ["method" => "validatesession", "body" => $params]];
print_r($body);
//$r = _request('/lib/_js_backend.php', $body);

//echo eval($r['success'] == true);

print_r($r);