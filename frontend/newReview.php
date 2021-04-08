<?php
/*
*Action page which handles admin response to job applications
*@author - Rachel Johnson
*/
    require_once("inc/functions.php");

    if (isset($_POST['btn_create_review'])) {

        $name = filter_has_var(INPUT_POST, 'name') ? $_POST['name']: null;
        $review = filter_has_var(INPUT_POST, 'review') ? $_POST['review']: null;
        
        $name = trim($name);
        $review = trim($review);
        
        if(!empty($name) && !empty($review)){
            
            
            echo newReview($name, $review);
            
            header('Location: index.php');
        }else{
            header('Location: index.php');
        }
        
    }else{//Redirect user if they haven't selected an option
            
        header('Location: index.php');
    }

?>