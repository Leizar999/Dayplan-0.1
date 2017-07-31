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

<table class="table table-striped table-bordered table-list">
	<tr>
		<th>LOGIN</th>
		<th>NAME</th>
		<th>SURNAME</th>
		<th>DEPARTMENT</th>
		<th>ROLE</th>
		<th>EMAIL</th>
	</tr>
	<?php while($row = mysqli_fetch_assoc($result)): ?>
		<tr>
			<td><a href="mailto:<?php echo $row["email"]; ?>?subject=Problem with your dayplan" title="Send email to <?php echo $row["login"] ?>"><?php echo $row["login"]; ?></a></td>
			<td> <?php echo $row["name"]; ?> </td>
			<td> <?php echo $row["surname"]; ?> </td>
			<td> <?php echo $row["department"]; ?> </td>
			<td> <?php echo $row["role"]; ?> </td>
			<td> <?php echo $row["email"]; ?> </td>
		</tr>
	<?php endwhile; ?>
</table>