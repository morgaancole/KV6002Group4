<?php
require_once "inc/functions.php";
ini_set("session.save_path", "/home/unn_w17005084/sessionData"); //location of session data file, 
session_start();
echo checkLoggedInStatus();
echo makePageStart("Payslips");
echo createPageBody();
echo createNav();

?>



<div class="main-content">

        <header>
            <div class="search-wrapper">
                <span class="ti-search"></span>
                <input type="search" placeholder="Search">
            </div>

            <div class="social-icons">
                <span class="ti-bell"></span>
                <span class="ti-comment"></span>
                <div></div>
            </div>
        </header>

        <main>
            <h2 class="dash-title">Payslips</h2>
                <div class="payslipOuter">
            <?php
$id = $_SESSION['id'];
$conn = getDatabase();
$stmt = $conn->prepare("SELECT hd_payslips.hours_worked, hd_payslips.salary, hd_payslips.overtime_worked, hd_payslips.pre_tax_income, hd_payslips.post_tax_income, hd_payslips.final_income, hd_payslips.deductables,
hd_payslip_process.process_id, hd_payslip_process.process_desc,
hd_staff_users.staff_first_name, hd_staff_users.staff_last_name, hd_staff_users.staff_email, hd_staff_users.staff_address, hd_staff_users.staff_postcode,
hd_timesheet_responses.Date, hd_timesheet_responses.location
FROM hd_payslips
JOIN hd_payslip_process on (hd_payslips.process_id = hd_payslip_process.process_id)
JOIN hd_staff_users on (hd_payslips.staff_id = hd_staff_users.staff_id)
JOIN hd_timesheet_responses on (hd_payslips.timesheet_id = hd_timesheet_responses.timesheet_id)
WHERE hd_staff_users.staff_id = " . $id );
$params = [];

$stmt->execute($params);
$result = $stmt->fetchall(PDO::FETCH_ASSOC);




    if(count($result) < 1) {
        echo "<p>No payslips have been stored in the database at this time. Please contact the admin staff</p>";
    } 


foreach ($result as $key => $value) {
    
   
    $payslip = <<<PAYSLIP

    <div class="payslipElementOuter">
                    <p>Date: $value[Date]</p>
                   <p>Post tax: $value[post_tax_income]</p>
                   <p>Take home: $value[final_income]</p>
                   <p>Status: $value[process_desc]</p>


                   <form action="./downloadPayslip.php" method="post"> 
                   <input type="hidden" id="first" name="first" value="$value[staff_first_name]">
                   <input type="hidden" id="last" name="last" value="$value[staff_last_name]">
                   <input type="hidden" id="email" name="email" value="$value[staff_email]">
                   <input type="hidden" id="address" name="address" value="$value[staff_address]">
                   <input type="hidden" id="postcode" name="postcode" value="$value[staff_postcode]">


                   <input type="hidden" id="hours_worked" name="hours_worked" value="$value[hours_worked]">
                   <input type="hidden" id="salary" name="salary" value="$value[salary]">
                   <input type="hidden" id="overtime_worked" name="overtime_worked" value="$value[overtime_worked]">
                   <input type="hidden" id="pre_tax_income" name="pre_tax_income" value="$value[pre_tax_income]">
                   <input type="hidden" id="post_tax_income" name="post_tax_income" value="$value[post_tax_income]">
                   <input type="hidden" id="final_income" name="final_income" value="$value[final_income]">
                   <input type="hidden" id="deductables" name="deductables" value="$value[deductables]">

                   <input type="hidden" id="location" name="location" value="$value[location]">
                   <input type="hidden" id="Date" name="Date" value="$value[Date]">
                   
                        <input type="submit" name="submit"  value="Download" />
                   </form>
    </div>

                 

PAYSLIP;
    $payslip .= "\n";
    echo $payslip;

}



?>
</div>
        </main>
    </div>


<?php

echo createPageClose();
?>