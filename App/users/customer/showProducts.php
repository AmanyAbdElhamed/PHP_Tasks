<?php
require '../helpers/DBConnection.php';
require '../helpers/functions.php';

$sql = "select * from users";
$op  = doQuery($sql);




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
    <div class="row">
    <?php while ($data = mysqli_fetch_assoc($op)) {
            $id=$data['userType_id'];
             $sql="select type_name from users_type where id=$id ";
             $op1=mysqli_query($con,$sql);
             $result=mysqli_fetch_assoc($op1);
        ?>
        <div class="col-md-4">
            <div class="card user-card">
                <div class="card-header">
                    <h5>Profile</h5>
                </div>
                <div class="card-block">
                
                    <div class="user-image">
                        <img src="uploads./<?php echo $data['image'];?>" class="img-radius" alt="User-Profile-Image">
                        <!-- <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="img-radius" alt="User-Profile-Image"> -->
                    </div>
                    <h6 class="f-w-600 m-t-25 m-b-10"><?php echo $data['name'];?></h6>
                    <p class="text-muted"> <?php echo $result['type_name'];?> | <?php echo $data['gender'];?> | <?php echo $data['email'];?></p>
                    
                </div>
            </div>
        </div>
        <?php }?> 
       
	</div>
</div>
</body>
</html>