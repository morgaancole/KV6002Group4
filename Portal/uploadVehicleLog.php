<?php
require_once "inc/functions.php";
ini_set("session.save_path", "/home/unn_w17005084/sessionData"); //location of session data file, 
session_start();
echo checkLoggedInStatus();
if (isset($_POST['submit'])) {
    handleUpload();
}

/**
 * Method handleUpload sanitizes and uploads posted data to the vehicle log table
 * 
 * PHP version 5.6
 *
 * @author Liam Davison
 */
function handleUpload()
{

    $id = $_POST['id'];
    $sanitizedId = sanitizeInput($id);

    $day = $_POST['day'];
    $sanitizedDay = sanitizeInput($day);

    $month = $_POST['month'];
    $sanitizedMonth = sanitizeInput($month);

    $year = $_POST['year'];
    $sanitizedYear = sanitizeInput($year);

    $date = $day . "/" . $month . "/" . $year;

    $reg = $_POST['reg'];
    $sanitizedReg = sanitizeInput($reg);

    $milage = $_POST['milage'];
    $sanitizedMilage = sanitizeInput($milage);

    $issues = $_POST['issues'];
    $sanitizedIssues = sanitizeInput($issues);

    $conn = getDatabase();
    $stmt = $conn->prepare("INSERT INTO hd_vehicle_log_responses (staff_id, current_mileage, any_issues, response_date, vehicle_reg)
        VALUES (:id, :milage, :issues, :date, :reg) ");
    $params = ["id" => $sanitizedId, "milage" => $sanitizedMilage, "issues" => $sanitizedIssues, "date" => $date, "reg" => $sanitizedReg];
    $result = $stmt->execute($params);

    if ($result) {

        require_once "inc/functions.php";
        echo makePageStart("Timesheet");
        echo createPageBody();

        $success = <<<UPLOADED

        <div class="upload_outer">
        <div class="upload_inner">
        <img class="upload_img" src="img/success.png" alt="success tick">
            <p>Thank you, your vehicle log has been successfully uploaded</p>
            <a href="dash.php"><button>Home</button></a>
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
            <a href="dash.php"><button>Home</button></a>
            </div>
        </div>

UPLOADED;
        $success .= "\n";
        echo $success;
        echo createPageClose();
    }

}


