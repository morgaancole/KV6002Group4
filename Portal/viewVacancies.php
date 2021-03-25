<?php
/*
*Page for admin users to view applications sent in from frontend
*@author - Morgan Wheatman
*/
require_once("inc/functions.php");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>View Vacancies</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <script src="js/vacancies.js"></script>
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
            <tbody>
                <h1 class="mtitle">Vacancies</h1>
                <div class="vacancy-page">
                    <?php 
                        echo getVacancies();
                    ?>
                </div>
            </tbody>
        </main>          
    </div>
</body>
</html>