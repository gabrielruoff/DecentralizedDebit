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
        if($currency == 'tok') { $link = "deposit.php?currency=$currency"; } else { $link = '#'; }
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
// show token balance block
make_balance_block('tok', $balances->data);
?>
<div id="smart-button-container">
    <div style="text-align: center; color: black""><label for="description"> </label><input readonly type="hidden" name="descriptionInput" id="description" maxlength="127" value="Token Deposit"></div>
<p id="descriptionError" style="visibility: hidden; color:red; text-align: center;">Please enter a description</p>
<div style="text-align: center; color: whitesmoke"><label for="amount" style="color:white">Amount To Withdraw </label><input style='color: #000000' name="amountInput" type="number" id="amount" value="" ><span> USD</span></div>
<p id="priceLabelError" style="visibility: hidden; color:red; text-align: center;">Please enter a price</p>
<div id="invoiceidDiv" style="text-align: center; display: none;"><label for="invoiceid"> </label><input name="invoiceid" maxlength="127" type="text" id="invoiceid" value="" ></div>
<p id="invoiceidError" style="visibility: hidden; color:red; text-align: center;">Please enter an Invoice ID</p>
<div style="text-align: center; margin-top: 0.625rem;" id="paypal-button-container"></div>
</div>
<script src="https://www.paypal.com/sdk/js?client-id=AaXLm-til0Fm_1kR5ejwOSVmypDBlvxuFb7leQed2QRaABTxQs07mSKci01iL4IXxCx0lq-XonT_ybFk&currency=USD" data-sdk-integration-source="button-factory"></script>
<script>
    function initPayPalButton() {
        var description = document.querySelector('#smart-button-container #description');
        var amount = document.querySelector('#smart-button-container #amount');
        var descriptionError = document.querySelector('#smart-button-container #descriptionError');
        var priceError = document.querySelector('#smart-button-container #priceLabelError');
        var invoiceid = document.querySelector('#smart-button-container #invoiceid');
        var invoiceidError = document.querySelector('#smart-button-container #invoiceidError');
        var invoiceidDiv = document.querySelector('#smart-button-container #invoiceidDiv');

        var elArr = [description, amount];

        if (invoiceidDiv.firstChild.innerHTML.length > 1) {
            invoiceidDiv.style.display = "block";
        }

        var purchase_units = [];
        purchase_units[0] = {};
        purchase_units[0].amount = {};

        function validate(event) {
            return event.value.length > 0;
        }

        paypal.Buttons({
            style: {
                color: 'gold',
                shape: 'rect',
                label: 'paypal',
                layout: 'vertical',

            },

            onInit: function (data, actions) {
                actions.disable();

                if(invoiceidDiv.style.display === "block") {
                    elArr.push(invoiceid);
                }

                elArr.forEach(function (item) {
                    item.addEventListener('keyup', function (event) {
                        var result = elArr.every(validate);
                        if (result) {
                            actions.enable();
                        } else {
                            actions.disable();
                        }
                    });
                });
            },

            onClick: function () {
                if (description.value.length < 1) {
                    descriptionError.style.visibility = "visible";
                } else {
                    descriptionError.style.visibility = "hidden";
                }

                if (amount.value.length < 1) {
                    priceError.style.visibility = "visible";
                } else {
                    priceError.style.visibility = "hidden";
                }

                if (invoiceid.value.length < 1 && invoiceidDiv.style.display === "block") {
                    invoiceidError.style.visibility = "visible";
                } else {
                    invoiceidError.style.visibility = "hidden";
                }

                purchase_units[0].description = description.value;
                purchase_units[0].amount.value = amount.value;

                if(invoiceid.value !== '') {
                    purchase_units[0].invoice_id = invoiceid.value;
                }
            },

            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: purchase_units,
                });
            },

            onApprove: function (data, actions) {
                return actions.order.capture().then(function (details) {
                    // alert('Transaction completed by ' + details.payer.name.given_name + '!'+amount.value + ' '+invoiceid.value);
                    console.log(JSON.stringify(details));
                    // alert(JSON.stringify(details));
                    $.ajax({
                        type : "POST",  //type of method
                        url  : "lib/_confirmtokendeposit.php",  //your page
                        data : { datastring: JSON.stringify(details)},// passing the values
                        success: function(response){
                            //do what you want here...
                            // alert('wow ' + response);
                            window.location.href = "confirmtokenwithdrawl.php?txid="+details.id;
                        }
                    });
                });
            },

            onError: function (err) {
                console.log(err);
            }
        }).render('#paypal-button-container');
    }
    initPayPalButton();
</script>
<?php
?>
</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="u-container-style u-group u-palette-5-dark-2 u-group-1">
          <div class="u-container-layout u-container-layout-3">
            <div class="u-clearfix u-custom-html u-custom-html-3"><!-- #!{php3} -->
<?php

echo "<style>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
.wrapper{
    width: 450px;
    background: black;
  padding: 30px;
  box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}
.wrapper .input-data{
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
  transform: translate(-15px, -45px);
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

echo "<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang='en' dir='ltr' xmlns=\"http://www.w3.org/1999/html\">
  <head>
    <meta charset='utf-8'>
    <!-- Somehow I got an error, so I comment the title, just uncomment to show -->
    <!-- <title>Input Animation | CodingNepal</title> -->
    <link rel='stylesheet' href='style.css'>
  </head>
  <body>
    <div class='wrapper'>
      <div class='input-data'>
        <input type='text' required>
        <div class='underline'>
</div>


<label>"; ?><script>var $_GET = <?php echo json_encode($_GET); ?>; document.write($_GET['currency']);</script></label><?php
echo "
<div>
</div>
</body>
</html>";

if (isset($_GET['submit'])) {
    $b = new apibackend();
    $username = $_SESSION['username'];
    $response = $b->validatesession($username, $sessionid);
    if ($response->success == true) {
        // generate a new withdraw address
        if(isset($_SESSION['withdrawcurrency'])) {
            $currency = $_SESSION['withdrawlcurrency'];
            $deposit_address = $b->getnewaddress($currency, $username, $sessionid);
            unset($_SESSION['withdrawlcurrency']);
            if($deposit_address->success == true) {
                $_SESSION['newaddress'] = $deposit_address->data->newaddress;
                $_SESSION['txnow'] = time();
                $_SESSION['withdrawlstatus'] = 'Waiting for deposit...';
                $url = "withdrawconfirm.php?currency=$currency";
                \Redirect\redirect($url);
            }
        } else {
            $err = "No currency selected";
        }

    } else {
        $err = "invalid session";}
}
?>
</div>
            <a href="https://www.nicepage.com/" class="u-btn u-btn-round u-button-style u-custom-color-2 u-hover-custom-color-3 u-radius-50 u-btn-1">Withdraw Crypto</a>
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