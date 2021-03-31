<?php
/*
*Action page which handles admin response to job applications
*@author - Morgan Wheatman
*/
    require_once("inc/functions.php");

    if (isset($_POST['btn_close_vacancy'])) {

        $jobId = filter_has_var(INPUT_POST, 'job_id') ? $_POST['job_id']: null;

        echo closeVacancy($jobId);
        
    }else{//Redirect user if they haven't clicked a vacancy
        header('Location: viewVacancies.php');
    }

    //header('Location: viewVacancies.php');
?>