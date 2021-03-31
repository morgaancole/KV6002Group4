<?php
/*
*Action page which handles admin response to job applications
*@author - Morgan Wheatman
*/
    require_once("inc/functions.php");

    if (isset($_POST['btn_create_vacancy'])) {

        $jobTitle = filter_has_var(INPUT_POST, 'title') ? $_POST['title']: null;
        $wage = filter_has_var(INPUT_POST, 'wage') ? $_POST['wage']: null;
        $description = filter_has_var(INPUT_POST, 'description') ? $_POST['description']: null;
        $requirements = filter_has_var(INPUT_POST, 'requirements') ? $_POST['requirements']: null;
        $closeDate = filter_has_var(INPUT_POST, 'close') ? $_POST['close']: null;

        $jobTitle = trim($jobTitle);
        $wage = trim($wage);
        $description = trim($description);
        $requirements = trim($requirements);
        $closeDate = trim($closeDate);

        if(!empty($jobTitle) && !empty($wage) && !empty($description) && !empty($requirements) && !empty($closeDate)){

            echo newVacancy($jobTitle, $wage, $description, $requirements, $closeDate);

            header('Location: viewVacancies.php');
        }else{
            header('Location: viewVacancies.php');
        }
        
    }else{//Redirect user if they haven't clicked a vacancy
        header('Location: viewVacancies.php');
    }

?>