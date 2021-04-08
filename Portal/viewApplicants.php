<?php
 ini_set("session.save_path", "/home/unn_w17005084/sessionData"); //location of session data file, 
 session_start(); //start session
 require_once("inc/functions.php");
 

/*
*Page for admin users to view applications sent in from frontend
*@author - Morgan Wheatman
*/
    //Checking if user is logged in & their admin level
    //Redirects user to staff dash if they are not admin
    if(checkLogin()){
        if($_SESSION['adminLevel'] != '1'){
            header('Location: dash.php');
        }
        
    }else{//Redirecting user if they're not logged in
        header('Location: ../frontend/loginForm.php');

    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>View Applicants</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
</head>
<body>
    <?php 
        echo adminNav(); 
    ?>
    <div class="main-content">
        <main>
            <tbody>
                <h1 class="mtitle">Applicants</h1>
                <div class="applicant-page">
                    <?php 
                        echo getApplicants();
                    ?>
                </div>
            </tbody>
        </main>          
    </div>
</body>
</html>