<?php

$units =60;
$bill =0;
if($units >0 && $units <=50){
$bill = 3.50 * $units;
echo $bill." EGP";
}
elseif($units>50 && $units<=150){
$bill = 4.00 * $units;
echo $bill." EGP";
}
elseif($units>150){
$bill = 6.50 * $units;    
echo $bill." EGP";
}
?>
