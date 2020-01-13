<?php
session_start();
$use=0;
if(array_key_exists("id",$_COOKIE)){
   $_SESSION['id']=$_COOKIE['id'];
    }
if(array_key_exists("id", $_SESSION)){
        $use=1;
    }



include("header2.php");
 


include("footer.php"); 


?>