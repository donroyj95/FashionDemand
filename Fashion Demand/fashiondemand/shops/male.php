<?php
	session_start();

	if(array_key_exists("id",$_COOKIE)){

		$_SESSION['id']=$_COOKIE['id'];
	}
	if(array_key_exists("id", $_SESSION)){
	
		require('connectdb.php');
		$id=$_REQUEST['id'];
		// $result=mysqli_query($link,"SELECT * FROM dress where shopId='".$id."' AND gender='M' ")or die ( mysqli_error());	
/////////////////
		$status="";
	if (isset($_POST['code']) && $_POST['code']!=""){
			$code = $_POST['code'];
			$result = mysqli_query($link,"SELECT * FROM dress WHERE dressId='".$code."' ");
			$row = mysqli_fetch_assoc($result);
			$name = $row['file_name'];
			$code = $row['dressId'];
			$price = $row['price'];
			$rlQty=$row['quantity'];
			// $image = $row['image'];

			$cartArray = array(
				$code=>array(	
				'name'=>$name,
				'code'=>$code,
				'price'=>$price,
				'quantity'=>1,
				'rlQty'=>$rlQty
				// 'image'=>$image
			)
			);

			if(empty($_SESSION["shopping_cart"])) {
				$_SESSION["shopping_cart"] = $cartArray;
				$status = "<div class='box'>Product is added to your cart!</div>";
			}else{
					$temp=1;
					$array_keys = array_keys($_SESSION["shopping_cart"]);
					foreach($_SESSION["shopping_cart"] as $key => $value){
					if($code==$value['code']) {
						$status = "Product is already added to your cart!";
						$temp=0;
						break;	
					} }
					 if($temp){
						
						$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
						$status = "Product is added to your cart!";
					}

				}

	}

////////////////////

	}
	else{
		header("Location: ../index.php");
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Front Page</title>


	<meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">



	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style type="text/css">
		html { 
  background: url(image1.jpg) no-repeat center center fixed; 
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


		body{
			
			font:helvetica,sans-serif;
			font-size:125%;

		}

		input{
			font-size:15px;
			width:250px;
			margin:4px;
			padding:5px;
			border-radius:5px;
			border:1px solid gray;

		}
		


		/*#frm{
			
 			background: black;
			color:#eee;
			border:1px solid gray;
			border-radius:8px;
			padding:20px;
			width:500px;
			margin:100px auto;

			opacity: 0.7;
			filter: alpha(opacity=60);
		}*/
		
		#navbr{
			height:72px;
			width:100%;
		
			background: black ;
			color:white;	
			opacity:0.9;


		}
		.con{
			 border: 5px solid #fff;
 			
			display:flex;
			flex-wrap:wrap;
			justify-content: space-around;
			align-items:center;
		}


		

	
	</style>
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</head>
<body>
	


<div id="navbr">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  	<a class="navbar-brand" href="../home.php"><h2>Fashion Demand</h2></a>
  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  	</button>
  	<div class="collapse navbar-collapse" id="navbarNav">
    	<ul class="navbar-nav">
      	<li class="nav-item">
        <a class="nav-link" href="../home.php">Home</a>
      	</li>
      	<li class="nav-item">
        <a class="nav-link" href="../about.php">About</a>
      	</li>
    	</ul>
  </div>
  <ul class="nav justify-content-end">
      </li>
      <li class="nav-item">
      <a class="nav-link" href='../index.php?logout=1'>Log out</a>
      </li>
      </li>
      </ul>




</nav>
</div>

<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<div class="cart_div">
<input type="hidden" name="current_url" value=<?php echo $_SERVER['QUERY_STRING'] ?> />
<a href="cart.php"><img src="cart-icon.png" /> Cart<span><?php echo $cart_count; ?></span></a>
</div>
<?php } ?>
<div class="con">
<?php

$result=mysqli_query($link,"SELECT * FROM dress where shopId='".$id."' AND gender='M' ")or die (mysqli_error());
while($row=mysqli_fetch_array($result)){
if($row['quantity']>0){
		echo "<div class='card' style='width: 18rem;'>
			<form method='post' action=''>
			<input type='hidden' name='code' value=".$row[0]." />
		  <img src='Images/".$row[2]."' height='300px' class='card-img-top' alt='...'>
		  <div class='card-body'>
		  	<h5 class='card-title'> ".$row[3]."</h5>
		  	<h5 class='card-title'>Sizes : ".$row[5]."</h5>	
		    <h5 class='card-title'>Price : ".$row[6]."</h5>
		    <h5 class='card-title'>Available: ".$row[8]." pieces</h5>
		    <button type='submit' class='buy'>Add To Cart</button>

		  </div>
		  </form>
		</div>";

	}
 
}
mysqli_close($link);


?>
</div>
<br>
<br>
<?php ;
if($status)
echo "<script type='text/javascript'>alert('$status');</script>";
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>