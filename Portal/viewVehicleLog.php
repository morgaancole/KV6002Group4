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

        <main>
        <?php
        
        $staff_id = filter_has_var(INPUT_GET, 'staffID') ? $_GET['staffID'] : null; 
        $pay_id = filter_has_var(INPUT_GET, 'payID') ? $_GET['payID'] : null; 

        $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
        $query  = $myPDO->query("SELECT *
        FROM hd_staff_users
        WHERE staff_id = $staff_id");
        
        while($row= $query->fetch(PDO::FETCH_ASSOC)){

echo "
		<h1>Update Position: '{$row['staff_first_name']}' </h1>
		<form id='UpdateEmployee' action='updateEmployee.php' method='get'>
			<p>staff_id<input type='text' name='staff_id' value='$staff_id' readonly /></p>
			<p>staff_first_name<input type='text' name='staff_first_name' size='50' value='{$row['staff_first_name']}' required/></p>
            <p>staff_last_name<input type='text' name='staff_last_name' value='{$row['staff_last_name']}' required/></p>
            <p>staff_email<input type='text' name='staff_email' value='{$row['staff_email']}' required/></p>
            <p>staff_password <input type='text' name='staff_password' value='{$row['staff_password']}' required/> </p>
            <p>staff_address<input type='text' name='staff_address' value='{$row['staff_address']}' required/></p>
            <p>staff_postcode<input type='text' name='staff_postcode' value='{$row['staff_postcode']}' required/></p>";

            echo"Role <br>";
        
            $rsVenue = $myPDO->query("SELECT pay_id, pay_desc from hd_pay_categories ORDER BY pay_desc");


              echo "<select name='pay_id'>";
              while ($venueRecord = $rsVenue->fetch(PDO::FETCH_ASSOC)) {
                  
                  if ($pay_id == $venueRecord['pay_id'] ) {
                      echo "<option value='{$venueRecord['pay_id']}' selected>
                      {$venueRecord['pay_desc']}</option>";
                  }
                  else { 
                      echo "<option value='{$venueRecord['pay_id']}'>{$venueRecord['pay_desc']}</option>";
                  }
                  }
              echo "</select> <br>";


     
              echo " <p><input type='submit' name='submit' value='Update Employee'></p>
            </form>
        ";

        }
?>



        </main>

</div>
</body>
</html>
