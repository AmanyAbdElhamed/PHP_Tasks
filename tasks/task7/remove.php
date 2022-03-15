<?php
require 'dbConnection.php';

$id = $_GET['id'];

$sql="select imagePath from articals where id=$id";
$op=mysqli_query($con,$sql);

$data=mysqli_fetch_assoc($op);


$sql="delete from articals where id=$id";
$op=mysqli_query($con,$sql);

if($op){
    $message='Raw Removed';
    unlink($data['imagePath']);
}else{
  $message='Error in Delete  '. mysqli_error($con);
}

$_SESSION['message']=$message;
header("location: index.php");

?>