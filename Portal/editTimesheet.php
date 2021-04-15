<?php
require_once "inc/functions.php";
ini_set("session.save_path", "/home/unn_w17005084/sessionData"); //location of session data file, 
session_start();
    //Checking if user is logged in & their admin level
    //Redirects user to staff dash if they are not admin
    if(checkLogin()){

        if($_SESSION['adminLevel'] != '1'){
            header('Location: dash.php');
        }
        
    }else{//Redirecting user if they're not logged in
        header('Location: ../frontend/loginForm.php');

    }echo makePageStart("Vehicle Logs");
echo createPageBody();
echo adminNav(); 
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
                <?php


        
        $timesheet_id = filter_has_var(INPUT_GET, 'timesheetID') ? $_GET['timesheetID'] : null; 
        $process_id = filter_has_var(INPUT_GET, 'processID') ? $_GET['processID'] : null; 
        $payslip_id = filter_has_var(INPUT_GET, 'payslipID') ? $_GET['payslipID'] : null; 


        $myPDO  = getDatabase();
        $query  = $myPDO->query("SELECT *
        FROM hd_timesheet_responses
        WHERE timesheet_id =  '$timesheet_id'");
        
        
        while($row= $query->fetch(PDO::FETCH_ASSOC)){


            list($day,$month,$year)=explode("/", $row['Date']);


            echo "  <form action='updateTimesheet.php' method='get'>
                    <div class='inputsInner'>
                    <label for='timesheet_id'>timesheetID</label>
                    <input type='text' name='timesheet_id' id='timesheet_id' value='$timesheet_id' readonly/>
                    </div>

                    <div class='inputsInner'>
                    <label for='payslip_id'>PayslipID</label>
                    <input type='text' name='payslip_id' id='payslip_id' value='$payslip_id' readonly/>
                    </div>

                    <div class='inputsInner'>
                    <label for='userID'>User ID</label>
                    <input type='text' name='id' id='userID' placeholder='User ID*' value='{$row['staff_id']}' required/>
                    </div>
                    <div class='inputsInner'>
                    <label>Date</label>
                    <div class='inputDate'>
                    <input type='text' name='day' id='day' value='$day' placeholder='DD*' maxlength='2' required/>
                    <input type='text' name='month' id='month' value='$month' placeholder='MM*' maxlength='2' required/>
                    <input type='text' name='year' id='year' value='$year' placeholder='YY*' maxlength='2' required/>
                    </div>
                    </div>
                    <div class='inputsInner'>
                    <label for='siteLocation'>Site Location</label>
                    <input type='text' name='location' id='siteLocation' pattern='[a-zA-Z0-9\s]+' value='{$row['location']}' placeholder='Site Location*' required/>
                    </div>
                    <div class='inputsInner'>
                    <label for='hoursWorked'>Regular hours worked at location</label>
                    <input type='number' name='hours' id='hoursWorked' value='{$row['hours_worked']}' placeholder='Regular hours*' min='1' max='8' maxlength='2' required/>
                    </div>
                    <div class='inputsInner'>
                    <label for='hoursWorkedOvertime'>Overtime hours worked at location</label>
                    <input type='number' name='hoursOvertime' id='hoursWorkedOvertime' value='{$row['overtime_worked']}' min='1' max='8' placeholder='Overtime hours' maxlength='2'/>
                    </div>
                    <div class='inputsInner'>
                    <label for='desc'>Description of jobs completed</label>
                    <textarea name='desc' id='desc' placeholder='Please insert details of jobs completed here...*' pattern='[A-Za-z0-9\s]+ {1,440}' required>{$row['jobs_completed_desc']}</textarea>
                    </div>
        
                    <div class='inputsInner'>";

                    $process = $myPDO->query("SELECT process_id, process_desc from hd_payslip_process ORDER BY process_desc");
        
    
                      echo "<select name='process_id'>";
                      while ($processRecord = $process->fetch(PDO::FETCH_ASSOC)) {
                          
                          if ($process_id == $processRecord['process_id'] ) {
                              echo "<option value='{$processRecord['process_id']}' selected>
                              {$processRecord['process_desc']}</option>";
                          }
                          else { 
                              echo "<option value='{$processRecord['process_id']}'>{$processRecord['process_desc']}</option>";
                          }
                          }
                      echo "          </div>
                      </select> <br>";




                    echo"<div class='inputsInner'>
                    <input type='submit' name='submit' class='submitBtn' />
                </div>
                    </form>
                </div>";
        }
        ?>
                
        </div>

    </div>
            


    </main>
</div>
<?php 
        echo createPageClose(); 
?>