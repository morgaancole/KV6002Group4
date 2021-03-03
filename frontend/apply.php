<?php
  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();
?>
<body>
    <h3 class="title"></h3>
    <div class="container">  
    <form id="contact" action="sendEmail.php" method="post" enctype="multipart/form-data">
      <div>
          <h3>Apply Here!</h3>
      </div>
      <fieldset>
          <label for="role">Applying For</label>
          <input name="role" type="text" required id="role" 
          placeholder="role" pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$" title="Only alphabets are allowed" 
          autocomplete="role" size="20" maxlength="20" readonly value="Joiner">
      </fieldset>
      <fieldset>
          <label for="fName">First Name</label>
          <input name="fname" type="text" required id="fname" 
          placeholder="First Name" pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$" title="Only alphabets are allowed" 
          autocomplete="first-name" size="20" maxlength="20">
      </fieldset>
      <fieldset>
          <label for="lname">Last Name</label>
          <input name="name" type="text" required id="lname" 
          placeholder="Last Name" pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$" title="Only alphabets are allowed" 
          autocomplete="last-name" size="20" maxlength="20">
      </fieldset>
      <fieldset>
          <label for="email">Email</label>
          <input name="email" type="email" required id="email" 
          placeholder="Email Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid email address" 
          autocomplete="email" size="20" maxlength="40">
      </fieldset>
      <fieldset>
         <label for="number">Contact Number</label>
         <input type="tel" id="phone" name="phone" placeholder="Phone number" maxlength="20" required>
      </fieldset>
      <fieldset>
         <label for="cv">Upload CV</label>
         <input type="file" name="fileToUpload" id="fileToUpload" accept="application/msword, application/pdf" required>
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