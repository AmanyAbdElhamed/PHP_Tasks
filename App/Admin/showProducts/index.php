<?php 

require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';

function addView($product_id){
    $sql="insert into views (product_id)values($product_id)";
    $op=doQuery($sql);
}

$product_id=$_GET["id"];
$sql = "select products.* , categories.categoryName from products
 inner join categories on products.category_id = categories.id where products.id=$product_id";
$op  = doQuery($sql);
addView($product_id);

$sql_view ="select count(product_id) from views where product_id=$product_id";
$op_view = doQuery($sql_view);
$number_views=mysqli_num_rows($op_view);
// echo '||  '.$number_views ;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="<?php echo Url("/resources/css/pdoductDetails.css");?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
    <!-- product -->
    <div class="product-content product-wrap clearfix product-deatil">
        <div class="row">

           
           <?php while ($raw = mysqli_fetch_assoc($op)){ ?>
            <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="product-image">
                   
                            <div class="item active">
                                <img src="<?php echo Url('/Products/uploads/'.$raw['productImage'])?>" class="img-responsive" alt="" />
                            </div>
                        
                </div>
            </div>
           
            <div class="col-md-6 col-md-offset-1 col-sm-12 col-xs-12">
                <h2 class="name">
                    <?php  echo $raw['productName']; ?>&nbsp;
                    <small>Category <a href="javascript:void(0);"><?php echo $raw['categoryName']; ?></a></small><br>
                    
                    <!-- <span class="fa fa-2x"><h5>(109) Votes</h5></span>
                    <a href="javascript:void(0);">109 customer reviews</a> -->
                </h2>
                <hr />
                <h3 class="price-container">
                <?php echo $raw['productPrice']; ?> GPE
                    <small>*includes tax</small>
                </h3>
                
                <hr />
                <div class="description description-tabs">
                    <ul id="myTab" class="nav nav-pills">
                        <li class="active"><a href="#more-information" data-toggle="tab" class="no-margin">Product Description </a></li>
                        <!-- <li class=""><a href="#specifications" data-toggle="tab">Specifications</a></li>
                        <li class=""><a href="#reviews" data-toggle="tab">Reviews</a></li> -->
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade active in" id="more-information">
                            <br />
                            <strong>Description Title</strong>
                            <p>
                            <?php echo $raw['productDescription']; ?>
                            </p>
                        </div>
            
                        </div>
                    </div>
                </div>
                <hr />
                <div class="pull-right">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <a href="<?php echo Url('showCarts/index.php?proID=').$raw['id'];?>" class="btn btn-success btn-lg">Add to cart (<?php echo $raw['productPrice']; ?> GPE)</a>
                    </div>
                    
                </div>
               
            </div>
            <?php  }?>
           
        </div>
    </div>
    <!-- end product -->
</div>


</body>
</html>