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
    <meta name="generator" content="Nicepage 3.9.0, nicepage.com">
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
  <body class="u-body"><header class="u-clearfix u-header u-palette-1-base u-header" id="sec-e42f"><div class="u-clearfix u-sheet u-sheet-1">
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
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="Home.php" style="padding: 10px 20px;">User Home</a>
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
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Home.php" style="padding: 10px 20px;">User Home</a>
</li></ul>
              </div>
            </div>
            <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
          </div>
        </nav>
        <a href="login.php" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-6 u-btn-1">Sign In</a>
        <a href="register.php" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-6 u-btn-2">Get Started</a>
      </div></header>
    <section class="u-black u-clearfix u-section-1" id="sec-7bb0">
      <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-1">Deposit</h2>
        <div class="u-clearfix u-gutter-0 u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="u-layout-row">
              <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-1">
                <div class="u-border-2 u-border-grey-75 u-container-layout u-valign-top u-container-layout-1">
                  <h5 class="u-text u-text-default u-text-2">Deposit Crypto</h5>
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
        echo "<a href=\"deposit.php?currency=$currency\"><img style=\"width: 175px; height: 175px; padding: 10px\" src=\"" . $icons . $currency . '.png' . "\"/>";
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
    if($value != 'null') {
        make_balance_block($key, $balances->data);
    }
}
echo "</ul></nav>"
?>
</div>
                </div>
              </div>
              <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-2">
                <div class="u-border-2 u-border-grey-75 u-container-layout u-valign-top u-container-layout-2">
                  <h5 class="u-text u-text-default u-text-3">Deposit Tokens</h5>
                  <div class="u-clearfix u-custom-html u-custom-html-2"><!-- #!{php5} -->
<?php
?>
<div id="smart-button-container">
    <div style="text-align: center; color: black""><label for="description"> </label><input readonly type="hidden" name="descriptionInput" id="description" maxlength="127" value="Token Deposit"></div>
    <p id="descriptionError" style="visibility: hidden; color:red; text-align: center;">Please enter a description</p>
    <div style="text-align: center; color: black"><label for="amount" style="color:white">Amount To Deposit </label><input name="amountInput" type="number" id="amount" value="" ><span> USD</span></div>
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
                            window.location.href = "confirmtokendeposit.php?txid="+details.id;
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
        <div class="u-clearfix u-layout-wrap u-layout-wrap-2">
          <div class="u-layout">
            <div class="u-layout-row">
              <div class="u-container-style u-layout-cell u-size-18 u-layout-cell-3">
                <div class="u-border-2 u-border-grey-75 u-container-layout u-valign-middle u-container-layout-3">
                  <div class="u-clearfix u-custom-html u-custom-html-3"><!-- #!{php2} -->
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
              <div class="u-container-style u-layout-cell u-size-42 u-layout-cell-4">
                <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-4">
                  <div class="u-form u-form-1">
                    <form action="deposit.php?submit=true" method="POST" class="u-clearfix u-form-custom-backend u-form-horizontal u-form-spacing-15 u-inner-form" style="padding: 15px" source="custom" redirect="true" name="idtest">
                      <div class="u-form-group u-form-submit">
                        <a href="#" class="u-btn u-btn-submit u-button-style u-btn-1">Deposit Crypto<br>
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
        <div class="u-clearfix u-custom-html u-custom-html-4"><!-- #!{php3} -->
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
                $_SESSION['newaddress'] = $deposit_address->data->newaddress;
                $_SESSION['txnow'] = time();
                $_SESSION['depositstatus'] = 'Waiting for deposit...';
                $url = 'depositconfirm.php';
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
        <div class="u-clearfix u-custom-html u-custom-html-5"><!-- #!{php4} -->
<?php
if(isset($err)) {
    echo "<p style=\"text-color:red\"> $err </p>";
}
?>
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
      <a class="u-link" href="https://nicepage.com/html-website-builder" target="_blank">
        <span>HTML Website Builder</span>
      </a>. 
    </section>
  </body>
</html>