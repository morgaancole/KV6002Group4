<?php
session_start(); //start session
session_destroy(); //destroy session
header("location: index.php"); //relocate to logged out home page
?>