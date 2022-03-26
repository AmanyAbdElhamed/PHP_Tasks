<?php
require './classes/blogClass.php';


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $obj=new Artical();

    $Result=$obj->Insert($_POST);

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
<h1>Artical</h1>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method='post' enctype="multipart/form-data">

    <div class="form-group">
    <label for="title"><b>Title</b></label>
    <input type="text" class="form-control" placeholder="Enter title" name="title"  >
    </div>

    <div class="form-group">
    <label for="content"><b>Content</b></label>
    
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