<?php 

 require './helpers/functions.php';

 session_start();

 session_destroy(); 


 header("Location: http://localhost/group12/App/users/loginUser.php");



?>