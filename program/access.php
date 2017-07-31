<?php
	session_start();

	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/bd.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/user.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/userdao.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/controller/userController.php");

	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/dayplan.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/dayplandao.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/controller/dayplanController.php");

	if(isset($_POST["login"], $_POST["pass"])){
		$bbdd = DB::getInstance();
		$bbdd->stablishUTF8();
		$login = $bbdd->clean($_POST["login"]);
		$pass = $bbdd->clean($_POST["pass"]);

		$user = new User();
		$userController = new userController($user);
		$userController->readLogin($login, $pass);

		$userDAO = new userDAO($user);

		$dayplan = new Dayplan();
		$dayplanController = new dayplanController($user);

		$dayplanDAO = new dayplanDAO($dayplan);

		$result = $dayplanDAO::getUserToday($user->getLogin());
		$row = mysqli_fetch_assoc($result[1]);

		if($userDAO->checkLogin()){
			//$_SESSION["success"] = "LOGIN CORRECT!: " . strtoupper($user->getLogin());
			$_SESSION["user"] = $userDAO::getUser($user->getLogin());
			$_SESSION["dayplan"] = $row;

			if($_SESSION["user"]->getRole() == "admin" || $_SESSION["user"]->getRole() == "supervisor"){
				header("location: /view/admin.php");
			}else {
				header("location: /view/panel.php");
			}
		}else{
			$_SESSION["errors"][0] = "WRONG USERNAME OR PASSWORD!";
			header("Location:../");
		}
	}
?>