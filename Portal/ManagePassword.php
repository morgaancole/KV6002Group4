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

    }echo makePageStart("Manage Password");
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
        
        $staff_id = filter_has_var(INPUT_GET, 'staffID') ? $_GET['staffID'] : null; 

        $myPDO  = getDatabase(); 
        $query  = $myPDO->query("SELECT *
        FROM hd_staff_users
        WHERE staff_id = $staff_id");
        
        /**Generates a new password and diaplays it in the form */
        while($row= $query->fetch(PDO::FETCH_ASSOC)){
            
            echo "
            <form id='UpdatePass' action='newPassword.php' method='get'>
            
            <div class='box-header with-border'>
            <a href='viewEmployees.php'><i class='fa fa-plus'></i>Back</a>
           </div>
        
                    <h2>Manage Password</h2>
                    
                    
                    <div class='inputsInner'>
                    <label for='staff_id'>Staff ID</label>
                    <input type='text' name='staff_id' id='staff_id' value='$staff_id' readonly />
                    </div>
        
                    <div class='inputsInner'>
                    <label for='staff_password'>Staff Password: * (at least 1 uppercase, lowercase, number and symbol. Between 8-12 characters)</label>
                    <input type='text' id='staff_password' pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$' name='staff_password' value="; $my_passwords = randomPassword(10,1,"lower_case,upper_case,numbers,special_symbols");
                   
                    foreach($my_passwords as $value){
                        //Print the element out.
                        echo $value;
                    };?> <?php echo"required />
                    </div>

                    <div class='inputsInner'>

                    <input type='submit' name='submit' class='submitBtn' value='Update Password'>
                    </div>

               </form>";?>
            <?php
               }
?>



        </main>

</div>
<?php 
        echo createPageClose(); 
?>

<?php

/**Generates random password*/
function randomPassword($length,$count, $characters) {
  
        $symbols = array();
        $passwords = array();
        $used_symbols = '';
        $pass = '';
     
        $symbols["lower_case"] = 'abcdefghijklmnopqrstuvwxyz';
        $symbols["upper_case"] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $symbols["numbers"] = '1234567890';
        $symbols["special_symbols"] = '!@#$%^&*_=+-';
     
        $characters = split(",",$characters); 
        foreach ($characters as $key=>$value) {
            $used_symbols .= $symbols[$value]; 
        }
        $symbols_length = strlen($used_symbols) - 1; 
         
        for ($p = 0; $p < $count; $p++) {
            $pass = '';
            for ($i = 0; $i < $length; $i++) {
                $n = rand(0, $symbols_length); 
                $pass .= $used_symbols[$n]; 
            }
            $passwords[] = $pass;
        }
         
        return $passwords; 
}

?>