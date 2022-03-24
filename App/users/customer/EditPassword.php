<?php 

require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';




if($_SERVER['REQUEST_METHOD']=='POST'){
   
    $currentPassword = Clean($_POST['currentPassword']);
    $newPassword = Clean($_POST['newPassword']);

    $errors = [];
    
    if (!Validate($currentPassword,'required')) {
        $errors['Current Password'] = "Field Required";
    } elseif (!Validate($currentPassword,'length')) {
        $errors['Current Password'] = "Length Must be >= 6 chars";
    }
    if (!Validate($newPassword,'required')) {
        $errors['New Password'] = "Field Required";
    } elseif (!Validate($newPassword,'length')) {
        $errors['New Password'] = "Length Must be >= 6 chars";
    }
    
    if(count($errors)>0){
       $_SESSION['Message']=$errors;
    }
    else{
        $id = $_SESSION['user']['id'];
        $sql = "select * from users where id = $id";
        $op  = mysqli_query($con, $sql);
        $data = mysqli_fetch_assoc($op);
        $oldPassword=$data['password'];
        if($oldPassword== md5($currentPassword)){
            $newPassword =   md5($newPassword);
            $sql = "update  users set password='$newPassword' where id=$id";
            $op  = doQuery($sql);
          
        if($op){
            $message = ["Message" => "Raw Inserted"];
        
            
        }else{
            $message = ["Message" => "Error Try Again"]; 
        }
        }
        else{
            $message = ["Message" => "Current Password Not Correct "];
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
    <link rel="stylesheet" type="text/css" href="http://localhost/group12/App\users\resources\css\pass.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/group12/App/users/resources/css/navbar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container bootstrap snippets bootdey">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-2">

       
            <div class="panel panel-info">
                
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-th"></span>
                        Change password   
                    </h3>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> " method="post">
                <div class="panel-body">
                    
                        <?php echo PrintMessages();?>
                        
                         <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                              <input class="form-control" type="password" name="currentPassword" placeholder="Current Password" >
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span></div>
                              <input class="form-control" type="password" name="newPassword" placeholder="New Password">
                            </div>
                          </div>
                      
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6"></div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <button class="btn icon-btn-save btn-success" type="submit">
                            <span class="btn-save-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>save</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
           
        </div>
    </div>
</div>
</body>
</html>