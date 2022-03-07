<?php

function nextChar($str){
    $nextStr=++$str;
    if(strlen($nextStr)>1){
        $nextStr=$nextStr[0];
    }
    echo $nextStr;
}

nextChar('r')

?>