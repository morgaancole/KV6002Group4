<?php
  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();
?>

<body style="background-image: url(styles/images/services.jpg);">
    <h3 class="title">Our Services
        <a href="contactForm.php">Contact Us for a quote</a> 
    </h3>
    
    <div class="wrap">  
        <div class="item">
            <form id="contact" action="apply.php" method="post">
                <h1>Job Title</h1>
                <fieldset>
                    <button name="submit" type="submit" id="apply-submit">Apply Here</button>
                </fieldset>
            </form>
        </div>
    </div>

</body>
<?php

echo makeFooter();
echo endMain();
echo makePageEnd();

?>