<?php
session_start();
require_once('/usr/local/php/lib/Backend.php');
use Backend\apibackend; $b = new apibackend();
//print_r($b->validatesession($_SESSION['username'], $_SESSION['sessionid']));
// make sure a user is logged in
if(!isset($_SESSION['username']) || !$b->validatesession($_SESSION['username'], $_SESSION['sessionid'])) {

    $root_path = $_SERVER['DOCUMENT_ROOT'];

    // you gotta be logged in, buddy
    echo "you must be logged in to access this page. You will be redirected.";

    header( "Refresh:0; url=/lib/_logout.php?url=/login.php");

}

?>
