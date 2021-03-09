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
                <a href="">
                    <span class="ti-time"></span>
                    <span>Timeshet</span>
                </a>
            </li>


            <li>
                <a href="">
                    <span class="ti-book"></span>
                    <span>Vehicle Logs</span>
                </a>
            </li>

            <li>
                    <a href="createEmployee.php">
                        <span class="ti-settings"></span>
                        <span>Create Employee</span>
                    </a>
                </li>

                <li>
                    <a href="viewEmployees.php">
                        <span class="ti-settings"></span>
                        <span>View Employees</span>
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


    <form action="createEmployee.php" method="post" enctype="multipart/form-data">
    
        <table align="center" width="1000">
            <tr>
                <td><h2>Create New Employee</h2></td>
            </tr>
            
            <tr>
                <td>First Name:</td>
                <td><input type="text" name="staff_first_name" size="60" required/></td>
            </tr>

            <tr>
                <td>Second Name:</td>
                <td><input type="text" name="staff_last_name" size="60" required/></td>
            </tr>

            <tr>
                <td>Staff Email:</td>
                <td><input type="email" name="staff_email" size="60" required/></td>
            </tr>

            <tr>
                <td>Password:</td>
                <td><input type="text" name="staff_password" value=<?php echo randomPassword();?> size="60" required /></td>
            </tr>

            <td>Staff address:</td>
                <td><input type="text" name="staff_address" size="60" required/></td>
            </tr>

            <td>Staff postcode:</td>
                <td><input type="text" name="staff_postcode" size="60" required/></td>
            </tr>
        
            <tr>
                <td><input type="submit" name="insert_employee" value="Create Employee"></td>
            </tr>
        </table>
    </form>
    </main>

</div>

</body>
</html>

<?php

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


$myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  

if(isset($_POST['insert_employee'])){

$staff_first_name = $_POST['staff_first_name'];
$staff_last_name = $_POST['staff_last_name'];
$staff_email = $_POST['staff_email'];
$staff_password = $_POST['staff_password'];
$staff_address = $_POST['staff_address'];
$staff_postcode = $_POST['staff_postcode'];


$query  = $myPDO->query("INSERT INTO hd_staff_users(staff_first_name,staff_last_name,staff_email,staff_password,staff_address,staff_postcode) VALUES('$staff_first_name','$staff_last_name','$staff_email','$staff_password','$staff_address','$staff_postcode')");
       
}

?>