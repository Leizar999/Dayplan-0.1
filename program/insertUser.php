<?php
	session_start();

	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/bd.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/user.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/userdao.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/controller/userController.php");

	if(isset($_POST["login"], $_POST["pass"], $_POST["name"], $_POST["surname"], $_POST["department"], $_POST["role"], $_POST["email"]) && $_POST["department"] != "" && $_POST["role"] != ""){
		$bbdd = DB::getInstance();
		$bbdd->stablishUTF8();
		$login = $bbdd->clean($_POST["login"]);
		$pass = $bbdd->clean($_POST["pass"]);
		$name = $bbdd->clean($_POST["name"]);
		$surname = $bbdd->clean($_POST["surname"]);
		$department = $bbdd->clean($_POST["department"]);
		$role = $bbdd->clean($_POST["role"]);
		$email = $bbdd->clean($_POST["email"]);

		$user = new User();
		$userController = new userController($user);
		$userController->readComplete($login, $pass, $name, $surname, $department, $role, $email);

		$userDAO = new userDAO($user);
		$check = $userDAO->checkDuplicates($login, $email);

		if($check[0]){
			$_SESSION["errors"][0] = "THE USERNAME '" . $login . "' IS ALREADY IN USE, CHOOSE ANOTHER!";
		} elseif($check[1]) {
			$_SESSION["errors"][0] = "THE USERNAME '" . $login . "' IS FREE, BUT THE MAIL '" . $email . "' IS ALREADY IN USE, CHOOSE ANOTHER!";
		} else {
			if($userDAO->insertUser()){
				$_SESSION["success"] = "USER CREATED!: '" . $user->getLogin() . "'";
				//echo "dentro";
			}
		}

	} else {
		$_SESSION["errors"][0] = "YOU NEED TO FILL ALL THE FIELDS!";
	}

	header("Location: " . $_SERVER["HTTP_REFERER"]);
?>