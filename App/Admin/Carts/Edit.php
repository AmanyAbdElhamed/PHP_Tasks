<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
##########################################################################################################
# Fetch Raw Data ..... 

$id = $_GET['id'];
$sql = "select * from cart  where cart.id = $id";
$op  = doQuery($sql);
$data = mysqli_fetch_assoc($op);

##########################################################################################################
#Fetch Rolles ..... 
$sql = "select * from users"; 
$roles_op  = doQuery($sql);
##########################################################################################################






if ($_SERVER['REQUEST_METHOD'] == "POST") {

    
    $customer_id = Clean($_POST['customer_id']);

   
    # VALIDATE INPUT ...... 
    $errors = []; 
    
    if(!Validate($customer_id ,'required')){  
        $errors['Customer_id'] = "Field Required";
    }elseif(!Validate($customer_id ,"number")){
        $errors['Customer_id'] = "Invalid Format ";
    }
    # Checke errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        // code ..... 

        $sql = "update cart set customer_id = $customer_id where id = $id";
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

            PrintMessages('Dashboard / Cart / Edit');

            ?>


        </ol>



        <form action="edit.php?id=<?php echo $data['id']; ?>" method="post" >

            <div class="form-group">
                <label for="exampleInputName">Customer </label>
                <!-- <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="customer_id" value="<?php //echo $data['customer_id']; ?>" placeholder="Enter customer ID"> -->
                <select class="form-control" id="exampleInputPassword1" name="customer_id">

                    <?php

                    while ($role_data = mysqli_fetch_assoc($roles_op)) {

                    ?>
                        <option value="<?php echo $role_data['id']; ?>"     <?php  if($role_data['id'] == $data['customer_id']){ echo 'selected';}?>><?php echo $role_data['name']; ?></option>

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