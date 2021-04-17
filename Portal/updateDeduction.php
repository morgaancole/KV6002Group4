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
$deduction_id = filter_has_var(INPUT_GET, 'deduction_id') ? $_GET['deduction_id'] : null;
$deduction_name = filter_has_var(INPUT_GET, 'deduction_name') ? $_GET['deduction_name'] : null; 
$deduction_amount = filter_has_var(INPUT_GET, 'deduction_amount') ? $_GET['deduction_amount'] : null;

//Variables are sanitized
$deduction_name = sanitizeInput($deduction_name);
$deduction_name = strtolower($deduction_name);
$deduction_name = ucfirst($deduction_name);

        //Connects to database
        $myPDO  = getDatabase(); 
        //update deduction
		$query  = $myPDO->query("UPDATE hd_deductions 
                    SET deduction_name = '$deduction_name', deduction_amount = '$deduction_amount'
                    WHERE deduction_id = '$deduction_id'");
        
        //redirect to deductions page
        require_once "inc/functions.php";
        echo makePageStart("Timesheet");
        echo createPageBody();
    
        $success = <<<UPLOADED
    
        <div class="upload_outer">
        <div class="upload_inner">
        <img class="upload_img" src="img/success.png" alt="success tick">
            <p>Deduction successfully updated</p>
            <a href="deductions.php"><button>Deductions</button></a>
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