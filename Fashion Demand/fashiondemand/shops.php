<?php
session_start();
include("connectdb.php");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$use=0;
$result = mysqli_query($link,"SELECT * FROM shops");



mysqli_close($link);

if(array_key_exists("id",$_COOKIE)){
   $_SESSION['id']=$_COOKIE['id'];
    }
    if(array_key_exists("id", $_SESSION)){
        $use=1;
    }


if($_POST){

   // echo $_POST['shops'];

    if($use)
    {
        $shopId=$_POST['shops'];
        header("Location: shops/frontPage.php");
    }
    else{
        header("Location: index.php");
    }


}

?>


<!DOCTYPE html>
<html>
<head>
	<title>shops</title>
    <?php include("header2.php");?>

<form id='frm' method='post'>


<?php 
while($row = mysqli_fetch_array($result))
{

//echo "<a href='login.php' id='lst'>".$row['shopName'] ."</a>";
//echo "<p><input type='submit' name='id' id='".$row['shopId']."' value='".$row['shopName'] ."'></p>";
// echo "<p><button class='Shops' type='submit' name='shops' value='".$row['shopId']."'>".$row['shopName'] ."</button></p>";

//</p><a href='shops/".$row['shopId']."/female/female.php' >Female</a>
echo "<p><div class='btn-group dropright'>
  <button type='button' class='Shops btn btn-secondary dropdown-toggle' value='".$row['shopId']."'   data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" .$row['shopName'] .
  "</button>
  <div class='dropdown-menu'>
   <p>
   <a href='shops/male.php?id=".$row['shopId']."'>Male</a>
   </p><a href='shops/female.php?id=".$row['shopId']."'>Female</a>

  </div>
</div></p>";


}

?>

</form>


<?php include("footer.php"); ?>




