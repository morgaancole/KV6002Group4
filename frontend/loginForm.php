<?php
  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();
?>

<body>
  
  <div class="title">Henderson Building Contractors</div>
      
      <form method="post" action="loginAction.php" name="signin-form">
          
            <div>
                <label>Email</label>
                <input type="text" name="txt_email"  required />
            </div>
          
            <div>
                <label>Password</label>
                <input type="password" name="txt_password" required />
            </div>          
    
            <button type="submit" name="btn_login" value="login">Log In</button>
      </form>

</body>




<?php
echo makeFooter();
echo endMain();
echo makePageEnd();
?>
