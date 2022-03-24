<?php 
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';

$product_id=$_GET['proID'];
$_SESSION['proID']=$product_id;
$customer_id=$_SESSION['user']['id'];
$sql="select id from cart where customer_id=$customer_id";
    $op=doQuery($sql);
    $cart_data=mysqli_fetch_assoc($op);
    $cartID= $cart_data["id"];
####################################################################
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $quantity = Clean($_POST['quantity']);
    $errors = []; 
    if(!Validate($quantity ,'required')){  
        $errors['quantity'] = "Field Required";
    }elseif(!Validate($quantity ,"number")){
        $errors['quantity'] = "Invalid Format ";
    }
    if(count($errors) > 0){
       $_SESSION['Message'] = $errors;
    }else{
        $sq = "select quantity from products where id=$product_id";
        $op1  = doQuery($sq);
        $quan_data=mysqli_fetch_assoc($op1);
        if($quan_data['quantity']>=$quantity){
        
       $sql = "update  cart_items set items_quantity=$quantity where cart_id=$cartID and product_id=$product_id"; 
       $op  = doQuery($sql);
       if($op){
           $message = ["Message" => "Raw Updated"];
       }else{
           $message = ["Message" => "Error Try Again"]; 
       }
       $_SESSION['Message'] = $message; 
    }
    else{
        $message = ["Message" => "Quantity not in store"]; 
        $_SESSION['Message'] = $message; 
    }
   
}
}
###########################################################################

   
addToCart($product_id,$cartID);

$sql1 = "select products.*, cart_items.items_quantity  from cart_items 
  inner join products on products.id = cart_items.product_id where cart_id=$cartID";
$cart_op  = doQuery($sql1);
#############################################################################

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
     <link rel="stylesheet" type="text/css"  href="http://localhost/group12/App/Admin/resources\css\carts.css " >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<div class="container bootstrap snippets bootdey">
    <div class="col-md-9 col-sm-8 content">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="#">Home</a></li>
                  <li class="active">Cart</li>
                </ol>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                
                <div class="panel panel-info panel-shadow">
                    <div class="panel-heading">
                        <h3>
                            <!-- <img class="img-circle img-thumbnail" src="https://bootdey.com/img/Content/user_3.jpg"> -->
                           <?php PrintMessages()?>
                        </h3>
                    </div>
                    
                    <div class="panel-body"> 
                        <div class="table-responsive">
                        
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php $allTotal=0; $i=0; while($data=mysqli_fetch_assoc($cart_op)){ ?>
                                <tr>
                                    <td><img src="<?php echo Url('/Products/uploads/'.$data['productImage'])?>" class="img-cart"></td>
                                    <td><strong><?php echo $data['productName'];?></strong></td>
                                    <td>

                                    <form class="form-inline" action="index.php?proID=<?php echo $product_id; ?>" method="post">
                                        <input class="form-control" type="text" name="quantity" value="<?php echo $data['items_quantity']; ?>" >
                                        <button rel="tooltip" type="submit" class="btn btn-default"><i class="fa fa-pencil"></i></button>
                                        <!-- <a href="#" class="btn btn-primary"><i class="fa fa-trash-o"></i></a> -->
                                    </form>
                                    </td>
                                    <td><?php echo $data['productPrice'];?></td>
                                   
                                    <td> <?php $total= $data['productPrice'] *
                                     $data['items_quantity'];
                                      echo $total;
                                      $allTotal+=$total; ?></td>
                                </tr>
                                <?php $_SESSION['orderDetails']['productID'][$i]=$data['id'];
                                      $_SESSION['orderDetails']['Quantity'][$i]=$data['items_quantity'];
                                      $_SESSION['orderDetails']['Price'][$i]=$data['productPrice']; $i++; }?>
                                <tr>
                                    <td colspan="6">&nbsp;</td>
                                </tr>
                                
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Total</strong></td>
                                    <td><?php $_SESSION['Total']=$allTotal;
                                               echo $allTotal ;?></td>
                                </tr>
                                     
                                    
                                </tr>
                                
                                
                            </tbody>
                        </table>
                        
                    </div>
                </div>
              
                </div>
                <a href="http://localhost/group12/App/indexProduct.php" class="btn btn-success"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Continue Shopping</a>
                <a href="http://localhost/group12/App/users/addresses/index.php" class="btn btn-primary pull-right">Next<span class="glyphicon glyphicon-chevron-right"></span></a>
                          
            </div>
        </div>
    </div>
</div>
</body>
</html>