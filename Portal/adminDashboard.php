<?php
 ini_set("session.save_path", "/home/unn_w17005084/sessionData"); //location of session data file, 
 session_start(); 
 require_once("inc/functions.php");

//Session data path needs to change for demo

/*
*Page for admin users to view applications sent in from frontend
*@author - Morgan Wheatman
*/
    require_once("inc/functions.php");

    //Checking if user is logged in & their admin level
    //Redirects user to staff dash if they are not admin
    if(checkLogin()){

        if($_SESSION['adminLevel'] != '1'){
            header('Location: dash.php');
        }
        
    }else{//Redirecting user if they're not logged in
        header('Location: ../frontend/loginForm.php');

    }
    echo makePageStart("Henderson Building Contractors"); 
    echo  createPageBody();
    echo adminNav(); 
?>

<!-- Admim Dashboard 
@author - Nicholas Coyles-->
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
            <h2 class="dash-title">Admin Dashboard</h2>
            
            <!--Links to parts of the portal-->
            <div class="dash-cards">
                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-briefcase"></span>
                        <div>
                            <h5>Manage Employees</h5>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="viewEmployees.php">View all</a>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-briefcase"></span>
                        <div>
                            <h5>View Vehicle logs</h5>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="vehicleLogs.php">View all</a>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-briefcase"></span>
                        <div>
                            <h5>View Payroll</h5>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="payroll.php">View all</a>
                    </div>
                </div>


            </div>
            <!--Data from the database to be displayed on the dashboard-->
            <section class="recent">
                <div class="activity-grid">
                   <div class="summary">
                        <div class="summary-card">
                            <div class="summary-single">
                                <span class="ti-id-badge"></span>
                                <div>
                                <!--Total amount of employees -->
                                    <h5>  <?php $myPDO  = getDatabase();  
                                    $query  = $myPDO->query("SELECT count(*)
                                    FROM hd_staff_users");
                                    while($row = $query->fetch(PDO::FETCH_ASSOC)){
                                        echo $row['count(*)'];
                                    }
                                    ?>
                                    </h5>

                                    <small>Number of Employees</small>
                                </div>
                                </div>
                                <div class="summary-single">
                                    <span class="ti-calendar"></span>
                                    <div>
                                        <h5>
                                        <!--Total number of timesheets submitted-->
                                        <?php $myPDO  = getDatabase();  
                                    $query  = $myPDO->query("SELECT count(*)
                                    FROM hd_timesheet_responses");
                                    while($row = $query->fetch(PDO::FETCH_ASSOC)){ 
                                        echo $row['count(*)'];
                                    }
                                    ?>
                                        
                                        </h5>
                                        <small>Number of timesheets</small>
                                    </div>
                                </div>

                                <div class="summary-single">
                                    <span class="ti-calendar"></span>
                                    <div>
                                        <h5>
                                        <!--Total number of vehicle logs submitted-->

                                        <?php $myPDO  = getDatabase();  
                                    $query  = $myPDO->query("SELECT count(*)
                                    FROM hd_vehicle_log_responses");
                                    while($row = $query->fetch(PDO::FETCH_ASSOC)){ 
                                        echo $row['count(*)'];
                                    }
                                    ?>
                                        </h5>
                                        <small>Number of vehicle logs</small>
                                    </div>
                                </div>

                        </div>
                    </div>
            </section>
        </main>
    </div>
    <?php 
        echo createPageClose(); 
?>