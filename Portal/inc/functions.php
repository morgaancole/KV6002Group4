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

//Function to get applicants from database and return it for the applicants page
//@author - Morgan Wheatman
function getApplicants(){
    $dbConn = getDatabase();

    $select_stmt = $dbConn->prepare("SELECT hd_job_applicants.applicant_id AS 'ID', 
                        hd_job_applicants.applicant_fname AS 'FirstName', 
                        hd_job_applicants.applicant_lname AS 'LastName', 
                        hd_job_applicants.applicant_email AS 'Email', 
                        hd_job_applicants.applicant_contact AS 'Contact', 
                        hd_job_vacancies.job_title AS 'Job',
                        hd_job_applicants.applicant_cv AS 'CV' 
                        FROM hd_job_applicants
                        INNER JOIN hd_job_vacancies on (hd_job_applicants.job_id = hd_job_vacancies.job_id)
                    ");

    $select_stmt->execute();

    return $select_stmt;
}

//Function to respond to an application appropriately
//Takes response as a parameter to determine which email to send
//@author - Morgan Wheatman
function applicantResponse($response, $applicantId){
    $dbConn = getDatabase();

    //Getting user data from database to send them an email
    $select_stmt = $dbConn->prepare("SELECT applicant_fname, applicant_email FROM hd_job_applicants WHERE applicant_id = :aid");
    $select_stmt->bindParam(":aid", $applicantId);
    $select_stmt->execute();
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

    //If database row is selected
    if($row){

        $firstName = $row['applicant_fname'];
        $email = $row['applicant_email'];

        if($response === 'accept'){
            
            $send = "Hi " . $firstName . "\n\nCongratulations!\n\nHenderson Contractors would like to bring you in for an interview!\nPlease confirm a date/time which would be convenient for you!\n\n";
            $send .= "Best Wishes,\nHenderson Building Contractors";

            $headers = "From: applications@hendersonbuilding.co.uk";

            $subject = "Response from Henderson Contractors";          
        }else if($response === 'reject'){

            $send = "Hi " . $firstName . "\n\nThanks so much for your interest!\n\nHowever, at this time we've chosen to proceed with another candidate\nPlease keep an eye on our jobs page as we may have another opening for your soon!\n\n";
            $send .= "Best Wishes,\nHenderson Building Contractors";

            $headers = "From: applications@hendersonbuilding.co.uk";

            $subject = "Response from Henderson Contractors";
        }
    
        //Sending to user	
        mail($email, $subject ,$send, $headers); 

        //Removing user data from database
        $delete_stmt = $dbConn->prepare("DELETE FROM hd_job_applicants WHERE applicant_id = :aid");
        $delete_stmt->bindParam(":aid", $applicantId);
        $delete_stmt->execute();

        return true;

    }else{

        echo "<h1>Something went wrong!</h1>";
        echo "<h1>Returning to applicants page</h1>";

        header("refresh:5;url=viewApplicants.php");

        return false;
    }
}


?>

