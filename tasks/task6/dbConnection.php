<?php

$server='localhost';
$dbName='group12';
$dbUser='root';
$dbpass='';
$con=mysqli_connect($server,$dbUser,$dbpass,$dbName);

if(!$con){
    echo die('error'.mysqli_connect_error());
}





?>