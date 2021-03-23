<?php
    require_once("inc/functions.php");

    if (isset($_POST['btn_accept'])) {
            
        $applicantId = filter_has_var(INPUT_POST, 'applicant_id') ? $_POST['applicant_id']: null;

        echo applicantResponse('accept', $applicantId);

        if(applicantResponse()){
            header('Location: viewApplicants.php');
        }
        
    }else if (isset($_POST['btn_reject'])) {
            
        $applicantId = filter_has_var(INPUT_POST, 'applicant_id') ? $_POST['applicant_id']: null;

        echo applicantResponse('reject', $applicantId);

        if(applicantResponse()){
            header('Location: viewApplicants.php');
        }
        
    }else{//Redirect user if they haven't selected an option
        header('Location: viewApplicants.php');
    }
?>