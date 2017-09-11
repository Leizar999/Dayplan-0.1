<?php

	include_once("/var/www/dayplan/model/bd.php");
	include_once("/var/www/dayplan/model/user.php");
	include_once("/var/www/dayplan/dao/userdao.php");
	include_once("/var/www/dayplan/controller/userController.php");

	include_once("/var/www/dayplan/model/dayplan.php");
	include_once("/var/www/dayplan/dao/dayplandao.php");
	include_once("/var/www/dayplan/controller/dayplanController.php");

	require '/var/www/dayplan/lib/PHPMailer/PHPMailerAutoload.php';

	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/bd.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/dayplan.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/dayplandao.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/controller/dayplanController.php");

	include_once($_SERVER["DOCUMENT_ROOT"] . "/model/user.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/userdao.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . "/controller/userController.php");

	session_start();

	if(isset($_POST["id"], $_POST["text"], $_POST["comment"], $_POST["email"]) && $_POST["comment"] != ""){

		$id = $_POST["id"];
		$text = $_POST["text"];
		$comment = $_POST["comment"];
		$email = $_POST["email"];

		$login = $_SESSION["user"]->getLogin();
		$date = date("d/m/Y H:i:s");

		$bbdd = DB::getInstance();
		$bbdd->stablishUTF8();

		$dayplan = new Dayplan();
		$dayplanController = new DayplanController($dayplan);

		$dayplanDAO = new dayplanDAO($dayplan);

		if($dayplanDAO->insertComment($id, $comment)){
			echo "comment inserted";

			$mail = new PHPMailer;

			//$mail->SMTPDebug = 3;                               	// Enable verbose debug output

			$mail->isSMTP();                                      	// Set mailer to use SMTP
			$mail->Host = 'smtp.office365.com';  					// Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               	// Enable SMTP authentication
			$mail->Username = 'alerts@mlcomponents.com';          	// SMTP username
			$mail->Password = 'MoreNiko19';                         	// SMTP password
			$mail->SMTPSecure = 'tls';                            	// Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    	// TCP port to connect to

			$mail->setFrom('alerts@mlcomponents.com', 'DAYPLAN SYSTEM');

			$mail->addAddress($email, $email);

			$mail->isHTML(true);

			// Set email format to HTML

			$mail->Subject = 	'New comments in your dayplan';
			$mail->Body    = 	"
				<div style='background-color:#f8fcfb;'>
					<br>
					<h1 style='text-align:center;'>YOU GOT THE NEW COMMENT IN YOUR DAYPLAN:</h1>
					<h3 style='font-weight: lighter;text-align:center;'>
						<b>RELATED WITH THIS DAYPLAN: </b>'" . $text . "'
					</h3>
					<br>
					<h3 style='font-weight: lighter;text-align:center;'><b>THE COMMENT IS:</b> " . $comment . "</h3>
					<h6>by: " . $_SESSION["user"]->getLogin() . " </h6>
					<p style='font-family: courier;text-align:center;'>
						This is an autogenerated message from the ML Components new dayplan mail system.
					</p>
					<br>
				</div>";
			$mail->AltBody = 'This is an autogenerated message from the ML Components new dayplan mail system.';

			if(!$mail->send()) {
			    $result = '<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later: </div><br>' . $mail->ErrorInfo;
			} else {
				$result = '<div class="alert alert-success">Thank You! I will be in touch</div>';
			}

			echo $result;
		}
	}
?>