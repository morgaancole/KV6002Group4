<?php

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

        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["cv_file"]["name"]);

        $fileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

        $fullPath = "http://unn-w19042409.newnumyspace.co.uk/project/frontend/uploads" . "/" . basename($_FILES["cv_file"]["name"]);       

        //Trimming input from user
        $firstName = trim($firstName);
        $lastName = trim($lastName);
        $email = trim($email);
        $contact = trim($contact);
        $role = trim($role);

        
        //Checking if fields are empty (also checked on client-side)

        if (!empty($jobId)  && !empty($firstName)  && !empty($lastName) && !empty($email) && !empty($contact) && !empty($role)) {
            echo sendApplication($jobId, $firstName, $lastName, $email, $contact, $role, $fullPath);
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