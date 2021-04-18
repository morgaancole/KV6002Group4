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
/**Removes selected employee from the database */
$staff_id = filter_has_var(INPUT_GET, 'staffID') ? $_GET['staffID'] : null; 

        //Connects to database
        $myPDO  = getDatabase(); 
		$query  = $myPDO->query("DELETE  
                    FROM hd_staff_users
                    WHERE staff_id = '$staff_id'");
        //Redirect to employees page
require_once "inc/functions.php";
        echo makePageStart("Employees");
        echo createPageBody();
    
        $success = <<<UPLOADED
    
        <div class="upload_outer">
        <div class="upload_inner">
        <img class="upload_img" src="img/success.png" alt="success tick">
            <p>Employee successfully removed</p>
            <a href="viewEmployees.php"><button>Employees</button></a>
            </div>
        </div>
    
UPLOADED;
        $success .= "\n";
        echo $success;
        echo createPageClose();

?>
<?php 
        echo createPageClose(); 
?>