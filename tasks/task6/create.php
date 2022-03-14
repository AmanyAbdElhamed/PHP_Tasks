<?php
require 'dbConnection.php';

function Clean($input){
     
    $input = trim($input);
    $input = strip_tags($input);
    $input = stripslashes($input);
    return $input;
}
function upLoadImage($imgTmpName,$disPath){
  if(!move_uploaded_file($imgTmpName,$disPath)){
    echo 'Error try again';
    }
}
function validateImage(){
   
    if(!empty($_FILES['image']['type'])){

        $imgTmpName = $_FILES['image']['tmp_name'];
        $imgType    = $_FILES['image']['type'];

        $allowedExtention = ['png','jpg','jpeg'];

        $inArray      = explode('/',$imgType);
        $imgExtention = end($inArray);

        if(in_array($imgExtention,$allowedExtention)){

            $finalName=time().rand().'.'.$imgExtention;

            $disPath='uploads/'. $finalName;

            upLoadImage($imgTmpName, $disPath);
            return $disPath;
        }
        else{
            'Invalid Extention';
        }

    }
    else {
        echo ' Image Required';
    }
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title     = Clean($_POST['title']);
    $content   = Clean($_POST['content']);
    
    $errors = []; 
    
   
    if(empty($title)){
        $errors['Title'] = "Required Field ";
    }
    elseif(!preg_match("/^[a-zA-Z-' ]*$/",$title)){
        $errors['Title'] ="Title must be chars ";
    }
    if(empty($content)){
        $errors['Content'] = "Required Field ";
    }
    elseif(strlen($content)<50){
        $errors['Content'] ="Content Length Must Be >= 50 Chars";
    }
    if(count($errors) > 0 ){
        foreach ($errors as $key => $value) {
            echo ' - '.$key.' : '.$value.'<br>';
        }
    }else{
  
    $path=validateImage();
    $sql="insert into articals (title,content,imagePath) values('$title','$content','$path')";
    $opration=mysqli_query($con,$sql);
    if($opration){
        echo 'raw inserted';
    }
    else{
        echo 'Error Try again'.mysqli_error($con);

    }
       mysqli_close($con);
       
    }
 
}




?>

<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
</head>
<body>
<div class="container">
<h1>Artical</h1>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method='post' enctype="multipart/form-data">

    <div class="form-group">
    <label for="title"><b>Title</b></label>
    <input type="text" class="form-control" placeholder="Enter title" name="title"  >
    </div>

    <div class="form-group">
    <label for="content"><b>Content</b></label>
    <!-- <input type="text" class="form-control"  placeholder="Enter content" name="content"  > -->
     <textarea placeholder="Enter content" class="form-control" name="content" ></textarea>
    </div>

    <div class="form-group">
    <label for="image"><b>Upload Image</b></label>
    <input type="file" class="form-control"  name="image"  width="100" height="100" >
    </div>


    <button type="submit" class="btn btn-primary">Submit</button>
    
</form>
</div>
  
</body>
</html>