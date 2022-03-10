<?php
session_start();

if(isset($_SESSION['artical'])){
    
    echo  $_SESSION['artical']['Title'].' || '
    .$_SESSION['artical']['Content'].'<br>';
}
else{
        echo 'No session with index (artical)<br>';
}

?>