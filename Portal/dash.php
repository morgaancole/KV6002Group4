<?php

require_once "inc/functions.php";
ini_set("session.save_path", "/home/unn_w17005084/sessionData"); //location of session data file, 

session_start();
echo checkLoggedInStatus();
echo makePageStart("Landing page");
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
        <h2 class="dash-title">Employee Dashboard</h2>

        <div class="dashOuter">
            <div class="dashSmallOuter">
                <div class="dashSmallInner">
                    <?php
                    
                    $id = $_SESSION['id'];
                   
                    $conn = getDatabase();
                    $stmt = $conn->prepare("SELECT  hd_vehicle_log_responses.response_date
                from hd_vehicle_log_responses
                where hd_vehicle_log_responses.staff_id = " . $id . " 
                order by hd_vehicle_log_responses.response_date
                limit 1");
                    $params = [];

                    $stmt->execute($params);
                    $result = $stmt->fetchall(PDO::FETCH_ASSOC);


                    $value = null;
                    if(count($result) > 0) {
                        $value = $result[0]['response_date'];
                    } else {
                        $value = "No vehicle logs have been created yet";
                    }



                    echo "
                <p>Your most recent vehicle log response was on the:</p>
                <p>
                ";
                    echo $value;
                    echo "
                </p>
                <p>Would you like to complete a new one now?</p>
                <a href='vehiclelog.php'><button>Vehicle log</button></a>
                
                ";

                    ?>
                </div>
                <div class="dashSmallInner">
                    <?php
                    $id = $_SESSION['id'];
                    $conn = getDatabase();
                    $stmt = $conn->prepare("SELECT  hd_timesheet_responses.Date, hd_timesheet_responses.timesheet_id
                from hd_timesheet_responses
                where hd_timesheet_responses.staff_id = " . $id . " 
                order by hd_timesheet_responses.Date
                limit 1");
                    $params = [];

                    $stmt->execute($params);
                    $result = $stmt->fetchall(PDO::FETCH_ASSOC);


                    $valueDate = null;
                    if(count($result) > 0) {
                        $valueDate = $result[0]['Date'];
                    } else {
                        $valueDate = "No timesheets have been created yet";
                    }

                    echo "
                <p>Your most recent timesheet response was on the:</p>
                <p>
                ";
                    echo $valueDate;
                    echo "
                </p>
                <p>Would you like to complete a new one now?</p>

                <a href='timesheet.php'><button>Timesheet</button></a>
                
                ";

                    ?>
                </div>
            </div>
            <div class="dashLargeOuter">
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <?php
                $id = $_SESSION['id'];
                $conn = getDatabase();
                $stmt = $conn->prepare("SELECT hd_payslips.final_income, hd_timesheet_responses.Date, hd_staff_users.staff_first_name
FROM hd_staff_users
JOIN hd_payslips ON (hd_staff_users.staff_id = hd_payslips.staff_id)
JOIN hd_timesheet_responses ON (hd_payslips.timesheet_id = hd_timesheet_responses.timesheet_id)
WHERE hd_staff_users.staff_id = " . $id);
                $params = [];

                $stmt->execute($params);
                $result = $stmt->fetchall(PDO::FETCH_ASSOC);


                $labelArr = [];
                $incomeArr = [];

                foreach ($result as $key => $value) {
                    array_push($labelArr, $value['Date']);
                    array_push($incomeArr, $value['final_income']);
                }



                ?>

                <p class="dashGraph">This graph maps your total income by date with data pulled from your completed payslips </p>
                <canvas id="myChart"></canvas>


                <script>
                    var labelArr = <?php echo json_encode($labelArr); ?>;
                    var incomeArr = <?php echo json_encode($incomeArr); ?>;

                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labelArr,
                            datasets: [{
                                label: 'Total income',
                                data: incomeArr,
                                backgroundColor: [
                                    'rgba(254, 2, 18, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(254, 2, 18, 1)',
                                ],
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    })
                </script>



            </div>
        </div>





    </main>
</div>