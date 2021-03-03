<?php
  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();
?>


<body>
<h3 class="title"></h3>
  <div class="container">  
    <form id="contact" action="sendEmail.php" method="post">
        
      <div>
          <h3>Joiner</h3>
      </div>
      <h2>£13 an hour</h2>
      <h2>Carpenter wanted with experience in fitting fire doors</h2>
      <h2>Requirements: Valid CSCS card, Course/Qualification in fire door fitting</h2>
      <h2>13/06/2021</h2>
      <fieldset>
          <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Apply Here</button>
      </fieldset>
    </form>  
  </div>
      
</body>


<?php
echo makeFooter();
echo endMain();
echo makePageEnd();

?>