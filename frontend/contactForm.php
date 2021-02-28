<?php
  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();
?>

<body style="background-image: url(styles/images/contact.jpg);">
<h3 class="title">Contact Us</h3>
  <div class="container">  
    <form id="contact" action="sendEmail.php" method="post">
      <div>
          <i class="fa fa-phone"></i>
          <h3>01670 707853</h3>
      </div>
      <h4>Contact us today, and get reply with in 24 hours!</h4>
      <fieldset>
          <input name="name" type="text" required id="name" 
          placeholder="Your Name" pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$" title="Only alphabets are allowed" 
          autocomplete="first-name" size="20" maxlength="20">
      </fieldset>
      <fieldset>
          <input name="email" type="email" required id="email" 
          placeholder="Email Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid email address" 
          autocomplete="email" size="20" maxlength="40">
      </fieldset>
      <fieldset>
         <input type="tel" id="phone" name="phone" placeholder="Phone number (optional)" maxlength="20">
      </fieldset>
      <fieldset>
          <input name="subject" type="text" required id="subject" 
          placeholder="Subject" pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$" title="Only alphabets are allowed" 
          autocomplete="subject" size="20" maxlength="20">
      </fieldset>
      <fieldset>
          <textarea name="message" placeholder="How can we help you?" minlength="1" title="Please enter a message"></textarea>
      </fieldset>
      <fieldset>
          <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Send now</button>
      </fieldset>
    </form>  
  </div>
      
</body>

<?php

echo makeFooter();
echo endMain();
echo makePageEnd();

?>