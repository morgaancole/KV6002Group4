<?php

if (isset($_POST['submit'])) {
    handleUpload();
}

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

    $conn = makeConnection();
    $stmt = $conn->prepare("INSERT INTO hd_vehicle_log_responses (staff_id, current_mileage, any_issues, response_date, vehicle_reg)
        VALUES (:id, :milage, :issues, :date, :reg) ");
    $params = ["id" => $sanitizedId, "milage" => $sanitizedMilage, "issues" => $sanitizedIssues, "date" => $date, "reg" => $sanitizedReg];
    $result = $stmt->execute($params);

    if ($result) {

        require_once "inc/functions.php";
        echo makePageStart("Timesheet");
        echo createPageBody();

        $success = <<<UPLOADED

        <div class="success_outer">
        <div class="success_inner">
        <img class="success_img" src="img/success.png" alt="success tick">
            <p>Thank you, your vehicle log has been successfully uploaded</p>
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
