<?php
require './helpers/DBConnection.php';
require './helpers/functions.php';

if($_SERVER['REQUEST_METHOD']=='POST'){

  $email    = Clean($_POST['email']);
  $password = Clean($_POST['password']);
  $errors = [];
  
  if (!Validate($email,'required')) {
    $errors['Email'] = "Field Required";
} elseif (!Validate($email,'email')) {
    $errors['Email']   = "Invalid Email";
}
if (!Validate($password,'required')) {
    $errors['Password'] = "Field Required";
} elseif (strlen($password) < 6) {
    $errors['Password'] = "Length Must be >= 6 chars";
}
  if(count($errors)>0){
    $_SESSION['Message']=$errors;
  }
else{
  $password = md5($password);

  $sql =  "select users.* , users_Type.type_name as role from users   inner join users_Type on users.userType_id = users_Type.id 
   where users.email = '$email' and users.password = '$password'"; 
  $result = mysqli_query($con,$sql); 

  if(mysqli_num_rows($result) == 1){
      $data = mysqli_fetch_assoc($result); 
      $_SESSION['user'] = $data; 
      header("Location: index.php");
  }else{
      echo 'Error In Login Try Again ';
  } 

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
    <link rel="stylesheet" type="text/css" href="reg.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
                            

<link href="https://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
<div class="container bootstrap snippets bootdey">
  <div class="header">
    <ul class="nav nav-pills pull-right">
      <!-- <li ><a href="http://getbootstrap.com/examples/jumbotron-narrow/#">Home</a></li> -->
      <!-- <li class="text-muted prj-name" ><a href="./registerUser.php">Register </a></li> -->
      <!-- <li><a href="http://getbootstrap.com/examples/jumbotron-narrow/#">About</a></li> -->
    </ul>
    <h3 class="text-muted prj-name">E-commerce</h3>
  </div>

  <div class="jumbotron text-center" style="min-height:250px;height:auto;">
    <div class="col-md-10 col-md-offset-2">
        <form class="form-horizontal" role="form" method="post"
        action="<?php echo $_SERVER['PHP_SELF'];?>">
            <div class="form-group text-center">
                <div class="col-sm-10 reg-icon">
                    <span class="fa fa-user fa-3x">Log in Admin</span>
                </div>
            </div>
            
              <div class="form-group">
                <div class="col-sm-10">
                  <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
              </div>
              
              <div class="form-group">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-info">
                    <span class="glyphicon glyphicon-share-alt"></span>
                    Sign In
                  </button>
                </div>
              </div>
        </form>
    </div>
  </div>
</div>                                        

</body>
</html>