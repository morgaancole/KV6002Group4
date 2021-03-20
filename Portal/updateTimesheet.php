<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>
<?php
//using the $_GET the correct values from the selected event can be accessed and they are stored with variables
$timesheet_id = filter_has_var(INPUT_GET, 'timesheet_id') ? $_GET['timesheet_id'] : null;
$id = filter_has_var(INPUT_GET, 'id') ? $_GET['id'] : null;
$day = filter_has_var(INPUT_GET, 'day') ? $_GET['day'] : null; 
$month = filter_has_var(INPUT_GET, 'month') ? $_GET['month'] : null;
$year = filter_has_var(INPUT_GET, 'year') ? $_GET['year'] : null; 
$location = filter_has_var(INPUT_GET, 'location') ? $_GET['location'] : null; 
$hours = filter_has_var(INPUT_GET, 'hours') ? $_GET['hours'] : null; 
$hoursOvertime = filter_has_var(INPUT_GET, 'hoursOvertime') ? $_GET['hoursOvertime'] : null; 
$desc = filter_has_var(INPUT_GET, 'desc') ? $_GET['desc'] : null; 


$date = $day . "/" . $month . "/" . $year;


        //Connects to database
        $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
        //SQL update statement to update the content of the database with the changes the user just made
		$query  = $myPDO->query("UPDATE hd_timesheet_responses 
        SET Date = '$date', location = '$location', hours_worked = '$hours',jobs_completed_desc = '$desc', overtime_worked = '$hoursOvertime'
        WHERE timesheet_id = '$timesheet_id'");

if($query) {
    require_once "inc/functions.php";
    echo makePageStart("Timesheet");
    echo createPageBody();

    $success = <<<UPLOADED

    <div class="success_outer">
    <div class="success_inner">
    <img class="success_img" src="img/success.png" alt="success tick">
        <p>Payslip Updated</p>
        <a href="payroll.php"><button>Back to Payroll</a></button>
        </div>
    </div>

UPLOADED;
    $success .= "\n";
    echo $success;
    echo createPageClose();
} 

?>
</body>
</html>