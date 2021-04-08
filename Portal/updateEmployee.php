<?php
 ini_set("session.save_path", "/home/unn_w17005084/sessionData"); //location of session data file, 
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
$staff_id = filter_has_var(INPUT_GET, 'staff_id') ? $_GET['staff_id'] : null;
$staff_first_name = filter_has_var(INPUT_GET, 'staff_first_name') ? $_GET['staff_first_name'] : null; 
$staff_last_name = filter_has_var(INPUT_GET, 'staff_last_name') ? $_GET['staff_last_name'] : null;
$staff_email = filter_has_var(INPUT_GET, 'staff_email') ? $_GET['staff_email'] : null;
$staff_password  = filter_has_var(INPUT_GET, 'staff_password') ? $_GET['staff_password'] : null;
$staff_address = filter_has_var(INPUT_GET, 'staff_address') ? $_GET['staff_address'] : null;
$staff_postcode = filter_has_var(INPUT_GET, 'staff_postcode') ? $_GET['staff_postcode'] : null;
$pay_id = filter_has_var(INPUT_GET, 'pay_id') ? $_GET['pay_id'] : null;

//validate inputs
$staff_first_name = trim($staff_first_name);
$staff_last_name = trim($staff_last_name);
$staff_email = trim($staff_email);
$staff_password = password_hash($staff_password);
$staff_address = trim($staff_address);
$staff_postcode = trim($staff_postcode);


        //Connects to database
        $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
        //SQL update statement to update the content of the database with the changes the user just made
		$query  = $myPDO->query("UPDATE hd_staff_users 
                    SET staff_first_name = '$staff_first_name', staff_last_name = '$staff_last_name',staff_email = '$staff_email',
                    staff_password = '$staff_password', staff_address = '$staff_address',staff_postcode = '$staff_postcode',pay_id ='$pay_id'
                    WHERE staff_id = '$staff_id'");
        
        header("Location: viewEmployees.php");
        die();

?>
</body>
</html>