<?php
require_once "inc/functions.php";
ini_set("session.save_path", "/home/unn_w17005084/sessionData"); //location of session data file, 
session_start();
    //Checking if user is logged in & their admin level
    //Redirects user to staff dash if they are not admin
    if(checkLogin()){

        if($_SESSION['adminLevel'] != '1'){
            header('Location: dash.php');
        }
        
    }else{//Redirecting user if they're not logged in
        header('Location: ../frontend/loginForm.php');

    }echo makePageStart("Vehicle Logs");
echo createPageBody();
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


    <table>
			<thead>
				<tr>
					<th>Log Id</th>
					<th>Staff Id </th>
                    <th>current Mileage</th>
                    <th>Issues</th>
                    <th>Response date</th>
                    <th>Vehicle Reg</th>
				</tr>
			</thead>
			<tbody>
				<?php
                
                $myPDO  = getDatabase();
                $query = $myPDO->query("SELECT *
                FROM hd_vehicle_log_responses
                order by log_id ");

 					while($row= $query->fetch(PDO::FETCH_ASSOC)){
				 
                        echo "
                        <tr>
                          <td>".$row['log_id']."</td>
                          <td>".$row['staff_id']."</td>
                          <td>".$row['current_mileage']."</td>
                          <td>".$row['any_issues']."</td>
                          <td>".$row['response_date']."</td>
                          <td>".$row['vehicle_reg']."</td>
                        </tr>

                      ";
                     }
                  ?>
			</tbody>
		</table>
        </main>
        
</div>
<?php 
        echo createPageClose(); 
?>
    