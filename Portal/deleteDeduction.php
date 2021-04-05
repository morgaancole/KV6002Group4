<?php
 ini_set("session.save_path", "/home/unn_w19042409/sessionData");
 session_start(); 
 require_once("inc/functions.php");

//Session data path needs to change for demo

/*
*Page for admin users to view applications sent in from frontend
*@author - Morgan Wheatman
*/
    require_once("inc/functions.php");

    //Checking if user is logged in & their admin level
    //Redirects user to staff dash if they are not admin
    if(checkLogin()){

        if($_SESSION['adminLevel'] != '1'){
            header('Location: dash.php');
        }
        
    }else{//Redirecting user if they're not logged in
        header('Location: ../frontend/loginForm.php');

    }
    echo makePageStart("Henderson Building Contractors"); 
    echo  createPageBody();
    echo adminNav(); 
?>

<?php
//using the $_GET the correct values from the selected event can be accessed and they are stored with variables
$deduction_id = filter_has_var(INPUT_GET, 'deductionID') ? $_GET['deductionID'] : null; 


$errors = false;


        //Connects to database
        $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
        //SQL update statement to update the content of the database with the changes the user just made
		$query  = $myPDO->query("DELETE  
                    FROM hd_deductions
                    WHERE deduction_id = '$deduction_id'");
        
        header("Location: deductions.php");
        die();

?>
    <?php 
        echo createPageClose(); 
?>