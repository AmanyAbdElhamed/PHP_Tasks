<?php 
 
  
  if($_SESSION['user']['role'] != "Admin"){
      header("Location: ".Url());
  }


?>