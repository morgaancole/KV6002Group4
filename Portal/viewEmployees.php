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

    }echo makePageStart("Employee List");
echo createPageBody();
echo adminNav(); 
?>
<!--@author Nicholas Coyles -->

<!--Displays a table of all employees-->
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

    <h2>Employees</h2>

    <form method="get" action="createEmployee.php">

    <div class="box-header with-border">
        <a href="createEmployee.php"><i class="fa fa-plus"></i>Create New Employee</a>
     </div>
    </form>
    <table class="responsive-table">

			<thead>
				<tr>
					<th>Staff Id</th>
					<th>First Name</th>
					<th>Last Name</th>
                    <th>Date of birth</th>
                    <th>Role</th>
                    <th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
                
                $myPDO  = getDatabase();  
                $query = $myPDO->query("SELECT  *
                FROM hd_staff_users
                left join hd_pay_categories on (hd_staff_users.pay_id = hd_pay_categories.pay_id)
                order by staff_id ");

 					while($row= $query->fetch(PDO::FETCH_ASSOC)){
				 
                        echo "
                        <tr>
                          <td data-label='Staff Id'>".$row['staff_id']."</td>
                          <td data-label='First Name'> ".$row['staff_first_name']."</td>
                          <td data-label='Last Name'> ".$row['staff_last_name']."</td>
                          <td data-label='Date of birth'>".$row['date_of_birth']."</td>
                          <td data-label='Role'>".$row['pay_desc']."</td>

                        
                          <td data-label='Action'><a href='viewEmployee.php?staffID={$row['staff_id']}&payID={$row['pay_id']}'>Edit</a>
                          <br>
                          <a href='deleteEmployee.php?staffID={$row['staff_id']}'>Delete</a>
                          <br>
                          <a href='ManagePassword.php?staffID={$row['staff_id']}'>New Password</a>
                          </td>
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