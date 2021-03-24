<?php
/*
*Page which dynamically displays jobs from database (inc/functions)
*@author - Morgan Wheatman
*/
  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();
?>

<body>
    <h3 class="title">Join The Team!
        <p>Note: All roles are based in the North East</p>
    </h3>
    
    
    <div class="job-page">  
        <?php echo makeJobsPage();?>
    </div>

</body>
<?php

echo makeFooter();
echo endMain();
echo makePageEnd();

?>