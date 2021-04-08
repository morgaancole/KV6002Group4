<?php
session_start(); //start session
session_destroy(); //destroy session
header("location: ../../../frontend/index.php"); //relocate to logged out home page
