<?php
function getDetails() {
    $id = $_SESSION['id'];
    $conn = makeConnection();
     $stmt = $conn->prepare("select staff_id, staff_first_name, staff_last_name, staff_email, staff_password, staff_address, staff_postcode, hd_pay_categories.hourly_rate, hd_vehicles.vehicle_reg from hd_staff_users join hd_pay_categories on (hd_staff_users.pay_id = hd_pay_categories.pay_id) join hd_vehicles on (hd_staff_users.vehicle_id = hd_vehicles.vehicle_id) where staff_id = " . $id);
        // $stmt = $conn->prepare("select * from hd_staff_users where staff_id = 1");
    $params = [];

    $stmt->execute($params);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);



    return $result;
}



?>