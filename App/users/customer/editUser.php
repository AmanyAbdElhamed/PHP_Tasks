<?php
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';


$id = $_SESSION['user']['id'];
$sql = "select * from users where id = $id";
$op  = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($op);



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = Clean($_POST['name']);
    $email    = Clean($_POST['email']);
    $phone    = Clean($_POST['phone']);
    
    $errors = [];
    if (!Validate($name,'required')) {
        $errors['Name'] = "Field Required";
    }elseif (!Validate($name,'string') ) {
        $errors['Name'] = "Field must be leters";
    }
    if (!Validate($email,'required')) {
        $errors['Email'] = "Field Required";
    } elseif (!Validate($email,'email')) {
        $errors['Email']   = "Invalid Email";
    }
    if(!Validate($phone,'required')){
        $errors['Phone'] = "Field Required";
    }
    // elseif(!filter_var($phone,FILTER_VALIDATE_INT)){
    //     $errors['phone'] = "Field must be numbers";
    // }
    if (!empty($_FILES['image']['name'])) {

      # Validate extension ..... 
      $imgType    = $_FILES['image']['type'];
      # Allowed Extensions 
      $allowedExtensions = ['jpg', 'png','jpeg'];
  
      $imgArray = explode('/', $imgType);
  
      # Image Extension ...... 
       $imageExtension =  strtolower(end($imgArray));
  
  
      if (!in_array($imageExtension, $allowedExtensions)) {
          $errors['Image'] = "Invalid Extension";
      }
    }
  
    
  

    if(count($errors)>0){
       $_SESSION['Message']=$errors;
    }
    else{
    
    if (!empty($_FILES['image']['name'])) {
      
      $FinalName = time() . rand() . '.' . $imageExtension;
      $disPath = 'uploads/' . $FinalName;
      $imgTemName = $_FILES['image']['tmp_name'];
      if (move_uploaded_file($imgTemName, $disPath)) {
        if(!empty($data['image'])){
        unlink('uploads/' . $data['image']);
        }
      }
    } else {
      $FinalName = $data['image'];
    }
    
    $sql = "update  users set name='$name', email='$email' , phone= $phone ,
      image='$FinalName' where id=$id";

    $op = doQuery($sql);
    if($op){
      $message = ["Message" => "Raw Updated"];
      header("Location: navbar.php");
    }else{
      $message = ["Message" => "Error Try Again"]; 
    }

    $_SESSION['Message'] = $message; 
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
    body {
      margin-top: 20px;
    }

    .avatar {
      width: 200px;
      height: 200px;
    }
  </style>
</head>

<body>


  <div class="container bootstrap snippets bootdey">
    <h1 class="text-primary">Edit Profile</h1>
    <hr>
    <div class="row">
      <!-- left column -->
      <form class="form-horizontal" role="form" method="post" 
      action="editUser.php?id=<?php echo $data['id'];?>" enctype="multipart/form-data">
      <div class="col-md-3">
        <div class="text-center">
          <?php if (empty($data['image'])) { ?>
            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="avatar img-circle img-thumbnail" alt="avatar">
          <?php } else { ?>
            <img src="<?php echo 'uploads/' . $data['image']; ?>" class="avatar img-circle img-thumbnail" alt="avatar">
          <?php } ?>
          <h6>Upload a different photo...</h6>

          <input type="file" class="form-control" name="image">
        </div>
      </div>

      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <!-- <div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          <i class="fa fa-coffee"></i>
           This is an <strong>.alert</strong>. Use this to show important messages to the user.

        </div> -->
        <h3>Personal info</h3>

      
          <div class="form-group">
            <label class="col-lg-3 control-label"> Name :</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name='name' value="<?php echo $data['name']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email :</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name='email' value="<?php echo $data['email']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Phone:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name='phone' value="<?php echo $data['phone']; ?>">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-10">
            <div class="pull-right">
              <button type="submit" class="btn btn-info ">
                <span class="glyphicon glyphicon-share-alt"></span>
                Save
              </button>
            </div>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
  <hr>
</body>

</html>