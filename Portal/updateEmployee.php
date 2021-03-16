<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>
<?php
//using the $_GET the correct values from the selected event can be accessed and they are stored with variables
$staff_id = filter_has_var(INPUT_GET, 'staff_id') ? $_GET['staff_id'] : null;
$staff_first_name = filter_has_var(INPUT_GET, 'staff_first_name') ? $_GET['staff_first_name'] : null; 
$staff_last_name = filter_has_var(INPUT_GET, 'staff_last_name') ? $_GET['staff_last_name'] : null;
$staff_email = filter_has_var(INPUT_GET, 'staff_email') ? $_GET['staff_email'] : null;
$staff_password  = filter_has_var(INPUT_GET, 'staff_password') ? $_GET['staff_password'] : null;
$staff_address = filter_has_var(INPUT_GET, 'staff_address') ? $_GET['staff_address'] : null;
$staff_postcode = filter_has_var(INPUT_GET, 'staff_postcode') ? $_GET['staff_postcode'] : null;
$pay_id = filter_has_var(INPUT_GET, 'pay_id') ? $_GET['pay_id'] : null;



        //Connects to database
        $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
        //SQL update statement to update the content of the database with the changes the user just made
		$query  = $myPDO->query("UPDATE hd_staff_users 
                    SET staff_first_name = '$staff_first_name', staff_last_name = '$staff_last_name',staff_email = '$staff_email',
                    staff_password = '$staff_password', staff_address = '$staff_address',staff_postcode = '$staff_postcode',pay_id ='$pay_id'
                    WHERE staff_id = '$staff_id'");
        
        header("Location: viewEmployees.php");
        die();

?>
</body>
</html>