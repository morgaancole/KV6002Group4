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
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <title>Henderson Building Contractors</title>
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
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Features</a></li>
                <li><a href="#">Contact</a></li>
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

?>