<?php
     ini_set("session.save_path", "/home/unn_w19042409/sessionData");
     session_start(); //start session, THIS

    //ini_set("session.save_path", "/home/unn_w17005084/sessionData"); //location of session data file, THIS
    //session_start(); //start session, THIS

    if(ISSET($_POST['btn_login'])){
        $email = filter_has_var(INPUT_POST, 'txt_email') ? $_POST['txt_email']: null;
        $password = filter_has_var(INPUT_POST, 'txt_password') ? $_POST['txt_password']: null;
        
        $email = trim($email);
        $password = trim($password);
        
        try {
            
        unset($_SESSION ['email']); //THIS
        unset($_SESSION ['logged-in']); //THIS
            
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
           
           $passwordHash = $user['staff_password'];


        if(password_verify($password, $passwordHash)){
        
            $_SESSION['logged-in'] = 'true'; //THIS
            $_SESSION ['email'] = $email; //THIS
 
            header('Location: ../Portal/staff_user_dash/group_project/userDashboard.php');
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
            
            $_SESSION['logged-in'] = true; //THIS
            $_SESSION ['email'] = $email; //THIS
            $_SESSION['adminLevel'] = '1';
            
            header('Location: ../Portal/adminDashboard.php');
               
        }       
            
        else{
          header('Location: loginFail.php');       
        }
    } 
        else{
          header('Location: loginFail.php'); 
        }  
            
            
     } catch (Exception $e) {
            echo "There was a problem: " . $e->getMessage();
    }
    
    }
?>
