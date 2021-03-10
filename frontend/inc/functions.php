<?php


function getDatabase(){
    $dir = 'sqlite:../DB/hendersonDB.sqlite';
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
                <li><a href="loginForm.php">Staff Login</a></li>
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
                $jobBox .= "<h2>$key : £$value.00</h2>";
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
    //$jobInfo = getJobs($jobId);

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
        <form id="contact" action="apply.php" method="post">
            
        <input style='display:none;' name='ID' type='text' readonly value ='$jobId'>
            <div>
                <h3>$jobTitle</h3>
            </div>
            <h2>£$jobWage.00 an hour</h2>
            <br>
            <h2>$jobDesc</h2>
            <br>
            <h2>Requirements: $jobReq</h2>
            <br>
            <h2>Applications close: $jobClose</h2>
            <fieldset>
                <button name="btn_apply_here" type="submit" id="apply-here">Apply Here</button>
            </fieldset>
        </form>  
        </div>
            
    </body>

JOB;

    $jobInfo .="\n";
    return $jobInfo;

}

function makeJobForm($jobId){
    $dbConn = getDatabase();
    $select_stmt = $dbConn->prepare("SELECT * FROM hd_job_vacancies WHERE job_id = :jobId");
    $select_stmt->bindParam(":jobId", $jobId);
    $select_stmt->execute();

    $job = $select_stmt->fetch(PDO::FETCH_ASSOC);

    $jobTitle = $job['job_title'];
    
    $jobForm = <<<FORM
        <body>
        <h3 class="title"></h3>

        <div class="container">  
        <form id="contact" action="sendApplication.php" method="post" enctype="multipart/form-data">
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
        <fieldset>
            <button name="btn_app_send" type="submit" id="contact-submit" data-submit="...Sending">Send now</button>
        </fieldset>
        </form>  
    </div>

    </body>

FORM;

    $jobForm .="\n";
    return $jobForm;

}

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
            
            $insert_stmt->execute();   


        }catch (Exception $e) {
            echo "There was a problem: " . $e->getMessage();
            
        }	
        
        if($insert_stmt->execute()){
            echo applicationSubmitted('sent');

            //Creating variables to use in sending emails
            $send = "Hi " . $firstName . "\nThanks for your application!\n\nHenderson Contractors will be in touch as soon as possible!\n";

            $headers = "From: applications@hendersonbuilding.co.uk";

            $subject = "Thanks for applying to join us";

            //Sending to user	
            mail($email, $subject ,$send, $headers);

            $subject = "New Applicant for role: " . $role;

            $message = "There has been a new applicant for the role of " . $role . "\n";
            $message .= "You can view their CV on our datase";

            //Sending to developer
            mail("morgan.wheatman@northumbria.ac.uk",$subject ,$message, $headers);
        }else{
            echo applicationSubmitted('failure');
        }

}

function applicationSubmitted($result){
    if($result === 'sent'){
        $bodyContent = <<<BODY
        <body>
        <h3 class="title">Thanks</h3>
          <div class="container">  
                <h2>Thanks for your application!</h2>
                <p>Your application has been received and we will be in touch when we have more information</p>
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

?>