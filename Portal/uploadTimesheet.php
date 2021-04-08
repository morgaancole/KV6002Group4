<?php
require_once "inc/functions.php";
ini_set("session.save_path", "/home/unn_w18010282/sessionData"); //location of session data file, 
session_start();
echo checkLoggedInStatus();
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

    $location = $_POST['location'];
    $sanitizedLocation = sanitizeInput($location);

    $hours = $_POST['hours'];
    $sanitizedHours = sanitizeInput($hours);

    $hoursOvertime = $_POST['hoursOvertime'];
    $sanitizedHoursOver = sanitizeInput($hoursOvertime);

    $desc = $_POST['desc'];
    $sanitizedDesc = sanitizeInput($desc);

    $timesheetID = generateRandomId();


    


    $conn = makeConnection();
    $stmt = $conn->prepare("INSERT INTO hd_timesheet_responses (timesheet_id, staff_id, Date, location, hours_worked, jobs_completed_desc, overtime_worked)
        VALUES( :tid ,:id, :date, :location, :hoursworked, :desc, :overTime)");
    $params = ["tid" => $timesheetID, "id" => $sanitizedId, "date" => $date, "location" => $sanitizedLocation, "hoursworked" => $sanitizedHours, "desc" => $sanitizedDesc, "overTime" => $sanitizedHoursOver];
    
    $result = $stmt->execute($params);

    


    if ($result) {
        $stmt = $conn->prepare("select hourly_rate, staff_first_name from hd_staff_users join hd_pay_categories on (hd_staff_users.pay_id = hd_pay_categories.pay_id) where staff_id = $sanitizedId");
        $params = [];

        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // echo $result['hourly_rate'];

        $hourlyRate = $result['hourly_rate'];
        $hourlyRateOvertime = $result['hourly_rate'] * 2;

        $salaryReg = $sanitizedHours * $hourlyRate;
        $salaryOvertime = $sanitizedHoursOver * $hourlyRateOvertime;

        $preTax = $salaryReg + $salaryOvertime;

        $postTax = $preTax * 0.80;

        $stmt = $conn->prepare("insert into hd_payslips (staff_id, hours_worked, salary, overtime_worked, pre_tax_income, post_tax_income, deductables,  final_income, process_id, timesheet_id )
         VALUES (:sid, :hours, :sal, :over, :pre, :post, :deductables, :final, :process, :tid)");
        $params = ["sid" => $sanitizedId, "hours" => $sanitizedHours, "sal" => $salaryReg, "over" => $sanitizedHoursOver, "pre" => $preTax,
            "post" => $postTax, "deductables" => 0, "final" => $postTax, "process" => 1, "tid" => $timesheetID];
        $result = $stmt->execute($params);

        if ($result) {
            require_once "inc/functions.php";
            echo makePageStart("Timesheet");
            echo createPageBody();

            $success = <<<UPLOADED

            <div class="upload_outer">
            <div class="upload_inner">
            <img class="upload_img" src="img/success.png" alt="success tick">
                <p>Thank you, your timesheet has been successfully uploaded</p>
                <a href="dash.php"><button>Home</button></a>
                </div>
            </div>

UPLOADED;
            $success .= "\n";
            echo $success;
            echo createPageClose();
        }


    } else {
        require_once "inc/functions.php";
        echo makePageStart("Timesheet");
        echo createPageBody();

        $success = <<<UPLOADED

        <div class="upload_outer">
        <div class="upload_inner">
        <img class="upload_img" src="img/failure.png" alt="failure tick">
            <p>Sorry, we have been unable to upload or make your changes, please try again.</p>
            <a href="http://192.168.64.2/group_project/dash.php"><button>Home</a></button>
            </div>
        </div>

UPLOADED;
        $success .= "\n";
        echo $success;
        echo createPageClose();
    }

}

function generateRandomId()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < 6; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}
