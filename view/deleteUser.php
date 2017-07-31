<head>
    <title>DAYPLAN</title>
</head>

<?php

	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/bd.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/user.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/userdao.php");
	include_once $_SERVER['DOCUMENT_ROOT'] . "/view/errors.php";

	$bbdd = DB::getInstance();
	$bbdd->stablishUTF8();

	$role = $_POST["role"];
	$department = $_POST["department"];

	$user = new User();

	$userDAO = new userDAO($user);

	$result = $userDAO->getUsers($role, $department);
?>
<form action="/program/eraseUser.php" method="post">
	<select class="form-control" name="user-select">
		<?php 
			while($row = mysqli_fetch_assoc($result)){
				echo "<option value='" . $row["login"] . "'>" . $row["name"] . "</option>";
			}
		?>
	</select>
	<br>
	<button type="submit" class="btn btn-primary col-sm-offset-5" id="erase">ERASE</button>
</form>
