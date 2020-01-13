<?php
	session_start();

	if(array_key_exists("id",$_COOKIE)){

		$_SESSION['id']=$_COOKIE['id'];
	}
	if(array_key_exists("id", $_SESSION)){
	
	
   //          $to = "manojjayasinghe43@gmail.com";
   //          $subject = "Subject of your email";
   //          $email_body = "The text for the mail...";
   //          $txt="hello";
			// $recipient="www.anuhasr@gmail.com";            

   //          mail($recipient, $subject,$txt, $email_body);
        


	include("connectdb.php");	
	if(isset($_POST['submit_row']))
	{
			 	 
			 
			 $price=$_POST['price'];
			 $size=$_POST['size'];
			 $gender=$_POST['gender'];
			 $type=$_POST['type'];
			 $quantity=$_POST['quantity'];	
			

			$result=mysqli_query($link,"SELECT shopId from shops where ownerId='".mysqli_real_escape_string($link,$_SESSION['id'])."'");

			$row=mysqli_fetch_array($result);
			
$targetDir = "Images/";
$allowTypes = array('jpg','png','jpeg','gif','pdf');
$gen='';
			for($i=0;$i<count($price);$i++)
			 {
				  if($price[$i]!="" && $size[$i]!=""&&$gender[$i+1]!="" )
				  {
					  	
					  	if($gender[$i+1]=="Female"){
					  		$gen='F';
					  	}
					  	else{
					  		$gen='M';
					  	}

							
							 $fileName = basename($_FILES["image"]["name"][$i+1]);

							$fileSize = $_FILES["image"]["size"];
							$targetFilePath = $targetDir . $fileName;
							$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
							$statusMsg = '';
								

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
								           
								             $insert =  mysqli_query($link,"INSERT INTO dress (uploadOn,file_name,type,price,size,gender,shopId,quantity) VALUES(NOW(),'".$fileName."','".$type."','".$price[$i]."','".$size[$i]."','".$gen."','".$row['shopId']."','".$quantity[$i]."')");

								            if($insert){
								                $statusMsg = "The dress ".($i+1)." has been uploaded successfully.";
								            }else{
								                $statusMsg = "Dress ".($i+1)." upload failed, please try again.";
								            } 
								        }else{
								            $statusMsg = "Sorry, there was an error uploading your file(File may be too large.upload less than 4MB images) ".($i+1).".";
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
	else{
	    	if (isset($_GET['message'])) {
	    $Message=$_GET['message'];
    echo "<script type='text/javascript'>alert('$Message');</script>";
    unset($_GET);
    $Message="";
    }
	    
	}



	$result2 =mysqli_query($link,"SELECT * FROM dress where shopId=(select shopId from shops where ownerId='".mysqli_real_escape_string($link,$_SESSION['id'])."')");
	 $dataRow = "";
	 	 // $row2 = mysqli_fetch_array($result2);

	//  	 while($row2 = mysqli_fetch_array($result2))
	// {
 //  	  $dataRow = $dataRow."<tr><td>$row2[0]</td><td>$row2[1]</td><td>$row2[3]</td><td>$row2[4]</td><td>$row2[5]</td><td>$row2[6]</td><td><a href='delete.php?id= $row['id']'>Delete</a></td></tr>";
	// }

	 
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
			width:60%;
			margin:1px;
			padding:3px;
			border-radius:5px;
			border:1px solid gray;

		}
		label{

			position: relative;
			top:10px;
			width:20%;
			float:left;
		}


			.my-custom-scrollbar {
		position: relative;
		height: 450px;
		overflow: auto;
		}
		.table-wrapper-scroll-y {
		display: block;
		}
		#SignUp,#Login,#btn,#Register{
			color:#eee;
			background: #337ab7;
		    font-size:15px;
			/*width:120px;*/
			width:10%;
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
			/*height:72px;*/
			/*width:100%;*/
			position: relative;
			background: black ;
			color:white;	
			opacity:0.9;
			


		}



		#wrapper
		{
		 margin:0 auto;
		 padding:0px;
		 text-align:center;
		 /*width:900px;*/
		 width:100%;
		}
		#wrapper h1
		{
		 margin-top:15px;
		 font-size:45px;
		 color:#9A7D0A;
		}
		#wrapper h1 p
		{
		 font-size:18px;
		}
		
		#employee_table input[type="text"]
		{
		 /*width:100px;*/
		 width:70%;
		 height:35px;
		 padding-left:10px;
		}
		#employee_table input[type="button"]
		{
		 /*width:100px;*/
		 width:100%;
		 height:35px;
		 
		}
		#employee_table input[type="number"]
		{
		 /*width:100px;*/
		 width:70%;
		 height:35px;
		 padding-left:10px;
		}
		
		#employee_table input[type="radio"]
		{
		 /*width:40px;*/
		 width:20%;
		 height:10px;
		 padding-left:10px;

		}
	
		span{
			margin-right:20px;

		}

		#MyForm,#MyForm3{
	display: none;
	/*border:3px solid gray;*/

	}	


	.sidenav {
  height: 1000px;
  /* Full-height: remove this if you want "auto" height */
  /*width: 180px; */
  width:12%;
  
  /* Set the width of the sidebar 
  position: fixed; /* Fixed Sidebar (stay in place on scroll) ///////////////////////////////////////////////*/
  z-index:1;

  /* Stay on top */
  top: 50%; /* Stay at the top */
  left: 0;
  
  float:left;
  background-color: #111; /* Black */
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 20px;


}

/* The navigation menu links */
.sidenav a{
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

  margin-left: 12%; /* Same as the width of the sidebar */
  padding: 1%;
}
#sub{
	width:20%;
}
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

	 

/* #DEL{
  	width:10%;
  }*/

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}


@media only screen and (max-width:620px) {
  /* For mobile phones: */
  body,label,input{
    width:100%;
    
  }
/*table,span,th{*/
/*    width:50%;*/
    /*font-size:70%;*/
    
/*  }*/
 #sub{
 	width:50%;
 }
 
 .sidenav  {
    width:100%;
    height:40%;
  }
  
  #MyForm3{
    width:100%;
  }

  #wrapper{
      width:200%;
  }
 #employee_table input[type="button"]{
      width:250%;
  }
  #employee_table input[type="file"]{
      width:250%;
  }
   #employee_table input[type="text"]{
      width:250%;
  }
  #employee_table input[type="number"]
		{  width:250%;
  }
  #employee_table input[type="radio"]
		{
			width:20%;
		}

  }
	</style>
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
$(document).ready(function(){ $('#additems').click(function(){$("#MyForm2").hide();$('#MyForm').toggle(500);});});
$(document).ready(function(){$('#viewItems').click(function(){$("#MyForm").hide();$('#MyForm2').toggle(500);});});
$(document).ready(function(){$('#viewItems').click(function(){$("#MyForm3").hide();$('#MyForm3').toggle(500);});});
</script>


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
      <!-- </li> -->
      <li class="nav-item">
        <a class="nav-link" href='../index.php?logout=1'>Log out</a>
      </li>
      <!-- </li> -->
      </ul>
</nav>
</div>


<div class="sidenav">
  <a href="#" id="additems" >Add Items</a>
  <a href="#" id="viewItems">View Items</a>
  <a href="#" id="delItems">Delete Items</a>
  <a href="#" id="#">Contact</a>
</div>

<!-- Page content -->
<div class="main">
<h1> Welcome to Fashion Demand</h1>


<p>Click below button to fill your profile details.</p>
<!-- <form method ="get" enctype="multipart/form-data" id="MyForm"> -->
<!-- <input type="submit" name="additems" value="Add Items"> -->


	
		 <form method="post" enctype="multipart/form-data" id="MyForm">
		 	<div style="overflow-x:auto;">
			<table id="employee_table" class="table table-striped" align=left>
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
				  	<tr><td><input type="text" name="type" placeholder="Type:Tshirts/shirst" list="typeName" autocomplete="off"></td></tr>
				   <tr id="row1">
					<!--    	<td><input type="text" name="Type" placeholder="Type"></td> -->
					    <td><input type="number" name="price[]" min="0" placeholder="Price(LKR)" required ></td>
					    
					    <td>
					    <select id="sizes" name="size[]">
						  <option value="S">S</option>
						  <option value="M">M</option>
						  <option value="L">L</option>
						  <option value="XL">XL</option>
						  <option value="XXL">XXL</option>
						  <option value="XXXL">XXXL</option>
						</select>
						</td>
					    <td>
					    	
					    	<span><input type="radio" name="gender[1]" value="Female" required >Female</span></td>
					   <td> <span><input type="radio" name="gender[1]" value="Male" required>Male</span></td>
					     <td><input type="number" name="quantity[]" min="1" placeholder="Quantity" required ></td>
					    <td><input type="file" name="image[1]"/ ></td>
					    <td></td>
				   </tr>
			</table>
		</div>
			<div id="sub">
			<input type="button" onclick="add_row();" value="ADD ROW">
			<input type="submit" name="submit_row" value="SUBMIT">
			</div>
		 </form>
	


<!-- </form> -->
<form method ="get" enctype="multipart/form-data" id="MyForm2">
	<div class="table-wrapper-scroll-y  my-custom-scrollbar" style="overflow-x:auto;">
		<table class="table table-bordered table-striped mb-0">
  <thead>
    <tr>		<th scope="col">#</th>
    			<th>Id</th>
    			
                <!--<th scope="col">Date</th>-->
                <th scope="col">Type</th>
                <th scope="col">Sex</th>
                <th scope="col">Size</th>
                <th scope="col">Image</th>
                <th scope="col">Price</th>
                <th scope="col">Qty</th>




        </tr>
            </thead>
          <tbody>
           <?php $NumOfRaw=1; while( $row2 = mysqli_fetch_array($result2)):; ?>
           
            <tr><td scope="row"><?php echo $NumOfRaw; ?></td>
                <td><?php echo $row2[0];?></td>
                <!--<td><?php echo $row2[1];?></td>-->
                <td><?php echo $row2[3];?></td>
                <td><?php echo $row2[4];?></td>
                <td><?php echo $row2[5];?></td>
                <td><img src="<?php echo 'Images/'.$row2[2];?>" height="60" width="50"></td>
                <td><?php echo $row2[6];?></td>
                <td><?php echo $row2[8];?></td>

                <td><a href="edit.php?id=<?php echo $row2[0]; ?>">Edit</a></td>
                <td><a href="delete.php?id=<?php echo $row2[0]; ?>">Del</a></td>
                
            </tr>
           
            <?php  $NumOfRaw=$NumOfRaw+1; endwhile;?>

        </tbody>
        
        </table>
		</div>

</form>

</div>
<!--<div>-->
<!--	<form method ="get"  enctype="multipart/form-data" id="MyForm3">-->
		
		
<!--	</form>-->

<!--</div>-->

<script>

function add_row()
{
 $rowno=$("#employee_table tr").length;

 $("#employee_table  tr:last").after("<tr id='row"+$rowno+"'><td><input type='number' min='0' name='price[]' placeholder='Price'></td><td><select id='sizes' name='size[]'><option value='S'>S</option><option value='M'>M</option><option value='L'>L</option><option value='XL'>XL</option><option value='XXL'>XXL</option><option value='XXXL'>XXXL</option></select></td><fieldset id='row"+$rowno+"'><td><span><input type='radio' name=gender["+$rowno+"] value='Female' required>Female</span></td><td><span><input type='radio' name=gender["+$rowno+"] value='Male' required>Male</span></td></fieldset><td><input type='number' name='quantity[]'  min='1' placeholder='Quantity'></td><td><input type='file' name=image["+$rowno+"] placeholder='Image'></td><div ><td ><input type='button' value='DELETE'  onclick=delete_row('row"+$rowno+"')></td></div></tr>");
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


