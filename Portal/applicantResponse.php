<?php
/*
*Action page which handles admin response to job applications
*@author - Morgan Wheatman
*/
    require_once("inc/functions.php");

    if (isset($_POST['btn_accept'])) {

        $response = 'accept';
        
    }else if (isset($_POST['btn_reject'])) {

        $response = 'reject';
        
    }else{//Redirect user if they haven't selected an option
        header('Location: viewApplicants.php');
    }

    $applicantId = filter_has_var(INPUT_POST, 'applicant_id') ? $_POST['applicant_id']: null;

    echo applicantResponse($response, $applicantId);

    header('Location: viewApplicants.php');
?>