<?php
  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();
?>

<<<<<<< Updated upstream

<div style="background-image: url('styles/images/builders.jpg');" class="banner" ></div>
  <div class="about">
    <div class="content">
      <div class="title">Henderson Building Contractors</div>
      <div>
        <h1>Contact Us</h1>
            <!-- Form that uses client side validation to make sure user is inputting correctly
                formatted information before it is sent to the backend -->
            <form action="sendEmail.php" method="post">
                <input name="name" type="text" required id="name" 
                    placeholder="Your Name" pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$" title="Only alphabets are allowed" 
                        autocomplete="first-name" size="20" maxlength="20">
                <br>
                <input name="email" type="email" required id="email" 
                    placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid email address" 
                        autocomplete="email" size="20" maxlength="40">
                        <br>     
                <input name="subject" type="text" required id="subject" 
                    placeholder="Subject" pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$" title="Only alphabets are allowed" 
                        autocomplete="subject" size="20" maxlength="20">
                        <br>     
                <textarea  name="message" placeholder="Your message" minlength="1" title="Please enter a message"></textarea>
                <input type="submit">
            </form>
    </div>
    </div>
=======
<body style="background-image: url(styles/images/living.jpg);">
  <div class="container">  
    <form id="contact" action="sendEmail.php" method="post">
      <h3 class="title">Contact Form</h3>
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
          <input name="subject" type="text" required id="subject" 
          placeholder="Subject" pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$" title="Only alphabets are allowed" 
          autocomplete="subject" size="20" maxlength="20">
      </fieldset>
      <fieldset>
          <textarea name="message" placeholder="Your message" minlength="1" title="Please enter a message"></textarea>
      </fieldset>
      <fieldset>
          <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Send now</button>
      </fieldset>
    </form>  
>>>>>>> Stashed changes
  </div>
      
</body>
</html>