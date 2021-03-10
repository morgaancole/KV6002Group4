<?php
//Sets the session so the user can login and out on this page
ini_set("session.save_path", "/home/unn_w18011589/sessionData");
session_start(); 
?>

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



$errors = false;

//Variables are trimmed to get rid of white space at the start or the end
$staff_first_name = trim($staff_first_name);
$staff_last_name = trim($staff_last_name);


        //Connects to database
        $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
        //SQL update statement to update the content of the database with the changes the user just made
		$query  = $myPDO->query("UPDATE hd_staff_users 
                    SET staff_first_name = '$staff_first_name', staff_last_name = '$staff_last_name'
                    WHERE staff_id = '$staff_id'");
        
        header("Location: http://unn-w18011589.newnumyspace.co.uk/KV6002/adminDashboard.php");
        die();

?>
</body>
</html>