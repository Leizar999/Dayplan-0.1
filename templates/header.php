<?php 

	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/bd.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/user.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/userdao.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/controller/userController.php");
	include_once $_SERVER['DOCUMENT_ROOT'] . "/view/errors.php";

	session_start();
?>

<?php if (isset($_SESSION["user"])): ?>

    <!-- Header -->
	<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
	  <div class="container bootstrap snippet">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	          <span class="icon-toggle"></span>
	      </button>
	      <a class="navbar-brand" href="/view/panel.php">MLComponents - DAYPLAN 0.1</a>
	    </div>
	    <div class="navbar-collapse collapse">

	      <ul class="nav navbar-nav navbar-right">
	        <li class="dropdown">
	          	<a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">
	            <i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION["user"]->getLogin(); ?> <span class="caret"></span></a>
	          	<ul id="g-account-menu" class="dropdown-menu" role="menu">
	          		<?php if($_SESSION["user"]->getRole() == "admin" || $_SESSION["user"]->getRole() == "supervisor"):
	          			echo '<li><a href="/view/admin.php">Admin Dashboard</a></li>';
	          		endif; ?>
	            	<li><a href="/view/panel.php">Go to main page</a></li>
	            	<li><a href="/program/logout.php"><i class="fa fa-beer"></i> Logout</a></li>
	          	</ul>
	        </li>
	      </ul>

	    </div>
	  </div><!-- /container -->
	</div>
	<!-- /Header -->
<?php endif; ?>



