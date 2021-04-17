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

    }echo makePageStart("Create Position");
echo createPageBody();
echo adminNav(); 
?>

<!--@author Nicholas Coyles -->


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
echo"
    <form action='createPosition.php' method='post' enctype='multipart/form-data'>
    <div class='box-header with-border'>
    <a href='position.php'><i class='fa fa-plus'></i>Back</a>
   </div>
            
            <h2>New Position</h2>
            
            
            <div class='inputsInner'>
            <label for='pay_desc'>Position Name</label>
            <input type='text' id='pay_desc' name='pay_desc'pattern='[A-Za-z]{1,20}' placeholder='Plumber' maxlength='30' required/>
            </div>
            <div class='inputsInner'>
            <label for='hourly_rate'>Hourly Rate</label>
            <input type='number' id='hourly_rate'name='hourly_rate' min='7' max='100' placeholder='10.00' required/>
            </div>

            <div class='inputsInner'>
            <input type='submit' name='insert_position' value='Submit'>
            </div>
    </form>";
    ?>

    
    </main>
</div>
<?php 
        echo createPageClose(); 
?>
        

<?php

$myPDO  = getDatabase(); 

if(isset($_POST['insert_position'])){

$pay_desc = $_POST['pay_desc'];
$hourly_rate = $_POST['hourly_rate'];

//Validate inputs
//Variables are sanitized
$pay_desc = sanitizeInput($pay_desc);
$pay_desc = strtolower($pay_desc);
$pay_desc = ucfirst($pay_desc);


/**Duplicate position check */
$check_positions  = $myPDO->query("SELECT pay_desc
FROM hd_pay_categories
WHERE pay_desc ='$pay_desc'");

$duplicatePosition = false;

while($row= $check_positions->fetch(PDO::FETCH_ASSOC)){

if($row['pay_desc'] == $pay_desc){
    $duplicatePosition = true; 
    echo '<script type="text/javascript">',
    'alert("Not created, duplicate position");',
    '</script>'
;
}
}
if($duplicatePosition == false){
    $query  = $myPDO->query("INSERT INTO hd_pay_categories(pay_desc,hourly_rate) VALUES('$pay_desc','$hourly_rate')");
    
    echo '<script type="text/javascript">',
    'alert("Position Created");',
    '</script>'
;



}







}

?>