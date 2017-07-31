<?php 
	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/bd.php");

	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/user.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/userdao.php");
	include_once $_SERVER['DOCUMENT_ROOT'] . "/view/errors.php";

	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/dayplan.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/dayplandao.php");
	include_once $_SERVER['DOCUMENT_ROOT'] . "/view/errors.php";

	session_start();

	$bbdd = DB::getInstance();
	$bbdd->stablishUTF8();

	$role = $_POST["role"];
	$department = $_POST["department"];

	$user = new User();
	$userdao = new UserDAO($user);
	$result = $userdao->getUsers($role, $department);

	while ($row = $bbdd->fetch($result)) {
	    $row_array['login'] = $row['login'];
	    $row_array['name'] = $row['name'];
	    $row_array['department'] = $row['department'];

	    $json_response[] = $row_array["login"];
	}

	echo json_encode($json_response);
?>