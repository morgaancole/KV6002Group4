<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>
<?php
//using the $_GET the correct values from the selected event can be accessed and they are stored with variables
$timesheet_id = filter_has_var(INPUT_GET, 'timesheetID') ? $_GET['timesheetID'] : null; 


$errors = false;


        //Connects to database
        $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
        //SQL update statement to update the content of the database with the changes the user just made
		$query  = $myPDO->query("DELETE  
                    FROM hd_payslips
                    WHERE timesheet_id = '$timesheet_id'");
        
        header("Location: payroll.php");
        die();

?>
</body>
</html>