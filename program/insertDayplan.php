<?php

	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/bd.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/dayplan.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/dayplandao.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/controller/dayplanController.php");

	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/user.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/userdao.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/controller/userController.php");

	session_start();

	$text = $_POST["text"];

	if(isset($text)){

		$login = $_SESSION["user"]->getLogin();
		$date = date("d/m/Y H:i:s");

		$bbdd = DB::getInstance();
		$bbdd->stablishUTF8();

		$dayplan = new Dayplan();
		$dayplanController = new DayplanController($dayplan);
		$dayplanController->readComplete($login, $text, $date);

		$dayplanDAO = new dayplanDAO($dayplan);

		if($dayplanDAO->getUserToday($login)[0]){
			echo "update";
			$dayplanDAO->updateDayplan($login, $text);
		}else {

			if($dayplanDAO->insertDayplan()){
				//$_SESSION["success"] = "DAYPLAN SENT!: " . strtoupper($login);
				//echo "dentro";
			}else{
				$_SESSION["errors"][0] = "SOMETHING BAD HAPPENED!";
				//echo "fuera";
			}
		} 
	} else {
		$_SESSION["errors"][0] = "YOU NEED TO FILL ALL THE FIELDS!";
	}
?>