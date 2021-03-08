<?php

  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();


    if(isset($_POST['btn_app_send'])){
        $jobId = filter_has_var(INPUT_POST, 'jobId') ? $_POST['jobId']: null;
        $firstName = filter_has_var(INPUT_POST, 'fname') ? $_POST['fname']: null;
        $lastName = filter_has_var(INPUT_POST, 'lname') ? $_POST['lname']: null;
        $email = filter_has_var(INPUT_POST, 'email') ? $_POST['email']: null;
        $contact = filter_has_var(INPUT_POST, 'phone') ? $_POST['phone']: null;

        //NEW
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["cv_file"]["name"]);

        $fileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

        $fullPath = "http://unn-w19042409.newnumyspace.co.uk/project/frontend/uploads" . "/" . basename($_FILES["cv_file"]["name"]);       

        try {
            $dbConn = getDatabase();
    
            $insert_stmt = $dbConn->prepare("INSERT INTO hd_job_applicants(applicant_fname, applicant_lname, applicant_email, applicant_contact, applicant_cv, job_id) 
                                            VALUES(:ufname, :ulname, :uemail, :ucontact, :ucv, :ujobid)");
            
            $insert_stmt->bindValue(':ufname', $firstName, PDO::PARAM_STR);
            $insert_stmt->bindValue(':ulname', $lastName, PDO::PARAM_STR);
            $insert_stmt->bindValue(':uemail', $email, PDO::PARAM_STR);
            $insert_stmt->bindValue(':ucontact', $contact, PDO::PARAM_INT);
            $insert_stmt->bindValue(':ucv', $fullPath, PDO::PARAM_STR);
            $insert_stmt->bindValue(':ujobid', $jobId, PDO::PARAM_INT);
            
            $insert_stmt->execute();   


        }catch (Exception $e) {
            echo "There was a problem: " . $e->getMessage();
            
        }	
        
        if($insert_stmt->execute()){
            echo applicationSubmitted('sent');
        }else{
            echo applicationSubmitted('failure');
        }
/*
        if (move_uploaded_file($_FILES["cv_file"]["tmp_name"], $targetFile)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["cv_file"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
            }
*/
    }else{
        //Sends user back to list of job vacancies if they haven't selected a job
        header("Location: jobs.php");
    }



echo makeFooter();
echo endMain();
echo makePageEnd();

?>