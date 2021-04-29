<!-- #!{head} -->
<?php
session_start();
include('/usr/local/php/lib/require_logged_in.php');
require_once('/usr/local/php/lib/Backend.php');
use Backend\apibackend;

$b = new apibackend();
?>
<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>withdrawconfirm</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="withdrawconfirm.css" media="screen">
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
    <meta property="og:title" content="withdrawconfirm">
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
    <section class="u-black u-clearfix u-section-1" id="sec-d1e0">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="u-black u-border-2 u-border-black u-container-style u-expanded-width u-group u-shape-rectangle u-group-1">
          <div class="u-container-layout u-container-layout-1">
            <div class="u-clearfix u-custom-html u-custom-html-1"><!-- #!{php1} -->
<?php
if(isset($_GET['status'])) {
    if($_GET['status'] == 'success') {
        $h2 = 'Withdrawl Successful';
    } else {
        $h2 = 'Transaction Error';
        $err = $_GET['status'];
    }
} else {
    $h2 = 'Error';
    $err = 'No Withdrawl Specified';
}
$currency = $_GET['currency'];
echo "<h1 style=\"text-align: left; padding-left: 30px;\">$h2</h1>";
?>
</div>
            <div class="u-align-center u-clearfix u-custom-html u-custom-html-2"><!-- #!{php2} -->
<?php
if(isset($err)) {
    echo "<h3 style=\"text-align: left; padding-left: 30px; color: orangered\">$err</h3>";
} else {
    function displaytransaction($transaction, $currency)
    {
        $statuscolor = 'orange';
        $statusstring = 'Pending';
        if ($transaction->confirmations >= 10) {
            $statuscolor = 'green';
            $statusstring = 'Confirmed';
        }
        if($currency != 'tok') { $decimals = 8; $pref = ''; } else { $decimals = 2; $pref = '$'; }
        $amount = $pref . strval(number_format(floatval($transaction->amount), $decimals));
        echo "<div align=\"center\" style=\"border-style: solid; border-radius: 15px; border-color: aqua; width: 400px;\">";
        echo "<p style=\"text-align: left; padding-left: 15px; font-weight: bold; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;\">Transaction: $transaction->txid </p>";
        echo "<p style=\"text-align: left; padding-left: 30px; color: $statuscolor\">Status: $statusstring</p>";
        echo "<p style=\"text-align: left; padding-left: 30px; color: gray\">- Amount: $amount </p>";
        echo "<p style=\"text-align: left; padding-left: 30px; color: gray\">- Received at: $transaction->time </p>";
        if($currency != 'tok') { echo "<p style=\"text-align: left; padding-left: 30px; color: gray\">- Confirmations: $transaction->confirmations </p>";
            echo "<p style=\"text-align: left; padding-left: 30px; color: gray\">- View on <a href='https://www.blockchain.com/btc/tx/$transaction->txid'; target='_blank'>Blockchain.com</a></p>"; }
        echo "</div><br>";
    }

        $transactions = $b->listtransactions('apitest', $currency, $_SESSION['sessionid'])->data->transactions;
        displaytransaction($transactions[0], $currency);
}
echo "<br><br>";
echo "<div align='center'>";
echo "<a href='/withdraw.php?currency=$currency'><button style='
background:    #15d798;
border:        1px solid #556699;
border-radius: 11px;
padding:       20px 45px;
color:         #ffffff;
display:       inline-block;
font:          normal bold 22px/1 \"Open Sans\", sans-serif;
text-align:    center;
display:       inline-block;
margin-right:  20px'>Back to Withdraw</button></a>";

echo "<a href='Home.php'><button style='
background:    #15d798;
border:        1px solid #556699;
border-radius: 11px;
padding:       20px 45px;
color:         #ffffff;
display:       inline-block;
font:          normal bold 22px/1 \"Open Sans\", sans-serif;
text-align:    center;
display:       inline-block;
margin-left:   20px'>Return to Home</button></a>";
echo "</div>";
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
      <a class="u-link" href="https://nicepage.com/landing-page" target="_blank">
        <span>Landing Page</span>
      </a>
      <p class="u-text">
        <span>created with</span>
      </p>
      <a class="u-link" href="https://nicepage.com/" target="_blank">
        <span>Website Builder Software</span>
      </a>. 
    </section>
  </body>
</html>