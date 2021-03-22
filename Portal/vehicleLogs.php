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


    <table>
			<thead>
				<tr>
					<th>Log Id</th>
					<th>Staff Id </th>
                    <th>current Mileage</th>
                    <th>Issues</th>
                    <th>Response date</th>
                    <th>Vehicle Reg</th>
				</tr>
			</thead>
			<tbody>
				<?php
                
                $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
                $query = $myPDO->query("SELECT *
                FROM hd_vehicle_log_responses
                order by log_id ");

 					while($row= $query->fetch(PDO::FETCH_ASSOC)){
				 
                        echo "
                        <tr>
                          <td>".$row['log_id']."</td>
                          <td>".$row['staff_id']."</td>
                          <td>".$row['current_mileage']."</td>
                          <td>".$row['any_issues']."</td>
                          <td>".$row['response_date']."</td>
                          <td>".$row['vehicle_reg']."</td>
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
