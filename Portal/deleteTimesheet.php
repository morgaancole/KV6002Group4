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
$timesheet_id = filter_has_var(INPUT_GET, 'timesheetID') ? $_GET['timesheetID'] : null; 


$errors = false;


        //Connects to database
        $myPDO  = getDatabase(); 
        //SQL update statement to update the content of the database with the changes the user just made
		$query  = $myPDO->query("DELETE  
                    FROM hd_payslips
                    WHERE timesheet_id = '$timesheet_id'");
        
        header("Location: payroll.php");
        die();

?>
<?php 
        echo createPageClose(); 
?>