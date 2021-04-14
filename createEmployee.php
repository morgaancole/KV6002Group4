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

    }echo makePageStart("Vehicle Logs");
echo createPageBody();
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
    
    <div class='box-header with-border'>
    <a href='viewEmployees.php'><i class='fa fa-plus'></i>Back</a>
   </div>

                <h2>Create Employee</h2>
            
            
            <div class='inputsInner'>
            <label for='staff_first_name'>Staff first name *</label>
            <input type='text' id='staff_first_name' name='staff_first_name' pattern='[A-Za-z]{0,20}' placeholder='John' required/>
            </div>

            <div class='inputsInner'>
            <label for='staff_last_name'>Staff last name *</label>
            <input type='text' id='staff_last_name'name='staff_last_name' pattern='[A-Za-z]{0,20}' placeholder='Smith' required/>
            </div>

            <div class='inputsInner'>
            <label for='staff_email'>Staff Email *</label>
            <input type='email' id='staff_email' name='staff_email'  pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$' placeholder='johnsmith@.gmailcom' required/>
            </div>

            <div class='inputsInner'>
            <label for='birthday'>Date of birth: *</label>
            <input type='date' id='birthday' name='birthday'max='2002-12-30' required>
            </div>

            <div class='inputsInner'>
            <label for='staff_password'>Staff Password *</label>
            <input type='text' id='staff_password' name='staff_password' pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$' value="; $my_passwords = randomPassword(10,1,"lower_case,upper_case,numbers,special_symbols");
           
            foreach($my_passwords as $value){
                //Print the element out.
                echo $value;
            };?> <?php echo"required />
            </div>
            
            <div class='inputsInner'>
            <label for='staff_address'>Staff Address *</label>
            <td><input type='text' id='staff_address'name='staff_address' pattern='[A-Za-z0-9'\.\-\s\,]' placeholder='12 Eskdale Road' required/></td>
            </div>

            <div class='inputsInner'>
            <label for='staff_postcode'>Staff postcode *</label>
                <td><input type='text' id='staff_postcode' name='staff_postcode' pattern='^(([A-Z][0-9]{1,2})|(([A-Z][A-HJ-Y][0-9]{1,2})|(([A-Z][0-9][A-Z])|([A-Z][A-HJ-Y][0-9]?[A-Z])))) [0-9][A-Z]{2}$' placeholder='CA1 1JB' required/></td>
            </div>

            <div class='inputsInner'>
            <td>Role</td>
            <td>";
            ?>
            <?php
    
            $myPDO  = getDatabase();
  


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

function randomPassword($length,$count, $characters) {
 
    // $length - the length of the generated password
    // $count - number of passwords to be generated
    // $characters - types of characters to be used in the password
     
    // define variables used within the function    
        $symbols = array();
        $passwords = array();
        $used_symbols = '';
        $pass = '';
     
    // an array of different character types    
        $symbols["lower_case"] = 'abcdefghijklmnopqrstuvwxyz';
        $symbols["upper_case"] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $symbols["numbers"] = '1234567890';
        $symbols["special_symbols"] = '!@#$%^&*_=+-';
     
        $characters = split(",",$characters); // get characters types to be used for the passsword
        foreach ($characters as $key=>$value) {
            $used_symbols .= $symbols[$value]; // build a string with all characters
        }
        $symbols_length = strlen($used_symbols) - 1; //strlen starts from 0 so to get number of characters deduct 1
         
        for ($p = 0; $p < $count; $p++) {
            $pass = '';
            for ($i = 0; $i < $length; $i++) {
                $n = rand(0, $symbols_length); // get a random character from the string with all characters
                $pass .= $used_symbols[$n]; // add the character to the password string
            }
            $passwords[] = $pass;
        }
         
        return $passwords; // return the generated password
    }


$myPDO  = getDatabase();
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
$staff_password = password_hash($staff_password, PASSWORD_DEFAULT);
$staff_address = trim($staff_address);
$staff_postcode = trim($staff_postcode);



$check_users  = $myPDO->query("SELECT date_of_birth,staff_last_name
FROM hd_staff_users
WHERE staff_last_name ='$staff_last_name'");

$duplicateUser = false;

while($row= $check_users->fetch(PDO::FETCH_ASSOC)){

if($row['date_of_birth'] == $date_of_birth && $row['staff_last_name'] == $staff_last_name ){
    $duplicateUser = true; 
    echo '<script type="text/javascript">',
    'alert("Not created, duplicate user");',
    '</script>'
;
}
}
if($duplicateUser == false){
    $query  = $myPDO->query("INSERT INTO hd_staff_users(staff_first_name,staff_last_name,staff_email,staff_password,staff_address,staff_postcode,pay_id,date_of_birth) VALUES('$staff_first_name','$staff_last_name','$staff_email','$staff_password','$staff_address','$staff_postcode','$pay_id','$date_of_birth')");
    

    echo '<script type="text/javascript">',
    'alert("Employee Created");',
    '</script>'
;



}
}

?>
