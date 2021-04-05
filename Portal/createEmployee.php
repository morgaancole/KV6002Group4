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
echo "
    <form action='createEmployee.php' method='post' enctype='multipart/form-data'>
    

                <h2>Create New Employee</h2>
            
            
            <div class='inputsInner'>
            <label for='staff_first_name'>Staff first name</label>
            <input type='text' id='staff_first_name' name='staff_first_name' pattern='[A-Za-z]{20}' placeholder='John' required/>
            </div>

            <div class='inputsInner'>
            <label for='staff_last_name'>Staff last name</label>
            <input type='text' id='staff_last_name'name='staff_last_name' pattern='[A-Za-z]{20}' placeholder='Smith' required/>
            </div>

            <div class='inputsInner'>
            <label for='staff_email'>Staff Email</label>
            <input type='email' id='staff_email' name='staff_email'  pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$' placeholder='johnsmith@.gmailcom' required/>
            </div>

            <div class='inputsInner'>
            <label for='birthday'>Date of birth:</label>
            <input type='date' id='birthday' name='birthday'max='2002-12-30'>
            </div>

            <div class='inputsInner'>
            <label for='staff_password'>Staff Password</label>
            <input type='text' id='staff_password' name='staff_password' pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}' value=";echo randomPassword();?> <?php echo"required />
            </div>
            
            <div class='inputsInner'>
            <label for='staff_address'>Staff Address</label>
            <td><input type='text' id='staff_address'name='staff_address' pattern='[A-Za-z0-9'\.\-\s\,]' placeholder='12 Eskdale Road' required/></td>
            </div>

            <div class='inputsInner'>
            <label for='staff_postcode'>Staff postcode</label>
                <td><input type='text' id='staff_postcode' name='staff_postcode' pattern='/^[A-Z]{1,2}[0-9]{1,2} ?[0-9][A-Z]{2}$/i' placeholder='CA1 1JB' required/></td>
            </div>

            <div class='inputsInner'>
            <td>Role</td>
            <td>";
            ?>
            <?php
    
            $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
  


        $role =  $myPDO->query("SELECT * from hd_pay_categories ORDER BY pay_desc");


          echo "<select name='pay_id'>";
          while ($row = $role->fetch(PDO::FETCH_ASSOC)){
              
 
                  echo "<option value='{$row['pay_id']}'>{$row['pay_desc']}</option>";
              
              }
          echo "</select>
          </div>
         
          <div class='inputsInner'>

         <input type='submit' name='insert_employee' value='Create Employee'>
         </div>
    </form>
    ";?>
    </main>

</div>

<?php 
        echo createPageClose(); 
?>


<?php

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


$myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  

if(isset($_POST['insert_employee'])){

$staff_first_name = $_POST['staff_first_name'];
$date_of_birth = $_POST['birthday'];
$staff_last_name = $_POST['staff_last_name'];
$staff_email = $_POST['staff_email'];
$staff_password = $_POST['staff_password'];
$staff_address = $_POST['staff_address'];
$staff_postcode = $_POST['staff_postcode'];
$pay_id = $_POST['pay_id'];


//validate inputs
$staff_first_name = trim($staff_first_name);
$staff_last_name = trim($staff_last_name);
$staff_email = trim($staff_email);
$staff_password = password_hash($staff_password);
$staff_address = trim($staff_address);
$staff_postcode = trim($staff_postcode);



$check_users  = $myPDO->query("SELECT date_of_birth,staff_last_name
FROM hd_staff_users
WHERE staff_last_name ='$staff_last_name'");

$duplicateUser = false;

while($row= $check_users->fetch(PDO::FETCH_ASSOC)){

if($row['date_of_birth'] == $date_of_birth && $row['staff_last_name'] == $staff_last_name ){
    $duplicateUser = true; 
}
}
if($duplicateUser == false){
    $query  = $myPDO->query("INSERT INTO hd_staff_users(staff_first_name,staff_last_name,staff_email,staff_password,staff_address,staff_postcode,pay_id,date_of_birth) VALUES('$staff_first_name','$staff_last_name','$staff_email','$staff_password','$staff_address','$staff_postcode','$pay_id','$date_of_birth')");
    
    echo makePageStart("Timesheet");
    echo createPageBody();
    
    $success = <<<UPLOADED

    <div class="success_outer">
    <div class="success_inner">
    <img class="success_img" src="img/success.png" alt="success tick">
        <p>Employee Created</p>
        <a href="viewEmployees.php"><button>Employee List</a></button>
        </div>
    </div>

UPLOADED;
    $success .= "\n";
    echo $success;
    echo createPageClose();
}
}

?>