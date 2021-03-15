<?php


if (isset($_POST['submit'])) {
    handlePwdChange();
}

function handlePwdChange() {

    $password = $_POST['password'];
    $sanitizedPwd = sanitizeInput($password);
    
    $passwordRepeat = $_POST['passwordRepeat'];
    $sanitizedPwdRepeat = sanitizeInput($passwordRepeat);

    

    if(!empty($sanitizedPwd) && !empty($sanitizedPwdRepeat) && $sanitizedPwd == $sanitizedPwdRepeat) {
        $pwdHash = password_hash($sanitizedPwd, PASSWORD_DEFAULT);
        $conn = makeConnection();
        $stmt = $conn->prepare("update hd_staff_users set staff_password = :newPwd where staff_id = 1");
        $params = ["newPwd" => $pwdHash];
    
        $result = $stmt->execute($params);
    
        if ($result) {
    
            require_once "inc/functions.php";
            echo makePageStart("Timesheet");
            echo createPageBody();
    
            $success = <<<UPLOADED
    
            <div class="success_outer">
            <div class="success_inner">
            <img class="success_img" src="img/success.png" alt="success tick">
                <p>Thank you, your password has been successfully uploaded</p>
                <a href="http://192.168.64.2/group_project/dash.php"><button>Home</a></button>
                </div>
            </div>
    
    UPLOADED;
            $success .= "\n";
            echo $success;
            echo createPageClose();
    
        } else {
            echo "not submitted";
        }
    } else {
        header('Location:http://192.168.64.2/group_project/manageAccount.php?incorrectDetails ');
    }

    

}


function makeConnection()
{
    //this has been changed from ./ to ../ in order to work with the project files
    //github, will need to be changed back for when i am testing
    $pdo = new PDO('sqlite:./DB/hendersonDB.sqlite');
    return $pdo;
}

function sanitizeInput($val)
{
    $santiseVal = htmlspecialchars($val);
    $santiseVal = trim($santiseVal);
    $santiseVal = stripslashes($santiseVal);
    return $santiseVal;
}




?>