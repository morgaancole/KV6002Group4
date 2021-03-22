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

    <div class="box-header with-border">
        <a href="position.php"><i class="fa fa-plus"></i> Back</a>
    </div>

    <form action="createDeduction.php" method="post" enctype="multipart/form-data">
    
        <table align="center" width="1000">
            <tr>
                <td><h2>Create New Deduction</h2></td>
            </tr>
            
            <tr>
                <td>Deduction:</td>
                <td><input type="text" name="deduction_name" size="60" required/></td>
            </tr>

            <tr>
                <td>Deduction Amount:</td>
                <td><input type="text" name="deduction_amount" size="60" required/></td>
            </tr>

            <tr>
                <td><input type="submit" name="insert_deduction" value="Submit"></td>
            </tr>
        </table>
    </form>

    
    </main>
</div>
</body>
</html>
        

<?php

$myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  

if(isset($_POST['insert_deduction'])){

$deduction_name = $_POST['deduction_name'];
$deduction_amount = $_POST['deduction_amount'];


$query  = $myPDO->query("INSERT INTO hd_deductions(deduction_name,deduction_amount) VALUES('$deduction_name','$deduction_amount')");
       
header("Location: deductions.php");
die();
}

?>