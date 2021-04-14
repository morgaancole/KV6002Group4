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

  }echo makePageStart("Vehicle Logs");
echo createPageBody();
echo adminNav(); 
?>


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
    
              <table id="example1" class="responsive-table">
                <thead>
                  <th>Employee Name</th>
                  <th>Employee ID</th>
                  <th>Hours</th>
                  <th>Salary</th>
                  <th>Overtime</th>
                  <th>Pre tax</th>
                  <th>Post tax</th>
                  <th>Deductions</th>
                  <th>Total Pay</th>
                  <th>Status</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                <?php
 $myPDO  = getDatabase();
 $query = $myPDO->query("SELECT * 
 FROM hd_payslips
 INNER JOIN hd_staff_users on (hd_payslips.staff_id = hd_staff_users.staff_id)
 INNER JOIN hd_pay_categories on (hd_staff_users.pay_id = hd_pay_categories.pay_id)
 INNER JOIN hd_payslip_process on (hd_payslips.process_id = hd_payslip_process.process_id)");

 while($row= $query->fetch(PDO::FETCH_ASSOC)){


    $hourlyRate = $row['hourly_rate'];
    $hourlyRateOvertime = $row['hourly_rate'] * 2;

    $salaryReg = $row['hours_worked'] * $hourlyRate;
    $salaryOvertime = $row['overtime_worked'] * $hourlyRateOvertime;

    $preTax = $salaryReg + $salaryOvertime;

    $postTax = $preTax * 0.80;

    $final = $postTax - $row['deductables'];

    

                      echo "
                        <tr>
                          <td data-label='Employee Name'>".$row['staff_first_name']. " ".$row['staff_last_name']."</td>
                          <td data-label='Employee ID'>".$row['staff_id']."</td>
                          <td data-label='Hours'>".$row['hours_worked']."</td>

                          <td data-label='Salary'>". $salaryReg."</td>
                          <td data-label='Overtime'>".$row['overtime_worked']."</td>

                          <td data-label='Pre tax'>".$preTax."</td>
                          <td data-label='Post tax'>".$postTax."</td>

                          <td data-label='Deductions'>".$row['deductables']."</td>
                          <td data-label='Total Pay'>".$final."</td>

                          <td data-label='Status'>".$row['process_desc']."</td>



                         <td data-label='Action'><a href='editTimesheet.php?timesheetID={$row['timesheet_id']}&processID={$row['process_id']}&payslipID={$row['payslip_id']}'>Edit</a>
                         <br>
                         <a href='deleteTimesheet.php?timesheetID={$row['timesheet_id']}'>Delete</a>
                         <br>
                         <a href='print.php?timesheetID={$row['timesheet_id']}'>Print</a>
                         </td>


                         </tr>
                      ";
                    }

                  ?>

                </tbody>
              </table>
    </main>
</div>
<?php 
        echo createPageClose(); 
?>