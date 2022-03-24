<?php 
   
   if(!isset($_SESSION['user'])){
       header("Location: loginUser.php");
       exit();
   }
?>