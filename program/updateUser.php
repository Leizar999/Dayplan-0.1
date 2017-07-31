<?php
	session_start();

	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/bd.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/user.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/userdao.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/controller/userController.php");

	echo $_POST["login"];
	echo $_POST["pass"];
	echo $_POST["name"];
	echo $_POST["surname"];
	echo $_POST["department"];
	echo $_POST["role"];
	echo $_POST["email"];

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

		$userDAO = new userDAO($user);

		$data = $userDAO->getUser($login);

		if($userDAO->updateUser($login, $pass, $name, $surname, $department, $role, $email)){
			$_SESSION["success"] = "USER UPDATED!: " . strtoupper($user->getLogin());
			//echo "dentro";
		}else{
			$_SESSION["errors"][0] = "SOMETHING BAD HAPPENED!";
			//echo "fuera";
		}
	} else {
		$_SESSION["errors"][0] = "YOU NEED TO FILL ALL THE FIELDS!";
	}

	header("Location: " . $_SERVER["HTTP_REFERER"]);

?>