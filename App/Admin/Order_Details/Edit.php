<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';

##########################################################################################################
# Fetch Raw Data ..... 

$id = $_GET['id'];
$sql = "select * from order_details where id = $id";
$op  = doQuery($sql);
$data = mysqli_fetch_assoc($op);

##########################################################################################################
#Fetch Orders
$sql = "select * from orders"; 
$order_op  = doQuery($sql);
##########################################################################################################
#Fetch products ..... 
$sql = "select * from products"; 
$product_op  = doQuery($sql);
##########################################################################################################





if ($_SERVER['REQUEST_METHOD'] == "POST") {

    
    $order_id = Clean($_POST['order_id']);
    $product_id = Clean($_POST['product_id']);
    $quantity = Clean($_POST['quantity']);
    $unitPrice = Clean($_POST['unitPrice']);

   
    # VALIDATE INPUT ...... 
    $errors = []; 
    
    if(!Validate($order_id ,'required')){  
        $errors['Order_id'] = "Field Required";
    }elseif(!Validate($order_id ,"number")){
        $errors['Order_id'] = "Invalid Format ";
    }


    if(!Validate($product_id ,'required')){  
        $errors['Product_id'] = "Field Required";
    }elseif(!Validate($product_id ,"number")){
        $errors['Product_id'] = "Invalid Format ";
    }


    if(!Validate($quantity ,'required')){  
        $errors['Quantity'] = "Field Required";
    }elseif(!Validate($quantity ,"number")){
        $errors['Quantity'] = "Invalid Format ";
    }

    if(!Validate($unitPrice ,'required')){  
        $errors['UnitPrice'] = "Field Required";
    }elseif(!Validate($unitPrice ,"number")){
        $errors['UnitPrice'] = "Invalid Format ";
    }

    # Checke errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        // code ..... 

        $sql = "update order_details set  order_id=$order_id  , product_id=$product_id , quantity=$quantity ,unitPrice=$unitPrice     where id = $id";
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





require '../layouts/header.php';

require '../layouts/nav.php';

require '../layouts/sidNav.php';
?>




<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">


            <?php

            PrintMessages('Dashboard / Order Detalils / Edit');

            ?>


        </ol>



        <form action="edit.php?id=<?php echo $data['id']; ?>" method="post" >

          

            <div class="form-group">
                <label for="exampleInputName">Product </label>
               
                <select class="form-control" id="exampleInputPassword1" name="product_id">

                    <?php

                    while ($prod = mysqli_fetch_assoc($product_op)) {

                    ?>
                        <option value="<?php echo $prod['id']; ?>" <?php  if($prod['id'] == $data['product_id']){ echo 'selected';}?>><?php echo $prod['productName']; ?></option>

                    <?php } ?>

                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputName"> Quantity</label>
                <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="quantity" value="<?php echo $data['quantity']; ?>" placeholder="Enter  Quantity">
            </div>

            <div class="form-group">
                <label for="exampleInputName"> Unit Price</label>
                <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="unitPrice" value="<?php echo $data['unitPrice']; ?>" placeholder="Enter Unit Price">
            </div>


            <button type="submit" class="btn btn-primary">Update</button>
        </form>




    </div>
</main>





<?php

require '../layouts/footer.php';

?>