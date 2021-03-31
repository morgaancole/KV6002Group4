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

    <div class="box">
            <div class="box-header with-border">
              <a href="createDeduction.php"><i class="fa fa-plus"></i>Create New Deduction</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Deduction Name</th>
                  <th>Amount</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
                $query = $myPDO->query("SELECT * FROM hd_deductions");

                while($row= $query->fetch(PDO::FETCH_ASSOC)){

                      echo "
                        <tr>
                          <td>".$row['deduction_name']."</td>
                          <td>".number_format($row['deduction_amount'], 2)."</td>
                        
                          <td><a href='editDeduction.php?deductionID={$row['deduction_id']}'>Edit</a</td>
                          <td><a href='deleteDeduction.php?deductionID={$row['deduction_id']}'>Delete</a</td>

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
</body>
</html>
        



