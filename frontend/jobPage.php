<?php
    require_once("inc/functions.php");
    echo makePageStart();
    echo makeNav();

    if(isset($_POST['btn_goToJob'])){
            $jobId = filter_has_var(INPUT_POST, 'job_id') ? $_POST['job_id']: null;

            echo makeFullJob($jobId);
    }else{
        //Sends user back to list of job vacancies if they haven't selected a job
        header("Location: jobs.php");
    }


    echo makeFooter();
    echo endMain();
    echo makePageEnd();

?>