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

	$dayplan = new Dayplan();
	$dayplandao = new DayplanDAO($dayplan);

	$json_response = array();

	$json_response[0] = $row = $bbdd->fetch($userdao->countUsers($role, $department));
	$json_response[1] = $row = $bbdd->fetch($dayplandao->countDayplans($role, $department));

	echo json_encode($json_response);
?>