<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';

# Fetch Data .... 
$custID=$_SESSION['user']['id'];
$sql = "select * from address_details where customer_id=$custID";
$op  = doQuery($sql);

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
    <h1 class="text-primary">List My Address</h1>
    <hr>
    <div class="row">
      <!-- left column -->
      
      <!-- <div class="col-md-3">
        <div class="text-center">
         
            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="avatar img-circle img-thumbnail" alt="avatar"> 
          
            <img src="<?php echo 'http://localhost/group12/App/users/customer/uploads/' . $_SESSION['user']['image']; ?>" class="avatar img-circle img-thumbnail" alt="image">
         
          

          
        </div>
      </div> -->
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
      
      <div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          <i class="fa fa-coffee"></i>
           This is an <strong>.alert</strong>. <?php PrintMessages('Address / Edit');?>
        </div>
        <h3>Personal info</h3>
       
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                List User's Address
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Address</th>
                                <th>city</th>
                                <th>state</th>
                                <th>zipcode</th>
                                <th>country</th>
                                <th>Control</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Address</th>
                                <th>city</th>
                                <th>state</th>
                                <th>zipcode</th>
                                <th>country</th>
                                <th>Control</th>
                            </tr>
                        </tfoot>


                        <tbody>

                            <?php

                            # Fetch And Print data .... 

                            while ($data = mysqli_fetch_assoc($op)) {

                            ?>
                                <tr>
                                    <td><?php echo $data['id']; ?></td>
                                    <td><?php echo $data['address']; ?></td>
                                    <td><?php echo $data['city']; ?></td>
                                    <td><?php echo $data['state']; ?></td>
                                    <td><?php echo $data['zipecode']; ?></td>
                                    <td><?php echo $data['country']; ?></td>
                                    <td>
                                      
                                   
                                      <a href='../customer/indexOrder.php?id=<?php echo $data['id']; ?>' class='btn btn-success m-r-1em'>  <span class="glyphicon glyphicon-share-alt"></span>Select</a>   
                                      
                                        <a href='edit.php?id=<?php echo $data['id']; ?>' class='btn btn-primary m-r-1em'>  <span class="glyphicon glyphicon-share-alt"></span>Edit</a>
                                        <a href='Remove.php?id=<?php echo $data['id']; ?>' class='btn btn-danger m-r-1em'>  <span class="glyphicon glyphicon-share-alt"></span>Delete</a>
                                    </td>


                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

   
             <div class="form-group">
            <div class="col-sm-10">
            <div class="pull-right">
              <a href="Create.php" class="btn btn-info ">
                <span class="glyphicon glyphicon-share-alt"></span>
                ADD New Address
                          </a>
            </div>
            </div>
          </div>
                </div>
            </div>
        </div>
        
      </div>
    </div>
  </div>
  <hr>
</body>

</html>
