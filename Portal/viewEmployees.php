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
        $myPDO  = new PDO('sqlite:/home/unn_w18011589/public_html/KV6002/DB/hendersonDB.sqlite');  
        $query  = $myPDO->query("SELECT staff_id,staff_first_name, staff_last_name
        FROM hd_staff_users");
        
        while($row = $query->fetch(PDO::FETCH_ASSOC)){ 

        ?>




      
        <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <h3>Employee's</h3>

                        <div class="table-responsive">

                            <table>
                                <thead>
                                    <tr>
                                        <th>Staff ID:</th>
                                        <th>First Name:</th>
                                        <th>Second Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $row['staff_id']; ?></td>
                                        <td><?php echo $row['staff_first_name']; ?></td>
                                        <td><?php echo $row['staff_last_name']; ?></td>
                                        <?php echo "<td><a href='viewEmployee.php?staffID={$row['staff_id']}'>Select</a</td>";?>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

            </section>

            <?php } ?>



        </main>

</div>
</body>
</html>
