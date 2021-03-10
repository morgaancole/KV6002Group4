<?php

    if(ISSET($_POST['btn_login'])){
        $email = filter_has_var(INPUT_POST, 'txt_email') ? $_POST['txt_email']: null;
        $password = filter_has_var(INPUT_POST, 'txt_password') ? $_POST['txt_password']: null;
        
        $email = trim($email);
        $password = trim($password);
        
        try {
            
        require_once("inc/functions.php");
                $dbConn = getDatabase();
 
        $select = $dbConn->prepare("SELECT * FROM hd_staff_users WHERE staff_email= :uemail");
                $select->bindParam(":uemail", $email);
                $select->execute();
                $user = $select->fetch(PDO::FETCH_ASSOC);
            
        $selectAdmin = $dbConn->prepare("SELECT * FROM hd_admin_users WHERE admin_email= :uemail");
                $selectAdmin->bindParam(":uemail", $email);
                $selectAdmin->execute();
                $admin = $selectAdmin->fetch(PDO::FETCH_ASSOC);
        
       if ($user) {  
        if($password === $user['staff_password']){
          header('Location: ../Portal/userDashboard.php');
        }       
        
        else{
          echo "Failed";       
        }
    } 
        
        else{
            echo "user not found";
        }
            
        if ($admin) {  
        if($password === $admin['admin_password']){
          header('Location: ../Portal/adminDashboard.php');
        }       
            
        else{
          echo "Failed";       
        }
    } 
        else{
          echo "user not found";
        }  
            
            
     } catch (Exception $e) {
            echo "There was a problem: " . $e->getMessage();
    }
    
    }
?>