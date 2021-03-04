<?php
# ALL
//require_once('/usr/local/php/lib/Backend.php');
session_start();
require_once('Backend.php');
use Backend\apibackend;
$b = new apibackend();
$resources = $_SERVER["DOCUMENT_ROOT"].'/resources';
echo $resources;

# register.php
$username = $_POST['username'];
$password = $_POST['password'];

$c = $b->createaccount($username, $password);
print_r($c);
if($c['success'] == 'True') { echo true; }
else { echo false; }

# login.php
if (isset($_POST['username'])) {
    $b = new apibackend();
    $response = $b>generatesessionid($_POST['username'], $_POST['password']);
    if ($response->success == true) {
        echo 'correct';
        // start session
        session_start();
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['sessionid'] = $response['session_id'];
        header("Location: Home.php");
        exit();
    } else {
        $err = "incorrect credentials";
    }
}

# Home.php
#------
$_SESSION['username'] = 'apitest'; $password = 'test2';
$_SESSION['sessionid'] = $b->generatesessionid($_SESSION['username'], $password)->data->session_id;
#------
$username = $_SESSION['username']; $currency = '*';
$balances = $b->getbalance($username, $currency, $_SESSION['sessionid']);
print_r($balances->data);
foreach($balances->data as $key=>$value){
    echo $key;
    make_balance_block($key, $balances->data);
}

function make_balance_block($currency, $data) {
    ?> <div>
        <?php
        if ($data->{$currency} != 'null') {
            echo "<p> Balance: </p>";
            echo "<p> Confirmed: ".$data->{$currency}->balance_conf." </p>";
            echo "<p> Unconfirmed: ".$data->{$currency}->balance_unconf." </p>";
        }
        ?>
    </div>
    <?php
}
?>
