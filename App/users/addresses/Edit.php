<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
##########################################################################################################
# Fetch Raw Data ..... 

$id = $_GET['id'];
$sql = "select * from address_details where id = $id";
$op  = doQuery($sql);
$data = mysqli_fetch_assoc($op);

##########################################################################################################





if ($_SERVER['REQUEST_METHOD'] == "POST") {

    
    $address = Clean($_POST['address']);
    $city    = Clean($_POST['city']);
    $state   = Clean($_POST['state']);
    $zipecode = Clean($_POST['zipecode']);
    $country = Clean($_POST['country']);
   
    
    $errors = []; 
    
    if(!Validate($address,'required')){       
        $errors['Address'] = "Field Required";
    }
    if(!Validate($city,'required')){       
      $errors['City'] = "Field Required";
    }
    if(!Validate($state,'required')){       
      $errors['State'] = "Field Required";
    }
    if(!Validate($zipecode,'required')){       
      $errors['Zipcode'] = "Field Required";
    }
    if(!Validate($country,'required')){       
    $errors['Country'] = "Field Required";
    }

    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        
        $custID=1;
      //$_SESSION['user']['id'];
        $sql = "update address_details set address='$address', city='$city',
        state='$state', zipecode='$zipecode',country='$country' where customer_id= $custID";
        $op  =  doQuery($sql);


        if ($op) {
            $message = ["Message" => "Raw Updated"];
            $_SESSION['Message'] = $message;
            header("Location: index.php");
            exit();
        } else {
            $message = ["Message" => "Error Try Again"];
            $_SESSION['Message'] = $message;
        }
    }
}

##########################################################################################################



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
    <h1 class="text-primary">Add Address</h1>
    <hr>
    <div class="row">
      <!-- left column -->
      <form class="form-horizontal" role="form" method="post" 
      action="Edit.php?id=<?php echo $data['id'];?>" >
      <div class="col-md-3">
        <div class="text-center">
          <?php if (empty($_SESSION['user']['image'])) { ?>
            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="avatar img-circle img-thumbnail" alt="avatar">
          <?php } else { ?>
            <img src="<?php echo 'http://localhost/group12/App/users/customer/uploads/' .$_SESSION['user']['image']; ?>" class="avatar img-circle img-thumbnail" alt="avatar">
          <?php } ?>
          

          
        </div>
      </div>
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
      
      <div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          <i class="fa fa-coffee"></i>
           This is an <strong>.alert</strong>. <?php PrintMessages('Address / Edit');?>
        </div>
        <h3>Personal info</h3>
       
        <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Line 1</label>
            <div class="col-sm-10">
              <input type="text" placeholder="Address Line 1" class="form-control"
               name="address" value="<?php echo $data['address'];?>">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">City</label>
            <div class="col-sm-10">
              <input type="text" placeholder="City" class="form-control" 
              name="city" value="<?php echo $data['city'];?>">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">State</label>
            <div class="col-sm-4">
              <input type="text" placeholder="State" class="form-control"
               name="state" value="<?php echo $data['state'];?>">
            </div>

            <label class="col-sm-2 control-label" for="textinput">Zipcode</label>
            <div class="col-sm-4">
              <input type="text" placeholder="Zip Code" class="form-control"
               name="zipecode" value="<?php echo $data['zipecode'];?>">
            </div>
          </div>



          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Country</label>
            <div class="col-sm-10">
              <input type="text" placeholder="Country" class="form-control"
               name="country" value="<?php echo $data['country'];?>">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="pull-right">                
                <button type="submit" class="btn btn-info">
                <span class="glyphicon glyphicon-share-alt"></span>
                    update</button>
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