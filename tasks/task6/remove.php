<?php
require 'dbConnection.php';

$id = $_GET['id'];


$sql="delete from articals where id=$id";
$op=mysqli_query($con,$sql);

if(!$op){
  echo 'Error in Delete  '. mysqli_error($con);
}
header("location: index.php");

?>