<?php

    include_once($_SERVER["DOCUMENT_ROOT"] . "/model/bd.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/model/dayplan.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/dayplandao.php");

    include_once($_SERVER["DOCUMENT_ROOT"] . "/model/user.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/userdao.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/controller/userController.php");

    session_start();

    $bbdd = DB::getInstance();
    $bbdd->stablishUTF8();

    $role = $_SESSION["user"]->getRole();
    $department = $_SESSION["user"]->getDepartment();

    $dayplan = new Dayplan();
    $dayplandao = new DayplanDAO($dayplan);
    $result = $dayplandao->totalDayplans($role, $department);

    $row = $bbdd->fetch($result);

    $tpages = round($row["dayplans"] / 5);

    if($tpages < 1){
        $tpages = 1;
    }

    $page = 1;

    echo $tpages;
?>

