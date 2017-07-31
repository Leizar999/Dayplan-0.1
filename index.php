<?php 
	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/bd.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/user.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/userdao.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/controller/userController.php");
	include_once $_SERVER['DOCUMENT_ROOT'] . "/view/errors.php";

	session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>DAYPLAN</title>
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/head.php" ?>
</head>
<body id="login-form">
	<header>
		<h1 class="jumbotron">MLC - DAYPLAN</h1>
	</header>

	<main>

		<form action="/program/access.php" method="post">
			<div class="container">
			    <div class="row">
					<div class="col-md-6 col-md-offset-3">
			    		<div class="panel panel-primary" id="login-box">
						  	<div class="panel-heading">
						    	<h3 class="panel-title">PLEASE LOGIN</h3>
						 	</div>
						  	<div class="panel-body">
						    	<form accept-charset="UTF-8" role="form">
				                    <fieldset>
							    	  	<div class="form-group">
							    		    <input class="form-control" placeholder="Login" name="login" type="text">
							    		</div>
							    		<div class="form-group">
							    			<input class="form-control" placeholder="Password" name="pass" type="password">
							    		</div>
							    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
							    	</fieldset>
						      	</form>
						    </div>
						</div>

						<?php if(isset($_SESSION["errors"])): ?>

							<div class="alert alert-danger alert-dismissable fade in text-center">
							  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  		<b><?php echo $_SESSION["errors"][0]; ?></b>
						  		<?php unset($_SESSION["errors"][0]); ?>
							</div>						

						<?php endif; ?>

						<?php session_destroy(); ?>

					</div>
				</div>
			</div>
		</form>
		
	</main>

</body>
</html>