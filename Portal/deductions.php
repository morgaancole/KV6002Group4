<?php
require_once "inc/functions.php";
ini_set("session.save_path", "/home/unn_w17005084/sessionData"); //location of session data file, 
session_start();
    //Checking if user is logged in & their admin level
    //Redirects user to staff dash if they are not admin
    if(checkLogin()){

      if($_SESSION['adminLevel'] != '1'){
          header('Location: dash.php');
      }
      
  }else{//Redirecting user if they're not logged in
      header('Location: ../frontend/loginForm.php');

  }echo makePageStart("Deductions");
echo createPageBody();
echo adminNav(); 
?>

<!--@author Nicholas Coyles -->

<div class="main-content">

    <header>
            <div class="search-wrapper">
                <span class="ti-search"></span>
                <input type="search" placeholder="Search">
            </div>

            <div class="social-icons">
                <span class="ti-bell"></span>
                <span class="ti-comment"></span>
                <div></div>
            </div>
    </header>
    <main>

    <div class="box">
            <div class="box-header with-border">

              <!--Create new deduction-->
              <a href="createDeduction.php"><i class="fa fa-plus"></i>Create New Deduction</a>
            </div>
            <div class="box-body">
              <table id="example1" class="responsive-table">
                <thead>
                  <th>Deduction Name</th>
                  <th>Amount</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                  
                  /**Table of all deductions, edit and delete options*/


                $myPDO  = getDatabase();  
                $query = $myPDO->query("SELECT * FROM hd_deductions");

                while($row= $query->fetch(PDO::FETCH_ASSOC)){

                      echo "
                        <tr>
                          <td data-label='Deduction Name'>".$row['deduction_name']."</td>
                          <td data-label='Amount'>".number_format($row['deduction_amount'], 2)."</td>
                        
                          <td data-label='Tools'><a href='editDeduction.php?deductionID={$row['deduction_id']}'>Edit</a>
                          <br>
                          <a href='deleteDeduction.php?deductionID={$row['deduction_id']}'>Delete</a>
                          </td>
                        </tr>

                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
    </div>


    </main>
</div>
<?php 
        echo createPageClose(); 
?>



