<head>
    <title>DAYPLAN</title>
</head>

<?php

	include($_SERVER["DOCUMENT_ROOT"] . "/model/bd.php");
	include($_SERVER["DOCUMENT_ROOT"] . "/model/dayplan.php");
	include($_SERVER["DOCUMENT_ROOT"] . "/dao/dayplandao.php");
	include $_SERVER['DOCUMENT_ROOT'] . "/view/errors.php";

	include($_SERVER["DOCUMENT_ROOT"] . "/model/user.php");
	include($_SERVER["DOCUMENT_ROOT"] . "/dao/userdao.php");
	include($_SERVER["DOCUMENT_ROOT"] . "/controller/userController.php");

	session_start();

	$bbdd = DB::getInstance();
	$bbdd->stablishUTF8();

	$dayplan = new Dayplan();

	$dayplanDAO = new DayplanDAO($dayplan);

	$role = $_SESSION["user"]->getRole();

	$department = $_SESSION["user"]->getDepartment();

	$result = $dayplanDAO->notSentDayplans($role, $department);

?>

<table class="table table-striped table-bordered table-list">
	<tr>
		<th>NAME</th>
		<th>SURNAME</th>
		<th>DEPARTMENT</th>
	</tr>
		<?php while($row = mysqli_fetch_assoc($result)): ?>
				<tr>
				<td><a href="mailto:<?php echo $row["email"]; ?>?subject=Problem with your dayplan"><?php echo $row["name"]; ?></a></td>
				<td> <?php echo $row["surname"]; ?> </td>
				<td> <?php echo $row["department"]; ?> </td>
				</tr>
		<?php endwhile; ?>
</table>