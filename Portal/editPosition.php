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
        
        $pay_id = filter_has_var(INPUT_GET, 'payID') ? $_GET['payID'] : null; 

        $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
        $query  = $myPDO->query("SELECT *
        FROM hd_pay_categories
        WHERE pay_id = $pay_id");
        
        while($row= $query->fetch(PDO::FETCH_ASSOC)){

echo "
		<h1>Update Position: '{$row['pay_desc']}' </h1>
		<form id='UpdatePosition' action='updatePosition.php' method='get'>
			<p>pay_id<input type='text' name='pay_id' value='$pay_id' readonly /></p>
			<p>pay_desc<input type='text' name='pay_desc' size='50' value='{$row['pay_desc']}' required/></p>
            <p>hourly_rate<input type='text' name='hourly_rate' value='{$row['hourly_rate']}' required/></p>


            <p><input type='submit' name='submit' value='Update Position'></p>
            </form>
        ";
        }
?>
    </main>
</div>
</body>
</html>
        




