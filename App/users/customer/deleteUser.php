<?php
require_once './dbConnection.php';

$id = $_GET['id'];

if ($id !== $_SESSION['user']['id']) {

  $sql = "select image from users where id = $id";
  $op = mysqli_query($con, $sql);
  $data = mysqli_fetch_assoc($op);

  $status =  DBRemove('users', $id);




  if ($status) {
    unlink('uploads/' . $data['image']);
    $message = ["Message" => "Raw Removed"];
  } else {
    $message = ["Message" => "Error Try Again"];
  }
} else {
  $message = ["Message" => "Can't do This Operation"];
}

$_SESSION['Message'] = $message;
header("Location: ");
