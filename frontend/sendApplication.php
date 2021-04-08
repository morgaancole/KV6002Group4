<?php
/*
*PAction page which takes user input from application form and calls application function
*@author - Morgan Wheatman
*/
  require_once("inc/functions.php");
  echo makePageStart();

  echo makeNav();

    if(isset($_POST['btn_app_send'])){
        $errors = array();

        $jobId = filter_has_var(INPUT_POST, 'ID') ? $_POST['ID']: null;
        $firstName = filter_has_var(INPUT_POST, 'fname') ? $_POST['fname']: null;
        $lastName = filter_has_var(INPUT_POST, 'lname') ? $_POST['lname']: null;
        $email = filter_has_var(INPUT_POST, 'email') ? $_POST['email']: null;
        $contact = filter_has_var(INPUT_POST, 'phone') ? $_POST['phone']: null;
        $role = filter_has_var(INPUT_POST, 'role') ? $_POST['role']: null;
  

        //Trimming input from user
        $firstName = trim($firstName);
        $lastName = trim($lastName);
        $email = trim($email);
        $contact = trim($contact);
        $role = trim($role);

        $targetDir = "uploads/";

        //Sanitising file name befpore insert
        $filename = str_replace(" ", "_", $_FILES['cv_file']['name']);

  
        $targetFile = $targetDir . $filename;

        $fullPath = "http://unn-w17005084.newnumyspace.co.uk/frontend/uploads" . "/" . $filename;  
        
        //Checking if fields are empty (also checked on client-side)
        if (!empty($jobId)  && !empty($firstName)  && !empty($lastName) && !empty($email) && !empty($contact) && !empty($role)) {   
           
            //Checks if CV upload worked
            if (move_uploaded_file($_FILES["cv_file"]["tmp_name"], $targetFile)) {

                echo sendApplication($jobId, $firstName, $lastName, $email, $contact, $role, $fullPath);
            
            }else { //If upload failed, sets value in database - can prompt Henderson to contact applicant and request CV
                $fullPath = "CV upload unavailable";
                echo sendApplication($jobId, $firstName, $lastName, $email, $contact, $role, $fullPath);
            }

        }else{
            $errors[] = "Something was left empty";
            header("Location: jobs.php");
        }

    }else{
        //Sends user back to list of job vacancies if they haven't selected a job
        header("Location: jobs.php");
    }

echo makeFooter();
echo endMain();
echo makePageEnd();

?>