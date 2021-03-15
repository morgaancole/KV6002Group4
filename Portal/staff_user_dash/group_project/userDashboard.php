<?php
require_once "inc/functions.php";
echo makePageStart("Timesheet");
echo createPageBody();
?>

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
                    <a href="userDashboard.php">
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
                    <a href="">
                        <span class="ti-book"></span>
                        <span>Payslip</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <span class="ti-settings"></span>
                        <span>View Account</span>
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
            <h2 class="dash-title">Employee Dashboard</h2>

          

            



        </main>
    </div>
    
    <?php

echo createPageClose();
?>