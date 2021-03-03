<!-- #!{php1} -->
<?php

session_start();
require_once('../Backend.php');

use Backend\apibackend;

$b = new apibackend();


$username = $_SESSION['username'];
$currency = '*';
$balances = $b->getbalance($username, $currency, $_SESSION['sessionid']);

function make_balance_block($currency, $data)
{
    ?>
    <div style="border-style: solid; border-color: aqua">
        <?php
        $icons = '/resources/icons';
        echo "<img style=\"width: 250px; height: 250px;\" src=\"" . $icons . $currency . '.png' . "\"/>";
        if ($data->{$currency} != 'null') {
            echo "<p> " . strtoupper($currency) . " Balance: </p>";
            echo "<p> Confirmed: " . $data->{$currency}->balance_conf . " </p>";
            echo "<p> Unconfirmed: " . $data->{$currency}->balance_unconf . " </p>";
        } else {
            echo "<p> No " . strtoupper($currency) . " Wallet </p>";
        }
        ?>
    </div>
<?php } ?>
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
    <meta name="generator" content="Nicepage 3.7.2, nicepage.com">
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
<!-- #!{php2} -->
<?php
// make a block displaying balance data for each wallet
foreach ($balances->data as $key => $value) {
    make_balance_block($key, $balances->data);
}
?>
    <div class="u-clearfix u-sheet u-sheet-1">
        <h1 class="u-text u-text-body-alt-color u-text-1">Welcome</h1>
        <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
            <div class="u-layout">
                <div class="u-layout-row">
                    <div class="u-size-43">
                        <div class="u-layout-col">
                            <div class="u-align-left u-black u-container-style u-layout-cell u-size-60 u-layout-cell-1">
                                <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-1"></div>
                            </div>
                        </div>
                    </div>
                    <div class="u-size-17">
                        <div class="u-layout-col">
                            <div class="u-align-left u-black u-container-style u-layout-cell u-size-30 u-layout-cell-2">
                                <div class="u-border-2 u-border-grey-75 u-container-layout u-valign-middle u-container-layout-2">
                                    <a href="https://nicepage.com/website-templates" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-50 u-btn-1">Settings</a>
                                </div>
                            </div>
                            <div class="u-container-style u-layout-cell u-palette-1-base u-size-30 u-layout-cell-3">
                                <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-3">
                                    <h6 class="u-text u-text-2">History</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="u-black u-border-2 u-border-grey-75 u-container-style u-expanded-width u-group u-group-1">
            #{php2}
            <div class="u-container-layout u-container-layout-4">
                <a href="#" class="u-border-2 u-border-hover-palette-1-base u-border-palette-4-base u-btn u-btn-round u-button-style u-none u-radius-50 u-text-palette-4-base u-btn-2">Deposit</a>
                <a href="#" class="u-border-2 u-border-hover-palette-1-base u-border-palette-4-base u-btn u-btn-round u-button-style u-none u-radius-50 u-text-palette-4-base u-btn-3">Withdraw</a>
            </div>
        </div>
    </div>
</section>


<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-bc4e"><div class="u-clearfix u-sheet u-sheet-1">
    <p class="u-small-text u-text u-text-variant u-text-1">Sample text. Click to select the text box. Click again or double click to start editing the text.</p>
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