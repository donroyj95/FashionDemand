<?php
	session_start();

	if(array_key_exists("id",$_COOKIE)){

		$_SESSION['id']=$_COOKIE['id'];
	}
	if(array_key_exists("id", $_SESSION)){
	
		echo "<p> Logged In! <a href='index.php?logout=1'>Log out</a></p>";


	}
	else{
		header("Location: login.php");
	}


?>


<!DOCTYPE html>
<html>
<head>
	<title>logged in page</title>

<?php include("top.php"); ?>
<h1> Welcome to Fashion Demand</h1>



<?php include("footer.php"); ?>



