<?php
	session_start();
	$error="";
	if(array_key_exists("logout", $_GET)){
		unset($_SESSION['id']);
		unset($_SESSION["shopping_cart"]);		 //session_destroy();
		setcookie("id","",time()-60*60);
		$_COOKIE["id"]="";
	}
	else if (array_key_exists("id", $_SESSION) OR array_key_exists("id", $_COOKIE))
	{
		header("Location:loggedin.php");
	}


	//retrieve data from the form
	if(array_key_exists( "submit",$_POST)) 
	{
		
		 $email=$_POST['email'];
		 $pass=$_POST['pas'];
		// $stayloggedIn=$_POST['stayloggedIn'];

		//mysql_select_db("fashiondemand");
		include("connectdb.php");
		//prevent mysql injection
		$email=stripcslashes($email);
		$pass=stripcslashes($pass);
		$email=mysqli_real_escape_string( $link,$email);
		$pass=mysqli_real_escape_string( $link,$pass);
	    


		$result = mysqli_query($link,"select * from users where email='$email'")
			or die("Faild to connect database".mysql_error());

		
			$row=mysqli_fetch_array($result);
			$temp=$row['id'];
			if(isset($row)){
					$hashedpss=md5($_POST['pas']);
				if($hashedpss==$row['password']&&$row['email']!="")
				{
				   
					$_SESSION['id']=$row['id'];
					if(isset($_POST['stayloggedIn']))
					{
					
						setcookie("id",$row['id'],time()+60*60*24*365);

					}
					$own=mysqli_fetch_array(mysqli_query($link,"SELECT * from shops where ownerId='$temp'"));
					if(isset($own)){
					header("Location: shops/frontpage.php");
					}
					else{
					
					header("Location: home.php");
				}
				}
				else {
					$message = "The email or password is incorrect!";
					//header("Location: login.php");
					echo "<script type='text/javascript'>alert('$message');</script>";

				}

			}else{
		$message = "Unregistered Email address";
					//header("Location: login.php");
					echo "<script type='text/javascript'>alert('$message');</script>";
					
	}
	}else{
	    	if (isset($_GET['message'])) {
	    $Message=$_GET['message'];
    echo "<script type='text/javascript'>alert('$Message');</script>";
    unset($_GET);
    $Message="";
    }
	    
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login page</title>
<?php include("top.php");?>
<div id ="frm">
	<form  method ="post">
		<p>
			<label>Email </label>
			<input type="email" name="email" id="email" placeholder="abc@gmail.com" pattern=".{4,}"   required title="4 characters minimum" >
		</p>		
		<p>
			<label>Password </label>
			<input type="password" name="pas" id="pas"  pattern=".{4,}"   required title="4 characters minimum" >
		</p>
		<p>

		<div class="custom-control custom-checkbox">
			
  			<input type="checkbox" name="stayloggedIn" value=1 class="custom-control-input" id="defaultChecked2" unchecked>
  			<label class="custom-control-label" for="defaultChecked2">Stay logged in</label>
			
		</div>
		</p>
		<p>
			<input type="submit" name="submit" id="btn" value="Login">
		</p>
		<p>	
			<button id="SignUp" onclick="location.href='SignIn.php'" type="button">Sign Up</button>
		</p>

	</form>

</div>
<?php include("footer.php");?>