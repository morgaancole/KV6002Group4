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
$pay_id = filter_has_var(INPUT_GET, 'pay_id') ? $_GET['pay_id'] : null;
$pay_desc = filter_has_var(INPUT_GET, 'pay_desc') ? $_GET['pay_desc'] : null; 
$hourly_rate = filter_has_var(INPUT_GET, 'hourly_rate') ? $_GET['hourly_rate'] : null;



        //Connects to database
        $myPDO  = getDatabase(); 
        //SQL update statement to update the content of the database with the changes the user just made
		$query  = $myPDO->query("UPDATE hd_pay_categories 
                    SET pay_desc = '$pay_desc', hourly_rate = '$hourly_rate'
                    WHERE pay_id = '$pay_id'");

header("Location:position.php");

die();
        
?>
<?php 
        echo createPageClose(); 
?>