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
    <meta name="keywords" content="Introduction">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>Home</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="Home.css" media="screen">
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
    <meta property="og:title" content="Home">
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
</li><li class="u-nav-item"><a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-base u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-white u-text-hover-palette-5-light-3" href="Home.php" style="padding: 10px 0px;">User Home</a>
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
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Home.php" style="padding: 10px 0px;">User Home</a>
</li></ul>
              </div>
            </div>
            <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
          </div>
        </nav>
        <a href="login.php" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-3-base u-radius-6 u-btn-1">Sign In</a>
        <a href="register.php" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-3-base u-radius-6 u-btn-2">Get Started</a>
      </div></header>
    <section class="u-align-left u-black u-clearfix u-section-1" id="sec-f0d0">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-clearfix u-custom-html u-custom-html-1"><!-- #!{php1} -->
<?php
$username = $_SESSION['username'];
echo "<h1> Welcome, $username </h1>";
?>
</div>
        <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="u-layout-row">
              <div class="u-size-43">
                <div class="u-layout-col">
                  <div class="u-align-left u-black u-container-style u-layout-cell u-size-60 u-layout-cell-1">
                    <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-1">
                      <h4 class="u-text u-text-1">Wallets</h4>
                      <h4 class="u-text u-text-2">Tokens</h4>
                      <div class="u-clearfix u-custom-html u-custom-html-2"><!-- #!{php2} -->
<?php
$b = new apibackend();


$currency = '*';
$balances = $b->getbalance($username, $currency, $_SESSION['sessionid']);

function make_balance_block($currency, $data)
{
    ?>
    <div align="center" style="border-style: solid; border-radius: 15px; border-color: aqua; width: 200px;">
        <?php
        $icons = '/resources/icons/';
        echo "<a href=\"wallet.php?currency=$currency\"><img style=\"width: 175px; height: 175px; padding: 10px\" src=\"" . $icons . $currency . '.png' . "\"/>";
        if($currency != 'tok') { $decimals = 8; } else { $decimals = 2; }
        if ($data->{$currency} != 'null') {
            echo "<p style=\"text-align: left; padding-left: 20px\"> " . strtoupper($currency) . " Balance: </p>";
            echo "<p style=\"text-align: left; padding-left: 20px\"> Confirmed: " . number_format(floatval($data->{$currency}->balance_conf), $decimals) . " </p>";
            echo "<p style=\"text-align: left; padding-left: 20px; color: gray\"> Unconfirmed: " . number_format(floatval($data->{$currency}->balance_unconf), $decimals)  . " </p>";
            echo "</a>";
        } else {
            echo "<a href=\"deposit.php?currency=$currency\">";
            echo "<p> No " . strtoupper($currency) . " Wallet </p>";
            echo "</a>";
        }
        ?>
    </div>
    <br>
    <span class="stretch"></span>
<?php }

// make a block displaying balance data for each wallet
echo "<nav style='height:750px;overflow:hidden; overflow-y:scroll; background: transparent'><ul>";
foreach ($balances->data as $key => $value) {
    if($key != 'tok') {
        make_balance_block($key, $balances->data);
    }
}
echo "</ul></nav>";
?>
</div>
                      <div class="u-clearfix u-custom-html u-custom-html-3"><!-- #!{php4} -->
<?php
# make a token balance block
make_balance_block('tok', $balances->data);
?>
</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="u-size-17">
                <div class="u-layout-col">
                  <div class="u-align-left u-black u-container-style u-layout-cell u-size-30 u-layout-cell-2">
                    <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-2">
                      <h6 class="u-text u-text-3">Account<span style="text-decoration: underline !important;"></span>
                      </h6>
                      <a href="https://nicepage.com/website-templates" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-50 u-btn-1">Settings</a>
                      <a href="lib/_logout.php" class="u-btn u-btn-round u-button-style u-hover-palette-2-light-1 u-palette-2-base u-radius-50 u-btn-2">Logout</a>
                    </div>
                  </div>
                  <div class="u-container-style u-layout-cell u-palette-1-base u-size-30 u-layout-cell-3">
                    <div class="u-border-2 u-border-grey-75 u-container-layout u-valign-top u-container-layout-3">
                      <h6 class="u-text u-text-4">History</h6>
                      <div class="u-clearfix u-custom-html u-custom-html-4"><!-- #!{php3} -->
<?php
$sessionid = $_SESSION['sessionid'];
$transactions = $b->listtransactions('apitest', 'tok', $sessionid)->data->transactions;
function displaytransaction($transaction) {
    $statuscolor = 'red';
    $statusstring = 'Pending';
    if($transaction->confirmations >= 10) { $statuscolor = 'green'; $statusstring = 'Confirmed'; }
    echo "<div align=\"center\" style=\"border-style: solid; border-radius: 15px; border-color: aqua; background-color: black; width: 200px;\">";
    echo "<p style=\"text-align: left; padding-left: 15px; font-weight: bold; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;\">Transaction: $transaction->txid </p>";
    echo "<p style=\"text-align: left; padding-left: 30px; color: $statuscolor\">Status: $statusstring</p>";
    echo "<p style=\"text-align: left; padding-left: 30px; color: gray\">- Amount: $transaction->amount </p>";
    echo "<p style=\"text-align: left; padding-left: 30px; color: gray\">- Received at: $transaction->time </p>";
    echo "<p style=\"text-align: left; padding-left: 30px; color: gray\">- Confirmations: $transaction->confirmations </p>";
    echo "<p style=\"text-align: left; padding-left: 30px; color: gray\">- View on <a href='https://www.blockchain.com/btc/tx/$transaction->txid'; target='_blank'>Blockchain.com</a></p>";
    echo "</div><br>";
}

echo "<nav style='height:750px;overflow:hidden; overflow-y:scroll; background: transparent'><ul>";
foreach($transactions as &$transaction) {
    displaytransaction($transaction);
}
echo "</ul></nav>";
?>
</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="u-black u-border-2 u-border-grey-75 u-container-style u-expanded-width u-group u-group-1">
          <div class="u-container-layout u-container-layout-4">
            <a href="deposit.php" class="u-border-2 u-border-hover-palette-4-light-2 u-border-palette-4-base u-btn u-btn-round u-button-style u-none u-radius-50 u-text-palette-4-base u-btn-3">Deposit</a>
            <a href="withdraw.php" class="u-border-2 u-border-hover-palette-4-light-2 u-border-palette-4-base u-btn u-btn-round u-button-style u-none u-radius-50 u-text-palette-4-base u-btn-4">Withdraw</a>
          </div>
        </div>
      </div>
    </section>
    
    
    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-bc4e"><div class="u-clearfix u-sheet u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">This site is under development.<br>geruoff@syr.edu<br>2021
        </p>
      </div></footer>
    <section class="u-backlink u-clearfix u-grey-80">
      <a class="u-link" href="https://nicepage.com/website-templates" target="_blank">
        <span>Website Templates</span>
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