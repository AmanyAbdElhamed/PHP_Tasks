<?php
 
function readFromFile(){
    $data=[];
    $index=0;
    $file=fopen('Artical.txt','r') or die('unable to open file');
    while(!feof($file)){
      $line=fgets($file);
      $firstposition=strpos($line,'||');
      $secondposition=strpos($line,'#');
      $size =$secondposition-$firstposition ; 
      $data[$index]['title']=substr($line ,0,$firstposition);
      $data[$index]['content']=substr($line ,$firstposition+2,$size-2);
      $data[$index]['path']=substr($line ,$secondposition+1,$size);
      $index++;
    }
    fclose($file);
    return $data;
}
function writeInFil($data){
    $newData='';
    $file=fopen('Artical.txt','w+')or die('unable to open file');
    foreach($data as $line){
        foreach ($line as $key => $value) {
            if($key=='title'){
                $newData=$newData.$value."||";
            }
            elseif($key=='content'){
                $newData=$newData.$value."#";
            }else{
                $newData= $newData.$value."\n";
            }
        
        }
        
        
        fwrite($file,$newData);
    }
    fclose($file);
}
function deleteRaw($ind){
    $data=readFromFile();
    foreach ($data as $index => $arr) {
            if($index!=$ind){
                foreach ($arr as $key => $value) {
                    $data[$index][$key]=$arr[$key];
                    
                   } 
            }
            else{
                continue;
            }
           
        }
     writeInFil($data);   
}


include 'header.php';
?>

<body>
<section class="container my-3">
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>content</th>
                    <th>path</th>
                    <th>Actions</th>
                </tr>
                </td>         
             </thead>
            <tbody>
               
                <!-- <tr>
                    <td colspan="3" class="bg-danger text-white ">No Users Yet</td>
                </tr> -->
                
                
                    <?php $data=readFromFile();
                    echo '<tr>';
                    foreach ($data as $key1 => $arr) {
                   
                        echo '<td>';
                        echo  $data[$key1]['title'];
                        echo '</td>';
                        echo '<td>';
                        echo  $data[$key1]['content'];
                        echo '</td>';
                        echo '<td>';
                        echo '<img src="';
                        echo $data[$key1]['path'];
                        echo'" alt="Italian Trulli">' ;
                        echo '</td>';
                        echo '<td>';
                        
                        echo ' <button class="btn btn-danger " onclick="deleteRaw($key1)" >Delete</button>';
                        echo '</td>';
                        echo'</tr>';
                     } 
                     
                   

                    ?>
                    
                   
                
            </tbody>
        </table>
    </div>
</section> 
</body>
</html>