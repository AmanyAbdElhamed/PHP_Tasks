<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';

##########################################################################################################
# Fetch Raw Data ..... 
$id = $_GET['id'];
$sql = "select * from orders where id = $id";
$op  = doQuery($sql);
$data = mysqli_fetch_assoc($op);

##########################################################################################################
# Fetch Roles ..... 
$sql = "select * from users_Type  "; 
$customer_id = doQuery($sql);
##########################################################################################################
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $orderDate      = Clean($_POST['orderDate']);
    $number_orders  = Clean($_POST['number_orders']);
    $customer_id    = Clean($_POST['customer_id']);
 
  

    # VALIDATE INPUT ...... 
    $errors = [];
    # Validate  orderDate... 
    if (!Validate($orderDate, 'required')) {
        $errors['Order Date'] = "Field Required";
    } elseif (!validate($orderDate, "orderDate")) {
        $errors['Order Date'] = "Invalid Format";
    }

     # Validate  number_orders 
     if (!Validate($number_orders, 'required')) {      
        $errors['number_orders'] = "Field Required";
       }elseif(!validate($number_orders,"number")){
        $errors['number_orders'] = "Enter number_orders ";
    }

     # Validate  customer_id
     if (!Validate($customer_id, 'required')) {      
        $errors['customer'] = "Field Required";
       }elseif(!validate($customer_id,"number")){
        $errors['customer'] = "Invalid Number Format";
    }


    # Check errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {

         $orderDate=strtotime($orderDate);
        $sql = "update orders set orderDate='$orderDate',number_orders=$number_orders,customer_id=$customer_id ";
         $op  = doQuery($sql);


        if ($op) {  
            $message = ["Message" => "Raw Updated"];
            header("Location: index.php");
        } else {
            $message = ["Message" => "Error Try Again"];
        }

        $_SESSION['Message'] = $message;
    }
}

##########################################################################################################





require '../layouts/header.php';

require '../layouts/nav.php';

require '../layouts/sidNav.php';
?>




<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">


            <?php

            PrintMessages('Dashboard / Products / Edit');

            ?>


        </ol>



        <form action="edit.php?id=<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">

         
        <div class="form-group">
                <label for="exampleInputproductDescription">Order Date</label>
                <input type="date" class="form-control"  id="exampleInputorderDate" aria-describedby=""
                value="<?php echo date('Y-m-d',$data['orderDate']);?>" name="orderDate"> </input>
            </div>

            <div class="form-group">
                <label for="exampleInputquantiy"> number_orders</label>
                <input type="number" class="form-control"  id="exampleInputquantiy" name="number_orders"
                value="<?php echo $data['number_orders']?>" placeholder="Enter number of orders">
            </div>
             <div class="form-group">
                <label for="exampleInputcategory_id">Customers</label>
                <select class="form-control" id="exampleInputcategory_id" name="customer_id">

                    <?php

                    while ($cust_data = mysqli_fetch_assoc($customer_id)) {

                    ?>
                        <option value="<?php echo $cust_data['id']; ?>" 
                        <?php  if($cust_data['id'] == $data['customer_id']){ echo 'selected';}?>><?php echo $cust_data['type_name']; ?></option>

                    <?php } ?>

                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>




    </div>
</main>





<?php

require '../layouts/footer.php';

?>