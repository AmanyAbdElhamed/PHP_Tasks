<?php

require './classes/dbConnection.php';

$db=new DB();
$id = $_GET['id']; 

$sql = "select imagePath from articals where id = $id"; 

 $op  =$db-> doQuery($sql);

 $data = mysqli_fetch_assoc($op); 
  
 $status = $db->DBRemove('articals',$id); 
if($status){

    unlink('uploads/'.$data['imagePath']);
    
      $message = ["Message" => "Raw Removed"]; 
  }else{
    $message = ["Message" => "Error Try Again"]; 
  }

 

  header("Location: index.php");
?>