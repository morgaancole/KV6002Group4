<?php

  require_once("inc/functions.php");
  echo makePageStart();


    if(isset($_POST['btn_app_send'])){
        $jobId = filter_has_var(INPUT_POST, 'jobId') ? $_POST['jobId']: null;
        $firstName = filter_has_var(INPUT_POST, 'fname') ? $_POST['fname']: null;
        $lastName = filter_has_var(INPUT_POST, 'lname') ? $_POST['lname']: null;
        $email = filter_has_var(INPUT_POST, 'email') ? $_POST['email']: null;
        $contact = filter_has_var(INPUT_POST, 'phone') ? $_POST['phone']: null;

        $cv_file = filter_has_var(INPUT_POST, 'cv_file') ? $_POST['cv_file']: null;



        var_dump($_POST);


    
        //$cv = filter_has_var(INPUT_POST, 'jobId') ? $_POST['jobId']: null;

        //echo $jobId;

        /*
             $fileDestination = "http://unn-w19042409.newnumyspace.co.uk/project/frontend/uploads/";

             $targetDir = "/home/unn_w19042409/public_html/project/frontend/uploads/";

            
             $path = pathinfo($file);
             $fileName = $path['filename'];
             $ext = $path['extension'];
             $tempName = $_FILES['cv_file']['tmp_name'];
             $pathFilenameExt = $targetDir.$fileName.".".$ext;
             $fileDestination .= $fileName.".".$ext;
        
            echo $fileDestination;


             /*
        // Check if file already exists
        if (file_exists($pathFilenameExt)) {
            echo "Sorry, file already exists.";
            }else{
                move_uploaded_file($tempName,$pathFilenameExt);
                echo "Congratulations! File Uploaded Successfully.";
            }
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