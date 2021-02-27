<?php

function getDatabase(){
    $dir = 'sqlite:/[YOUR-PATH]/combadd.sqlite';
    $dbh  = new PDO($dir) or die("cannot open the database");
   
}

//Function to create web page
function makePageStart() {

	$pageStartContent = <<<PAGESTART
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/style.css">
        
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <title>Henderson Building Contractors</title>
        <link rel="icon" href="styles/images/logo.png" type="image" sizes="16x16">
    </head>
PAGESTART;
	$pageStartContent .="\n";
	return $pageStartContent;
}

function makeNav(){
        $makeNav = <<<NAVIGATION
        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
            </label>
            <div class="nav-logo">
                <img src="styles/images/logo.png">
            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="jobs.php">Jobs</a></li>
                <li><a href="contactForm.php">Contact</a></li>
                <li><a href="#">Staff Login</a></li>
            </ul>
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
            <a href="contactForm.php">Contact</a>
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
                <p><a href="mailto:enquiries@hendersonbuilding.co.uk">enquiries@hendersonbuilding.co.uk</a></p>
            </div>
        </div>
        <div class="footer-right">
            <p class="footer-company-about">
            <span>About the company</span>
                Henderson Building Contractors was formed in 1984 by Bill and Ros Henderson. Operating out of their family home, they carried out private domestic work to the local area.</p>
            <div class="footer-icons">
            <a href="#"><i class="fa fa-facebook-f"></i></a>
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
    </html>
PAGEEND;

    $pageEndContent .="\n";
    return $pageEndContent;
}

?>