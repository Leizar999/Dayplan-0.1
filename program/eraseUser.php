<?php
	session_start();

	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/bd.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/user.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/userdao.php");

	if(isset($_POST["user-select"])){
		$bbdd = DB::getInstance();
		$bbdd->stablishUTF8();

		$user = new User();

		$userDAO = new userDAO($user);

		$valid = $userDAO->deleteUser($_POST["user-select"]);

		if($valid){
			$_SESSION["success"] = "USER '" . $_POST["user-select"] . "' CORRECTLY DELETED :)";
		} else {
			$_SESSION["errors"][0] = "ERROR WHAT A HORROR!";
		}
	}

	header("location: " . $_SERVER["HTTP_REFERER"]);
?>