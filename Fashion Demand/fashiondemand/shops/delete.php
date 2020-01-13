<?php
session_start();

	if(array_key_exists("id",$_COOKIE)){

		$_SESSION['id']=$_COOKIE['id'];
	}
	if(array_key_exists("id", $_SESSION)){

require('connectdb.php');
$id=$_REQUEST['id'];
$name=mysqli_query($link,"SELECT * FROM dress WHERE dressID='".$id."'")or die ( mysqli_error());
$imagename=mysqli_fetch_array($name);
$dir="Images/";
unlink($dir.$imagename[2]);
$query = "DELETE FROM dress WHERE dressId='".$id."'"; 
$result = mysqli_query($link,$query) or die ( mysqli_error());
$message='Deleted successfully';
header("Location: frontpage.php?message=" . urlencode($message));
die;
}
	else{
		header("Location: ../index.php");}?>