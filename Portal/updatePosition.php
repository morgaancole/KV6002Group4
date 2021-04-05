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
?>

<?php
//using the $_GET the correct values from the selected event can be accessed and they are stored with variables
$pay_id = filter_has_var(INPUT_GET, 'pay_id') ? $_GET['pay_id'] : null;
$pay_desc = filter_has_var(INPUT_GET, 'pay_desc') ? $_GET['pay_desc'] : null; 
$hourly_rate = filter_has_var(INPUT_GET, 'hourly_rate') ? $_GET['hourly_rate'] : null;



$errors = false;

//Variables are trimmed to get rid of white space at the start or the end
$pay_desc = trim($pay_desc);
$hourly_rate = trim($hourly_rate);


        //Connects to database
        $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
        //SQL update statement to update the content of the database with the changes the user just made
		$query  = $myPDO->query("UPDATE hd_pay_categories 
                    SET pay_desc = '$pay_desc', hourly_rate = '$hourly_rate'
                    WHERE pay_id = '$pay_id'");
        
        header("Location:position.php");
        die();

?>
</body>
</html>