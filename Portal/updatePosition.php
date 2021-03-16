<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>
<?php
//using the $_GET the correct values from the selected event can be accessed and they are stored with variables
$pay_id = filter_has_var(INPUT_GET, 'pay_id') ? $_GET['pay_id'] : null;
$pay_desc = filter_has_var(INPUT_GET, 'pay_desc') ? $_GET['pay_desc'] : null; 
$hourly_rate = filter_has_var(INPUT_GET, 'hourly_rate') ? $_GET['hourly_rate'] : null;



$errors = false;

//Variables are trimmed to get rid of white space at the start or the end
$pay_desc = trim($pay_desc);
$hourly_rate = trim($hourly_rate);


        //Connects to database
        $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
        //SQL update statement to update the content of the database with the changes the user just made
		$query  = $myPDO->query("UPDATE hd_pay_categories 
                    SET pay_desc = '$pay_desc', hourly_rate = '$hourly_rate'
                    WHERE pay_id = '$pay_id'");
        
        header("Location:position.php");
        die();

?>
</body>
</html>