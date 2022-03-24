<?php
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';

$sql = "select products.* , categories.categoryName from products inner join categories on products.category_id = categories.id";

$op  = doQuery($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/group12/App/users/resources/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/group12/App/users/resources/css/product.css">
    <script src="http://localhost/group12/App/users/resources/js/navbar.js"></script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>


    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div id="wrapper" class="wrapper-content">
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        E-Commerce
                    </a>
                </li>
                <li>
                    <a href="http://localhost/group12/App\users\customer\editUser.php">Edit MY Profile</a>
                </li>
                <li>
                    <a href="http://localhost/group12/App\users\customer\EditPassword.php">Edit Password</a>
                </li>
                <li>
                    <a href="http://localhost/group12/App\users\addresses\index.php">Address</a>
                </li>

            </ul>
        </div>

        <div id="page-content-wrapper">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <!-- <button class="btn-menu btn btn-success btn-toggle-menu" type="button"> -->
                            <!-- <i class="fa fa-bars"></i>
                        </button> -->
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="./navbar.php" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-panel"></i>
                                    <p>Home</p>
                                </a>
                            </li>
                            <li>
                                <a href="../logout.php">
                                    <i class="ti-settings"></i>
                                    <p>Log Out</p>
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
                        <div class="container">
                            <div class="row">

                                <?php while ($raw = mysqli_fetch_assoc($op)) { ?>


                                    <div class="col-md-3">
                                        <div class="ibox">
                                            <div class="ibox-content product-box active">

                                                <div>

                                                    <img src="<?php echo Url('/Products/uploads/' . $raw['productImage']) ?>" width="230px" height="100px" alt="">
                                                </div>
                                                <div class="product-desc">
                                                    <span class="product-price">
                                                        <?php echo $raw['productPrice']; ?> GPE
                                                    </span>
                                                    <!-- <small class="text-muted"><?php echo $raw['categoryName']; ?></small> -->
                                                    <a href="#" class="product-name"> <?php echo $raw['productName']; ?></a>




                                                    <div class="m-t text-righ">

                                                        <a href="<?php echo Url('showProducts/index.php?id=') . $raw['id']; ?>" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>





                                <?php } ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>