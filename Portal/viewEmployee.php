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

    }echo makePageStart("Employee Details");
echo createPageBody();
echo adminNav(); 
?>
<!--@author Nicholas Coyles -->

<!--Displays all the details for an employee-->
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
        
        /**Form can be editted and submitted*/
        $staff_id = filter_has_var(INPUT_GET, 'staffID') ? $_GET['staffID'] : null; 
        $pay_id = filter_has_var(INPUT_GET, 'payID') ? $_GET['payID'] : null; 

        $myPDO  = getDatabase(); 
        $query  = $myPDO->prepare("SELECT *
        FROM hd_staff_users
        WHERE staff_id = $staff_id");

        $result = $query->execute();

        if($result){
        while($row= $query->fetch(PDO::FETCH_ASSOC)){
            
 

echo "
<div class='box-header with-border'>
<a href='viewEmployees.php'><i class='fa fa-plus'></i>Back</a>
</div>

		<h1>Update Employee: '{$row['staff_first_name']}' </h1>
		<form id='UpdateEmployee' action='updateEmployee.php' method='get'>
        <div class='inputsInner'>
        <label for='staff_id'>Staff ID</label>
        <input type='text' name='staff_id' id='staff_id' value='$staff_id' readonly />
        </div>
        <div class='inputsInner'>
        <label for='staff_first_name'>Staff First Name</label>
        <input type='text' name='staff_first_name' id='staff_first_name'pattern='[A-Za-z]{1,20}' maxlength='30' placeholder='John' value='{$row['staff_first_name']}' required/>
        </div>
        <div class='inputsInner'>
        <label for='staff_last_name'>Staff Last Name</label>
        <input type='text' name='staff_last_name' id='staff_last_name'pattern='[A-Za-z]{1,20}' maxlength='30' value='{$row['staff_last_name']}' required/>
        </div>
        <div class='inputsInner'>
        <label for='staff_email'>Staff Email</label>
        <input type='text' name='staff_email' id='staff_email'pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$' placeholder='johnsmith@.gmail.com' value='{$row['staff_email']}' required/>
        </div>
        <div class='inputsInner'>
        <label for='staff_address'>Staff Address</label>
        <input type='text' name='staff_address' id='staff_address' value='{$row['staff_address']}' pattern='[A-Za-z0-9'\.\-\s\,]{1,40}' maxlength='40' placeholder='12 Eskdale Road' required/>
        </div>
        <div class='inputsInner'>
        <label for='staff_postcode'>Staff Postcode</label>
        <input type='text' name='staff_postcode' id='staff_postcode'  pattern='^(([A-Z][0-9]{1,2})|(([A-Z][A-HJ-Y][0-9]{1,2})|(([A-Z][0-9][A-Z])|([A-Z][A-HJ-Y][0-9]?[A-Z])))) [0-9][A-Z]{2}$' placeholder='CA1 1JB' value='{$row['staff_postcode']}' required/>
        </div>   
            ";

            echo"<div class='inputsInner'>
            <label for='pay_id'>Staff Role</label>";
        
            $Role = $myPDO->query("SELECT pay_id, pay_desc from hd_pay_categories ORDER BY pay_desc");
            /**Drop down of available roles */

              echo "<select id='pay_id'name='pay_id'>";
              while ($roleRecord = $Role->fetch(PDO::FETCH_ASSOC)) {
                  
                  if ($pay_id == $roleRecord['pay_id'] ) {
                      echo "<option value='{$roleRecord['pay_id']}' selected>
                      {$roleRecord['pay_desc']}</option>";
                  }
                  else { 
                      echo "<option value='{$roleRecord['pay_id']}'>{$roleRecord['pay_desc']}</option>";
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
    }else {
        require_once "inc/functions.php";
        echo makePageStart("Employees");
        echo createPageBody();

        $success = <<<UPLOADED

        <div class="upload_outer">
        <div class="upload_inner">
        <img class="upload_img" src="img/failure.png" alt="failure tick">
            <p>Sorry, there was an error getting the information.</p>
            <a href="viewEmployees.php"><button>Back</a></button>
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
