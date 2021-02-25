<?php

//Function to create web page
function makePageStart() {

	$pageStartContent = <<<PAGESTART
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <title>Henderson Building Contractors</title>
        <script type="text/javascript" src="inc/stickynav.js"></script>
        <link rel="icon" href="styles/images/logo.png" type="image" sizes="16x16">
    </head>
    <body>
PAGESTART;
	$pageStartContent .="\n";
	return $pageStartContent;
}

function makeNav(){
        $makeNav = <<<NAVIGATION
            <nav class="navbar">
            <div class="content">
            <div class="logo">
                <a href="index.php"><img src="styles/images/logo.png" /></a>
            </div>
            <ul class="menu-list">
                <div class="icon cancel-btn">
                <i><img class ="close-btn" src="styles/images/close.png" /></i>
                </div>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="contactForm.php">Contact</a></li>
                <li><a href="#">Staff Login</a></li>
                
            </ul>
            <div class="icon menu-btn">
                <i>
                <svg viewBox="0 0 100 80" width="40" height="40">
                        <rect width="100" height="20"></rect>
                        <rect y="30" width="100" height="20"></rect>
                        <rect y="60" width="100" height="20"></rect>
                    </svg>
                </i>
            </div>
            </div>
        </nav>
NAVIGATION;

    $makeNav .="\n";
	return $makeNav;
}

//Function to create main body of page
function startMain(){
    $mainContent = <<<MAIN

	<main>

MAIN;
    $mainContent .="\n";
    return $mainContent;
}

//Function to make a footer(){
function makeFooter(){
    $footer = <<<FOOTER
    <footer class="footer-distributed">

        <div class="footer-left">
            <img src="styles/images/logo.png">

            <p class="footer-links">
            <a href="#">Home</a>
            |
            <a href="#">About</a>
            |
            <a href="#">Services</a>
            |
            <a href="#">Contact</a>
            |
            <a href="#">Staff Login</a>
            </p>

            <p class="footer-company-name">© 2021, Developed by students of Northumbria University</p>
        </div>

        <div class="footer-center">
            <div>
            <i class="fa fa-map-marker"></i>
            <p><span>14 Atley Business Park,
                North Nelson Park Industrial Estate</span>
                Cramlington, NE23 1WP</p>
            </div>

            <div>
            <i class="fa fa-phone"></i>
            <p>01670 707853</p>
            </div>
            <div>
            <i class="fa fa-envelope"></i>
            <p><a href="mailto:testaddress@hendersonbuilding.co.uk">test@hendersonbuilding.co.uk</a></p>
            </div>
        </div>
        <div class="footer-right">
            <p class="footer-company-about">
            <span>About the company</span>
            Henderson Building Contractors was formed in 1984 by Bill and Ros Henderson. Operating out of their family home, they carried out private domestic work to the local area.</p>
            <div class="footer-icons">
            <a href="#"><i class="fa fa-facebook"></i></a>
            </div>
        </div>
    </footer>
FOOTER;

    $footer .="\n";
    return $footer;
}

//Function to end main body of page
function endMain(){
	return "</main>\n";
}

//Function to end document
function makePageEnd(){
    $pageEndContent = <<<PAGEEND
    </body>
    </html>
PAGEEND;

    $pageEndContent .="\n";
    return $pageEndContent;
}

?>