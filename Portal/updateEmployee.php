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

    }echo makePageStart("");
echo createPageBody();
echo adminNav(); 
?>
<!--@author Nicholas Coyles -->


<?php
$staff_id = filter_has_var(INPUT_GET, 'staff_id') ? $_GET['staff_id'] : null;
$staff_first_name = filter_has_var(INPUT_GET, 'staff_first_name') ? $_GET['staff_first_name'] : null; 
$staff_last_name = filter_has_var(INPUT_GET, 'staff_last_name') ? $_GET['staff_last_name'] : null;
$staff_email = filter_has_var(INPUT_GET, 'staff_email') ? $_GET['staff_email'] : null;
$staff_address = filter_has_var(INPUT_GET, 'staff_address') ? $_GET['staff_address'] : null;
$staff_postcode = filter_has_var(INPUT_GET, 'staff_postcode') ? $_GET['staff_postcode'] : null;
$pay_id = filter_has_var(INPUT_GET, 'pay_id') ? $_GET['pay_id'] : null;

//Variables are sanitizes
$staff_first_name = sanitizeInput($staff_first_name);
$staff_first_name = strtolower($staff_first_name);
$staff_first_name = ucfirst($staff_first_name);

$staff_last_name = sanitizeInput($staff_last_name);
$staff_last_name = strtolower($staff_last_name);
$staff_last_name = ucfirst($staff_last_name);

$staff_email = sanitizeInput($staff_email);
$staff_address = sanitizeInput($staff_address);
$staff_postcode = sanitizeInput($staff_postcode);

/**Duplicate user check */
$myPDO  = getDatabase();

$check_users  = $myPDO->query("SELECT date_of_birth,staff_last_name,staff_id
FROM hd_staff_users
WHERE staff_last_name ='$staff_last_name' and NOT staff_id = '$staff_id'");

/**Duplicate email check*/
$check_email  = $myPDO->query("SELECT staff_email,staff_id
FROM hd_staff_users
WHERE NOT staff_id = '$staff_id'");

$duplicateUser = false;
$duplicateEmail = false;

while($row= $check_users->fetch(PDO::FETCH_ASSOC)){
$date_of_birth = $row['date_of_birth'];

//Checks for users with the same last name and date of birth
if($row['date_of_birth'] == $date_of_birth && $row['staff_last_name'] == $staff_last_name ){
    $duplicateUser = true; 

    require_once "inc/functions.php";
    echo makePageStart("Employees");
    echo createPageBody();

    $success = <<<UPLOADED

    <div class="upload_outer">
    <div class="upload_inner">
    <img class="upload_img" src="img/failure.png" alt="failure tick">
        <p>Sorry, can't change name. User already exists with same last name and date of birth</p>
        <a href="viewEmployees.php"><button>Back</a></button>
        </div>
    </div>

UPLOADED;
    $success .= "\n";
    echo $success;
    echo createPageClose();

;
}
}

while($row= $check_email->fetch(PDO::FETCH_ASSOC)){
    if($row['staff_email'] == $staff_email){
        $duplicateEmail = true;

    require_once "inc/functions.php";
    echo makePageStart("Employees");
    echo createPageBody();

    $success = <<<UPLOADED

    <div class="upload_outer">
    <div class="upload_inner">
    <img class="upload_img" src="img/failure.png" alt="failure tick">
        <p>Sorry, can't update email. User already exists with same email</p>
        <a href="viewEmployees.php"><button>Back</a></button>
        </div>
    </div>

UPLOADED;
    $success .= "\n";
    echo $success;
    echo createPageClose();


;
    }
    }


if($duplicateUser == false && $duplicateEmail == false){

        //Connects to database
        $myPDO  = getDatabase();
        //employee updated
		$query  = $myPDO->query("UPDATE hd_staff_users 
                    SET staff_first_name = '$staff_first_name', staff_last_name = '$staff_last_name',staff_email = '$staff_email', staff_address = '$staff_address',staff_postcode = '$staff_postcode',pay_id ='$pay_id'
                    WHERE staff_id = '$staff_id'");
        //redirect to employee page

        require_once "inc/functions.php";
        echo makePageStart("Timesheet");
        echo createPageBody();
    
        $success = <<<UPLOADED
    
        <div class="upload_outer">
        <div class="upload_inner">
        <img class="upload_img" src="img/success.png" alt="success tick">
            <p>User successfully updated</p>
            <a href="viewEmployees.php"><button>Employee list</button></a>
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