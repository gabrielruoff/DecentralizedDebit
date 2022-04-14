<?php
session_start();
include('/usr/local/php/lib/require_logged_in.php');
require_once('/usr/local/php/lib/Backend.php');
use Backend\apibackend;

$b = new apibackend();

if(isset($_SESSION['username']) && isset($_SESSION['sessionid'])) {

    $username = $_SESSION['username'];
    $sessionid = $_SESSION['sessionid'];
    $b->destorysession($username, $sessionid);
    session_unset(); session_destroy();

} else { echo  'not logged in'; }

if(isset($_GET['url'])) {
    $url = $_GET['url'];
} else { $url = '/index.html'; }

\Redirect\redirect($url);