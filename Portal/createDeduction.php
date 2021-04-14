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

    }
echo makePageStart("Vehicle Logs");
echo createPageBody();
echo adminNav(); 
?>



<div class="main-content">

    <header>
            <div class="search-wrapper">
                <span class="ti-search"></span>
                <input type="search" placeholder="Search">
            </div>

            <div class="social-icons">
                <span class="ti-bell"></span>
                <span class="ti-comment"></span>
                <div></div>
            </div>
    </header>
    <main>

    <?php
echo "
    <form action='createDeduction.php' method='post' enctype='multipart/form-data'>
    
                <h2>Create New Deduction</h2>
           
            
                <div class='inputsInner'>
                <label for='deduction_name'>Deduction</label>
                <input type='text' id='deduction_name'name='deduction_name' pattern='[A-Za-z]{20}' placeholder='Tax' required/>
                </div>
                <div class='inputsInner'>
                <label for='deduction_amount'>Deduction Amount</label>
                <input type='number' id='deduction_amount' name='deduction_amount' min='1' max='100' pattern='[0-9]+' placeholder='10.00' required/>
                </div>
                <div class='inputsInner'>
                <input type='submit' name='insert_deduction' value='Submit'>
                </div>
            
    </form>";?>

    
    </main>
</div>
<?php 
        echo createPageClose(); 
?>

<?php

$myPDO  = getDatabase();

if(isset($_POST['insert_deduction'])){

$deduction_name = $_POST['deduction_name'];
$deduction_amount = $_POST['deduction_amount'];

//Trimming inputs from user
$deduction_name = trim($deduction_name);
$deduction_amount =trim($deduction_amount);



$query  = $myPDO->query("INSERT INTO hd_deductions(deduction_name,deduction_amount) VALUES('$deduction_name','$deduction_amount')");
       
header("Location: deductions.php");
die();
}

?>

