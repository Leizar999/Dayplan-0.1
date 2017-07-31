<?php 

if(isset($_SESSION["success"])){
	echo $_SESSION["success"];
	unset($_SESSION["success"]);
} elseif(isset($_SESSION["errors"][0])) {
	echo $_SESSION["errors"][0];
	unset($_SESSION["errors"][0]);
}

?>
