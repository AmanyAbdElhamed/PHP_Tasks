<?php

# Logic ...... 
##########################################################################################################

require '../helpers/DBConnection.php';
require '../helpers/functions.php';


$sql = "select * from users";
$cart_op  = doQuery($sql);
##########################################################################################################
if($_SERVER['REQUEST_METHOD'] == "POST"){

    // CODE ..... 
    $customer_id = Clean($_POST['customer_id']);

   
    # VALIDATE INPUT ...... 
    $errors = []; 
    
    if(!Validate($customer_id ,'required')){  
        $errors['Customer_id'] = "Field Required";
    }elseif(!Validate($customer_id ,"number")){
        $errors['Customer_id'] = "Invalid Format ";
    }


    # Checke errors 
    if(count($errors) > 0){
       $_SESSION['Message'] = $errors;
    }else{
        // code ..... 

       $sql = "insert into cart (customer_id) values ($customer_id)"; 
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

             PrintMessages('Dashboard / Cart / Create');
             
          ?>
      
        
      
      
        </ol>



        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Customers </label>
                <!-- <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="customer_id" placeholder="Enter customer ID"> -->
                <select class="form-control" id="exampleInputPassword1" name="customer_id">

                    <?php

                    while ($data = mysqli_fetch_assoc($cart_op)) {

                    ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>

                    <?php } ?>

                </select>
            </div>

            <button type="submit" class="btn btn-primary">SAVE</button>
        </form>




    </div>
</main>





<?php

require '../layouts/footer.php';

?>