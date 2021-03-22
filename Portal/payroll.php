<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <title>Document</title>
</head>
<body>
<body>

<input type="checkbox" id="sidebar-toggle">
<div class="sidebar">
    <div class="sidebar-header">
        <h3 class="brand">
            <span>Hendersons</span>
        </h3>
        <label for="sidebar-toggle" class="ti-menu-alt"></label>
    </div>

    <div class="sidebar-menu">
        <ul>
            <li>
                <a href="adminDashboard.php">
                    <span class="ti-home"></span>
                    <span>Home</span>
                </a>
            </li>

            <li>
             <a href="payroll.php">
                <span class="ti-time"></span>
                <span>Payroll</span>
             </a>
            </li>

            <li>
                    <a href="position.php">
                        <span class="ti-settings"></span>
                        <span>Positions</span>
                    </a>
                </li>

                <li>
                    <a href="vehicleLogs.php">
                        <span class="ti-settings"></span>
                        <span>View Vehichle Logs</span>
                    </a>
                </li>

                <li>
                    <a href="viewEmployees.php">
                        <span class="ti-settings"></span>
                        <span>View Employees</span>
                    </a>
                </li>

                <li>
                    <a href="../frontend/logout.php">
                        <span>Log Out</span>
                    </a>
                </li>
        </ul>
    </div>
</div>

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

                      echo "
                        <tr>
                          <td>".$row['staff_first_name']. " ".$row['staff_last_name']."</td>
                          <td>".$row['staff_id']."</td>
                          <td>".$row['hours_worked']."</td>

                          <td>".$row['salary']."</td>
                          <td>".$row['overtime_worked']."</td>

                          <td>".$row['pre_tax_income']."</td>
                          <td>".$row['post_tax_income']."</td>

                          <td>".$row['deductables']."</td>
                          <td>".$row['final_income']."</td>

                          <td>".$row['process_desc']."</td>



                         <td><a href='editTimesheet.php?timesheetID={$row['timesheet_id']}&processID={$row['process_id']}&payslipID={$row['payslip_id']}'>Edit</a</td>


                         <td><a href='deleteTimesheet.php?timesheetID={$row['timesheet_id']}'>Delete</a</td>
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
        