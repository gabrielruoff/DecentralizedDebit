<!-- #!{head} -->
<?php
session_start();
require_once('/usr/local/php/lib/Backend.php');

use Backend\apibackend;
use Redirect;
?>
<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Contact Us">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>register</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="register.css" media="screen">
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
    <meta property="og:title" content="register">
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
    <section class="u-black u-clearfix u-section-1" id="carousel_6946">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="u-layout-row">
              <div class="u-align-center-sm u-align-right-lg u-align-right-md u-align-right-xl u-container-style u-layout-cell u-left-cell u-size-30 u-layout-cell-1">
                <div class="u-container-layout u-container-layout-1">
                  <h2 class="u-align-center-xs u-text u-text-palette-3-base u-text-1">Create an Account</h2>
                  <p class="u-align-center-xs u-text u-text-2">Something cool bro make an account</p>
                  <h6 class="u-align-center-xs u-text u-text-3"><b>Username:</b>
                  </h6>
                  <h6 class="u-align-center-xs u-text u-text-4"><b style="">Password:</b>
                  </h6>
                  <h6 class="u-align-center-xs u-text u-text-5"><b style="">Confirm Password:</b>
                  </h6>
                </div>
              </div>
              <div class="u-container-style u-layout-cell u-right-cell u-size-30 u-layout-cell-2">
                <div class="u-container-layout u-container-layout-2">
                  <div class="u-clearfix u-custom-html u-custom-html-1"><!-- #!{php1} -->
<?php

$b = new apibackend();

if (isset($_POST['username']) && isset($_POST['password_confirm'])) {
    $b = new apibackend();
    $username = $_POST['username']; $password = $_POST['password'];
    if($password == $_POST['password_confirm']) {
        $response = $b->createaccount($username, $password);
        if ($response->success == true) {
            // start session
            $response = $b->generatesessionid($username, $password);
            if ($response->success == true) {
                $_SESSION['username'] = $username;
                $_SESSION['sessionid'] = $response->data->session_id;
            } else {
                $err = $response->err;
            }

            Redirect\redirect('Home.php');

        } else {
            $err = $response->err;
        }
    } else {
        $err = "Passwords do not match";
    }
}
?>
</div>
                  <div class="u-form u-form-1">
                    <form action="register.php" method="POST" class="u-clearfix u-form-custom-backend u-form-spacing-40 u-form-vertical u-inner-form" style="padding: 10px" source="custom" name="register" redirect="true">
                      <div class="u-form-group u-form-group-1">
                        <label for="text-20c2" class="u-form-control-hidden u-label"></label>
                        <input type="text" id="text-20c2" name="username" class="u-border-1 u-border-grey-30 u-input u-input-rectangle">
                      </div>
                      <div class="u-form-group u-form-group-2">
                        <label for="text-c0a4" class="u-form-control-hidden u-label"></label>
                        <input type="text" placeholder="" id="text-c0a4" name="password" class="u-border-1 u-border-grey-30 u-input u-input-rectangle">
                      </div>
                      <div class="u-form-group u-form-group-3">
                        <label for="text-4f44" class="u-form-control-hidden u-label"></label>
                        <input type="text" id="text-4f44" name="password_confirm" class="u-border-1 u-border-grey-30 u-input u-input-rectangle">
                      </div>
                      <div class="u-align-left u-form-group u-form-submit">
                        <a href="#" class="u-btn u-btn-rectangle u-btn-submit u-button-style u-palette-3-base u-btn-1">Submit</a>
                        <input type="submit" value="submit" class="u-form-control-hidden">
                      </div>
                      <div class="u-form-send-message u-form-send-success"> Thank you! Your message has been sent. </div>
                      <div class="u-form-send-error u-form-send-message"> Unable to send your message. Please fix errors then try again. </div>
                      <input type="hidden" value="" name="recaptchaResponse">
                    </form>
                  </div>
                  <div class="u-clearfix u-custom-html u-custom-html-2"><!-- #!{php2} -->
<?php
if(isset($err)) {
    echo "<p style=\"text-color:red\"> $err </p>";
}
?>
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
      <a class="u-link" href="https://nicepage.com/website-mockup" target="_blank">
        <span>Website Mockup</span>
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