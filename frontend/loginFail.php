<?php
  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();
?>

<body>
  
  <div class="title">Staff Login</div>
      <div class="container">
        <div class="form-container">
          <form id="contact" method="post" action="loginAction.php" name="signin-form">
              
                <div>
                    <br>
                    <br>
                    <label>Email</label>
                    <input 
                        type="email"
                        name="txt_email"
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                        title="Invalid email address" 
                        autocomplete="email" 
                        size="20" 
                        maxlength="40"
                        placeholder="Email" 
                        required 
                        id="email"/>
                </div>
              
                <div>
                    <label>Password</label>
                    <input 
                        type="password"
                        name="txt_password"
                        autocomplete="password"
                        placeholder="Password"
                        size="20"  
                        maxlength="40"
                        required
                        id="password"/>
                </div>   
              <br>
                    <p> Incorrect email or password. Please try again. </p>
              <br>
                <button type="submit" name="btn_login" value="login">Log In</button>
          </form>
        </div>
      </div>
</body>

<?php
echo makeFooter();
echo endMain();
echo makePageEnd();
?>
