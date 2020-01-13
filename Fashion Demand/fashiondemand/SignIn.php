<?php
if($_POST)
{
		$Fname=$_POST['FirstName'];
		$Lname=$_POST['LastName'];
		$Eml=$_POST['Email'];
		$Pass=$_POST['Password'];
		$Cpss=$_POST['CPassword'];
		$addrs=$_POST['address'];

		if($Pass==$Cpss)
		{
					//mysql_select_db("login");
				include("connectdb.php");
				// prevent mysql injection
				$Fname=stripcslashes($Fname);
				$Lname=stripcslashes($Lname);
				$Eml=stripcslashes($Eml);
				$Pass=stripcslashes($Pass);
				$Cpss=stripcslashes($Cpss);
				$addrs=stripcslashes($addrs);

				$Fname=mysqli_real_escape_string( $link,$Fname);
				$Lname=mysqli_real_escape_string( $link,$Lname);
				$Eml=mysqli_real_escape_string( $link,$Eml);
				$Pass=mysqli_real_escape_string( $link,$Pass);
				$Cpss=mysqli_real_escape_string( $link,$Cpss);
				$addrs=mysqli_real_escape_string($link,$addrs);

				$check=mysqli_query($link,"SELECT * from users where email ='$Eml' ");
				if( mysqli_num_rows($check)>0)
				{
					$message = "Email address has already registered!";
				    echo "<script type='text/javascript'>alert('$message');</script>";
					die();
				}

				mysqli_query($link,"INSERT INTO users (registerOn,email,firstName,lastName,address) VALUES (NOW(),'".$Eml."','".$Fname."','".$Lname."','".$addrs."' ) " );
				$result = mysqli_query($link,"SELECT * from users where email='$Eml' ");
				$Id=mysqli_fetch_array($result);
				$id=$Id['id'];
				$Hpass=md5($_POST['Password']);

				mysqli_query($link,"UPDATE users SET password= '$Hpass' where id='$id'  " );
				
					$to = $Eml;
					$subject = "Welcome";
					$txt = "Welcome to Fashion Demand!";
					$headers = "From: fashiondemand01.com" . "\r\n";
					mail($to,$subject,$txt,$headers);

				header("Location:index.php");

		}
		
		else
		{
				$message = "Passwords are not match!";
			    echo "<script type='text/javascript'>alert('$message');</script>";
			   
		}



}



?>



<!DOCTYPE html>
<html>
<head>
	<title>Sign In page</title>

<?php include("top.php"); ?>

<div id="frm">
<form method="post">
	<p>
		<label>First Name </label>
		<input type="text" name="FirstName" id="FirstName" placeholder="First Name" required >

	</p>
	<p>
		<label>Last Name </label>
		<input type="text" name="LastName" id="LastName" placeholder="Last Name"  required>

	</p>
	<p>
		<label>Email </label>
		<input type="email" name="Email" id="Email" placeholder="abc@gmail.com" required >
	</p>
	<p>
		<label>Address </label>
		<input type="text" name="address" id="address" placeholder="" required >
	</p>
	<p>
		<label>Password </label>
		<input type="password" id="Password" name="Password" pattern=".{4,}"   required title="4 characters minimum">
	</p>
	<p>
		<label>Confirm Password </label>
		<input type="password" id="CPassword" name="CPassword" pattern=".{4,}"   required title="4 characters minimum">
	</p>
	<br>
	<p>
		<input type="submit" name="SignUp" id="SignUp" value="Sign Up">
	</p>
	<p>	
			<button id="Login" onclick="location.href='index.php'" type="button">Login</button>
	</p>


</form>
</div>




<?php include("footer.php"); ?>

