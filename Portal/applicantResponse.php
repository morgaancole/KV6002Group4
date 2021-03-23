<?php
    require_once("inc/functions.php");

    if (isset($_POST['btn_accept'])) {
            
        $applicantId = filter_has_var(INPUT_POST, 'applicant_id') ? $_POST['applicant_id']: null;

        $dbConn = getDatabase();

        //Getting user data from database to send them an email
        $select_stmt = $dbConn->prepare("SELECT applicant_fname, applicant_email FROM hd_job_applicants WHERE applicant_id = :aid");
        $select_stmt->bindParam(":aid", $applicantId);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);


        $firstName = $row['applicant_fname'];
        $email = $row['applicant_email'];

        $send = "Hi " . $firstName . "\n\nCongratulations!\n\nHenderson Contractors would like to bring you in for an interview!\nPlease confirm a date/time which would be convenient for you!\n\n";
        $send .= "Best Wishes,\nHenderson Building Contractors";

        $headers = "From: applications@hendersonbuilding.co.uk";

        $subject = "Response from Henderson Contractors";

        //Sending to user	
        mail($email, $subject ,$send, $headers);

        //Removing user data from database
        $delete_stmt = $dbConn->prepare("DELETE FROM hd_job_applicants WHERE applicant_id = :aid");
        $delete_stmt->bindParam(":aid", $applicantId);
        $delete_stmt->execute();

        header('Location: viewApplicants.php');
        
    }else if (isset($_POST['btn_reject'])) {
            
        $applicantId = filter_has_var(INPUT_POST, 'applicant_id') ? $_POST['applicant_id']: null;

        $dbConn = getDatabase();

        //Getting user data from database to send them an email
        $select_stmt = $dbConn->prepare("SELECT applicant_fname, applicant_email FROM hd_job_applicants WHERE applicant_id = :aid");
        $select_stmt->bindParam(":aid", $applicantId);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);


        $firstName = $row['applicant_fname'];
        $email = $row['applicant_email'];

        $send = "Hi " . $firstName . "\n\nThanks so much for your interest!\n\nHowever, at this time we've chosen to proceed with another candidate\nPlease keep an eye on our jobs page as we may have another opening for your soon!\n\n";
        $send .= "Best Wishes,\nHenderson Building Contractors";

        $headers = "From: applications@hendersonbuilding.co.uk";

        $subject = "Response from Henderson Contractors";

        //Sending to user	
        mail($email, $subject ,$send, $headers);

        //Removing user data from database
        $delete_stmt = $dbConn->prepare("DELETE FROM hd_job_applicants WHERE applicant_id = :aid");
        $delete_stmt->bindParam(":aid", $applicantId);
        $delete_stmt->execute();

        header('Location: viewApplicants.php');
        
    }else{//Redirect user if they haven't selected an option
        header('Location: viewApplicants.php');
    }
?>