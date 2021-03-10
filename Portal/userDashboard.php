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

    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar">
        <div class="sidebar-header">
            <h3 class="brand">
                <span>Hendersons</span>
            </h3>
            <label for="sidebar-toggle" class="ti-menu-alt"></label>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="userDashboard.php">
                        <span class="ti-home"></span>
                        <span>Home</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <span class="ti-time"></span>
                        <span>Timeshet</span>
                    </a>
                </li>


                <li>
                    <a href="">
                        <span class="ti-book"></span>
                        <span>Vehicle Logs</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <span class="ti-book"></span>
                        <span>Payslip</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <span class="ti-settings"></span>
                        <span>View Account</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>

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

            <div class="dash-cards">
                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-briefcase"></span>
                        <div>
                            <h5>View Payslip</h5>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="">View</a>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-briefcase"></span>
                        <div>
                            <h5>View Vehicle logs</h5>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="">View all</a>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-briefcase"></span>
                        <div>
                            <h5>View Timesheets</h5>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="">View all</a>
                    </div>
                </div>


            </div>


            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <h3>Recent Activity</h3>

                        <div class="table-responsive">

                            <table>
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Date</th>
                                        <th>User</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Vehicle log updated</td>
                                        <td>8 March, 2020</td>
                                        <td>Nicholas</td>
                                        <td>
                                            <span class="badge success">Success</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="summary">
                        <div class="summary-card">
                            <div class="summary-single">
                                <span class="ti-id-badge"></span>
                                <div>
                                <h5>Add</h5>
                                <small>Add</small>
                                </div>
                                </div>
                                <div class="summary-single">
                                    <span class="ti-calendar"></span>
                                    <div>
                                        <h5>Add</h5>
                                        <small>Add</small>
                                    </div>
                                </div>

                                <div class="summary-single">
                                    <span class="ti-calendar"></span>
                                    <div>
                                        <h5>Add</h5>
                                        <small>Add</small>
                                    </div>
                                </div>

                        </div>
                    </div>
            </section>



        </main>
    </div>
    
</body>
</html>