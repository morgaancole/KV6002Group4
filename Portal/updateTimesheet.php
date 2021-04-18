<?php
require_once "inc/functions.php";
ini_set("session.save_path", "/home/unn_w17005084/sessionData"); //location of session data file, 
session_start();
    //Checking if user is logged in & their admin level
    //Redirects user to staff dash if they are not admin
    if(checkLogin()){

        if($_SESSION['adminLevel'] != '1'){
            header('Location: dash.php');
        }
        
    }else{//Redirecting user if they're not logged in
        header('Location: ../frontend/loginForm.php');

    }echo makePageStart("");
echo createPageBody();
echo adminNav(); 
?>
<!--@author Nicholas Coyles -->

<?php
$timesheet_id = filter_has_var(INPUT_GET, 'timesheet_id') ? $_GET['timesheet_id'] : null;
$id = filter_has_var(INPUT_GET, 'id') ? $_GET['id'] : null;
$day = filter_has_var(INPUT_GET, 'day') ? $_GET['day'] : null; 
$month = filter_has_var(INPUT_GET, 'month') ? $_GET['month'] : null;
$year = filter_has_var(INPUT_GET, 'year') ? $_GET['year'] : null; 
$location = filter_has_var(INPUT_GET, 'location') ? $_GET['location'] : null; 
$hours = filter_has_var(INPUT_GET, 'hours') ? $_GET['hours'] : null; 
$hoursOvertime = filter_has_var(INPUT_GET, 'hoursOvertime') ? $_GET['hoursOvertime'] : null; 
$desc = filter_has_var(INPUT_GET, 'desc') ? $_GET['desc'] : null; 
$process_id = filter_has_var(INPUT_GET, 'process_id') ? $_GET['process_id'] : null; 
$payslip_id = filter_has_var(INPUT_GET, 'payslip_id') ? $_GET['payslip_id'] : null; 

//Variables are sanitized
$location = sanitizeInput($location);
$desc = sanitizeInput($desc);



$date = $day . "/" . $month . "/" . $year;


        //Connects to database
        $myPDO  = getDatabase();
        //updates the timesheet
        $query  = $myPDO->query("UPDATE hd_timesheet_responses 
        SET Date = '$date', location = '$location', hours_worked = '$hours',jobs_completed_desc = '$desc', overtime_worked = '$hoursOvertime'
        WHERE timesheet_id = '$timesheet_id'");
        
        //updates the status
        $query2  = $myPDO->query("UPDATE hd_payslips
        SET process_id = '$process_id'
        WHERE payslip_id = '$payslip_id'");
        
        //updates the payslip
        $query3 = $myPDO->query("UPDATE hd_payslips
        SET hours_worked = '$hours', overtime_worked = '$hoursOvertime'
        WHERE timesheet_id = '$timesheet_id'");

//If all successfull
if($query && $query2 &&  $query3) {
    //email employee that timesheet was approved
    if($payslip_id = 1){

    $myPDO  = getDatabase();
    $query4 = $myPDO->query("SELECT staff_email
    FROM hd_staff_users
    WHERE staff_id = '$id'");
    
    while($row= $query4->fetch(PDO::FETCH_ASSOC)){
    $staff_email = $row['staff_email'];
    $msg = "Your timesheet has been approved";
    $subject = "Your payslip";
    $headers = "From Hendersons, check staff portal";
    mail($staff_email,$subject,$msg, $headers);
    }

    }
    //email employee that timesheet was rejected
    if($payslip_id = 3){
  
    $myPDO  = getDatabase();
    $query5 = $myPDO->query("SELECT staff_email
    FROM hd_staff_users
    WHERE staff_id = '$id'");
    
    while($row= $query5->fetch(PDO::FETCH_ASSOC)){
    $staff_email = $row['staff_email'];
    $msg = "Your timesheet has been rejected";
    $subject = "Your payslip";
    $headers = "From Hendersons, check staff portal";
    mail($staff_email,$subject,$msg, $headers);
    }

    }


    require_once "inc/functions.php";
    echo makePageStart("Timesheet");
    echo createPageBody();

    $success = <<<UPLOADED

    <div class="upload_outer">
    <div class="upload_inner">
    <img class="upload_img" src="img/success.png" alt="success tick">
        <p>Timesheet successfully updated</p>
        <a href="payroll.php"><button>Payroll</button></a>
        </div>
    </div>

UPLOADED;
    $success .= "\n";
    echo $success;
    echo createPageClose();
} else {
    require_once "inc/functions.php";

    $success = <<<UPLOADED

    <div class="upload_outer">
    <div class="upload_inner">
    <img class="upload_img" src="img/failure.png" alt="failure tick">
        <p>Sorry, there was an error please try again.</p>
        <a href="payroll.php"><button>Payroll</a></button>
        </div>
    </div>

UPLOADED;
    $success .= "\n";
    echo $success;
    echo createPageClose();
}

?>
<?php 
        echo createPageClose(); 
?>