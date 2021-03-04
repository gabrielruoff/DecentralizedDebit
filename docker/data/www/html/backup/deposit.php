<!-- #!{head} -->
<?php
session_start();
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
    <title>deposit</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="deposit.css" media="screen">
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
    <meta property="og:title" content="deposit">
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
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="login.html" style="padding: 10px 20px;">Login</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="deposit.html" style="padding: 10px 20px;">Deposit</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="" style="padding: 10px 20px;">depositconfirm</a>
</li></ul>
          </div>
          <div class="u-custom-menu u-nav-container-collapse">
            <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
              <div class="u-sidenav-overflow">
                <div class="u-menu-close"></div>
                <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2"><li class="u-nav-item"><a class="u-button-style u-nav-link" href="index.html" style="padding: 10px 20px;">Home</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="About.html" style="padding: 10px 20px;">About</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Contact-Us.html" style="padding: 10px 20px;">Contact Us</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="login.html" style="padding: 10px 20px;">Login</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="deposit.html" style="padding: 10px 20px;">Deposit</a>
</li></ul>
              </div>
            </div>
            <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
          </div>
        </nav>
        <a href="login.php" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-6 u-btn-1">Sign In</a>
        <a href="register.php" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-6 u-btn-2">Get Started</a>
      </div></header>
    <section class="u-clearfix u-section-1" id="sec-7bb0">
      <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-1">Deposit</h2>
        <div class="u-clearfix u-gutter-0 u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="u-layout-row">
              <div class="u-container-style u-layout-cell u-size-60 u-layout-cell-1">
                <div class="u-border-2 u-border-grey-75 u-container-layout u-valign-top u-container-layout-1">
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
        echo "<img style=\"width: 175px; height: 175px; padding: 10px\" src=\"" . $icons . $currency . '.png' . "\"/>";
        if ($data->{$currency} != 'null') {
            echo "<a href=\"deposit.php?currency=$currency\"><p style=\"text-align: left; padding-left: 20px\"> " . strtoupper($currency) . " Balance: </p>";
            echo "<p style=\"text-align: left; padding-left: 20px\"> Confirmed: " . number_format(floatval($data->{$currency}->balance_conf), 8) . " </p>";
            echo "<p style=\"text-align: left; padding-left: 20px; color: gray\"> Unconfirmed: " . number_format(floatval($data->{$currency}->balance_unconf), 8)  . " </p>";
            echo "<input type=\"radio\" name=\"r1\" value=\"p\"></a>";
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
foreach ($balances->data as $key => $value) {
    if($value != 'null') {
        make_balance_block($key, $balances->data);
    }
}
?>
</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="u-clearfix u-layout-wrap u-layout-wrap-2">
          <div class="u-layout">
            <div class="u-layout-row">
              <div class="u-container-style u-layout-cell u-size-18 u-layout-cell-2">
                <div class="u-border-2 u-border-grey-75 u-container-layout u-valign-middle u-container-layout-2">
                  <div class="u-clearfix u-custom-html u-custom-html-2"><!-- #!{php2} -->
<?php
if(isset($_GET['currency'])) {
    $_SESSION['depositcurrency'] = $_GET['currency'];
    echo "<p>Deposit into ".strtoupper($_SESSION['depositcurrency'])." wallet:</p>";
} else {
    echo "<p>Select a wallet to deposit into</p>";
}
?>
</div>
                </div>
              </div>
              <div class="u-container-style u-layout-cell u-size-42 u-layout-cell-3">
                <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-3">
                  <div class="u-form u-form-1">
                    <form action="deposit.php?submit=true" method="POST" class="u-clearfix u-form-custom-backend u-form-horizontal u-form-spacing-15 u-inner-form" style="padding: 15px" source="custom" redirect="true" name="idtest">
                      <div class="u-form-group u-form-submit">
                        <a href="#" class="u-btn u-btn-submit u-button-style u-btn-1">Request Deposit Address<br>
                        </a>
                        <input type="submit" value="submit" class="u-form-control-hidden">
                      </div>
                      <div class="u-form-send-message u-form-send-success">Thank you! Your message has been sent.</div>
                      <div class="u-form-send-error u-form-send-message">Unable to send your message. Please fix errors then try again.</div>
                      <input type="hidden" value="" name="recaptchaResponse">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="u-clearfix u-custom-html u-custom-html-3"><!-- #!{php3} -->
<?php
if (isset($_GET['submit'])) {
    $b = new apibackend();
    $username = $_SESSION['username'];
    $response = $b->validatesession($username, $sessionid);
    if ($response->success == true) {
        // generate a new deposit address
        if(isset($_SESSION['depositcurrency'])) {
            $deposit_address = $b->getnewaddress($_SESSION['depositcurrency'], $username, $sessionid);
            if($deposit_address->success == true) {
                $_POST['newaddress'] = $deposit_address->data->newaddress;
                echo $_POST['newaddress'];
                $_SESSION['txnow'] = time();
                \Redirect\redirect('depositconfirm.php');
            }
        } else {
            $err = "No currency selected";
        }

    } else {
        $err = "invalid session";}
}
?>
</div>
        <div class="u-clearfix u-custom-html u-custom-html-4"><!-- #!{php4} -->
<?php
if(isset($err)) {
    echo "<p style=\"text-color:red\"> $err </p>";
}
?>
</div>
      </div>
    </section>
    <section class="u-align-center u-clearfix u-section-2" id="sec-11fa">
      <div class="u-clearfix u-sheet u-sheet-1"></div>
    </section>
    
    
    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-bc4e"><div class="u-clearfix u-sheet u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Sample text. Click to select the text box. Click again or double click to start editing the text.</p>
      </div></footer>
    <section class="u-backlink u-clearfix u-grey-80">
      <a class="u-link" href="https://nicepage.com/html-templates" target="_blank">
        <span>HTML Template</span>
      </a>
      <p class="u-text">
        <span>created with</span>
      </p>
      <a class="u-link" href="https://nicepage.com/html-website-builder" target="_blank">
        <span>HTML Website Builder</span>
      </a>. 
    </section>
  </body>
</html>