<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>
<?php
//using the $_GET the correct values from the selected event can be accessed and they are stored with variables
$staff_id = filter_has_var(INPUT_GET, 'staffID') ? $_GET['staffID'] : null; 


$errors = false;


        //Connects to database
        $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
        //SQL update statement to update the content of the database with the changes the user just made
		$query  = $myPDO->query("DELETE  
                    FROM hd_staff_users
                    WHERE staff_id = '$staff_id'");
        
        header("Location: viewEmployees.php");
        die();

?>
</body>
</html>