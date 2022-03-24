<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';


if($_SERVER['REQUEST_METHOD'] == "POST"){

    // CODE ..... 
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
    if(count($errors) > 0){
       $_SESSION['Message'] = $errors;
    }else{
        // code ..... 

       $sql = "insert into order_details (order_id,product_id,quantity,unitPrice) values ($order_id,$product_id,$quantity,$unitPrice)"; 
       $op  = doQuery($sql);


       if($op){
           $message = ["Message" => "Raw Inserted"];
       }else{
           $message = ["Message" => "Error Try Again".mysqli_error($con)]; 
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
                <label for="exampleInputName">Order ID</label>
                <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="order_id" placeholder="Enter Order ID">
            </div>

            <div class="form-group">
                <label for="exampleInputName">Product ID</label>
                <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="product_id" placeholder="Enter Product ID">
            </div>
            <div class="form-group">
                <label for="exampleInputName"> Quantity</label>
                <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="quantity" placeholder="Enter  Quantity">
            </div>
            <div class="form-group">
                <label for="exampleInputName">Unit Price</label>
                <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="unitPrice" placeholder="Enter Unit Price">
            </div>

            <button type="submit" class="btn btn-primary">SAVE</button>
        </form>




    </div>
</main>





<?php

require '../layouts/footer.php';

?>