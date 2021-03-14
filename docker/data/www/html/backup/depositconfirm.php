<!-- #!{head} -->
<?php
ob_implicit_flush(true);
session_start();
require_once('/usr/local/php/lib/Backend.php');
use Backend\apibackend;
use Redirect;
$b = new apibackend();
$sessionid = $_SESSION['sessionid'];
$transactions = $b->listtransactions('apitest', 'btc', $sessionid)->data->transactions;

//echo $_SESSION['depositconfirmpagestatus'];
if($_SESSION['depositconfirmpagestatus'] != 'wait' && $_SESSION['depositconfirmpagestatus'] != 'show') {
    $_SESSION['depositconfirmpagestatus'] = 'wait';
}
//echo $_SESSION['depositconfirmpagestatus'];

//echo $_SESSION['txnow'].'/';
//echo($transactions[0]->time);

function btc_displayincomingtransaction($transaction) {
    $statuscolor = 'red';
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
?>
<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>depositconfirm</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="depositconfirm.css" media="screen">
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
    <meta property="og:title" content="depositconfirm">
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
    <section class="u-clearfix u-section-1" id="sec-d1e0">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="u-border-2 u-border-black u-container-style u-custom-color-1 u-expanded-width u-group u-radius-25 u-shape-round u-group-1">
          <div class="u-container-layout u-container-layout-1">
            <div class="u-clearfix u-custom-html u-custom-html-1"><!-- #!{php2} -->
<?php
if($_SESSION['depositconfirmpagestatus'] == 'show') { $depositstatus = 'Incoming Deposit:'; }
else { $depositstatus = 'Waiting for deposit...'; }
echo "<h2 style=\"text-align: left; padding-left: 30px;\">".$depositstatus."</h2>";
?>
</div>
            <div class="u-align-center u-clearfix u-custom-html u-custom-html-2"><!-- #!{php1} -->
<?php
        $switch = false;
        foreach ($transactions as &$transaction) {
            if ($transaction->category == 'receive' && floatval($transaction->time) >= $_SESSION['txnow']) {
                if($_SESSION['depositconfirmpagestatus'] == 'show') {
                    btc_displayincomingtransaction($transaction);
                    $switch = true;
                } else {
                    echo $_SESSION['depositconfirmpagestatus'];
                    $_SESSION['depositconfirmpagestatus'] = 'show';
                    echo $_SESSION['depositconfirmpagestatus'];
                    ob_flush();
                    ob_end_clean();
                    Redirect\redirect('');
                    exit();
                }
            }
        }
        if($_SESSION['depositconfirmpagestatus'] == 'wait') {
            $lastrefresh = false;
            $padding = strval((545/2)-200).'px';
            echo "<img style=\"width: 400px; height: 400px; margin-top: $padding\" src=\"resources/animated/loading.gif\"/>";
        }
        ?>
</div>
            <div class="u-align-center u-clearfix u-custom-html u-custom-html-3"><!-- #!{php3} -->
<?php
if($_SESSION['depositconfirmpagestatus'] == 'wait') {
    $newaddress = $_SESSION['newaddress'];
    echo "<div>";
    echo "<p style=\"text-align: center; margin-left: 50px;\">Please send your deposit to this address: $newaddress</p>";
    echo "<p style=\"text-align: center; margin-left: 50px; color: lightblue\">It may take a few minutes to receive your deposit.</p>";
    echo "</div>";
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
      <a class="u-link" href="https://nicepage.com/html5-template" target="_blank">
        <span>Free HTML5 Template</span>
      </a>
      <p class="u-text">
        <span>created with</span>
      </p>
      <a class="u-link" href="https://nicepage.com/html-website-builder" target="_blank">
        <span>Visual HTML Editor</span>
      </a>. 
    </section>
  </body>
</html><!-- #!{foot} -->
<?php
        if($_SESSION['depositconfirmpagestatus'] == 'wait') {
            ob_flush();
            ob_end_clean();
            sleep(15);
            Redirect\redirect('');
            exit();
        }

        if($switch) {
            $_SESSION['depositconfirmpagestatus'] = 'wait';
            echo $_SESSION['depositconfirmpagestatus'];
        }

?>