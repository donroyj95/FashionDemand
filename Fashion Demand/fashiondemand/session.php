<?php
	session_start();
echo "manoj";
	if($_SESSION['email']){
		echo "you are login";
	}
	else{
		header("Location: index.php");
	}



?>