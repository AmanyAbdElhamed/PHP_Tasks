<?php 
 
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
####################################################################################




############################################################################
# Fetch Data .... 
$orderID=makeDetailOrder();
$sql = "select order_details.* ,orders.*, products.* from order_details 
       inner join  orders on order_details.order_id = orders.id 
       inner join products on order_details.product_id = products.id 
       where  orders.id=$orderID";
$op  = doQuery($sql);
$data=mysqli_fetch_assoc($op);
#############################################
#fetch product
$sql1="select products.* from products inner join order_details 
on products.id=order_details.product_id where order_details.order_id=";
$op1=doQuery($sql1);

####################################################################
#fetch Address
$addressID=$_GET['id'];
$sql2="select Address_details.* from Address_details inner join orders
on Address_details.customer_id=orders.customer_id where Address_details.id=$addressID ";
$op2=doQuery($sql2);
$address_data=mysqli_fetch_assoc($op2);

####################################################################
#fetch phone ,name
$sql3="select users.* from users inner join orders
on users.id=orders.customer_id";
$op3=doQuery($sql3);
$users_data=mysqli_fetch_assoc($op3);

####################################################################
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/group12/App/users/resources/css/order.css">


    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container-fluid">

<div class="container">
  <!-- Title -->
  <!-- fetsh form -->
  
  <div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Order #<?php  echo $data['number_orders'];?></h2>
  </div>

  <!-- Main content -->
  <div class="row">
    <div class="col-lg-8">
      <!-- Details -->
      <div class="card mb-4">
        <div class="card-body">
          <div class="mb-3 d-flex justify-content-between">
            <div>
              <span class="me-3"><?php  echo  date('d-m-Y' ,$data['orderDate']);?></span>
              <!-- <span class="me-3">  #<?php  echo $data['number_orders'];?></span> -->
              <!-- <span class="me-3">Visa -1234</span>
              <span class="badge rounded-pill bg-info">SHIPPING</span> -->
            </div>
            <div class="d-flex">
              <!-- <button class="btn btn-link p-0 me-3 d-none d-lg-block btn-icon-text"><i class="bi bi-download"></i> <span class="text">Invoice</span></button> -->
              <div class="dropdown">
                <button class="btn btn-link p-0 text-muted" type="button" data-bs-toggle="dropdown">
                  <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i> Edit</a></li>
                  <li><a class="dropdown-item" href="#"><i class="bi bi-printer"></i> Print</a></li>
                </ul>
              </div>
            </div>
          </div>
          <table class="table table-borderless">
            <tbody>
            <?php $total=0;
             while($product_data=mysqli_fetch_assoc($op)){?>
              <tr>
                <td>
                
                  <div class="d-flex mb-2">
                    <div class="flex-shrink-0">
                    
                    
                      <img src="<?php echo Url('/Products/uploads/'.$product_data['productImage']); ?>" alt="" width="35" class="img-fluid">
                    </div>
                    <div class="flex-lg-grow-1 ms-3">
                      <h6 class="small mb-0"><a href="#" class="text-reset"><?php echo $product_data['productName']; ?></a></h6>
                      <!-- <span class="small">Color: Black</span> -->
                    </div>
                  </div>
                 
                </td>
                <td><?php echo $product_data['quantity']; ?></td>
                <td class="text-end"><?php $total+=$data['totalprice'];
                echo $product_data['productPrice']; ?> EPG</td>
              </tr>
              <?php }?>
            </tbody>
            <tfoot>
              <tr>
               
              <tr class="fw-bold">
                <td colspan="2">TOTAL</td>
                <td class="text-end"><?php echo $total;  ?> EPG</td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <!-- Payment -->
      <div class="card mb-4">
        <div class="card-body">
          <div class="row">
            
            <div class="col-lg-6">
              <h3 class="h6">Billing address</h3>
              <address>
                <strong><?php echo $users_data['name']; ?></strong><br>
                <?php echo $address_data['address'];?>, <?php echo $address_data['state'];?>,<?php echo $address_data['zipecode'];?><br>
                <?php echo $address_data['country'];?>, <?php echo $address_data['city'];?><br>
                <abbr title="Phone">Phone:</abbr> <?php echo $users_data['phone']; ?>
              </address>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <!-- Customer Notes -->
      
     

<!-- end while -->
</div>
  </div>
    
</body>
</html>