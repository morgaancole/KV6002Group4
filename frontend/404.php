<?php
/*
*Page which users are sent to in the event of a 404 error
*@author - Morgan Wheatman
*/
  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();
?>


<body body style="background-image: url(styles/images/living.jpg);">
<h3 class="title">404 Not Found</h3>
  <div class="container">  
    <h3>It looks like you got a bit lost</h3>
    <h3>Return <a href='index.php'>Home?</a></h3>
    <h3>View <a href='services.php'>Services?</a></h3>
    <h3>View <a href='jobs.php'>Jobs?</a></h3>
    <h3><a href='contactForm.php'>Contact Us?</a></h3>
    <h3>Staff <a href='loginForm.php'>Login</a></h3>
  </div>
      
</body>


<?php
echo makeFooter();
echo endMain();
echo makePageEnd();
?>