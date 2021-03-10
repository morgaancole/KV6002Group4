<?php
  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();


  if(isset($_POST['btn_apply_here'])){

    $jobId = filter_has_var(INPUT_POST, 'ID') ? $_POST['ID']: null;

    echo makeJobForm($jobId);
  }

echo makeFooter();
echo endMain();
echo makePageEnd();

?>