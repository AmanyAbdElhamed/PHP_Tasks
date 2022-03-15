<?php
require 'dbConnection.php';


$id=$_GET['id'];
$sql="select * from articals where id=$id";
$op=mysqli_query($con,$sql);
$data=mysqli_fetch_assoc($op);


function Clean($input){
    return stripslashes(strip_tags(trim($input)));
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
           return 'Invalid Extention';
        }

    }
    else {
       return 0;
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
     # Validate Image ... 
    if (empty($_FILES['image']['name'])) {
        $path=0;
    } 
    else {

        $imgType    = $_FILES['image']['type'];
        $allowedExtensions = ['jpg', 'png','jpeg'];
        $imgArray = explode('/', $imgType);
        $imageExtension =  strtolower(end($imgArray));
        if (!in_array($imageExtension, $allowedExtensions)) {
            $errors['Image'] = "Invalid Extension";
        }
    }
        
    if(count($errors) > 0 ){
        foreach ($errors as $key => $value) {
            echo ' - '.$key.' : '.$value.'<br>';
        }
    }
    else{
        # Upload Image ..... 
        $FinalName = time() . rand() . '.' . $imageExtension;
        $disPath = 'uploads/' . $FinalName;
        $imgTemName = $_FILES['image']['tmp_name'];
        if (move_uploaded_file($imgTemName, $disPath)) {
    
        if($path==0){
        $image=$data['imagePath'];
        $sql="update articals set title='$title',content='$content',imagePath='$image' where id=$id";
        $flage=false;
        }
        else{                                                                                                
        $sql="update articals set title='$title',content='$content',imagePath='$path' where id=$id";
         $flage=true;
        }
        $opration=mysqli_query($con,$sql);
        if($opration&& $flage){
            $message= 'raw Updated';
            unlink($data['imagePath']);
            $_SESSION['message']=$message;
            header("location: index.php");
        }
        elseif($opration&& !$flage){
        $message= 'raw Updated';
        $_SESSION['message']=$message;
        header("location: index.php");
        }
        else{
        echo 'Error Try again'.mysqli_error($con);
        }
       mysqli_close($con); 
    }
    else{
        echo 'Error In Upload File Try Again';
        }
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
<h1>Update</h1>

<form action="edit.php?id=<?php echo $id;?> "method='post' enctype="multipart/form-data">

    <div class="form-group">
    <label for="title"><b>Title</b></label>
    <input type="text" class="form-control" placeholder="Enter title" name="title" value="<?php echo $data['title']; ?>" >
    </div>

    <div class="form-group">
    <label for="content"><b>Content</b></label>
    <input placeholder="Enter content" class="form-control" name="content" value="<?php echo $data['content'];?>" >
    </div>

    <div class="form-group">
    <label for="image"><b>Upload Image</b></label>
    <img src="<?php echo $data['imagePath'];?>" width="70" height="70">
    <input type="file" class="form-control"  name="image"  width="100" height="100" 
    value="" >
    
    </div>


    <button type="submit" class="btn btn-primary">Save</button>
    
</form>
</div>
  
</body>
</html>