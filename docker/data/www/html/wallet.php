<!-- #!{head} -->
<?php
session_start();
require_once('/usr/local/php/lib/Backend.php');
use Backend\apibackend;
use Redirect;
$b = new apibackend();
$username = $_SESSION['username'];
$sessionid = $_SESSION['sessionid'];
?>
<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>wallet</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="wallet.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 3.8.0, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "Site1",
		"url": "index.html"
}</script>
    <meta property="og:title" content="wallet">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#478ac9">
    <link rel="canonical" href="index.html">
    <meta property="og:url" content="index.html">
  </head>
  <body class="u-body"><header class="u-clearfix u-header u-header" id="sec-e42f"><div class="u-clearfix u-sheet u-sheet-1">
        <nav class="u-menu u-menu-dropdown u-offcanvas u-menu-1">
          <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px;">
            <a class="u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
              <svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu-hamburger"></use></svg>
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><symbol id="menu-hamburger" viewBox="0 0 16 16" style="width: 16px; height: 16px;"><rect y="1" width="16" height="2"></rect><rect y="7" width="16" height="2"></rect><rect y="13" width="16" height="2"></rect>
</symbol>
</defs></svg>
            </a>
          </div>
          <div class="u-custom-menu u-nav-container">
            <ul class="u-nav u-unstyled u-nav-1"><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="index.html" style="padding: 10px 20px;">Home</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="About.html" style="padding: 10px 20px;">About</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="Contact-Us.html" style="padding: 10px 20px;">Contact Us</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="deposit.php" style="padding: 10px 20px;">Deposit</a>
</li></ul>
          </div>
          <div class="u-custom-menu u-nav-container-collapse">
            <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
              <div class="u-sidenav-overflow">
                <div class="u-menu-close"></div>
                <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2"><li class="u-nav-item"><a class="u-button-style u-nav-link" href="index.html" style="padding: 10px 20px;">Home</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="About.html" style="padding: 10px 20px;">About</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Contact-Us.html" style="padding: 10px 20px;">Contact Us</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="deposit.php" style="padding: 10px 20px;">Deposit</a>
</li></ul>
              </div>
            </div>
            <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
          </div>
        </nav>
        <a href="login.php" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-6 u-btn-1">Sign In</a>
        <a href="register.php" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-6 u-btn-2">Get Started</a>
      </div></header>
    <section class="u-black u-clearfix u-section-1" id="sec-5390">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="u-layout-col">
              <div class="u-size-30">
                <div class="u-layout-row">
                  <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-1">
                    <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-1">
                      <div class="u-align-center u-clearfix u-custom-html u-custom-html-1"><!-- #!{php1} -->
<?php
$currency = $_GET['currency'];
// show coin logo
$icons = '/resources/icons/';
echo "<div align=\"center\" style=\"border-style: solid; border-radius: 15px; border-color: aqua; width: 400px;\">";
echo "<h2 style=\"text-align: center; font-weight: bold\">Wallet: $currency</h2>";
echo "<img style=\"width: 200px; height: 200px; padding: 10px\" src=\"" . $icons . $currency . '.png' . "\"/>";
echo "</div>";
?>
</div>
                    </div>
                  </div>
                  <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-2">
                    <div class="u-border-2 u-border-grey-75 u-container-layout u-valign-middle u-container-layout-2">
                      <div class="u-align-center u-clearfix u-custom-html u-custom-html-2"><!-- #!{php2} -->
<?php
$balances = $b->getbalance($username, $currency, $sessionid);
function make_balance_block($currency, $data)
{
    print_r($data);
    ?>
    <div align="center" style="border-style: solid; border-radius: 15px; border-color: aqua; width: 200px;">
        <?php
            echo "<p style=\"text-align: left; padding-left: 20px\"> " . strtoupper($currency) . " Balance: </p>";
            echo "<p style=\"text-align: left; padding-left: 20px\"> Confirmed: " . number_format(floatval($data->{$currency}->balance_conf), 8) . " </p>";
            echo "<p style=\"text-align: left; padding-left: 20px; color: gray\"> Unconfirmed: " . number_format(floatval($data->{$currency}->balance_unconf), 8)  . " </p>";
        ?>
    </div>
    <br>
<?php }

// make a block displaying balance data for each wallet
make_balance_block($currency, $balances->data);

?>
</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="u-size-30">
                <div class="u-layout-row">
                  <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-3">
                    <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-3">
                      <h2 class="u-text u-text-default u-text-1">Received</h2>
                      <div class="u-align-center u-clearfix u-custom-html u-custom-html-3"><!-- #!{php3} -->
<?php
// sort transactions into send and received
$receive = array();
$send = array();
$transactions = $b->listtransactions('apitest', $currency, $sessionid)->data->transactions;
foreach($transactions as &$transaction) {
    if($transaction->category == 'receive') {
        array_push($receive, $transaction);
    } elseif($transaction->category == 'send') {
        array_push($send, $transaction);
    }
}

function displaytransaction($transaction) {
    $statuscolor = 'orange';
    $statusstring = 'Pending';
    if($transaction->confirmations >= 10) { $statuscolor = 'green'; $statusstring = 'Confirmed'; }
    echo "<div align=\"center\" style=\"border-style: solid; border-radius: 15px; border-color: aqua; width: 400px;\">";
    echo "<p style=\"text-align: left; padding-left: 15px; font-weight: bold; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;\">Transaction: $transaction->txid </p>";
    echo "<p style=\"text-align: left; padding-left: 30px; color: $statuscolor\">Status: $statusstring</p>";
    echo "<p style=\"text-align: left; padding-left: 30px; color: gray\">- Amount: +$transaction->amount </p>";
    echo "<p style=\"text-align: left; padding-left: 30px; color: gray\">- Received at: $transaction->time </p>";
    echo "<p style=\"text-align: left; padding-left: 30px; color: gray\">- Confirmations: $transaction->confirmations </p>";
    echo "<p style=\"text-align: left; padding-left: 30px; color: gray\">- View on <a href='https://www.blockchain.com/btc/tx/$transaction->txid'; target='_blank'>Blockchain.com</a></p>";
    echo "</div><br>";
}

// display received
foreach($receive as &$received) {
    displaytransaction($received);
}
?>
</div>
                    </div>
                  </div>
                  <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-4">
                    <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-4">
                      <h2 class="u-text u-text-default u-text-2">Sent</h2>
                      <div class="u-align-center u-clearfix u-custom-html u-custom-html-4"><!-- #!{php4} -->
<?php
// display sent
foreach($send as &$sent) {
    displaytransaction($sent);
}
?>
</div>
                    </div>
                  </div>
                </div>
              </div>
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
      <a class="u-link" href="https://nicepage.com/html-templates" target="_blank">
        <span>HTML Template</span>
      </a>
      <p class="u-text">
        <span>created with</span>
      </p>
      <a class="u-link" href="https://nicepage.com/static-site-generator" target="_blank">
        <span>Static Website Generator</span>
      </a>. 
    </section>
  </body>
</html>