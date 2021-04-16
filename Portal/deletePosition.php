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
<!--@author Nicholas Coyles -->

<?php
/**Removes selected position from the database */

$pay_id = filter_has_var(INPUT_GET, 'payID') ? $_GET['payID'] : null;

        //Connects to database
        $myPDO  = getDatabase();  
		$query  = $myPDO->query("DELETE  
                    FROM hd_pay_categories
                    WHERE pay_id = '$pay_id'");
        //Redirect to positions page
        header("Location: position.php");
        die();

?>
<?php 
        echo createPageClose(); 
?>