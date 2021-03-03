<?php
  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();

    if(isset($_POST['btn_apply_here'])){
        $jobId = filter_has_var(INPUT_POST, 'jobId') ? $_POST['jobId']: null;

        echo makeJobForm($jobId);
    }else{
        //Sends user back to list of job vacancies if they haven't selected a job
        header("Location: jobs.php");
    }



echo makeFooter();
echo endMain();
echo makePageEnd();

?>