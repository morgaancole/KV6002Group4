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
    
            
            <h2>Create New Position</h2>
            
            
            <div class='inputsInner'>
            <label for='pay_desc'>Position Name</label>
            <input type='text' id='pay_desc' name='pay_desc'pattern='[A-Za-z]{20}' placeholder='Plumber' required/>
            </div>
            <div class='inputsInner'>
            <label for='hourly_rate'>Hourly Rate</label>
            <input type='number' id='hourly_rate'name='hourly_rate' min='7.5' max='100' pattern='^\d{1,2}.\d{2}$' placeholder='12.50' required/>
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

$myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  

if(isset($_POST['insert_position'])){

$pay_desc = $_POST['pay_desc'];
$hourly_rate = $_POST['hourly_rate'];

//Validate inputs
$pay_desc = trim($pay_desc);
$hourly_rate = trim($name);


$query  = $myPDO->query("INSERT INTO hd_pay_categories(pay_desc,hourly_rate) VALUES('$pay_desc','$hourly_rate')");
       
header("Location: position.php");
die();
}

?>