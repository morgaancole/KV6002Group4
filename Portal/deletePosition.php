<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>
<?php
//using the $_GET the correct values from the selected event can be accessed and they are stored with variables
$pay_id = filter_has_var(INPUT_GET, 'payID') ? $_GET['payID'] : null;


$errors = false;


        //Connects to database
        $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
        //SQL update statement to update the content of the database with the changes the user just made
		$query  = $myPDO->query("DELETE  
                    FROM hd_pay_categories
                    WHERE pay_id = '$pay_id'");
        
        header("Location: position.php");
        die();

?>
</body>
</html>