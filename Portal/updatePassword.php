<?php
require_once "inc/functions.php";
ini_set("session.save_path", "/home/unn_w17005084/sessionData"); //location of session data file, 
session_start();
echo checkLoggedInStatus();
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
        $conn = getDatabase();
        $id = $_SESSION['id'];

        $stmt = $conn->prepare("update hd_staff_users set staff_password = :newPwd where staff_id = " . $id);
        $params = ["newPwd" => $pwdHash];
    
        $result = $stmt->execute($params);

    
        if ($result) {
    
            require_once "inc/functions.php";
            echo makePageStart("Timesheet");
            echo createPageBody();
    
            $success = <<<UPLOADED
    
            <div class="upload_outer">
            <div class="upload_inner">
            <img class="upload_img" src="img/success.png" alt="success tick">
                <p>Thank you, your password has been successfully uploaded</p>
                <a href="dash.php"><button>Home</a></button>
                </div>
            </div>
    
UPLOADED;
            $success .= "\n";
            echo $success;
            echo createPageClose();
    
        } else {
            require_once "inc/functions.php";
        echo makePageStart("Timesheet");
        echo createPageBody();

        $success = <<<UPLOADED

        <div class="upload_outer">
        <div class="upload_inner">
        <img class="upload_img" src="img/failure.png" alt="failure tick">
            <p>Sorry, we have been unable to upload or make your changes, please try again.</p>
            <a href="dash.php"><button>Home</a></button>
            </div>
        </div>
UPLOADED;
        $success .= "\n";
        echo $success;
        echo createPageClose();
        }
    } else {
        header('Location: manageAccount.php');

    }

    

}






?>