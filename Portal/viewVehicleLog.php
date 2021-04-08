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
		<h1>Update Position: '{$row['staff_first_name']}' </h1>
		<form id='UpdateEmployee' action='updateEmployee.php' method='get'>
			<p>staff_id<input type='text' name='staff_id' value='$staff_id' readonly /></p>
			<p>staff_first_name<input type='text' name='staff_first_name' size='50' value='{$row['staff_first_name']}' required/></p>
            <p>staff_last_name<input type='text' name='staff_last_name' value='{$row['staff_last_name']}' required/></p>
            <p>staff_email<input type='text' name='staff_email' value='{$row['staff_email']}' required/></p>
            <p>staff_password <input type='text' name='staff_password' value='{$row['staff_password']}' required/> </p>
            <p>staff_address<input type='text' name='staff_address' value='{$row['staff_address']}' required/></p>
            <p>staff_postcode<input type='text' name='staff_postcode' value='{$row['staff_postcode']}' required/></p>";

            echo"Role <br>";
        
            $rsVenue = $myPDO->query("SELECT pay_id, pay_desc from hd_pay_categories ORDER BY pay_desc");


              echo "<select name='pay_id'>";
              while ($venueRecord = $rsVenue->fetch(PDO::FETCH_ASSOC)) {
                  
                  if ($pay_id == $venueRecord['pay_id'] ) {
                      echo "<option value='{$venueRecord['pay_id']}' selected>
                      {$venueRecord['pay_desc']}</option>";
                  }
                  else { 
                      echo "<option value='{$venueRecord['pay_id']}'>{$venueRecord['pay_desc']}</option>";
                  }
                  }
              echo "</select> <br>";


     
              echo " <p><input type='submit' name='submit' value='Update Employee'></p>
            </form>
        ";

        }
?>



        </main>

</div>
</body>
</html>
