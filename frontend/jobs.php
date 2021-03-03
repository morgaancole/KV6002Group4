<?php
  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();
?>

<body style="background-image: url(styles/images/jobs.jpg);">
    <h3 class="title">Join The Team!</h3>
    
    <div class="job-page">  
        <?php echo makeJobsPage();?>
    </div>

</body>
<?php

echo makeFooter();
echo endMain();
echo makePageEnd();

?>