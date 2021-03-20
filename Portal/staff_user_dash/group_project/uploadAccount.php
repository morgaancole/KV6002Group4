<?php
function getDetails() {
    $conn = makeConnection();
     $stmt = $conn->prepare("select staff_id, staff_first_name, staff_last_name, staff_email, staff_password, staff_address, staff_postcode, hd_vehicles.vehicle_reg, hd_pay_categories.hourly_rate from hd_staff_users join hd_vehicles on(hd_staff_users.vehicle_id = hd_vehicles.vehicle_id) join hd_pay_categories on (hd_staff_users.pay_id = hd_pay_categories.pay_id) where staff_id = 1");
        // $stmt = $conn->prepare("select * from hd_staff_users where staff_id = 1");
    $params = [];

    $stmt->execute($params);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    setcookie("test", $result['staff_id'], time() + (86400 * 30), "/");

    // $result = $stmt->fetchAll();

    return $result;
}


function makeConnection()
{
    //this has been changed from ./ to ../ in order to work with the project files
    //github, will need to be changed back for when i am testing
    $pdo = new PDO('sqlite:./DB/hendersonDB.sqlite');
    return $pdo;
}


?>