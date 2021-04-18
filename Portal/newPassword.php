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

/**Hashes new password and puts it into the database*/

$staff_id = filter_has_var(INPUT_GET, 'staff_id') ? $_GET['staff_id'] : null;
$staff_password = filter_has_var(INPUT_GET, 'staff_password') ? $_GET['staff_password'] : null;

$staff_password = password_hash($staff_password, PASSWORD_DEFAULT);

$myPDO  = getDatabase(); 


$query  = $myPDO->query("UPDATE hd_staff_users 
                    SET staff_password  = '$staff_password'
                    WHERE staff_id = '$staff_id'");
        
        //redirect to the employees page
        header("Location:viewEmployees.php");

        die();
                
?>
<?php 
    echo createPageClose(); 
?>

