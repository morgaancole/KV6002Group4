<?php
/*
*PHP Functions file to be used throughout  project - includes page-building functions & client-side communications
*Protected by .htaccess to protect functionality which communicates with client side
*/
function getDatabase(){
    try{
        $dir = 'sqlite:../DB/hendersonDB.sqlite';
        $dbConnection  = new PDO($dir) or die("cannot open the database");   
    }catch (Exception $e) {
        echo "There was a problem: " . $e->getMessage();
    }


    return $dbConnection;
}

//function that gets a session from session array
function getSession($key){
	$returnValue = "";
	if(isset($_SESSION[$key])){
		$returnValue = $_SESSION[$key];
	}
	return $returnValue;
}

//uses getSession function to check if user success logged in
function checkLogin(){
	if (getSession('logged-in') == true){
		return true;
	}
	else{
		return false;
	}
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

/*Function to create navbar for admin users*/
function adminNav(){
    $nav = <<<NAV
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar">
        <div class="sidebar-header">
            <h3 class="brand">
                <span>Henderson</span>
            </h3>
            <label for="sidebar-toggle" class="ti-menu-alt"></label>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="adminDashboard.php">
                        <span class="ti-home"></span>
                        <span>Home</span>
                    </a>
                </li>

                <li>
                    <a href="payroll.php">
                        <span class="ti-time"></span>
                        <span>Payroll</span>
                    </a>
                </li>

                <li>
                    <a href="position.php">
                        <span class="ti-settings"></span>
                        <span>Positions</span>
                    </a>
                </li>

                <li>
                    <a href="vehicleLogs.php">
                        <span class="ti-settings"></span>
                        <span>View Vehichle Logs</span>
                    </a>
                </li>

                <li>
                    <a href="viewEmployees.php">
                        <span class="ti-settings"></span>
                        <span>View Employees</span>
                    </a>
                </li>

                <li>
                    <a href="viewVacancies.php">
                        <span class="ti-files"></span>
                        <span>View Vacancies</span>
                    </a>
                </li>

                <li>
                    <a href="viewApplicants.php">
                        <span class="ti-user"></span>
                        <span>View Applicants</span>
                    </a>
                </li>

                <li>
                    <a href="logout.php">
                        <span class="ti-share"></span>
                        <span>Log Out</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>

NAV;

    $nav .= "\n";

    return $nav;
}

/*Function to get applicants from database and display them on admin page
*@author - Morgan Wheatman
*/
function getApplicants(){

    $dbConn = getDatabase();

    $select_stmt = $dbConn->prepare("SELECT 
                                        hd_job_applicants.applicant_fname AS 'FirstName', 
                                        hd_job_applicants.applicant_lname AS 'LastName', 
                                        hd_job_applicants.applicant_email AS 'Email', 
                                        hd_job_applicants.applicant_contact AS 'Contact', 
                                        hd_job_vacancies.job_title AS 'Job',
                                        hd_job_applicants.applicant_cv AS 'CV',
                                        hd_job_applicants.applicant_id AS 'ID' 
                                        FROM hd_job_applicants
                                        INNER JOIN hd_job_vacancies on (hd_job_applicants.job_id = hd_job_vacancies.job_id)
                                    ");

    $select_stmt->execute();

    //Array for results
    $applicants = array();
    if ($select_stmt->execute()) {
        while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
            $applicants[] = $row;
        }
    }

    $applicantBox = "";

    //Checks if there are any applicants before displaying page
    if(empty($applicants)){
        $applicantPage = <<<JOBS
        <div class="no-applicants"> 
            <div class="applicants-message">
                <h2>No Applicants</h2>
                <p>There are currently no applications to join us</p>
                <br>
            </div>
        </div>

JOBS;
    }else{

    //Looping through multidimensional array to display results
    foreach ( $applicants as $jobItem ) {  

        $applicantBox .= "<div class='applicant-box'>";
        

        foreach ( $jobItem as $key => $value ) {
            switch ($key) {
                case 'FirstName':
                    $applicantBox .= "<h2><b>Name: </b>$value";
                    break;
                case 'LastName':
                    $applicantBox .= " $value</h2><br>";
                    break;
                case 'Email':
                    $applicantBox .= "<p><b>Email:</b> $value</p><br>";
                    break;
                case 'Contact':
                    $applicantBox .= "<p><b>Contact number:</b> (+44)$value</p><br>";
                    break;
                case 'Job':
                    $applicantBox .= "<p><b>Applying For: </b>$value</p><br>";
                    break;
                case 'CV':
                    $applicantBox .= "<form action='$value'><input type='submit' value='View CV' /></form>";
                    break;
                case 'ID':
                    $applicantBox .= "<form action='applicantResponse.php' method='post'>";
                    $applicantBox .= "<input type='text' style='display: none' id='applicant_id' name='applicant_id' value='$value'>";
                    $applicantBox .= "<input type='submit' name='btn_accept' id='accept' value='Accept Application' />";
                    $applicantBox .= "<input type='submit' name='btn_reject' id='reject' value='Reject Application' /></form>";
                    break;
            }
            
        }

        $applicantBox .= "</div>";
        
    }
    $applicantPage = <<<JOBS
                   $applicantBox
    
JOBS;
    }

return $applicantPage;

}

/*Function to respond to an application appropriately
*Takes response as a parameter to determine which email to send
*@author - Morgan Wheatman
*/
function applicantResponse($response, $applicantId){

    try{
        $dbConn = getDatabase();

        //Getting user data from database to send them an email
        $select_stmt = $dbConn->prepare("SELECT applicant_fname, applicant_email, applicant_cv FROM hd_job_applicants WHERE applicant_id = :aid");
        $select_stmt->bindParam(":aid", $applicantId);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        $firstName = $row['applicant_fname'];
        $email = $row['applicant_email'];

        //Getting CV link from database and splitting string to delete it from uploads folder
        $cvLink = $row['applicant_cv']; 

        $targetPath = "../frontend/uploads/";

        $linkParts = explode("uploads/", $cvLink);

        $cvFileName = $linkParts[1];

        $targetPath .= $cvFileName;

        //Checking response from admin and sending appropriate email
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

        
        //Using unlink() function to delete applicant's CV from uploads folder
        if (!unlink($targetPath)) { 
            $errors[] = "CV couldn't be deleted";
        } 
        else { 
            return true;
        } 


    }catch (Exception $e) {
        echo "There was a problem: " . $e->getMessage();
        
    }

}

/*Function to get vacancies from database and display appropriate output
*Displays message if there are no vacancies
*@author - Morgan Wheatman
*/
function getVacancies(){
    $dbConn = getDatabase();

    $select_stmt = $dbConn->prepare("SELECT 
                                        job_title AS 'Title', 
                                        job_wage AS 'Wage', 
                                        job_desc AS 'Description', 
                                        job_requirements AS 'Requirements', 
                                        job_close_date AS 'Close',
                                        job_id AS 'ID' 
                                    FROM hd_job_vacancies
                                    ");

    $select_stmt->execute();

    //Array for results
    $vacancies = array();
    if ($select_stmt->execute()) {
        while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
            $vacancies[] = $row;
        }
    }

    //New vacancy form which will be hidden unless toggled by admin
    $vacancyPage = <<<VACANCIES
        <div class="vacancy-form" id="vacancy">

            <button type="submit" id="show">Create Job</button>

            <div id ="vac-form">
            <form id="new-vacancy" action="newVacancy.php" method="post">
                <input 
                    name="title" type="text" required id="title" 
                    placeholder="Title" pattern="[a-zA-Z0-9\s]+" title="Only alphaneumerics are allowed" 
                    autocomplete="first-name" size="20" maxlength="40"
                ><br>
                <input 
                    name="wage" type="text" required id="wage" 
                    placeholder="Wage (Hourly)" pattern="[0-9]+" title="Only numbers are allowed" 
                    autocomplete="wage" size="20" maxlength="10"
                ><br>
                <textarea type="text" name="description" id="description" placeholder="Description of role" minlength="1" required title="description"></textarea><br>

                <textarea type="text" name="requirements" id="requirements" placeholder="Requirements" minlength="1" required title="requirements"></textarea><br>

                <input 
                    type="text" 
                    name="close" 
                    placeholder="Close Date DD/MM/YYYY"
                    pattern="(^(((0[1-9]|1[0-9]|2[0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)">         

                <button name="btn_create_vacancy" type="submit" id="create-vacancy">Create Job</button>
            </form>
            </div>
        </div>

VACANCIES;
    $vacancyBox = "";

    //Checks if there are any applicants before displaying page
    if(empty($vacancies)){
        $vacancyPage .= <<<JOBS
        <div class="no-applicants"> 
            <div class="applicants-message">
                <h2>No Vacancies</h2>
                <p>There are vacancies</p>
                <p>Create a vacancy using the above button</p>
                <br>
            </div>
        </div>

JOBS;
    }else{
        //Looping through multidimensional array to display results
        foreach ( $vacancies as $jobItem ) {  

            $vacancyBox .= "<div class='vacancy-box'>";

            foreach ( $jobItem as $key => $value ) {
                //Switch statement to create hashtable of keys
                switch ($key) {
                    case 'Title':
                        $vacancyBox .= "<h2><b>$value</b></h2>";
                        break;
                    case 'Wage':
                        $vacancyBox .= "<p><b>Wage(Hourly)</b> : £$value.00</p><br>";
                        break;
                    case 'Description':
                        $vacancyBox .= "<p>$value</p><br>";
                        break;
                    case 'Requirements':
                        $vacancyBox .= "<p><b>Requirements: </b>$value</p><br>";
                        break;
                    case 'Close':
                        $vacancyBox .= "<p><b>Applications Close: </b>$value</p><br>";
                        break;
                    case 'ID':
                        $vacancyBox .= "<form action='closeVacancy.php' method='post'>";
                        $vacancyBox .= "<input type='text' style='display: none' id='job_id' name='job_id' value='$value'>";
                        $vacancyBox .= "<input type='submit' name='btn_close_vacancy' id='close' value='Close Vacancy' /></form>";
                        break;
                }
                
            }

            $vacancyBox .= "</div>";       
        }
        $vacancyPage .= $vacancyBox;

    }

return $vacancyPage;

}

/*Function to close a vacancy/remove from database on admin request
*@author - Morgan Wheatman
*/
function closeVacancy($jobId){
    try{
        $dbConn = getDatabase();

        $select_stmt = $dbConn->prepare("SELECT * FROM hd_job_applicants WHERE job_id = :job_id");
        $select_stmt->bindParam(":job_id", $jobId);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        if($row){
            $applicantMessage = <<<APPLICANTS
            <link rel="stylesheet" href="styles.css">
            <div class="main-content">
                <main>
                    <tbody>
                        <h1 class="mtitle">Can't Delete</h1>
                        <div class="vacancy-page">
                            <div class="no-applicants"> 
                                <div class="applicants-message">
                                    <h2>There are still applicants for this role</h2>
                                    <p><a href='viewApplicants.php'>Respond to all applications before closing</a></p>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </tdbody>
                </main>
            </div>
    
APPLICANTS;
            echo adminNav();
            echo $applicantMessage;
        }else{
            //Removing vacancies from database
            $delete_stmt = $dbConn->prepare("DELETE FROM hd_job_vacancies WHERE job_id = :jid");
            $delete_stmt->bindParam(":jid", $jobId);
            $delete_stmt->execute();

            header('Location: viewVacancies.php');
        }

    }catch (Exception $e) {
        echo "There was a problem: " . $e->getMessage();
        
    }

}

/*Function to create a new vacancy and add it to database
*Takes user input as arguments to store
*@author - Morgan Wheatman
*/
function newVacancy($jobTitle, $wage, $description, $requirements, $closeDate){
    try{
        $dbConn = getDatabase();

        //Inserting new vacancy
        $insert_stmt = $dbConn->prepare("INSERT INTO hd_job_vacancies(job_title, job_wage, job_desc, job_requirements, job_close_date) 
                                            VALUES(:jtitle, :jwage, :jdesc, :jreq, :jcdate)
                                        ");

        $insert_stmt->bindParam(":jtitle", $jobTitle);
        $insert_stmt->bindParam(":jwage", $wage);
        $insert_stmt->bindParam(":jdesc", $description);
        $insert_stmt->bindParam(":jreq", $requirements);
        $insert_stmt->bindParam(":jcdate", $closeDate);
        $insert_stmt->execute();

    }catch (Exception $e) {
        echo "There was a problem: " . $e->getMessage();
        
    }
}

?>

