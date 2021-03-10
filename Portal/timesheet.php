<?php

    require_once("inc/functions.php");
    echo makePageStart("Timesheet");
    echo createPageBody();
?>


    <div class="timesheetOuter">
        <div class="timesheetInner">
            <h1>Timesheet</h1>
                <div class="inputsOuter">
                    <form action="./uploadTimesheet.php" method="post">
                    <div class="inputsInner">
                    <label for="userID">User ID</label>
                    <input type="text" name="id" id="userID" placeholder="User ID"/>
                    </div>
                    <div class="inputsInner">
                    <label>Date</label>
                    <div class="inputDate">
                    <input type="text" name="day" id="day" placeholder="DD" maxlength="2"/>
                    <input type="text" name="month" id="month" placeholder="MM" maxlength="2"/>
                    <input type="text" name="year" id="year" placeholder="YY" maxlength="2"/>
                    </div>
                    </div>
                    <div class="inputsInner">
                    <label for="siteLocation">Site Location</label>
                    <input type="text" name="location" id="siteLocation" placeholder="Site Location"/>
                    </div>
                    <div class="inputsInner">
                    <label for="hoursWorked">Hours worked at location</label>
                    <input type="text" name="hours" id="hoursWorked" placeholder="Hours" maxlength="2"/>
                    </div>
                    <div class="inputsInner">
                    <label for="desc">Description of jobs completed</label>
                    <textarea name="desc" id="desc" placeholder="Please insert details of jobs completed here..."></textarea>
                    </div>
                    <div class="inputsInner">
                    <!-- <button class="submitBtn" type="submit">Submit</button> -->
                    <input type="submit" name="submit" class="submitBtn" />
                </div>
                    </form>
                </div>
        </div>
    </div>

<?php 

echo createPageClose();
?>