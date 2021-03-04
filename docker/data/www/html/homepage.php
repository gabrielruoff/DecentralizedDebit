<?php
require_once('/usr/local/php/lib/Backend.php');
use Backend\apibackend;

$bknd = new apibackend();
$body = ["password" => "test2"];
$data = ["method" => "createwalletbtc", 'body' => $body];

//echo $bknd->_request('Account/apitest', $data);
//echo $bknd->getbalance('*', 'apitest', 'test2');
echo $bknd->authenticate('dsf', 'fdgfd');