<?php 

   require '../helpers/DBConnection.php';
   require '../helpers/functions.php';

  
  if($data['addedBy'] !=  $_SESSION['user']['id'] && $_SESSION['user']['role']!="Admin"){
    header("Location: ".Url('Products'));
    exit();
}

$id = $_GET['id']; 
# select image Name .... 
$sql = "select image from products where id = $id"; 
 $op  = doQuery($sql);
 $data = mysqli_fetch_assoc($op); 



  # Call DBRemove Method 
  $status = DBRemove('products',$id); 


  if($status){

    unlink('uploads/'.$data['image']);
    
      $message = ["Message" => "Raw Removed"]; 
  }else{
    $message = ["Message" => "Error Try Again"]; 
  }

  $_SESSION['Message'] = $message; 

  header("Location: index.php");
?>