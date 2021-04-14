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

    }echo makePageStart("Vehicle Logs");
echo createPageBody();
echo adminNav(); 
?>

<?php
//using the $_GET the correct values from the selected event can be accessed and they are stored with variables
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


$date = $day . "/" . $month . "/" . $year;


        //Connects to database
        $myPDO  = getDatabase();
        //SQL update statement to update the content of the database with the changes the user just made
		$query  = $myPDO->query("UPDATE hd_timesheet_responses 
        SET Date = '$date', location = '$location', hours_worked = '$hours',jobs_completed_desc = '$desc', overtime_worked = '$hoursOvertime'
        WHERE timesheet_id = '$timesheet_id'");
        
        $query2  = $myPDO->query("UPDATE hd_payslips
        SET process_id = '$process_id'
        WHERE payslip_id = '$payslip_id'");
        
        
        $query3 = $myPDO->query("UPDATE hd_payslips
        SET hours_worked = '$hours', overtime_worked = '$hoursOvertime'
        WHERE timesheet_id = '$timesheet_id'");


if($query && $query2 &&  $query3) {
    require_once "inc/functions.php";
    echo makePageStart("Timesheet");
    echo createPageBody();

    if($payslip_id = 1){
    
    $to      = '';
    $subject = 'Timesheet Approved';
    $message = 'Hello, your timesheet has been approved';
    $headers = 'From: webmaster@example.com'       . "\r\n" .
                 'Reply-To: webmaster@example.com' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
    }


    $success = <<<UPLOADED

    <div class="success_outer">
    <div class="success_inner">
    <img class="success_img" src="img/success.png" alt="success tick">
        <p>Payslip Updated</p>
        <a href="payroll.php"><button>Back to Payroll</a></button>
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