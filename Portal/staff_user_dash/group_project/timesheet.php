<?php
require_once "inc/functions.php";
echo makePageStart("Timesheet");
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
            <h2 class="dash-title">Timesheet form</h2>
            <p class="italic">Please note all fields marked with an asterisk (*) are required</p>

            <div class="timesheetOuter">
        <div class="timesheetInner">
           
                <div class="inputsOuter">
                    <form action="./uploadTimesheet.php" method="post">
                    <div class="inputsInner">
                    <label for="userID">User ID</label>
                    <input type="text" name="id" id="userID" placeholder="User ID*" required/>
                    </div>
                    <div class="inputsInner">
                    <label>Date</label>
                    <div class="inputDate">
                    <input type="text" name="day" id="day" placeholder="DD*" maxlength="2" required/>
                    <input type="text" name="month" id="month" placeholder="MM*" maxlength="2" required/>
                    <input type="text" name="year" id="year" placeholder="YY*" maxlength="2" required/>
                    </div>
                    </div>
                    <div class="inputsInner">
                    <label for="siteLocation">Site Location</label>
                    <input type="text" name="location" id="siteLocation" placeholder="Site Location*" required/>
                    </div>
                    <div class="inputsInner">
                    <label for="hoursWorked">Regular hours worked at location</label>
                    <input type="text" name="hours" id="hoursWorked" placeholder="Regular hours*" maxlength="2" required/>
                    </div>
                    <div class="inputsInner">
                    <label for="hoursWorkedOvertime">Overtime hours worked at location</label>
                    <input type="text" name="hoursOvertime" id="hoursWorkedOvertime" placeholder="Overtime hours" maxlength="2"/>
                    </div>
                    <div class="inputsInner">
                    <label for="desc">Description of jobs completed</label>
                    <textarea name="desc" id="desc" placeholder="Please insert details of jobs completed here...*" required></textarea>
                    </div>
                    <div class="inputsInner">
                    <input type="submit" name="submit" class="submitBtn" />
                </div>
                    </form>
                </div>
                
        </div>

    </div>
            



        </main>
    </div>


   



<?php

echo createPageClose();
?>