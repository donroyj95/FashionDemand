<? ob_start(); ?>


<?php
if($_POST)
{
		$Fname=$_POST['FirstName'];
		$Lname=$_POST['LastName'];
		$Eml=$_POST['Email'];
		$Pass=$_POST['Password'];
		$Cpss=$_POST['CPassword'];
		$Sname=$_POST['Sname'];
		$Loc=$_POST['loc'];
		$Addr=$_POST['address'];

		if($Pass==$Cpss)
		{
					//mysql_select_db("fashiondemand");
				include("connectdb.php");
				// prevent mysql injection
				$Fname=stripcslashes($Fname);
				$Lname=stripcslashes($Lname);
				$Eml=stripcslashes($Eml);
				$Pass=stripcslashes($Pass);
				$Cpss=stripcslashes($Cpss);

				$Fname=mysqli_real_escape_string( $link,$Fname);
				$Lname=mysqli_real_escape_string( $link,$Lname);
				$Eml=mysqli_real_escape_string( $link,$Eml);
				$Pass=mysqli_real_escape_string( $link,$Pass);
				$Cpss=mysqli_real_escape_string( $link,$Cpss);
				$Sname=mysqli_real_escape_string($link,$Sname);
				$Loc=mysqli_real_escape_string($link,$Loc);
				$Addr=mysqli_real_escape_string($link,$Addr);


				$check=mysqli_query($link,"SELECT * from users where email ='$Eml' ");
				if( mysqli_num_rows($check)>0)
				{
					$message = "Email address has already registered!";
				    //echo "<script type='text/javascript'>alert('$message');</script>";
					header("Location: index.php?message=" . urlencode($message));
					die();
				}

				mysqli_query($link,"INSERT INTO users (registerOn,email,firstName,lastName,address) VALUES (NOW(),'".$Eml."','".$Fname."','".$Lname."','".$Addr."' ) " );
				$result = mysqli_query($link,"SELECT * from users where email='$Eml' ");
				$Id=mysqli_fetch_array($result);
				$id=$Id['id'];
				$OwnId=$id;
				$Hpass=md5($_POST['Password']);
				mysqli_query($link,"UPDATE users SET password= '$Hpass' where id='$id'");

				if($_POST['Sname'])
				{			
							mysqli_query($link,"INSERT INTO shops (registerOn,shopName,location,ownerId) VALUES (NOW(),'".$Sname."','".$Loc."','".$OwnId."' )  " );
							

						

					$to = $Eml;
					$subject = "Welcome";
					$txt = "Welcome to Fashion Demand!";
					$headers = "From: fashiondemand01.com" . "\r\n";
					if(mail($to,$subject,$txt,$headers)){
						echo "";
					}
						

				}
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
	<title>Registration</title>
<?php include("top.php");?>

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
		<label>Address </label>
		<input type="text" name="address" id="address" placeholder="" required >
	</p>
	<p>
		<label>Email </label>
		<input type="email" name="Email" id="Email" placeholder="abc@gmail.com" required >
	</p>
	<p>
		<label>Shop Name </label>
		<input type="text" name="Sname" id="Sname"  required >
	</p>
	<p>
		<label>Shop Location </label>
		<input type="text" name="loc" id="loc"  required >
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
		<input type="submit" name="Register" id="Register" value="Register">
	</p>
	<p>	
			<button id="Login" onclick="location.href='index.php'" type="button">Login</button>
	</p>
</form>
</div>
<?php include("footer.php");?>


<? ob_flush(); ?>