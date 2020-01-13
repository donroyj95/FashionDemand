<?php

session_start();

if(array_key_exists("id",$_COOKIE)){

		$_SESSION['id']=$_COOKIE['id'];
	}

	if(array_key_exists("id", $_SESSION)){

$total_price;		
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
	foreach($_SESSION["shopping_cart"] as $key => $value) {
		

		if($_POST["code"] == $value['code'])
		{

		unset($_SESSION["shopping_cart"][$key]);
		$status = "<div class='box' style='color:red;'>
		Product is removed from your cart!</div>";
		}
		if(empty($_SESSION["shopping_cart"]))
		unset($_SESSION["shopping_cart"]);
			}		
		}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
	
  foreach($_SESSION["shopping_cart"] as &$val){

    if($val['code'] === $_POST["code"]){
    	if($val['rlQty']>=$_POST["quantity"]){
        $val['quantity'] = $_POST["quantity"];
    }
    else {
    	$status = "<div class='box' style='color:red;'>
		Available quantityies are less!</div>";
    }
        break; // Stop the loop after we've found the product
    }
    }
}
if(isset($_POST['buy'])){
	include("connectdb.php");
	$order="Id"."\t"."QTY"."\t"."Price(LKR)"."\r\n";
	$tot=0;
	foreach($_SESSION["shopping_cart"] as &$val){

		$tot+=$val['quantity']*$val['price'];
		$order=$order.$val["code"]."\t".$val['quantity']."\t".$val['quantity']*$val['price']."\r\n";
		$result2=mysqli_query($link,"UPDATE dress SET quantity=quantity-'".$val['quantity']."' '$Hpass' where dressId='".$val['code']."'");
		if($result2){
			echo "pass";
		}
	}
	$order=$order."Total Price = ".$tot;




$result =mysqli_query($link,"SELECT * FROM users where id='".$_SESSION['id']."'");

$row=mysqli_fetch_array($result);


			$to = $row['email'];
			$subject = "Welcome";
			$txt = $order;
			$headers = "From: fashiondemand01.com" . "\r\n";
			mail($to,$subject,$txt,$headers);
			//mail("manojjayasinghe43@gmail.com",$subject,$txt,$headers);
			unset($_SESSION["shopping_cart"]);
			
			header("Location:../shops.php");

}
  	

}
else{header("Location: ../index.php");}
?>
<html>
<head>
<title>Shopping Cart</title>
<link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
</head>
<body>
<div style="width:700px; margin:50 auto;">

<h2>Fashion Demand Cart</h2>   

<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<div class="cart_div">
<a href="cart.php">
<img src="cart-icon.png" /> Cart
<span><?php echo $cart_count; ?></span></a>
</div>
<?php
}
?>

<div class="cart">
<?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>	
<table class="table">
<tbody>
<tr>
<td></td>
<td></td>
<td>QUANTITY</td>
<td>UNIT PRICE</td>
<td>ITEMS TOTAL</td>
</tr>	
<?php		
foreach ($_SESSION["shopping_cart"] as $product){
?>
<tr><!-- <img src='<?php echo $product["image"]; ?>' width="50" height="40" /> -->
<td><?php echo "<img src='Images/".$product["name"]."' width='50' height='40' alt='...'>" ?></td>
<td><br />
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='remove'>Remove Item</button>
</form>
</td>
<td>
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="change" />
<select name='quantity' class='quantity' onchange="this.form.submit()">
<option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
<option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
<option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
<option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
<option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
</select>
</form>
</td>
<td><?php echo "LKR ".$product["price"]; ?></td>
<td><?php echo "LKR ".$product["price"]*$product["quantity"]; ?></td>
</tr>
<?php
$total_price += ($product["price"]*$product["quantity"]);
}

?>

<tr>
<td colspan="5" align="right">
<strong>TOTAL: <?php echo "LKR ".$total_price; ?></strong>
</td>


</tr>
</tbody>
</table>
<form method="post">
	<input type="submit" name="buy" value ="BUY">  
</form>		
  <?php
}else{
	echo "<h3>Your cart is empty!</h3>";
	}
?>
</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">

<?php
if($status)
 echo $status; 
$status="";
// echo $_POST['current_url'];
?>


</div>


<br /><br />
<a href="../shops.php"><strong>Shops</strong></a> <br /><br />

</div>
</body>
</html>