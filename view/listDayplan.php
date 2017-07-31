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

	$option = $_POST["option"];

	$role = $_SESSION["user"]->getRole();

	if(isset($_POST["text"])){
		$login = $_POST["text"];
	}

	if(isset($_POST["department"])){
		$department = $_POST["department"];
	} else {
		$department = $_SESSION["user"]->getDepartment();
	}

	$recover = false;

	$num_rows = 0;

	switch ($option) {
		case 'all':
		$result = $dayplanDAO->getDayplans($role, $department);
		$num_rows = mysqli_num_rows($result);
		break;
		case 'today':
		$result = $dayplanDAO->getDayplansToday($role, $department);
		$num_rows = mysqli_num_rows($result);
		break;
		case 'user':
		$result = $dayplanDAO->getDayplan($login, $role, $department);
		$num_rows = mysqli_num_rows($result);
		break;
		case 'recover':
		$result = $dayplanDAO->getUserLast($login)[1];
		$row = mysqli_fetch_assoc($result);
		$recover = true;
		$num_rows = mysqli_num_rows($result);
		break;
	}

	$tpages = ceil($num_rows / 5);

    if($tpages < 1){
        $tpages = 1;
    }

    $page = 1;
?>

<?php if($recover): ?>

	<?php echo $row["texteditor"];?>

<?php else: ?>

	<div class="panel panel-default panel-table">
		<div class="panel-body text-center">
			<div id="docx">
			  <div class="WordSection1">

					<table class="table table-striped table-bordered table-list">
						<thead>
							<tr>
								<th class="text-center">NAME</th>
								<th class="text-center">SURNAME</th>
								<th class="text-center">TEXT OF DAYPLAN</th>
								<th class="text-center">DATE</th>
								<th class="text-center">COMMENTS</th>
							</tr>
						</thead>
						<tbody class="text-center">
							<?php while($row = mysqli_fetch_assoc($result)): ?>
								<tr>
									<td hidden id="<?php echo $row['id']; ?>"><?php echo $row["email"]; ?></td>
									<td><a href="mailto:<?php echo $row["email"]; ?>?subject=Problem with your dayplan" title="Send email to <?php echo $row["name"] ?>"><?php echo $row["name"]; ?></a></td>
									<td> <?php echo $row["surname"]; ?> </td>
									<td> <?php echo $row["texteditor"]; ?> </td>
									<td> <?php echo $row["dateplan"]; ?> </td>
									<td class="edit"> <?php echo $row["comments"]; ?> </td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>

			  </div>
			</div>
		</div>

		<div class="panel-footer">
			<button id="export" class="btn btn-success">Export</button> Click to open table in Microsoft Word
			<!--div class="row">
				<div class="col col-xs-4" id="pagination">
					
				</div>
				<div class="col col-xs-8">
					<ul class="pagination hidden-xs pull-right">
					    <button class='btn-danger' id="back-button">BACK</button>
					  	<button class='btn-success' id="next-button">NEXT</button>
					</ul>
					
				</div>
			</div-->
		</div>
	</div>
<?php endif; ?>

<script src="/js/functions.js"></script>
<script src="/js/editable.js"></script>
