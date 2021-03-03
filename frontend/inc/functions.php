<?php


function getDatabase(){
    $dir = 'sqlite:../DB/henderson.db';
    $dbConnection  = new PDO($dir) or die("cannot open the database");   

    return $dbConnection;
}


//Function to create web page
function makePageStart() {

	$pageStartContent = <<<PAGESTART
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">      
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <title>Henderson Building Contractors</title>
        <link rel="icon" href="styles/images/logo.png" type="image" sizes="16x16">
        <script type="text/javascript" src="functions.js"></script>
        <link rel="stylesheet" href="styles/style.css">      
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
                <li><a href="services.php">Services</a></li>
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
            <a href="index.php">Home</a>
            |
            <a href="#">About</a>
            |
            <a href="services.php">Services</a>
            |
            <a href="jobs.php">Jobs</a>
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

//Function which gets Jobs from database
function getJobs($job){
    $dbConn = getDatabase();

    $select_stmt = $dbConn->prepare("SELECT 
                                        job_id AS 'ID',
                                        job_title AS 'Role',
                                        job_wage AS 'Wage(Hourly)',
                                        job_close_date AS 'Closing Date'
                                        FROM hd_job_vacancies");
    
    
    $select_stmt->execute();

    //Array for results
    $jobs = array();
    if ($select_stmt->execute()) {
        while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
            $jobs[] = $row;
        }
    }

    return $jobs;
}

function makeJobsPage(){

    $jobs = getJobs('all');

    $jobBox = "";

    foreach ( $jobs as $jobItem ) {

        $jobBox .= "<div class='job-box'>";
        $jobBox .= "<form id='jobForm' action='jobPage.php' method='post'>";
    
        foreach ( $jobItem as $key => $value ) {
            if ($key === 'ID'){
                $jobBox .= "<label style='display:none;' for='$key'>$key</label>
                        <input style='display:none;' name='$key' type='text' readonly value ='$value'>";
                        
            }else if($key === 'Wage(Hourly)'){
                $jobBox .= "<h2>$key : £$value</h2>";
            }else {
                $jobBox .= "<h2>$key : $value</h2>";
            }
        }
    
        $jobBox .= "<fieldset><button name='btn_goToJob' type='submit' id='goToJob'>See More</button></fieldset>";
        $jobBox .= "</form></div><br>";
    }

    $jobsPage = <<<JOBS
                $jobBox

JOBS;

    $jobsPage .="\n";
    return $jobsPage;
}

function makeFullJob($jobId){
    $jobInfo = getJobs($jobId);

    $dbConn = getDatabase();

    $select_stmt = $dbConn->prepare("SELECT * FROM hd_job_vacancies WHERE job_id = :jobId");
    $select_stmt->bindParam(":jobId", $jobId);
    $select_stmt->execute();

    $job = $select_stmt->fetch(PDO::FETCH_ASSOC);

    $jobId = $job['job_id'];
    $jobTitle = $job['job_title'];
    $jobWage = $job['job_wage'];
    $jobDesc = $job['job_desc'];
    $jobReq = $job['job_requirements'];
    $jobClose = $job['job_close_date'];

    $jobInfo = <<<JOB
    <body>
    <h3 class="title"></h3>
        <div class="container">  
        <form id="contact" action="sendEmail.php" method="post">
            
            <div>
                <h3>$jobTitle</h3>
            </div>
            <h2>£$jobWage an hour</h2>
            <br>
            <h2>$jobDesc</h2>
            <br>
            <h2>Requirements: $jobReq</h2>
            <br>
            <h2>Applications close: $jobClose</h2>
            <fieldset>
                <button name="submit" type="submit" id="apply-here" data-submit="...Sending">Apply Here</button>
            </fieldset>
        </form>  
        </div>
            
    </body>

JOB;

    $jobInfo .="\n";
    return $jobInfo;

}

?>