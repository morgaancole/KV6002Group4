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
$pay_id = filter_has_var(INPUT_GET, 'pay_id') ? $_GET['pay_id'] : null;
$pay_desc = filter_has_var(INPUT_GET, 'pay_desc') ? $_GET['pay_desc'] : null; 
$hourly_rate = filter_has_var(INPUT_GET, 'hourly_rate') ? $_GET['hourly_rate'] : null;

//Variables are sanitized
$pay_desc = sanitizeInput($pay_desc);

        //Connects to database
        $myPDO  = getDatabase(); 
        //updates position
        $query  = $myPDO->query("UPDATE hd_pay_categories 
                    SET pay_desc = '$pay_desc', hourly_rate = '$hourly_rate'
                    WHERE pay_id = '$pay_id'");
//redirect to positions page
header("Location:position.php");
die();
        
?>
<?php 
        echo createPageClose(); 
?>