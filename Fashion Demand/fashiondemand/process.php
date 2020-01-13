<!-- <?php
	session_start();

	if(array_key_exists("logout", $_GET)){
		unset($_SESSION);
		setcookie("id","",time()-60*60);
		$_COOKIE["id"]="";
	}else if(array_key_exists("id", $_SESSION) OR array_key_exists("id", $_COOKIE)){
		header("Location: loggedin.php");
	}


	//retrieve date from the form
	if(array_key_exists( "login",$_POST)) 
	{

		 $email=$_POST['email'];
		 $pass=$_POST['pas'];

		//mysql_select_db("login");
		$link=mysqli_connect("localhost","root","","login");

		if(mysqli_connect_error()){
			die("bad connection");
		}
		//prevent mysql injection
		// $email=stripcslashes($email);
		// $pass=stripcslashes($pass);
		$email=mysqli_real_escape_string( $link,$email);
		$pass=mysqli_real_escape_string( $link,$pass);


		$result = mysqli_query($link,"select * from users where email='$email'")
			or die("Faild to connect database".mysql_error());

		$row=mysqli_fetch_array($result);

		if(isset($row)){
				$hashedpss=md5($_POST['pas']);
			if($hashedpss==$row['password'])
			{
				echo "login successfully";
				$_SESSION['id']=$row['id'];
				if($_POST['stayloggedIn']=='1')
				{
				
					setcookie("id",$row['id'],time()+60*60*24*365);

				}
				header("Location: loggedin.php");
			}
			else {
				$message = "The email or password is incorrect!";
				//header("Location: login.php");
				echo "<script type='text/javascript'>alert('$message');</script>";

				die();

			}

		}

	}
?> -->