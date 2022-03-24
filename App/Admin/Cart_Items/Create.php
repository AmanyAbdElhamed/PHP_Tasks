<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
// require '../helpers/checkAdmin.php';



############################################################################################
$sql = "select * from products";
$product_op  = doQuery($sql);
####################################################################################################
$sql="select * from cart";
$cart_op = doQuery($sql); 
####################################################################################################



if($_SERVER['REQUEST_METHOD'] == "POST"){

    // CODE ..... 
    $cart_id = Clean($_POST['cart_id']);
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
    if(count($errors) > 0){
       $_SESSION['Message'] = $errors;
    }else{
        // code ..... 

       $sql = "insert into cart_items (cart_id,product_id,items_quantity) values ($cart_id,$product_id,$items_quantity)"; 
       $op  = doQuery($sql);


       if($op){
           $message = ["Message" => "Raw Inserted"];
       }else{
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

             PrintMessages('Dashboard / Cart Items / Create');
             
          ?>
      
        
      
      
        </ol>



        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >

            <div class="form-group">
                <label for="exampleInputName">Carts </label>
                <!-- <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="cart_id" placeholder="Enter Cart ID"> -->
                <select class="form-control" id="exampleInputPassword1" name="cart_id">

                    <?php

                    while ($data = mysqli_fetch_assoc($cart_op)) {

                    ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['id']; ?></option>

                    <?php } ?>

                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputName">Products </label>
                <!-- <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="product_id" placeholder="Enter Product ID"> -->
                <select class="form-control" id="exampleInputPassword1" name="product_id">

                    <?php

                    while ($data = mysqli_fetch_assoc($product_op)) {

                    ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['productName']; ?></option>

                    <?php } ?>

                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputName">Items Quantity</label>
                <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="items_quantity" placeholder="Enter Items Quantity">
            </div>

            <button type="submit" class="btn btn-primary">SAVE</button>
        </form>




    </div>
</main>





<?php

require '../layouts/footer.php';

?>