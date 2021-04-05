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
        
        $staff_id = filter_has_var(INPUT_GET, 'staffID') ? $_GET['staffID'] : null; 
        $pay_id = filter_has_var(INPUT_GET, 'payID') ? $_GET['payID'] : null; 

        $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
        $query  = $myPDO->query("SELECT *
        FROM hd_staff_users
        WHERE staff_id = $staff_id");
        
        while($row= $query->fetch(PDO::FETCH_ASSOC)){

echo "
		<h1>Update Employee: '{$row['staff_first_name']}' </h1>
		<form id='UpdateEmployee' action='updateEmployee.php' method='get'>
        <div class='inputsInner'>
        <label for='staff_id'>Staff ID</label>
        <input type='text' name='staff_id' id='staff_id' value='$staff_id' readonly />
        </div>
        <div class='inputsInner'>
        <label for='staff_first_name'>Staff First Name</label>
        <input type='text' name='staff_first_name' id='staff_first_name' size='50' value='{$row['staff_first_name']}' required/>
        </div>
        <div class='inputsInner'>
        <label for='staff_last_name'>Staff Last Name</label>
        <input type='text' name='staff_last_name' id='staff_last_name' value='{$row['staff_last_name']}' required/>
        </div>
        <div class='inputsInner'>
        <label for='staff_email'>Staff Email</label>
        <input type='text' name='staff_email' id='staff_email' value='{$row['staff_email']}' required/>
        </div>
        <div class='inputsInner'>
        <label for='staff_password'>Staff Password</label>
        <input type='text' name='staff_password' id='staff_password' value='{$row['staff_password']}' required/>
        </div>
        <div class='inputsInner'>
        <label for='staff_address'>Staff Address</label>
        <input type='text' name='staff_address' id='staff_address' value='{$row['staff_address']}' required/>
        </div>
        <div class='inputsInner'>
        <label for='staff_postcode'>Staff Postcode</label>
        <input type='text' name='staff_postcode' id='staff_postcode' value='{$row['staff_postcode']}' required/>
        </div>   
            ";

            echo"<div class='inputsInner'>
            <label for='pay_id'>Staff Role</label>";
        
            $rsVenue = $myPDO->query("SELECT pay_id, pay_desc from hd_pay_categories ORDER BY pay_desc");


              echo "<select id='pay_id'name='pay_id'>";
              while ($venueRecord = $rsVenue->fetch(PDO::FETCH_ASSOC)) {
                  
                  if ($pay_id == $venueRecord['pay_id'] ) {
                      echo "<option value='{$venueRecord['pay_id']}' selected>
                      {$venueRecord['pay_desc']}</option>";
                  }
                  else { 
                      echo "<option value='{$venueRecord['pay_id']}'>{$venueRecord['pay_desc']}</option>";
                  }
                  }
              echo "</select>
              </div>";


     
              echo " 
              <div class='inputsInner'>
              <input type='submit' name='submit' value='Update Employee'>
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
