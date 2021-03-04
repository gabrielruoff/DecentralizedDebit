<?php
require_once('../Backend.php');
use Backend\apibackend;
$b = new apibackend();
$sessionid = $b->generatesessionid('apitest', 'test2')->data->session_id;
print_r($b->listtransactions('apitest', 'btc', $sessionid));