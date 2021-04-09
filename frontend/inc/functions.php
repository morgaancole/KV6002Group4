<?php
/*
*PHP Functions page to be used throughout frontend product - includes page-building functions & client-side communications
*Protected by .htaccess to protect functionality which communicates with client side
*@author Morgan Wheatman
*@author Rachel Johnson
*/

//Returns database connection
function getDatabase(){
    try{
        $dir = 'sqlite:../DB/hendersonDB.sqlite';
        $dbConnection  = new PDO($dir) or die("cannot open the database");   
    }catch (Exception $e) {
        echo "There was a problem: " . $e->getMessage();
    }


    return $dbConnection;
}

//Function to create web page
//@author - Morgan Wheatman
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
        <link rel="stylesheet" href="styles/style.css">     
    </head>
PAGESTART;
	$pageStartContent .="\n";
	return $pageStartContent;
}

//Function to make nav menu
//@author - Morgan Wheatman
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
                <li><a href="about.php">About</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="jobs.php">Jobs</a></li>
                <li><a href="contactForm.php">Contact</a></li>
                <li><a href="loginForm.php">Staff Login</a></li>
            </ul>
      </nav>
NAVIGATION;

    $makeNav .="\n";
	return $makeNav;
}

//Function to create main body of page
//@author - Morgan Wheatman
function startMain(){
    $mainContent = <<<MAIN

	<main>

MAIN;
    $mainContent .="\n";
    return $mainContent;
}

//Function to make a footer
//@author - Morgan Wheatman
function makeFooter(){
    $footer = <<<FOOTER
    <footer class="footer-distributed">

        <div class="footer-left">
            <img src="styles/images/logo.png">

            <p class="footer-links">
            <a href="index.php">Home</a>
            |
            <a href="about.php">About</a>
            |
            <a href="services.php">Services</a>
            |
            <a href="jobs.php">Jobs</a>
            |
            <a href="contactForm.php">Contact</a>
            |
            <a href="loginForm.php">Staff Login</a>
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
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>

            </div>
        </div>
    </footer>
FOOTER;

    $footer .="\n";
    return $footer;
}

//Function to end main body of page
//@author - Morgan Wheatman
function endMain(){
	return "</main>\n";
}

//Function to end document
//@author - Morgan Wheatman
function makePageEnd(){
    $pageEndContent = <<<PAGEEND
    </html>
PAGEEND;

    $pageEndContent .="\n";
    return $pageEndContent;
}

//Function which gets Jobs from database
//@author - Morgan Wheatman
function getJobs($job){
    try{
        $dbConn = getDatabase();
        
        //Selecting all columns, but assigning alias to ID to protect DB structure
        $select_stmt = $dbConn->prepare("SELECT job_id AS 'ID',
                                                job_title,
                                                job_wage,
                                                job_desc,
                                                job_requirements,
                                                job_close_date
                                                FROM hd_job_vacancies");

        $select_stmt->execute();

        //Array for results
        $jobs = array();
        if ($select_stmt->execute()) {
            while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                $jobs[] = $row;
            }
        }
    }catch (Exception $e) {
        echo "There was a problem: " . $e->getMessage();
    }

    return $jobs;
}

//Function which dynamically builds job page
//Displays message if no jobs are available
//@author - Morgan Wheatman
function makeJobsPage(){

    $jobBox = "";

    $jobs = getJobs('all');

    //Checks if there are any vacancies before displaying page
    if(empty($jobs)){
        $jobsPage = <<<JOBS
        <div class="no-jobs"> 
            <div class="job-message">
                <h2>Sorry</h2>
                <p>We currently have no vacancies at Henderson.</p>
                <br>
                <p>Please keep an eye on this page as we update it whenever we have a new spot</p>
                <br>
                <p>Feel free to <a href="contactForm.php">contact us </a>if you have any enquiries</p>
                <br>
                <p>Thanks for your interest!</p>
            </div>
        </div>

JOBS;
    //Displays all jobs if there are any available
    }else{

        foreach ( $jobs as $jobItem ) {

            $jobBox .= "<div class='job-box'>";
            $jobBox .= "<form id='jobForm' action='apply.php' method='post'>";
        
            foreach ( $jobItem as $key => $value ) {
                switch ($key) {
                    case 'ID':                        
                        $jobBox .= "<input style='display:none;' name='$key' type='text' readonly value ='$value'>";
                        break;
                    case 'job_title':
                        $jobBox .= "<h2>Role : $value</h2>";
                        break;
                    case 'job_wage':
                        $jobBox .= "<p><b>Wage(Hourly)</b> : £$value.00</p>";
                        break;
                    case 'job_desc':
                        $jobBox .= "<p>$value</p><br>";
                        break;
                    case 'job_requirements':
                        $jobBox .= "<p><b>Requirements: </b>$value</p><br>";
                        break;
                    case 'job_close_date':
                        $jobBox .= "<p><b>Applications Close: </b>$value</p>";
                        break;
                }  
            }
        
            $jobBox .= "<fieldset><button name='btn_apply_here' type='submit' id='goToJob'>Apply Here</button></fieldset>";
            $jobBox .= "</form></div><br>";
        }

        $jobsPage = <<<JOBS
                    $jobBox

JOBS;
    }

    $jobsPage .="\n";
    return $jobsPage;
}

//Function which dynamically builds form/application for user
//@author - Morgan Wheatman
function makeJobForm($jobId){
    try{
        $dbConn = getDatabase();
        $select_stmt = $dbConn->prepare("SELECT * FROM hd_job_vacancies WHERE job_id = :jobId");
        $select_stmt->bindParam(":jobId", $jobId);
        $select_stmt->execute();

        $job = $select_stmt->fetch(PDO::FETCH_ASSOC);

        $jobTitle = $job['job_title'];
    }catch (Exception $e) {
        echo "There was a problem: " . $e->getMessage();
        
    }

    $jobForm = <<<FORM
        <body>
        <script type="text/javascript" src="jobForm.js"></script>
        <h3 class="title"></h3>

        <div class="container">  
            <div class="form-container">
                <form id="jobForm" action="sendApplication.php" method="post" enctype="multipart/form-data">
                <div>
                    <h3>Apply Here!</h3>
                </div>
                <input style='display:none;' name='ID' type='text' readonly value ='$jobId'>
                <fieldset>
                    <label for="role">Applying For</label>
                    <input name="role" type="text" required id="role" 
                    placeholder="role" pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$" title="Only alphabets are allowed" 
                    autocomplete="role" size="20" maxlength="20" readonly value="$jobTitle">
                </fieldset>
                <fieldset>
                    <label for="fName">First Name</label>
                    <input name="fname" type="text" required id="fname" 
                    placeholder="First Name" pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$" title="Only alphabets are allowed" 
                    autocomplete="first-name" size="20" maxlength="20">
                </fieldset>
                <fieldset>
                    <label for="lname">Last Name</label>
                    <input name="lname" type="text" required id="lname" 
                    placeholder="Last Name" pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$" title="Only alphabets are allowed" 
                    autocomplete="last-name" size="20" maxlength="20">
                </fieldset>
                <fieldset>
                    <label for="email">Email</label>
                    <input name="email" type="email" required id="email" 
                    placeholder="Email Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid email address" 
                    autocomplete="email" size="20" maxlength="40">
                </fieldset>
                <fieldset>
                    <label for="number">Contact Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="Phone number" maxlength="20" required>
                </fieldset>
                <fieldset>
                    <label for="cv">Upload CV</label>
                    <input type="file" name="cv_file" id="cv_file" accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" required>
                </fieldset>
                <fieldset id="consentText">
                    <input type="checkbox" id="consentCheck" name="consent" value="consent">
                    <label for="consent"> I consent to Henderson Building Contractors storing my information for recruiting</label>
                </fieldset>
                <fieldset>
                    <button name="btn_app_send" type="submit" id="btn_app_send" data-submit="...Sending">Send now</button>
                </fieldset>
                </form>  
            </div>
        </div>

    </body>

FORM;

    $jobForm .="\n";
    return $jobForm;

}

//Function which stores users messasge in database IF they consent
//Isn't called if user does not consent
//@author - Morgan Wheatman
function storeMessage($name, $email, $phone, $message){
    try {
        $dbConn = getDatabase();

        $insert_stmt = $dbConn->prepare("INSERT INTO hd_enquires(enquiry_name, enquiry_email, contact_number, enquiry_message) VALUES(:uname, :uemail, :uphone, :umessage)");
        
        $insert_stmt->bindValue(':uname', $name);
        $insert_stmt->bindValue(':uemail', $email);
        $insert_stmt->bindValue(':uphone', $phone);
        $insert_stmt->bindValue(':umessage', $message);
        
        $insert_stmt->execute();   
    }catch (Exception $e) {
        echo "There was a problem: " . $e->getMessage();
        
    }	
    
}

//Function which sends users/applicants' application
//Saves applicant CV in uploads folder
//@author - Morgan Wheatman
function sendApplication($jobId, $firstName, $lastName, $email, $contact, $role, $fullPath){
            
        try {
            $dbConn = getDatabase();
    
            $insert_stmt = $dbConn->prepare("INSERT INTO hd_job_applicants(applicant_fname, applicant_lname, applicant_email, applicant_contact, applicant_cv, job_id) 
                                            VALUES(:ufname, :ulname, :uemail, :ucontact, :ucv, :ujobid)");
            
            $insert_stmt->bindValue(':ufname', $firstName, PDO::PARAM_STR);
            $insert_stmt->bindValue(':ulname', $lastName, PDO::PARAM_STR);
            $insert_stmt->bindValue(':uemail', $email, PDO::PARAM_STR);
            $insert_stmt->bindValue(':ucontact', $contact, PDO::PARAM_INT);
            $insert_stmt->bindValue(':ucv', $fullPath, PDO::PARAM_STR);
            $insert_stmt->bindValue(':ujobid', $jobId, PDO::PARAM_INT);


        }catch (Exception $e) {
            echo "There was a problem: " . $e->getMessage();
            
        }	
        
        if($insert_stmt->execute()){
            echo applicationSubmitted('sent');

            //Creating variables to use in sending emails
            $send = "Hi " . $firstName . "\nThanks for your application!\n\nHenderson Contractors will be in touch as soon as possible!\n";

            //If CV wasn't successfully uploaded, asks applicant to reply to email with CV file
            if($fullPath == "CV upload unavailable"){
                $send .= "However, your CV couldn't be uploaded.\n";
                $send .= "Please could you reply to this email and attach your CV?\n";
            }

            $headers = "From: applications@hendersonbuilding.co.uk";

            $subject = "Thanks for applying to join us";

            //Sending to user	
            mail($email, $subject ,$send, $headers);

            $subject = "New Applicant for role: " . $role;

            $message = "There has been a new applicant for the role of " . $role . "\n";
            $message .= "You can view their application on our admin portal";

            //Sending to developer
            mail("morgan.wheatman@northumbria.ac.uk",$subject ,$message, $headers);
        }else{
            echo applicationSubmitted('failure');
        }
}

//Function which displays message for user after submitting an application
//@author - Morgan Wheatman
function applicationSubmitted($result){
    if($result === 'sent'){
        $bodyContent = <<<BODY
        <body>
        <h3 class='title'>Thanks</h3>
          <div class="container">  
                <h2 class='title'>Thanks for your application!</h2>
                <p>Your application has been received and we will be in touch when we have more information</p>
                <h3>Return <a href='index.php'>Home?</a></h3>
                <h3>View <a href='services.php'>Services?</a></h3>
                <h3>View <a href='jobs.php'>Jobs?</a></h3>
                <h3><a href='contactForm.php'>Contact Us?</a></h3>
          </div>
              
        </body>
BODY;
    }else if($result === 'failure'){
        $bodyContent = <<<BODY
        <body>
        <h3 class="title">Oops</h3>
          <div class="container">  
                <h2>Sorry, it looks like something went wrong!</h2>
                <p>Please try again later!</p>
          </div>         
        </body>
BODY;
    }

    return $bodyContent;
}



//Function that displays reviews from database
//@author - Rachel Johnson


function getReviews(){
    
        $dbConn = getDatabase();

        $select_stmt = $dbConn->prepare("SELECT review_id AS 'ID',
                                                review,
                                                customer_name
                                                FROM hd_reviews 
                                                ORDER BY RANDOM()
                                                LIMIT 6");

        $select_stmt->execute();

        $reviews = array();
        if ($select_stmt->execute()) {
            while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                $reviews[] = $row;
            }
        }

 $reviewBox = "";

    if(empty($reviews)){
        $reviewPage = <<<REVIEWS
        <div class="no-applicants"> 
            <div class="applicants-message">
                <h2>No Applicants</h2>
                <p>There are currently no applications to join us</p>
                <br>
            </div>
        </div>

REVIEWS;
    }else{

    foreach ( $reviews as $reviewItem ) {  

        $reviewBox .= "<div class='job-box'>";
        

        foreach ( $reviewItem as $key => $value ) {
            switch ($key) {
                case 'review':
                    $reviewBox .= "$value</h2><br><br>";
                    break;
                case 'customer_name':
                    $reviewBox .= "<h2><b> - </b>$value";
                    break;
                
            }
            
        }

        $reviewBox .= "</div>";
        
    }
    $reviewPage = <<<REVIEWS
                   $reviewBox
    
REVIEWS;
    }

return $reviewPage;
}

//Function that allows the user to submit a review to the database
//@author - Rachel Johnson

function newReview($name, $review){
    
    try{
        $dbConn = getDatabase();

        //Inserting new review
        $insert_stmt = $dbConn->prepare("INSERT INTO hd_reviews(customer_name, review) 
                                            VALUES(:cname, :creview)
                                        ");

        $insert_stmt->bindParam(":cname", $name);
        $insert_stmt->bindParam(":creview", $review);

        $insert_stmt->execute();

    }catch (Exception $e) {
        echo "There was a problem: " . $e->getMessage();
        
    }
}




?>