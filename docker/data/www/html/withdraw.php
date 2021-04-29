<!-- #!{head} -->
<?php
session_start();
include('/usr/local/php/lib/require_logged_in.php');
require_once('/usr/local/php/lib/Backend.php');
use Backend\apibackend;
?>
<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>withdraw</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="withdraw.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 3.9.0, nicepage.com">
    
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "Site1",
		"url": "index.html"
}</script>
    <meta property="og:title" content="withdraw">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#478ac9">
    <link rel="canonical" href="index.html">
    <meta property="og:url" content="index.html">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff"</head>
  <body class="u-body"><header class="u-clearfix u-header u-palette-1-base u-header" id="sec-e42f"><div class="u-clearfix u-sheet u-sheet-1">
        <nav class="u-menu u-menu-dropdown u-offcanvas u-menu-1">
          <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px; font-weight: 700; text-transform: uppercase;">
            <a class="u-button-style u-custom-active-border-color u-custom-border u-custom-border-color u-custom-borders u-custom-hover-border-color u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-text-active-color u-custom-text-color u-custom-text-hover-color u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
              <svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu-hamburger"></use></svg>
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><symbol id="menu-hamburger" viewBox="0 0 16 16" style="width: 16px; height: 16px;"><rect y="1" width="16" height="2"></rect><rect y="7" width="16" height="2"></rect><rect y="13" width="16" height="2"></rect>
</symbol>
</defs></svg>
            </a>
          </div>
          <div class="u-custom-menu u-nav-container">
            <ul class="u-nav u-spacing-30 u-unstyled u-nav-1"><li class="u-nav-item"><a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-base u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-white u-text-hover-palette-5-light-3" href="index.html" style="padding: 10px 0px;">Home</a>
</li><li class="u-nav-item"><a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-base u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-white u-text-hover-palette-5-light-3" href="About.html" style="padding: 10px 0px;">About</a>
</li><li class="u-nav-item"><a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-base u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-white u-text-hover-palette-5-light-3" href="Contact-Us.html" style="padding: 10px 0px;">Contact Us</a>
</li><li class="u-nav-item"><a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-base u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-white u-text-hover-palette-5-light-3" href="deposit.php" style="padding: 10px 0px;">Deposit</a>
</li><li class="u-nav-item"><a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-base u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-white u-text-hover-palette-5-light-3" href="Home.php" style="padding: 10px 0px;">Wallets</a>
</li></ul>
          </div>
          <div class="u-custom-menu u-nav-container-collapse">
            <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
              <div class="u-sidenav-overflow">
                <div class="u-menu-close"></div>
                <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2"><li class="u-nav-item"><a class="u-button-style u-nav-link" href="index.html" style="padding: 10px 0px;">Home</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="About.html" style="padding: 10px 0px;">About</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Contact-Us.html" style="padding: 10px 0px;">Contact Us</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="deposit.php" style="padding: 10px 0px;">Deposit</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Home.php" style="padding: 10px 0px;">Wallets</a>
</li></ul>
              </div>
            </div>
            <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
          </div>
        </nav>
        <a href="login.php" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-3-base u-radius-6 u-btn-1">Sign In</a>
        <a href="register.php" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-3-base u-radius-6 u-btn-2">Get Started</a>
      </div></header>
    <section class="u-black u-clearfix u-section-1" id="sec-c9e4">
      <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-1">Withdraw</h2>
        <div class="u-clearfix u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="u-layout-row">
              <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-1">
                <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-1">
                  <h4 class="u-text u-text-2">Withdraw Crypto</h4>
                  <div class="u-clearfix u-custom-html u-custom-html-1"><!-- #!{php1} -->
<?php
$b = new apibackend();


$username = $_SESSION['username'];
$sessionid = $_SESSION['sessionid'];
$currency = '*';
$response = $b->validatesession($username, $sessionid);
if ($response->success == false) {
    Redirect\redirect('login.php');
}
$balances = $b->getbalance($username, $currency, $_SESSION['sessionid']);

function make_balance_block($currency, $data)
{
    ?>
    <div align="center" style="border-style: solid; border-radius: 15px; border-color: aqua; width: 200px;">

        <?php
        $icons = '/resources/icons/';
        if($currency != 'tok') { $link = "withdraw.php?currency=$currency"; } else { $link = '#'; }
        echo "<a href=$link><img style=\"width: 175px; height: 175px; padding: 10px\" src=\"" . $icons . $currency . '.png' . "\"/>";
        if($currency != 'tok') { $decimals = 8; } else { $decimals = 2; }
        if ($data->{$currency} != 'null') {
            echo "<p style=\"text-align: left; padding-left: 20px\"> " . strtoupper($currency) . " Balance: </p>";
            echo "<p style=\"text-align: left; padding-left: 20px\"> Confirmed: " . number_format(floatval($data->{$currency}->balance_conf), $decimals) . " </p>";
            echo "<p style=\"text-align: left; padding-left: 20px; color: gray\"> Unconfirmed: " . number_format(floatval($data->{$currency}->balance_unconf), $decimals)  . " </p></a>";
        } else {
            echo "<p> No " . strtoupper($currency) . " Wallet </p>";
        }
        ?>
    </div>
    <br>
    <span class="stretch"></span>
<?php } ?>

<?php
// make a block displaying balance data for each wallet
echo "<nav style='height:750px;overflow:hidden; overflow-y:scroll;'><ul>";
foreach ($balances->data as $key => $value) {
    // don't show tok or non-existent wallets
    if($value != 'null' && $key != 'tok') {
        make_balance_block($key, $balances->data);
    }
}
echo "</ul></nav>";
?>
</div>
                </div>
              </div>
              <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-2">
                <div class="u-border-2 u-border-grey-75 u-container-layout u-valign-top u-container-layout-2">
                  <h4 class="u-text u-text-3">Exchange Tokens for USD</h4>
                  <div class="u-clearfix u-custom-html u-custom-html-2"><!-- #!{php2} -->
<?php
echo "<style>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
.wrapper{
width: 450px;
    height: 425px;
    background: #555D67;
  padding: 30px;
  box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}
.wrapper .input-data{
 margin-top: 40px;
  height: 40px;
  width: 100%;
  position: relative;
}
.wrapper .input-data input{
  height: 100%;
  width: 100%;
  border: none;
  font-size: 17px;
  border-bottom: 2px solid silver;
}
.input-data input:focus ~ label,
.input-data input:valid ~ label{
  transform: translate(-15px, -37px);
  font-size: 30px;
  font-weight: bold;
  color: whitesmoke;
}
.wrapper .input-data label{
  position: absolute;
  bottom: 10px;
  left: 15px;
  color: grey;
  pointer-events: none;
  transition: all 0.3s ease;
}
.input-data .underline{
  position: absolute;
  height: 2px;
  width: 75%;
  bottom: 5px;
}
.input-data .underline:before{
  position: absolute;
  content: '';
  height: 100%;
  width: 100%;
  background: #4158d0;
  transform: scaleX(0);
  transform-origin: center;
  transition: transform 0.3s ease;
}
.input-data input:focus ~ .underline:before,
.input-data input:valid ~ .underline:before{
  transform: scaleX(1);
}
</style>";
// show token balance block
make_balance_block('tok', $balances->data);
?>
</div>
                  <div class="u-clearfix u-custom-html u-custom-html-3"><!-- #!{php6} -->
<?php
$max = $balances->data->tok->balance_conf;
?>
<div class='wrapper' style="width: 485px; height: 450px; padding: 30px; margin-top: 10px;">

    <form method='post' id='tokenwithdrawform' action='/withdraw.php'>
        <div id="smart-button-container">
            <div style="text-align: center; color: black">
                <div class='input-data' style="bottom: 15px">
                    <input type='number' id='amount' name='amount' autocomplete='off' style='color:black' max='<?php echo $max; ?>' required>
                    <div class='underline'>
                    </div>
                    <label for="amount">Amount To Withdraw </label>
                </div>
            </div>

            <div style="text-align: center; color: black">
                <div class='input-data' style="bottom: 15px">
                    <input type='text' id='destination' name='destination' autocomplete='off' style='color:black' required>
                    <div class='underline'>
                    </div>
                    <label for="destination">PayPal Email Address</label>
                </div>
            </div>

            <div style="text-align: center; color: black">
                <div class='input-data' style="bottom: 0px">
                    <input type='text' id='destinationconfirm' name='destinationconfirm' autocomplete='off' style='color:black' required>
                    <div class='underline'>
                    </div>
                    <label for="destinationconfirm">Confirm PayPal Email Address</label>
                </div>
            </div>

            <br>
            <input type="submit" id="submit" name="withdrawsubmit" style="
            display: block;
          margin-right: auto;
          margin-left: auto;
          background-color: #1BF185;
          letter-spacing: 3px;
          border-radius: 50px;
          font-weight: bold;
          color: black;
          font-family:
          sans-serif;
          font-size: 16px;
          height: 64px;
          width: 268px" value="WITHDRAW TOKENS">

        </div>
    </form>
</div>
<?php
if(isset($_POST['withdrawsubmit'])) {
    if(trim($_POST['destination']) == trim($_POST['destinationconfirm'])) {
        $b = new apibackend();
        $username = $_SESSION['username'];
        $response = $b->validatesession($username, $sessionid);
        if ($response->success == true) {
            $currency = 'tok';
            $amount = trim($_POST['amount']);
            if($amount <= $balances->data->{$currency}) {
                $withdrawl = $b->withdrawtokens($username, $sessionid, trim($_POST['destination']), $amount);
                unset($_SESSION['withdrawlcurrency']);
                print_r($withdrawl);
                if ($withdrawl->success == true) {

                    $url = "withdrawconfirm.php?currency=$currency&status=success";
                } else {
                    echo $withdrawl->err;
                    $url = "withdrawconfirm.php?currency=$currency&status=$withdrawl->err";
                }
//            redirect to confirmation page
                \Redirect\redirect($url);
            } else {
                $err = "Insufficient Balance";
            }
        } else {
            $err = "invalid session";
        }
    } else {
        $err = "Paypal Email addresses do not match";
    }
}
?>
</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="u-container-style u-group u-palette-5-dark-2 u-group-1">
          <div class="u-container-layout u-valign-top u-container-layout-3">
            <div class="u-clearfix u-custom-html u-custom-html-4"><!-- #!{php3} -->
<?php
$max = $balances->data->{$_GET['currency']}->balance_conf;
echo "
<form method='post' id='withdrawform' action='/withdraw.php'>
    <div class='wrapper'>
      <div class='input-data' style='top: 50px;'>
        <input type='number' id='amount' name='amount' autocomplete='off' style='color:black' max='$max' required>
        <div class='underline'>
</div>


<label>"; ?>
<script>
    var $_GET = <?php echo json_encode($_GET); ?>;
    if (typeof $_GET['currency'] != 'undefined') {
        document.write($_GET['currency'].toUpperCase() + ' Quantity');
    } else {
        document.write("Select a Currency to Withdraw")
    }
</script>
</label></input><div>
</div>
<br>
<?php
//receiving address
echo "
      <div class='input-data' style='top: 20px;'>
        <input type='text' id='rxaddress' name='rxaddress' autocomplete='off' style='color:black' required>
        <div class='underline'>
</div>
<label>"; ?>
<script>
    var $_GET = <?php echo json_encode($_GET); ?>;
    if (typeof $_GET['currency'] != 'undefined') {
        document.write($_GET['currency'].toUpperCase() + ' Withdrawl Address');
    } else {
        document.write("Withdrawl Address")
    }
</script>
</label>
<br><br><br>
<input type="submit"; id="submit"; name="submit"; style="display: block;
  margin-right: auto;
  margin-left: auto;
  background-color: #1BF185;
  letter-spacing: 3px;
  border-radius: 50px;
  font-weight: bold;
  color: black;
  font-family:
  sans-serif;
  font-size: 16px;
  height: 64px;
  width: 268px" value="WITHDRAW CRYPTO">
</form>
<?php

if (isset($_POST['submit'])) {
//    print_r($_POST);
    $b = new apibackend();
    $username = $_SESSION['username'];
    $response = $b->validatesession($username, $sessionid);
    if ($response->success == true) {
        if(isset($_SESSION['withdrawlcurrency'])) {
            $rx = trim($_POST['rxaddress']);
            $amount = trim($_POST['amount']);
            $currency = $_SESSION['withdrawlcurrency'];
            $withdrawl = $b->withdrawcrypto($username, $sessionid, $rx, $amount, $currency);
            unset($_SESSION['withdrawlcurrency']);
            if($withdrawl->success == true) {
                $_SESSION['txnow'] = time();
                $url = "withdrawconfirm.php?currency=$currency&status=success";
            } else {
                echo $withdrawl->err;
                $url = "withdrawconfirm.php?currency=$currency&status=$withdrawl->err";
            }
//            redirect to confirmation page
            \Redirect\redirect($url);
        } else {
            $err = "No currency selected";
        }

    } else {
        $err = "invalid session";}
}
?>
</div>
            <div class="u-clearfix u-custom-html u-custom-html-5"><!-- #!{php5} -->
<?php

// assign onclick to button after creation
?>
<script>
    document.getElementsByClassName('u-border-0 u-btn u-btn-round u-button-style u-custom-color-2 u-hover-custom-color-3 u-radius-50 u-btn-1').onclick = function() { document.getElementById('withdrawform').submit(); }
</script>
<?php
if(isset($_GET['currency'])) {
    $_SESSION['withdrawlcurrency'] = $_GET['currency'];
    echo "<p>Withdraw from ".strtoupper($_SESSION['withdrawlcurrency'])." wallet</p>";
} else {
    echo "<p><i>Select a wallet to withdraw from by clicking its icon above</i></p>";
}
?>
</div>
            <div class="u-clearfix u-custom-html u-custom-html-6"><!-- #!{php4} -->
<?php
if(isset($err)) {
    echo "<p style='color:orangered; text-align: center'>error: $err </p>";
}
?>
</div>
          </div>
        </div>
      </div>
    </section>
    
    
    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-bc4e"><div class="u-clearfix u-sheet u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">This site is under development.<br>geruoff@syr.edu<br>2021
        </p>
      </div></footer>
    <section class="u-backlink u-clearfix u-grey-80">
      <a class="u-link" href="https://nicepage.com/css-templates" target="_blank">
        <span>CSS Templates</span>
      </a>
      <p class="u-text">
        <span>created with</span>
      </p>
      <a class="u-link" href="https://nicepage.com/" target="_blank">
        <span>Website Design Software</span>
      </a>. 
    </section>
  </body>
</html>