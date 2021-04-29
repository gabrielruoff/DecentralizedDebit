<?php
session_start();
require_once('/usr/local/php/lib/Backend.php');
use Backend\apibackend;
$b = new apibackend();
//if(isset($POST['datastring'])) {
    $transaction = $_POST['datastring'];
    echo $transaction;
    print_r(json_decode($transaction));
    $response = $b->deposittokens($_SESSION['username'], $_SESSION['sessionid'], json_decode($transaction));
    print_r($response);
//}