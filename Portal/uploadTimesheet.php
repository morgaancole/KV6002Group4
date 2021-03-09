<?php


    if(isset($_POST['submit'])) {
        handleUpload();
    }

   

    function handleUpload() {
        

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

        $desc = $_POST['desc'];
        $sanitizedDesc = sanitizeInput($desc);

        // echo $sanitizedId;
        // echo "<br />";
        // echo $date;
        // echo "<br />";
        // echo $sanitizedLocation;
        // echo "<br />";
        // echo $sanitizedHours;
        // echo "<br />";
        // echo $sanitizedDesc;
        // echo "<br />";


        
        $conn = makeConnection();
        $stmt = $conn->prepare("INSERT INTO hd_timesheet_responses (staff_id, Date, location, hours_worked, jobs_completed_desc)
        VALUES(:id, :date, :location, :hoursworked, :desc)");
        $params = ["id" => $sanitizedId, "date" => $date, "location" => $sanitizedLocation, "hoursworked" => $sanitizedHours, "desc" => $sanitizedDesc];

         $stmt->execute($params);
         $result = $stmt->fetchAll();
        print_r($result);

        // $stmt = $conn->prepare("INSERT INTO hd_timesheet_responses (staff_id, Date, location, hours_worked, jobs_completed_desc)
        // VALUES(:id, :date, :location, :hoursworked, :desc)");
        // $params = ["id" => $sanitizedId, "date" => $date, "location" => $sanitizedLocation, "hoursworked" => $sanitizedHours, "desc" => $sanitizedDesc];
        // $stmt->execute($params);

        // $pdo = new PDO('sqlite:./DB/hendersonDB.sqlite');
        // $conn = makeConnection();
        // $stmt = $conn->prepare("select * from hd_job_vacancies where job_id = :id");
        // $testID = 1;
        // $stmt->bindParam('id', $testID);
        // $stmt->execute();
        // $result = $stmt->fetchAll();
        // print_r($result);

        // $conn = makeConnection();
        // $stmt = $conn->prepare("insert into hd_timesheet_responses (hours_worked) values (:hours)");
        // $stmt->bindParam('hours', $sanitizedHours);
        // $stmt->execute();
        //  $result = $stmt->fetchAll();
        // print_r($result);


        // $statement = $pdo->prepare("INSERT INTO hd_timesheet_responses (staff_id, Date, location, hours_worked, jobs_completed_desc) VALUES(:id, :date, :location, :hoursworked, :desc)");
        //  $params = ["id" => $sanitizedId, "date" => $date, "location" => $sanitizedLocation, "hoursworked" => $sanitizedHours, "desc" => $sanitizedDesc];
        // $statement->execute($params);

     
        
    }

    function makeConnection() {
        $pdo = new PDO('sqlite:../DB/hendersonDB.sqlite');
        return $pdo;
    }

    function sanitizeInput($val) {
        $santiseVal = htmlspecialchars($val);
        $santiseVal = trim($santiseVal);
        $santiseVal = stripslashes($santiseVal);
        return $santiseVal;
    }