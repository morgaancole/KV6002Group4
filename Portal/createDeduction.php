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
echo makePageStart("Create Deduction");
echo createPageBody();
echo adminNav(); 
?>
<!--@author Nicholas Coyles Create deduction page-->



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
    <div class='box-header with-border'>
    <a href='deductions.php'><i class='fa fa-plus'></i>Back</a>
   </div>
                <h2>Create Deduction</h2>
           
            
                <div class='inputsInner'>
                <label for='deduction_name'>Deduction</label>
                <input type='text' id='deduction_name'name='deduction_name' pattern='[A-Za-z0-9]{1,20}' maxlength='200' placeholder='Tax' required/>
                </div>
                <div class='inputsInner'>
                <label for='deduction_amount'>Deduction Amount</label>
                <input type='number' id='deduction_amount' name='deduction_amount' min='1' max='100' placeholder='10.00' required/>
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

/* 
* Sanitizes input, checks for duplicate entry, submits to database
*/
if(isset($_POST['insert_deduction'])){

$deduction_name = $_POST['deduction_name'];
$deduction_amount = $_POST['deduction_amount'];

//Trimming inputs from user
$deduction_name = sanitizeInput($deduction_name);


/**Duplicate deduction check */
$check_deductions  = $myPDO->query("SELECT deduction_name
FROM hd_deductions
WHERE deduction_name ='$deduction_name'");

$duplicateDeduction = false;

while($row= $check_deductions->fetch(PDO::FETCH_ASSOC)){

/* 
* Pop up on screen if a duplicate entry
*/    
if($row['deduction_name'] == $deduction_name){
    $duplicateDeduction = true; 
    echo '<script type="text/javascript">',
    'alert("Not created, duplicate deduction");',
    '</script>'
;
}
}
if($duplicateDeduction == false){
/* 
* Submits to database if a new entry
*/
    $query  = $myPDO->query("INSERT INTO hd_deductions(deduction_name,deduction_amount) VALUES('$deduction_name','$deduction_amount')");
    

    echo '<script type="text/javascript">',
    'alert("Deduction Created");',
    '</script>'
;



}






}

?>

