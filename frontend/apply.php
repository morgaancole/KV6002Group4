<?php
/*
*Page where user can fill in application form and submit CV
*@author - Morgan Wheatman
*/
  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();

  //Checks if user came from jobPage
  if(isset($_POST['btn_apply_here'])){

    $jobId = filter_has_var(INPUT_POST, 'ID') ? $_POST['ID']: null;

    echo makeJobForm($jobId);
  }else{
    //Redirects user if they didn't come from jobPage
    header("Location: jobs.php");
  }


echo makeFooter();
echo endMain();
echo makePageEnd();

?>

<html>

</html>