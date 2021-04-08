<?php
 ini_set("session.save_path", "/home/unn_w17005084/sessionData"); //location of session data file, 
 session_start(); //start session
session_destroy(); //destroy session
header("location: ../frontend/index.php"); //relocate to logged out home page
