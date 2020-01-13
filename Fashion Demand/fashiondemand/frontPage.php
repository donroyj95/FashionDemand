<?php
	session_start();

	if(array_key_exists("id",$_COOKIE)){

		$_SESSION['id']=$_COOKIE['id'];
	}
	if(array_key_exists("id", $_SESSION)){
	
		// if($_POST){
		// 	include("connectdb.php");
		// 	$result=mysqli_query($link,"SELECT shopId from shops WHERE '".$_SESSION['id']."'=ownerId ");
		// 	$row=mysqli_fetch_array($result);
		
		// 	mysqli_query($link,"INSERT INTO dress (type,shopId) VALUES('".mysqli_real_escape_string($link,$_POST['type'])."','".$row['shopId']."'");
	
		// }

		include("connectdb.php");	
	if(isset($_POST['submit_row']))
	{
			 	 
			 
			 $price=$_POST['price'];
			 $size=$_POST['size'];
			 $gender=$_POST['gender'];
			 $type=$_POST['type'];
			
			

			$result=mysqli_query($link,"SELECT shopId from shops where ownerId='".mysqli_real_escape_string($link,$_SESSION['id'])."'");

			$row=mysqli_fetch_array($result);
			


			for($i=0;$i<count($price);$i++)
			 {
				  if($price[$i]!="" && $size[$i]!=""&&$gender[$i+1]!="" )
				  {
					  	$gen='';
					  	if($gender[$i+1]=="Female"){
					  		$gen='F';
					  	}
					  	else{
					  		$gen='M';
					  	}



					 //  	$check = getimagesize($_FILES['image']['tmp_name']);

					 // if($check !== false){
					 //        $image = $_FILES['image']['tmp_name'];
					 //        $imgContent = addslashes(file_get_contents($image));



					         // mysqli_query($link,"INSERT INTO dress (uploadOn,type,price,size,gender,shopId) VALUES(NOW(),'".$type."','".$price[$i]."','".$size[$i]."','".$gen."','".$row['shopId']."')");



					       	// }
					       	// else {
					       	// 	echo "error";
					       	// }
//////////////////////////////////////
							$targetDir = "../Images/";
							 $fileName = basename($_FILES["image"]["name"][$i+1]);

							$fileSize = $_FILES["image"]["size"];
							$targetFilePath = $targetDir . $fileName;
							$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
							$statusMsg = '';
								

								
								
							    // Allow certain file formats
							    $allowTypes = array('jpg','png','jpeg','gif','pdf');
							    if(in_array($fileType, $allowTypes)){
							    	$extension = pathinfo($_FILES["image"]["name"][$i+1], PATHINFO_EXTENSION);
									$name = $targetDir ."man";

									$check= mysqli_query($link,"SELECT * FROM dress where file_name='".mysqli_real_escape_string($link,$fileName)."' ");
											if( mysqli_num_rows($check)>0)
											{
												$message = "Image name has already exist!";
											    echo "<script type='text/javascript'>alert('$message');</script>";
												
											}
									

							        // Upload file to server
							       else{

								       		 if(move_uploaded_file($_FILES["image"]["tmp_name"][$i+1], $targetFilePath)){
								           
								             $insert =  mysqli_query($link,"INSERT INTO dress (uploadOn,file_name,type,price,size,gender,shopId) VALUES(NOW(),'".$fileName."','".$type."','".$price[$i]."','".$size[$i]."','".$gen."','".$row['shopId']."')");

								            if($insert){
								                $statusMsg = "The dress ".($i+1)." has been uploaded successfully.";
								            }else{
								                $statusMsg = "Dress ".($i+1)." upload failed, please try again.";
								            } 
								        }else{
								            $statusMsg = "Sorry, there was an error uploading your file ".($i+1).".";
								        }
							    }



							    }else{
							        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
							    }
											  	
													
								if($statusMsg){
								echo "<script type='text/javascript'>alert('$statusMsg');</script>";				  	
							}
												   


		    

//////////////////////////////////



				  }
				  else{
				  		echo "empty";
				  }
			 }
	}



	$result2 =mysqli_query($link,"SELECT * FROM dress where shopId=(select shopId from shops where ownerId='".mysqli_real_escape_string($link,$_SESSION['id'])."')");
	 $dataRow = "";
	 	 

	 	 while($row2 = mysqli_fetch_array($result2))
	{
  	  $dataRow = $dataRow."<tr><td>$row2[0]</td><td>$row2[1]</td><td>$row2[3]</td><td>$row2[4]</td><td>$row2[5]</td><td>$row2[6]</td></tr>";
	}

	 
}
	



	
	else{
		header("Location: ../../login.php");
	}


	




?>


<!DOCTYPE html>
<html>
<head>
	<title>Front Page</title>


	<meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">



	<link rel="stylesheet" type="text/css" href="style.css">
	

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
		label{

			position: relative;
			top:10px;
			width:180px;
			float:left;
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
		#SignUp,#Login,#btn,#Register{
			color:#eee;
			background: #337ab7;
		    font-size:15px;
			width:120px;
			margin:4px;
			padding:5px;
			border-radius:5px;
			border:1px solid gray;
		}
		#heading{
			background: black ;
			color:white;	
			opacity:0.5;
			margin:0px;
		}
		#navbr{
			background: black ;
			color:white;	
			opacity:0.8;
		}



		#wrapper
		{
		 margin:0 auto;
		 padding:0px;
		 text-align:center;
		 width:900px;
		}
		#wrapper h1
		{
		 margin-top:50px;
		 font-size:45px;
		 color:#9A7D0A;
		}
		#wrapper h1 p
		{
		 font-size:18px;
		}
		#employee_table input[type="text"]
		{
		 width:150px;
		 height:35px;
		 padding-left:10px;
		}
		#form_div input[type="button"]
		{
		 width:110px;
		 height:35px;
		 background-color:#D4AC0D;
		 border:none;
		 border-bottom:3px solid #B7950B;
		 border-radius:3px;
		 color:white;
		}
		#form_div input[type="submit"]
		{
		 margin-top:10px;
		 width:110px;
		 height:35px;
		 background-color:#D4AC0D;
		 border:none;
		 border-bottom:3px solid #B7950B;
		 border-radius:3px;
		 color:white;
		}
		#employee_table input[type="radio"]
		{
		 width:40px;
		 height:10px;
		 padding-left:10px;

		}
		span{
			margin-right:20px;

		}

		#MyForm,#MyForm2{
	display: none;
	/*border:3px solid gray;*/

	}	


	.sidenav {
  height: 100%; /* Full-height: remove this if you want "auto" height */
  width: 160px; /* Set the width of the sidebar */
  position: fixed; /* Fixed Sidebar (stay in place on scroll) ///////////////////////////////////////////////*/
  z-index: 1; /* Stay on top */
  top: 1; /* Stay at the top */
  left: 0;
  background-color: #111; /* Black */
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 20px;
}

/* The navigation menu links */
.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover {
  color: #f1f1f1;
}

/* Style page content */
.main {
  margin-left: 160px; /* Same as the width of the sidebar */
  padding: 0px 10px;
}
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

	 table,th,tr,td
            {
                border: 1px solid black;
            }


	</style>
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
$(document).ready(function(){ $('#additems').click(function(){$("#MyForm2").hide();$('#MyForm').toggle(500);});});
$(document).ready(function(){$('#viewItems').click(function(){$("#MyForm").hide();$('#MyForm2').toggle(500);});});
</script>


</head>
<body>
	


<div id="navbr">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  	<a class="navbar-brand" href="../../home.php"><h2>Fashion Demand</h2></a>
  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  	</button>
  	<div class="collapse navbar-collapse" id="navbarNav">
    	<ul class="navbar-nav">
      	<li class="nav-item">
        <a class="nav-link" href="../../home.php">Home</a>
      	</li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li> -->
      	<li class="nav-item">
        <a class="nav-link" href="../../about.php">About</a>
      	</li>
    	</ul>
  </div>
  <ul class="nav justify-content-end">
      </li>
      <li class="nav-item">
        <a class="nav-link" href='../../login.php?logout=1'>Log out</a>
      </li>
      </li>
      </ul>




</nav>
</div>


<div class="sidenav">
  <a href="#" id="additems" >Add Items</a>
  <a href="#" id="viewItems">View Items</a>
  <a href="#" id="#">Clients	</a>
  <a href="#" id="#">Contact</a>
</div>

<!-- Page content -->
<div class="main">
<h1> Welcome to Fashion Demand</h1>


<p>Click below button to fill your profile details.</p>
<!-- <form method ="get" enctype="multipart/form-data" id="MyForm"> -->
<!-- <input type="submit" name="additems" value="Add Items"> -->
<div id="wrapper">

	<div id="form_div">
		 <form method="post" enctype="multipart/form-data" id="MyForm">

			<table id="employee_table" align=center>
				  	<datalist id="typeName">
				  		<option value="T-shirt">T-Shirt</option>
				  		<option value="Shirt">Shirt</option>
				  		<option value="Trouser">Trouser</option>
				  		<option value="Blouse">Blouse</option>
				  		<option value="Frock">Frock</option>
				  		<option value=""></option>
				  		<option value=""></option>
				  		<option value=""></option>
				  		<option value=""></option>
				  	</datalist>
				  	<tr><input type="text" name="type" placeholder="Type:Tshirts/shirst" list="typeName" autocomplete="off"></tr>
				   <tr id="row1">
					<!--    	<td><input type="text" name="Type" placeholder="Type"></td> -->
					    <td><input type="number" name="price[]" placeholder="Price(LKR)" required ></td>
					    <datalist id="sizes">
					    	<option value="S">S</option>
					  		<option value="M">M</option>
					  		<option value="L">L</option>
					  		<option value="XL">XL</option>
					  		<option value="XXL">XXL</option>
					  		<option value="XXXL">XXXL</option>
					    </datalist>
					    <td><input type="text" name="size[]" placeholder="Size" required list="sizes" autocomplete="off"></td>

					    <td>
					    	
					    	<span><input type="radio" name="gender[1]" value="Female" required >Female</span></td>
					   <td> <span><input type="radio" name="gender[1]" value="Male" required>Male</span></td>
					    
					    <td><input type="file" name="image[1]"/ ></td>
				   </tr>
			</table>
			<input type="button" onclick="add_row();" value="ADD ROW">
			<input type="submit" name="submit_row" value="SUBMIT">
			
		 </form>
	</div>

</div>
<!-- </form> -->
<form method ="get" enctype="multipart/form-data" id="MyForm2">

<table class="table table-striped">
  <thead>
    <tr>
    	<th>Dress Id</th>
                <th>Date</th>
                <th>Type</th>
                <th>Gender</th>
                <th>Size</th>
                <th>Price</th>
        </tr>




		<!-- <table style="background-color: green;">
            <tr>
                <th>Dress Id</th>
                <th>Date</th>
                <th>Type</th>
                <th>Gender</th>
                <th>Size</th>
                <th>Price</th>
                
            </tr> -->
            
           <?php echo $dataRow;?>

        </table>
</form>

</div>

<script>

function add_row()
{
 $rowno=$("#employee_table tr").length;

 $("#employee_table tr:last").after("<tr id='row"+$rowno+"'><td><input type='number' name='price[]' placeholder='Price'></td><td><input type='text' name='size[]' placeholder='Size'></td><fieldset id='row"+$rowno+"'><td><span><input type='radio' name=gender["+$rowno+"] value='Female' required>Female</span></td><td><span><input type='radio' name=gender["+$rowno+"] value='Male' required>Male</span></td></fieldset><td><input type='file' name=image["+$rowno+"] placeholder='Image'></td><td><input type='button' value='DELETE' onclick=delete_row('row"+$rowno+"')></td></tr>");
 // alert("gender['"+$rowno+"']");
}
function delete_row(rowno)
{
 $('#'+rowno).remove();
}
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>




</body>
</html>


