 <?php
  require_once("inc/functions.php");
  echo makePageStart();
  echo makeNav();
?>
  <div style="background-image: url('styles/images/angel.jpg');" class="banner" ></div>
  <div class="about">
    <div class="content">
      <div class="title">Henderson Building Contractors</div>
      <p>Homepage shit can go here:</p>
    </div>
  </div>

  <script>
    const body = document.querySelector("body");
    const navbar = document.querySelector(".navbar");
    const menuBtn = document.querySelector(".menu-btn");
    const cancelBtn = document.querySelector(".cancel-btn");
    menuBtn.onclick = ()=>{
      navbar.classList.add("show");
      menuBtn.classList.add("hide");
      body.classList.add("disabled");
    }
    cancelBtn.onclick = ()=>{
      body.classList.remove("disabled");
      navbar.classList.remove("show");
      menuBtn.classList.remove("hide");
    }
    window.onscroll = ()=>{
      this.scrollY > 20 ? navbar.classList.add("sticky") : navbar.classList.remove("sticky");
    }
  </script>
