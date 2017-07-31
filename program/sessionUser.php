<?php 

	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/bd.php");
	include($_SERVER["DOCUMENT_ROOT"] . "/model/user.php");
	include($_SERVER["DOCUMENT_ROOT"] . "/dao/userdao.php");
	include($_SERVER["DOCUMENT_ROOT"] . "/controller/userController.php");

	session_start();

	$bbdd = DB::getInstance();
	$bbdd->stablishUTF8();

	$login = $_SESSION["user"]->getLogin();

	$role = $_SESSION["user"]->getRole();

	$department = $_SESSION["user"]->getDepartment();

	$data = array("login" => $login, "role" => $role, "department" => $department);

	echo json_encode($data);
?>