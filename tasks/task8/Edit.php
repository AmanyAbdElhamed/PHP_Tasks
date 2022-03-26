<?php

require './classes/blogClass.php';


$id=$_GET['id'];

$db=new DB();

$sql="select * from articals where id=$id";
$op=$db->doQuery($sql);
$data=mysqli_fetch_assoc($op);


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $obj=new Artical();

    $Result=$obj->Edit($_POST,$id,$data);

    foreach ($Result as $key => $value) {
        echo '- '.$key.' : '.$value.'<br>';
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
    <img src="uploads/<?php echo $data['imagePath'];?>" width="70" height="70">
    <input type="file" class="form-control"  name="image"  width="100" height="100" 
    value="" >
    
    </div>


    <button type="submit" class="btn btn-primary">Save</button>
    
</form>
</div>
  
</body>
</html>