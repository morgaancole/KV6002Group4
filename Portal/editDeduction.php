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

    }echo makePageStart("Edit deduction");
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
        /**Displays all details about selected deduction */
        $deduction_id = filter_has_var(INPUT_GET, 'deductionID') ? $_GET['deductionID'] : null; 

        $myPDO  = getDatabase();  
        $query  = $myPDO->prepare("SELECT *
        FROM hd_deductions
        WHERE deduction_id = $deduction_id");
        
        $result = $query->execute();

        //Checks if there is an error returning data
        if($result){

        while($row= $query->fetch(PDO::FETCH_ASSOC)){

echo "
		<h1>Update Deduction: '{$row['deduction_name']}' </h1>

        <div class='box-header with-border'>
        <a href='deductions.php'><i class='fa fa-plus'></i>Back</a>
       </div>

		<form id='UpdateDeduction' action='updateDeduction.php' method='get'>
        <div class='inputsInner'>
        <label for='deduction_id'>Deduction ID</label>
        <input type='text' id='deduction_id' name='deduction_id' value='$deduction_id' readonly />
        </div>
        <div class='inputsInner'>
        <label for='deduction_name'>Deduction Name</label>
        <input type='text' name='deduction_name' id='deduction_name' size='50' value='{$row['deduction_name']}' readonly/>
        </div>
        <div class='inputsInner'>    
        <label for='deduction_amount'>Deduction Amount*</label>
        <input type='number' name='deduction_amount' id ='deduction_amount'value='{$row['deduction_amount']}'  min='1' max='100' required/>
        </div>

        <div class='inputsInner'>
            <input type='submit' name='submit'  class='submitBtn' value='Update Deduction'>
        </div>
            </form>
        ";
        }
    }else {
        require_once "inc/functions.php";
        echo makePageStart("Deductions");
        echo createPageBody();

        $success = <<<UPLOADED

        <div class="upload_outer">
        <div class="upload_inner">
        <img class="upload_img" src="img/failure.png" alt="failure tick">
            <p>Sorry, there was an error getting the information.</p>
            <a href="deductions.php"><button>Back</a></button>
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
        




