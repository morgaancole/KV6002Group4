<?php
/*
*Page where user can submit an enquiry
*Uses external javascript to validate input
*@author - Morgan Wheatman
*/
  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();
?>
<script type="text/javascript" src="contact.js"></script>

<body>
<h3 class="title">Contact Us</h3>
  <div class="container">  
    <div class="form-container">
        <form id="contact" action="sendEmail.php" method="post">
          <div>
              <i class="fa fa-phone"></i>
              <h3>01670 707853</h3>
          </div>
          <h4>Contact us today, and get reply within 24 hours!</h4>
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
            <input type="tel" required id="phone" name="phone" placeholder="Phone number" maxlength="20">
          </fieldset>
          <fieldset>
              <input name="subject" type="text" required id="subject" 
              placeholder="Subject" pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$" title="Only alphabets are allowed" 
              autocomplete="subject" size="20" maxlength="20">
          </fieldset>
          <fieldset>
              <textarea type="text" name="message" id="message" placeholder="How can we help you?" minlength="1" required title="Please enter a message"></textarea>
          </fieldset>
          <label for="consent">Do you consent to your data being stored in our database for future promotional offers?</label>
          <select name="consent" id="consent">
            <option value="selectOption">Please Select</option>
            <option value="yes">Yes</option>
            <option value="no">No</option>
          </select><br>
          <p id="errorMessage">Please Select an option from the above dropdown menu</p>
          <fieldset>
              <button name="btn_contact" type="submit" id="submit" data-submit="...Sending">Send now</button>
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