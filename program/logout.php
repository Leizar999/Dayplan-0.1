<?php
	session_start();
	session_destroy();

	$_SESSION["errors"][0] = "CORRECTLY LOGOUT";

	header("location: /index.php");
?>