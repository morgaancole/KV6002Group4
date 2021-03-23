<?php

function getDatabase(){
    try{
        $dir = 'sqlite:../DB/hendersonDB.sqlite';
        $dbConnection  = new PDO($dir) or die("cannot open the database");   
    }catch (Exception $e) {
        echo "There was a problem: " . $e->getMessage();
    }


    return $dbConnection;
}

function makePageStart($title) {
    $pageStart = <<<PAGESTART

    <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>$title</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles.css">
    </head>

PAGESTART;
    $pageStart .="\n";
    return $pageStart;
}


function createPageBody() {
    $pageBody = <<<CREATEPAGEBODY

    <body>

CREATEPAGEBODY;

    $pageBody .= "\n";
    return $pageBody;


}

function createPageClose() {
    $pageClose = <<<CLOSE

    </body>
    </html>
    
CLOSE;
    $pageClose .= "\n";
    return $pageClose;
}


function createNav() {
    $nav = <<<NAVBAR

    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar">
        <div class="sidebar-header">
            <h3 class="brand">
                <span>Hendersons</span>
            </h3>
            <label for="sidebar-toggle" class="ti-menu-alt"></label>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="./dash.php">
                        <span class="ti-home"></span>
                        <span>Home</span>
                    </a>
                </li>

                <li>
                    <a href="./timesheet.php">
                        <span class="ti-time"></span>
                        <span>Timesheet</span>
                    </a>
                </li>


                <li>
                    <a href="./vehiclelog.php">
                        <span class="ti-book"></span>
                        <span>Vehicle Logs</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <span class="ti-book"></span>
                        <span>Payslip</span>
                    </a>
                </li>

                <li>
                    <a href="./manageAccount.php">
                        <span class="ti-settings"></span>
                        <span>Manage Account</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>


NAVBAR;

    $nav .= "\n";
    return $nav;
}


?>

