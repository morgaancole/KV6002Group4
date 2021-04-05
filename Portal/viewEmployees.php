<?php
 ini_set("session.save_path", "/home/unn_w19042409/sessionData");
 session_start(); 
 require_once("inc/functions.php");

//Session data path needs to change for demo

/*
*Page for admin users to view applications sent in from frontend
*@author - Morgan Wheatman
*/
    require_once("inc/functions.php");

    //Checking if user is logged in & their admin level
    //Redirects user to staff dash if they are not admin
    if(checkLogin()){

        if($_SESSION['adminLevel'] != '1'){
            header('Location: dash.php');
        }
        
    }else{//Redirecting user if they're not logged in
        header('Location: ../frontend/loginForm.php');

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <title>Document</title>
</head>
<body>
    <?php 
        echo adminNav(); 
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
    <form method="get" action="createEmployee.php">

    <button><i class="fa fa-plus"></i> New user</button>
    </form>

    <table>
			<thead>
				<tr>
					<th>Staff Id</th>
					<th>First Name</th>
					<th>Last Name</th>
                    <th>Date of birth</th>
                    <th>Role</th>
				</tr>
			</thead>
			<tbody>
				<?php
                
                $myPDO  = new PDO('sqlite:../DB/hendersonDB.sqlite');  
                $query = $myPDO->query("SELECT staff_id, staff_first_name,staff_last_name, pay_desc, hd_staff_users.pay_id,date_of_birth
                FROM hd_staff_users
                INNER join hd_pay_categories on (hd_staff_users.pay_id = hd_pay_categories.pay_id)
                order by staff_id ");

 					while($row= $query->fetch(PDO::FETCH_ASSOC)){
				 
                        echo "
                        <tr>
                          <td>".$row['staff_id']."</td>
                          <td>".$row['staff_first_name']."</td>
                          <td>".$row['staff_last_name']."</td>
                          <td>".$row['date_of_birth']."</td>
                          <td>".$row['pay_desc']."</td>

                        
                          <td><a href='viewEmployee.php?staffID={$row['staff_id']}&payID={$row['pay_id']}'>Edit</a</td>
                          <td><a href='deleteEmployee.php?staffID={$row['staff_id']}'>Delete</a</td>

                        </tr>

                      ";
                     }
                  ?>
			</tbody>
		</table>
        </main>
        
</div>
</body>
</html>
