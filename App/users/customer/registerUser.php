<?php
require '../helpers/DBConnection.php';
require '../helpers/functions.php';

function createCart(){
    $sql="select id from users order by id DESC limit 1";
    $op=doQuery($sql);
    $data=mysqli_fetch_assoc($op);
    $id=$data['id'];
   
    $sql="insert into cart (customer_id)values($id)";
    $op=doQuery($sql);
    if($op){
        $message = ["Message" => "Raw Inserted"];
        
    }else{
        $message = ["Message" => "Error Try Again".mysqli_error($GLOBALS['con'])]; 
    }

    $_SESSION['Message'] = $message; 
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $name     = Clean($_POST['name']);
    $email    = Clean($_POST['email']);
    $password = Clean($_POST['password']);
    $phone    = Clean($_POST['phone']);
    $gender   = $_POST['gender'];

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
    if (!Validate($password,'required')) {
        $errors['Password'] = "Field Required";
    } elseif (strlen($password) < 6) {
        $errors['Password'] = "Length Must be >= 6 chars";
    }
    if(!Validate($phone,'required')){
        $errors['Phone'] = "Field Required";
    }
    // elseif(!filter_var($phone,FILTER_VALIDATE_INT)){
    //     $errors['phone'] = "Field must be numbers";
    // }
    
    if(!Validate($gender,'checked')){
        $errors['Gender'] = "Field Required";
    }

    if(count($errors)>0){
       $_SESSION['Message']=$errors;
    }
    else{
        $password =   md5($password);
        $id=2;
        $sql="insert into users (name,email,password,gender,phone,userType_id)
        values ('$name','$email','$password','$gender','$phone', $id)";
        $op  = doQuery($sql);
        if($op){
            $message = ["Message" => "Raw Inserted"];
            createCart();
            
        }else{
            $message = ["Message" => "Error Try Again".mysqli_error($GLOBALS['con'])]; 
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
    <link rel="stylesheet" type="text/css" href="http://localhost/group12/App\users\resources\css\reg.css">
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
                <li class="text-muted prj-name"><a href="./loginUser.php">LogIn </a></li>
                <!-- <li><a href="http://getbootstrap.com/examples/jumbotron-narrow/#">About</a></li> -->
            </ul>
            <h3 class="text-muted prj-name">E-commerce</h3>
        </div>

        <div class="jumbotron text-center" style="min-height:400px;height:auto;">
            <div class="col-md-10 col-md-offset-2">
                <form class="form-horizontal" role="form" method="post"
                action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <div class="form-group text-center">
                    <?php PrintMessages('Users / Register');?>
                        <div class="col-sm-10 reg-icon">
                       
       
                            <span class="fa fa-user fa-3x">Sign up</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Name">
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
                            <input type="text" class="form-control" name="phone" placeholder="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">

                            <label>
                                <h4> Male</h4>
                            </label>&nbsp;
                            <input class="form-check-input" type="radio" name="gender" value="male">&nbsp;
                            <label>
                                <h4>Female</h4>
                            </label>&nbsp;
                            <input class="form-check-input" type="radio" name="gender" value="female">

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-info">
                                <span class="glyphicon glyphicon-share-alt"></span>
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>