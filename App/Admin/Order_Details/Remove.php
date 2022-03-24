<?php 

   require '../helpers/DBConnection.php';
   require '../helpers/functions.php';
   require '../helpers/checkLogin.php';
   

  $id = $_GET['id']; 

  # Call DBRemove Method 
  $status = DBRemove('order_details',$id); 


  if($status){
      $message = ["Message" => "Raw Removed"]; 
  }else{
    $message = ["Message" => "Error Try Again"]; 
  }

  $_SESSION['Message'] = $message; 

  header("Location: index.php");
?>