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
        
        $pay_id = filter_has_var(INPUT_GET, 'payID') ? $_GET['payID'] : null; 

        $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
        $query  = $myPDO->query("SELECT *
        FROM hd_pay_categories
        WHERE pay_id = $pay_id");
        
        while($row= $query->fetch(PDO::FETCH_ASSOC)){

echo "
		<h1>Update Position: '{$row['pay_desc']}' </h1>
		<form id='UpdatePosition' action='updatePosition.php' method='get'>
        <div class='inputsInner'>
        <label for='pay_id'>Pay ID</label>
		<input type='text' name='pay_id' id='pay_id' value='$pay_id' readonly />
        </div>
        <div class='inputsInner'>
        <label for='pay_desc'>Description*</label>
		<input type='text' name='pay_desc' id='pay_desc' size='50' value='{$row['pay_desc']}' required/>
        </div>
        <div class='inputsInner'>
        <label for='hourly_rate'>Hourly Rate*</label>
        <input type='number' name='hourly_rate' id='hourly_rate' value='{$row['hourly_rate']}'   min="7.5" max="100" required/>
        </div>

        <div class='inputsInner'>
        <input type='submit' name='submit' class='submitBtn' value='Update Position'>
        <div>
            </form>
        ";
        }
?>
    </main>
</div>
<?php 
        echo createPageClose(); 
?>




