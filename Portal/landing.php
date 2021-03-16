<?php

    require_once("inc/functions.php");
    echo makePageStart("Landing page");
    echo createPageBody();
    echo createNav();
?>


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
            <h2 class="dash-title">Employee Dashboard</h2>

            <div class="landing_outer">
        <div class="landing_inner">
        <a href="vehiclelog.php"><button>Vehicle Logs</button></a>
            <a href="timesheet.php"><button>Timesheets</button></a>
            <a href="#"><button>Payslips</button></a>
        </div>
    </div>

            



        </main>
    </div>


    


<?php 

echo createPageClose();
?>


