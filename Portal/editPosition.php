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

    }echo makePageStart("Edit Position");
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
        /**Displays all details about selected position */
        $pay_id = filter_has_var(INPUT_GET, 'payID') ? $_GET['payID'] : null; 

        $myPDO  = getDatabase();
        $query  = $myPDO->prepare("SELECT *
        FROM hd_pay_categories
        WHERE pay_id = $pay_id");
        
        $result = $query->execute();

        if($result){
        while($row= $query->fetch(PDO::FETCH_ASSOC)){

echo "<div class='box-header with-border'>
<a href='positions.php'><i class='fa fa-plus'></i>Back</a>
</div>
		<h1>Update Position: '{$row['pay_desc']}' </h1>
		<form id='UpdatePosition' action='updatePosition.php' method='get'>
        <div class='inputsInner'>
        <label for='pay_id'>Pay ID</label>
		<input type='text' name='pay_id' id='pay_id' value='$pay_id' readonly />
        </div>
        <div class='inputsInner'>
        <label for='pay_desc'>Role</label>
		<input type='text' name='pay_desc' id='pay_desc' size='50' value='{$row['pay_desc']}' readonly/>
        </div>
        <div class='inputsInner'>
        <label for='hourly_rate'>Hourly Rate*</label>
        <input type='number' name='hourly_rate' id='hourly_rate' value='{$row['hourly_rate']}' min='1' max='100' required/>
        </div>

        <div class='inputsInner'>
        <input type='submit' name='submit' class='submitBtn' value='Update Position'>
        <div>
            </form>
        ";
        }
    }else {
            require_once "inc/functions.php";
            echo makePageStart("Positions");
            echo createPageBody();
    
            $success = <<<UPLOADED
    
            <div class="upload_outer">
            <div class="upload_inner">
            <img class="upload_img" src="img/failure.png" alt="failure tick">
                <p>Sorry, there was an error getting the information.</p>
                <a href="positions.php"><button>Back</a></button>
                </div>
            </div>
    
UPLOADED;
            $success .= "\n";
            echo $success;
            echo createPageClose();
        }
?>
    </main>
</div>
<?php 
        echo createPageClose(); 
?>




