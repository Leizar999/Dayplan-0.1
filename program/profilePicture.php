<?php

	include($_SERVER["DOCUMENT_ROOT"] . "/model/bd.php");
	include($_SERVER["DOCUMENT_ROOT"] . "/model/user.php");
	include($_SERVER["DOCUMENT_ROOT"] . "/dao/userdao.php");
	include($_SERVER["DOCUMENT_ROOT"] . "/controller/userController.php");

	session_start();

	// Preparing variables to upload document

	$dir = $_SERVER["DOCUMENT_ROOT"] . "/img/profile/" . $_SESSION["user"]->getLogin() . "/"; //Directory

	//mkdir($dir);

	// When the directory is not empty:
	function delete_directory($dir){

		if ($handle = opendir($dir)){
		    while (false !== ($file = readdir($handle))) {
		        if ($file != "." && $file != "..") {

					if(is_dir($dir . $file)){
						if(!@rmdir($dir . $file)){ // Empty directory? Remove it
						
		                delete_directory($dir . $file .'/'); // Not empty? Delete the files inside it
						}
					} else {
		               @unlink($dir.$file);
					}
		        }
		    }
		    closedir($handle);

			@rmdir($dir);
		}
	}

	$remove_directory = delete_directory($dir);

	mkdir($dir);

	$upload_directory = $dir;
	$upload_file = $upload_directory . "profile.jpg";

	echo $upload_file;

	echo '<pre>';
	if (move_uploaded_file($_FILES['upload']['tmp_name'], $upload_file)) {
	    echo "The file is valid and has been uploaded.\n";
	} else {
	    echo "Possible attack in upload file!\n";
	}

	print "</pre>";

	header("location: " . $_SERVER["HTTP_REFERER"]);

?>