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
        <?php
        
        $staffID = filter_has_var(INPUT_GET, 'staffID') ? $_GET['staffID'] : null; 

        $myPDO  = new PDO('sqlite:/home/unn_w18011589/public_html/KV6002/DB/hendersonDB.sqlite');  
        $query  = $myPDO->query("SELECT staff_id,staff_first_name, staff_last_name
        FROM hd_staff_users
        WHERE staff_id = $staffID");
        
        while($row = $query->fetch(PDO::FETCH_ASSOC)){ 

echo "
		<h1>Update '{$row['staff_first_name']}'</h1>
		<form id='UpdateEvent' action='updateEmployee.php' method='get'>
			<p>Employee ID <input type='text' name='staff_id' value='$staffID' readonly /></p>
			<p>First name <input type='text' name='staff_first_name' size='50' value='{$row['staff_first_name']}' required/></p>
            <p>Last name <input type='text' name='staff_last_name' value='{$row['staff_last_name']}' required/></p>


            <p><input type='submit' name='submit' value='Update Employee'></p>
            </form>
        ";
        }
        ?>



        </main>

</div>
</body>
</html>
