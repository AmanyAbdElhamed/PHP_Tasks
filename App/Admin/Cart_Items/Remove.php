<?php 

   require '../helpers/DBConnection.php';
   require '../helpers/functions.php';
   require '../helpers/checkLogin.php';
   require '../helpers/checkAdmin.php';

  $id = $_GET['id']; 

  # Call DBRemove Method 
  $status = DBRemove('cart_items',$id); 


  if($status){
      $message = ["Message" => "Raw Removed"]; 
  }else{
    $message = ["Message" => "Error Try Again"]; 
  }

  $_SESSION['Message'] = $message; 

  header("Location: index.php");
?>