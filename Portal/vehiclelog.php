<?php
require_once "inc/functions.php";
ini_set("session.save_path", "/home/unn_w17005084/sessionData"); //location of session data file, 
session_start();
echo checkLoggedInStatus();
echo makePageStart("Vehicle logs");
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
        <h2 class="dash-title">Vehicle log form</h2>
        <p class="italic">Please note all fields marked with an asterisk (*) are required</p>


        <div class="vehiclelogouter">
            <div class="vehicleloginner">
                <div class="inputsOuter">
                    <form action="./uploadVehicleLog.php" method="post" id="VLForm" onsubmit="return checkEnquiry(this)">
                        <div class="inputsInner">
                        <p class="errorMsg" id="errorMsg"></p>
                            <label for="userID">User ID</label>
                            <?php
$id = $_SESSION['id'];
echo "<input type='text' name='id' id='userID' placeholder='$id' value='$id' readonly />"
?>
                        </div>


                        <div class="inputsInner">
                            <label for="reg">Vehicle reg</label>
                            <?php
$conn = getDatabase();
$stmt = $conn->prepare("SELECT vehicle_reg from hd_vehicles");
$params = [];

$stmt->execute($params);
$result = $stmt->fetchall(PDO::FETCH_ASSOC);

echo "<select name='reg' id='reg' required>
                        <option value=''>Please select</option>";

foreach ($result as $key => $value) {
    echo '<option value="' . $value['vehicle_reg'] . '">' . $value['vehicle_reg'] . '</option>';
}

echo "</select>";

?>
                        </div>


                        <div class="inputsInner">
                            <label>Date</label>
                            <div class="inputDate">
                                <input type="text" name="day" id="day" placeholder="DD*" maxlength="2" required />
                                <input type="text" name="month" id="month" placeholder="MM*" maxlength="2" required />
                                <input type="text" name="year" id="year" placeholder="YY*" maxlength="2" required />
                            </div>
                        </div>
                        <div class="inputsInner">
                            <label for="currentmilage">Current milage</label>
                            <input type="text" name="milage" id="currentmilage" placeholder="Current milage*"
                                required />
                        </div>
                        <div class="inputsInner">
                            <label for="issues">Any issues</label>
                            <textarea name="issues" id="issues"
                                placeholder="Please insert any issues with the vehicle (add n/a if none)*"
                                required></textarea>
                        </div>
                        <div class="inputsInner">
                            <input type="submit" name="submit" class="submitBtn" />
                        </div>

                    </form>
                </div>
            </div>
        </div>





    </main>
</div>


<script src="checkVehicleLog.js"></script>
<?php

echo createPageClose();
?>