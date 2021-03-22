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

    <?php
        
        $deduction_id = filter_has_var(INPUT_GET, 'deductionID') ? $_GET['deductionID'] : null; 

        $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
        $query  = $myPDO->query("SELECT *
        FROM hd_deductions
        WHERE deduction_id = $deduction_id");
        
        while($row= $query->fetch(PDO::FETCH_ASSOC)){

echo "
		<h1>Update Position: '{$row['deduction_name']}' </h1>
		<form id='UpdateDeduction' action='updateDeduction.php' method='get'>
			<p>deduction_id<input type='text' name='deduction_id' value='$deduction_id' readonly /></p>
			<p>deduction_name<input type='text' name='deduction_name' size='50' value='{$row['deduction_name']}' required/></p>
            <p>deduction_amount<input type='text' name='deduction_amount' value='{$row['deduction_amount']}' required/></p>


            <p><input type='submit' name='submit' value='Update Deduction'></p>
            </form>
        ";
        }
?>
    </main>
</div>
</body>
</html>
        




