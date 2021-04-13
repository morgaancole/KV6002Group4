<?php
require_once "inc/functions.php";
ini_set("session.save_path", "/home/unn_w17005084/sessionData"); //location of session data file, 
session_start();
echo checkLoggedInStatus();
if (isset($_POST['submit'])) {
    handleDetailsChange();
}

function handleDetailsChange()
{

    $firstName = sanitizeInput($_POST['first']);
    $lastName = sanitizeInput($_POST['last']);
    $email = sanitizeInput($_POST['email']);

    $address = sanitizeInput($_POST['address']);

    $postcode = sanitizeInput($_POST['postcode']);

    $conn = getDatabase();

    $id = $_SESSION['id'];


    if (!empty($firstName)) {
        $stmt = $conn->prepare("UPDATE hd_staff_users set staff_first_name = :newFirst where staff_id = " . $id);
        $params = ["newFirst" => $firstName];
        $result = $stmt->execute($params);
    }

    if (!empty($lastName)) {
        $stmt = $conn->prepare("UPDATE hd_staff_users set staff_last_name = :newLast where staff_id = " . $id);
        $params = ["newLast" => $lastName];
        $result = $stmt->execute($params);
    }

    if (!empty($email)) {
        $stmt = $conn->prepare("UPDATE hd_staff_users set staff_email = :newEmail where staff_id = " . $id);
        $params = ["newEmail" => $email];
        $result = $stmt->execute($params);
    }

    if (!empty($address)) {
        $stmt = $conn->prepare("UPDATE hd_staff_users set staff_address = :newAddress where staff_id = " . $id);
        $params = ["newAddress" => $address];
        $result = $stmt->execute($params);
    }

    if (!empty($postcode)) {
        $stmt = $conn->prepare("UPDATE hd_staff_users set staff_postcode = :newPostcode where staff_id = " . $id);
        $params = ["newPostcode" => $postcode];
        $result = $stmt->execute($params);
    }

    if ($result) {
        require_once "inc/functions.php";
        echo makePageStart("Timesheet");
        echo createPageBody();

        $success = <<<UPLOADED

        <div class="upload_outer">
        <div class="upload_inner">
        <img class="upload_img" src="img/success.png" alt="success tick">
            <p>Thank you, your personal details have been successfuly updated</p>
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

}
