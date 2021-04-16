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
/**Removes selected deduction from the database */

$deduction_id = filter_has_var(INPUT_GET, 'deductionID') ? $_GET['deductionID'] : null; 

$errors = false;


        //Connects to database
        $myPDO  = getDatabase();
		$query  = $myPDO->query("DELETE  
                    FROM hd_deductions
                    WHERE deduction_id = '$deduction_id'");
        //Redirect to deductions page
        header("Location: deductions.php");
        die();

?>
    <?php 
        echo createPageClose(); 
?>