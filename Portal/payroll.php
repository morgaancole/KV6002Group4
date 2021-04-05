<?php
 ini_set("session.save_path", "/home/unn_w19042409/sessionData");
 session_start(); 
 require_once("inc/functions.php");

//Session data path needs to change for demo

/*
*Page for admin users to view applications sent in from frontend
*@author - Morgan Wheatman
*/
    require_once("inc/functions.php");

    //Checking if user is logged in & their admin level
    //Redirects user to staff dash if they are not admin
    if(checkLogin()){

        if($_SESSION['adminLevel'] != '1'){
            header('Location: dash.php');
        }
        
    }else{//Redirecting user if they're not logged in
        header('Location: ../frontend/loginForm.php');

    }
    echo makePageStart("Henderson Building Contractors"); 
    echo  createPageBody();
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
    
              <table id="example1" class="table table-bordered">
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
 $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
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
                          <td>".$row['staff_first_name']. " ".$row['staff_last_name']."</td>
                          <td>".$row['staff_id']."</td>
                          <td>".$row['hours_worked']."</td>

                          <td>". $salaryReg."</td>
                          <td>".$row['overtime_worked']."</td>

                          <td>".$preTax."</td>
                          <td>".$postTax."</td>

                          <td>".$row['deductables']."</td>
                          <td>".$final."</td>

                          <td>".$row['process_desc']."</td>



                         <td><a href='editTimesheet.php?timesheetID={$row['timesheet_id']}&processID={$row['process_id']}&payslipID={$row['payslip_id']}'>Edit</a</td>


                         <td><a href='deleteTimesheet.php?timesheetID={$row['timesheet_id']}'>Delete</a</td>

                         <td><a href='print.php?timesheetID={$row['timesheet_id']}'>Print</a</td>

                         </tr>
                      ";
                    }

                  ?>

                </tbody>
              </table>
    </main>
</div>
</body>
</html>
        