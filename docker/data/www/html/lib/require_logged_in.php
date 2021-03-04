<?php

session_start();

// make sure a user is logged in
if($_SESSION["username"] == "") {

    $root_path = $_SERVER['DOCUMENT_ROOT'];

    // you gotta be logged in, buddy
    echo "you must be logged in to access this page. You will be redirected.";

    header( "Refresh:0; url=homepage.php");

}

?>
