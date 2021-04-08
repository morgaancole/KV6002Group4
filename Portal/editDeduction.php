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
        
        $deduction_id = filter_has_var(INPUT_GET, 'deductionID') ? $_GET['deductionID'] : null; 

        $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
        $query  = $myPDO->query("SELECT *
        FROM hd_deductions
        WHERE deduction_id = $deduction_id");
        
        while($row= $query->fetch(PDO::FETCH_ASSOC)){

echo "
		<h1>Update Deduction: '{$row['deduction_name']}' </h1>

		<form id='UpdateDeduction' action='updateDeduction.php' method='get'>
        <div class='inputsInner'>
        <label for='deduction_id'>Deduction ID</label>
        <input type='text' id='deduction_id' name='deduction_id' value='$deduction_id' readonly />
        </div>
        <div class='inputsInner'>
        <label for='deduction_name'>Deduction Name*</label>
        <input type='text' name='deduction_name' id='deduction_name' size='50' value='{$row['deduction_name']}' required/>
        </div>
        <div class='inputsInner'>    
        <label for='deduction_amount'>Deduction Amount*</label>
        <input type='number' name='deduction_amount' id ='deduction_amount'value='{$row['deduction_amount']}'  min="10" max="100" required/>
        </div>

        <div class='inputsInner'>
            <input type='submit' name='submit'  class='submitBtn' value='Update Deduction'>
        </div>
            </form>
        ";
        }
?>
    </main>
</div>
<?php 
        echo createPageClose(); 
?>
        




