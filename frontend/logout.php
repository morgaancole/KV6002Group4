<?php
	ini_set("session.save_path", "/home/unn_w19042409/sessionData");
	session_start();
	$SESSION = array();
	session_destroy();

	header("Location: loginForm.php");
?>