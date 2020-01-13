
    <script type="text/javascript" src="jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style type="text/css">
    html { 
  background: url(image2.jpg) no-repeat center center fixed; 
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
    #navbr{
        
      background: black ;
      color:white;  
      opacity:0.9;
        }

   .Shops{

    font:helvetica,sans-serif;
    font-size:125%;
    display:inline-block;
    width:200px;
    height:60px;
    /*background-color:#ccc;*/
    border:1px solid #ff0000;
    border-radius:5px;
    text-align:center;
    text-decoration: none;
    padding: 14px 25px;
    margin:5px 50px;
}
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

@media only screen and (max-width:620px) {
  /* For mobile phones: */
   #navbr,#frm {
    width:100%;
  }
}

  </style>
</head>
<body>
<div id="navbr">
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="home.php"><h2>Fashion Demand</h2></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="shops.php">Shops</a>
      </li>
      <!--<li class="nav-item">-->
      <!--  <a class="nav-link" href="#"></a>-->
      <!--</li>-->
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
     
      
    </ul>
  </div>
  
  <div>
     <?php if($use==0){
echo "<ul class='nav justify-content-end'>
     
      <li class='nav justify-content-end'>
        <a class='nav-link' href='index.php'>Log in</a>
      </li>
      
      <li class='nav justify-content-end'>
        <a class='nav-link' href='SignIn.php'>Sign Up</a>
      </li>
      <li class='nav justify-content-end'>
        <a class='nav-link 'href='register.php'>Register</a>
      </li>
      </ul>";
}
else{
    echo "<ul class='nav justify-content-end'>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='index.php?logout=1'>Log out</a>
      </li>
      </li>
      </ul>";

}
?>
</div>
  


</nav>
</div>