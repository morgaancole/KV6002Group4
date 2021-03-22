<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>
<?php
//using the $_GET the correct values from the selected event can be accessed and they are stored with variables
$deduction_id = filter_has_var(INPUT_GET, 'deductionID') ? $_GET['deductionID'] : null; 


$errors = false;


        //Connects to database
        $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
        //SQL update statement to update the content of the database with the changes the user just made
		$query  = $myPDO->query("DELETE  
                    FROM hd_deductions
                    WHERE deduction_id = '$deduction_id'");
        
        header("Location: deductions.php");
        die();

?>
</body>
</html>