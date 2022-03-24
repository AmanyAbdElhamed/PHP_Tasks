<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';
##########################################################################################################
# Fetch Raw Data ..... 

$id = $_GET['id'];
$sql = "select * from cart_items where id = $id";
$op  = doQuery($sql);
$data = mysqli_fetch_assoc($op);

##########################################################################################################
#Fetch cart ..... 
$sql = "select * from cart"; 
$cart_op  = doQuery($sql);
##########################################################################################################
#Fetch products ..... 
$sql = "select * from products"; 
$product_op  = doQuery($sql);
##########################################################################################################







if ($_SERVER['REQUEST_METHOD'] == "POST") {

    
    $cart_id = Clean($_POST['customer_id']);
    $product_id = Clean($_POST['product_id']);
    $items_quantity = Clean($_POST['items_quantity']);

   
    # VALIDATE INPUT ...... 
    $errors = []; 
    
    if(!Validate($cart_id ,'required')){  
        $errors['Cart_id'] = "Field Required";
    }elseif(!Validate($cart_id ,"number")){
        $errors['Cart_id'] = "Invalid Format ";
    }



    if(!Validate($product_id ,'required')){  
        $errors['Product_id'] = "Field Required";
    }elseif(!Validate($product_id ,"number")){
        $errors['Product_id'] = "Invalid Format ";
    }


    if(!Validate($items_quantity ,'required')){  
        $errors['Items_quantity'] = "Field Required";
    }elseif(!Validate($items_quantity ,"number")){
        $errors['Items_quantity'] = "Invalid Format ";
    }

    # Checke errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        // code ..... 

        $sql = "update cart_items set customer_id = $customer_id , product_id=$product_id , items_quantity=$items_quantity     where id = $id";
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

            PrintMessages('Dashboard / Cart Items / Edit');

            ?>


        </ol>



        <form action="edit.php?id=<?php echo $data['id']; ?>" method="post" >

            <div class="form-group">
                <label for="exampleInputName">Cart ID</label>
                <!-- <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="cart_id" value="<?php echo $data['cart_id']; ?>" placeholder="Enter Cart ID"> 
            -->
            <select class="form-control" id="exampleInputPassword1" name="cart_id">

                    <?php

                    while ($cart_data = mysqli_fetch_assoc($cart_op)) {

                    ?>
                        <option value="<?php echo $cart_data['id']; ?>" <?php  if($cart_data['id'] == $data['cart_id']){ echo 'selected';}?>><?php echo $cart_data['id']; ?></option>

                    <?php } ?>

                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputName">Products</label>
                <!-- <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="product_id" value="<?php echo $data['product_id']; ?>" placeholder="Enter Product ID"> -->
                <select class="form-control" id="exampleInputPassword1" name="product_id">

                    <?php

                    while ($prod = mysqli_fetch_assoc($product_op)) {

                    ?>
                        <option value="<?php echo $prod['id']; ?>" <?php  if($prod['id'] == $data['product_id']){ echo 'selected';}?>><?php echo $prod['productName']; ?></option>

                    <?php } ?>

                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputName">Items Quantity</label>
                <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="items_quantity" value="<?php echo $data['items_quantity']; ?>" placeholder="Enter Items Quantity">
            </div>


            <button type="submit" class="btn btn-primary">Update</button>
        </form>




    </div>
</main>





<?php

require '../layouts/footer.php';

?>