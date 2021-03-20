<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
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
            <h2 class="dash-title">Timesheet form</h2>
            <p class="italic">Please note all fields marked with an asterisk (*) are required</p>

            <div class="timesheetOuter">
        <div class="timesheetInner">
           
                <div class="inputsOuter">
                <?php


        
        $timesheet_id = filter_has_var(INPUT_GET, 'timesheetID') ? $_GET['timesheetID'] : null; 

        $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
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
                    <input type='text' name='location' id='siteLocation' value='{$row['location']}' placeholder='Site Location*' required/>
                    </div>
                    <div class='inputsInner'>
                    <label for='hoursWorked'>Regular hours worked at location</label>
                    <input type='text' name='hours' id='hoursWorked' value='{$row['hours_worked']}' placeholder='Regular hours*' maxlength='2' required/>
                    </div>
                    <div class='inputsInner'>
                    <label for='hoursWorkedOvertime'>Overtime hours worked at location</label>
                    <input type='text' name='hoursOvertime' id='hoursWorkedOvertime' value='{$row['overtime_worked']}' placeholder='Overtime hours' maxlength='2'/>
                    </div>
                    <div class='inputsInner'>
                    <label for='desc'>Description of jobs completed</label>
                    <textarea name='desc' id='desc' placeholder='Please insert details of jobs completed here...*'  required>{$row['jobs_completed_desc']}</textarea>
                    </div>";
        
                    $rsVenue = $myPDO->query("SELECT process_id, process_desc from hd_payslip_process ORDER BY process_desc");
        
        
                      echo "<select name='process_id'>";
                      while ($venueRecord = $rsVenue->fetch(PDO::FETCH_ASSOC)) {
                          
                          if ($process_id == $venueRecord['process_id'] ) {
                              echo "<option value='{$venueRecord['process_id']}' selected>
                              {$venueRecord['process_desc']}</option>";
                          }
                          else { 
                              echo "<option value='{$venueRecord['process_id']}'>{$venueRecord['process_desc']}</option>";
                          }
                          }
                      echo "</select> <br>";




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
</body>
</html>