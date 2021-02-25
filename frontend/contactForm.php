<?php
  require_once("functions.php");
  echo makePageStart();
  echo makeNav();
?>


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
  </div>
</body>
</html>