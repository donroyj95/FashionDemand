<?php
	session_start();
	if(array_key_exists("id",$_COOKIE)){
		$_SESSION['id']=$_COOKIE['id'];
	}
	if(array_key_exists("id", $_SESSION)){
		require('connectdb.php');
		$id=$_REQUEST['id'];//include("auth.php");
		$query0="SELECT * from shops where ownerId='".$_SESSION['id']."'";
		$query = "SELECT * from dress where dressId='".$id."'"; 
		$result0=mysqli_query($link, $query0) or die ( mysqli_error());
		$result = mysqli_query($link, $query) or die ( mysqli_error());
		$row0=mysqli_fetch_assoc($result0);
		$row = mysqli_fetch_assoc($result);
		if($row0['shopId']!=$row['shopId'])
			{
				header("Location: ../index.php");
			}
		}
	else{
		header("Location: ../index.php");
	}
		$status = "";
		if(isset($_POST['new']) && $_POST['new']==1)
		{
			$id=$_REQUEST['id'];
			// $trn_date = NOW();
			$type =$_REQUEST['type'];
			$gender =$_REQUEST['gender'];
			$size =$_REQUEST['size'];
			$price =$_REQUEST['price'];
			$quantity=$_REQUEST['quantity'];
			//$submittedby = $_SESSION["username"];echo $id;
			$update="UPDATE dress SET uploadOn=NOW(),
			type='".$type."', gender='".$gender."', size='".$size."', price='".$price."',quantity='".$quantity."' where dressId='".$id."'";
			$check=mysqli_query($link, $update) or die(mysqli_error());
			if($check){
 			$message = "Record Updated Successfully.";
			header("Location: frontpage.php?message=" . urlencode($message));}}?>
<!DOCTYPE html>
<html>
		<head>
		<meta charset="utf-8">
		<title>Update Record</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.css" />
		<style type="text/css">
		html { 
  background: url(img.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
	body{
		background: none;
	}
	</style>
		<style type="text/css">
			#frm{
			
 			background: black;
			color:#eee;
			border:1px solid gray;
			border-radius:8px;
			padding:20px;
			width:500px;
			margin:100px auto;

			opacity: 0.7;
			filter: alpha(opacity=60);
		}
		</style>


		</head>
		<body>
		<div class="form">
		<p><a href="dashboard.php">Dashboard</a> 
		| <a href="insert.php">Insert New Record</a> 
		| <a href="logout.php">Logout</a></p>
		<h1>Update Record</h1>

		<div>
		<!-- <form name="form" method="post" action=""> 
		<input type="hidden" name="new" value="1" />
		
		<input name="dressId" type="hidden" value="<?php echo $row['dressId'];?>" />
		<p>Type <input type="text" name="type" placeholder="Enter Type" 
		required value="<?php echo $row['type'];?>" /></p>
		Gender
<?php 
		if($row['gender']=='F'){
			echo"<p>Female <input type='radio' name='gender' value='F' required checked /></p>
			<p>Male <input type='radio' name='gender' value='M' required   /></p>";
		}
		else{
			echo"<p>Female <input type='radio' name='gender' value='F' required  /></p>
			<p>Male <input type='radio' name='gender' value='M' required checked  /></p>";

		}
?>

		<p>Size <input type="text" name="size" placeholder="Enter size" 
		required value="<?php echo $row['size'];?>" /></p>

		<p>Price <input type="number" name="price" placeholder="Enter price" 
		required value="<?php echo $row['price'];?>" /></p>

		<p><input name="submit" type="submit" value="Update" /></p>
		</form> -->
<div id="frm">
		<form name="form" method="post" action="" >
			<input type="hidden" name="new" value="1" />
		<input name="dressId" type="hidden" value="<?php echo $row['dressId'];?>" />
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-4 col-form-label">Type</label>
    <div class="col-sm-5">
      <input type="text" class="form-control"  name="type" required value="<?php echo $row['type'];?>"/>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-4 col-form-label">Size</label>
    <div class="col-sm-5">
      <input type="text" name="size" class="form-control"  required value="<?php echo $row['size'];?>" />
    </div>
  </div>
   <div class="form-group row">
    <label for="inputPassword3" class="col-sm-4 col-form-label">Price</label>
    <div class="col-sm-5">
      <input type="number" name="price" min="0" class="form-control" id="inputPassword3" required value="<?php echo $row['price'];?>" />
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-4 col-form-label">Quantity</label>
    <div class="col-sm-5">
      <input type="number" name="quantity" min="0" class="form-control" id="inputPassword3" required value="<?php echo $row['quantity'];?>" />
    </div>
  </div>
  <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-4 pt-0">Gender</legend>
        <div class="col-sm-5">
<?php 
		if($row['gender']=='F'){
			echo"
		<div class='form-check'>	
		<input class='form-check-input' type='radio' name='gender' value='F' required checked />
          <label class='form-check-label' for='gridRadios1'>
            Female 
          </label>
          </div>
          <div class='form-check'>
          <input class='form-check-input'type='radio' name='gender' value='M'>
          <label class='form-check-label' for='gridRadios2'>
            Male
          </label>
        </div>
			";
		}
		else{
			echo"
		<div class='form-check'>	
		<input class='form-check-input' type='radio' name='gender' value='F' required>
          <label class='form-check-label' for='gridRadios1'>
            Female
          </label>
          </div>
          <div class='form-check'>
          <input class='form-check-input' type='radio' name='gender'  value='M' required checked>
          <label class='form-check-label' for='gridRadios2'>
            Male
          </label>
        </div>";
		}
?>
      </div>
  </fieldset>
  <div class="form-group row">
    <div class="col-sm-10">
    	<input name="submit" type="submit" class="btn btn-primary" value="Update" />
    </div>
  </div>
</form>
</div>

</div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>