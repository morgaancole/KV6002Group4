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
$deduction_id = filter_has_var(INPUT_GET, 'deduction_id') ? $_GET['deduction_id'] : null;
$deduction_name = filter_has_var(INPUT_GET, 'deduction_name') ? $_GET['deduction_name'] : null; 
$deduction_amount = filter_has_var(INPUT_GET, 'deduction_amount') ? $_GET['deduction_amount'] : null;

//Variables are trimmed to get rid of white space at the start or the end
$deduction_name = trim($deduction_name);
$deduction_amount = trim($deduction_amount);


        //Connects to database
        $myPDO  = getDatabase(); 
        //SQL update statement to update the content of the database with the changes the user just made
		$query  = $myPDO->query("UPDATE hd_deductions 
                    SET deduction_name = '$deduction_name', deduction_amount = '$deduction_amount'
                    WHERE deduction_id = '$deduction_id'");
        
        header("Location:deductions.php");
        die();

?>
<?php 
        echo createPageClose(); 
?>