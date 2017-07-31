<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/model/user.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/userdao.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/controller/userController.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>DAYPLAN - ADMIN ZONE</title>
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/head.php" ?>
</head>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/header.php"; ?>

<?php 
	if(!isset($_SESSION["user"]))
	header("location: /index.php");
?>
	<!-- Main -->
	<div class="container bootstrap snippet">

		<!-- upper section -->
		<div class="row">
			<div class="col-md-3">
				<!-- left -->
				<a href="#"><strong><i class="glyphicon glyphicon-briefcase"></i> Toolbox</strong></a>
				<hr>

				<ul class="nav nav-pills nav-stacked">
					<li class="dropdown">
						<a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#" id="dayplans" title="Dayplans options">
						<i class="glyphicon glyphicon-list-alt"></i> Dayplans<span class="caret"></span></a>
						<ul id="g-account-menu" class="dropdown-menu" role="menu">
							<li><a href="#" id="listDayplans">List all dayplans</a></li>
							<li><a href="#" id="listTodayDay">List today dayplans</a></li>
							<li><a href="#" id="listUserDay">List a user dayplan</a></li>
							<li><a href="#" id="listNotSentDayplan">List not sent dayplans</a></li>
						</ul>
						
						<?php

							if($_SESSION["user"]->getRole() == "admin"): 

						?>

						<li class="dropdown">
						<a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#" title="Users options">
						<i class="glyphicon glyphicon-user"></i> Users<span class="caret"></span></a>
						<ul id="g-account-menu" class="dropdown-menu" role="menu">
							<li><a href="#" id="listUsers">List users</a></li>
							<li><a href="#" id="createUsers">Create a user</a></li>
							<li><a href="#" id="eraseUsers">Erase a user</a></li>
							<li><a href="#" id="updateUsers">Update a user</a></li>
						</ul>
					</li>

						<?php endif; ?>

					<li><a href="#" id="reminder" title="Send reminder to users in not sent list"><i class="glyphicon glyphicon-bullhorn"></i> Reminder</a></li>
					<li><a href="#" id="option2"><i class="glyphicon glyphicon-briefcase"></i> Tools</a></li>
					<li><a href="#" id="option3"><i class="glyphicon glyphicon-plus"></i> Advanced..</a></li>
				</ul>

			</div><!-- /span-3 -->
			<div class="col-md-9">
				<!-- column 2 -->	
				<a href="admin.php" title="Show the dayplan status"><strong><i class="glyphicon glyphicon-dashboard"></i> My Dashboard</strong></a>
				<hr>
				<div class="row">
					<!-- center left-->
					<div class="col-md-12" id="main">

						<div class="panel panel-primary">
							<div class="panel-heading"><h4>Dayplans Status</h4></div>
							<div class="panel-body">

								<small>Complete</small>
								<div class="progress">
									<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="complete">
										<span class="sr-only">12% Complete</span>
									</div>
								</div>
								<small>Not complete</small>
								<div class="progress">
									<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="notComplete">
										<span class="sr-only">20% Complete</span>
									</div>
								</div>

							</div><!--/panel-body-->
						</div><!--/panel-->                     

					</div><!--/col-->

				</div><!--/row-->
			</div><!--/col-span-9-->
		</div><!--/row-->
		<!-- /upper section -->

	<?php if(isset($_SESSION["errors"][0])): ?>

		<div class="alert alert-danger alert-dismissable fade in text-center">
		  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  		<b><?php echo $_SESSION["errors"][0] ?></b>
	  		<?php unset($_SESSION["errors"][0]); ?>
		</div>

		<?php elseif(isset($_SESSION["success"])): ?>

		<div class="alert alert-success alert-dismissable fade in text-center">
		  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  		<b><?php echo $_SESSION["success"]; ?></b>
	  		<?php unset($_SESSION["success"]); ?>
		</div>	

	<?php endif; ?>

	</div><!--/container-->
	<!-- /Main -->
</html>