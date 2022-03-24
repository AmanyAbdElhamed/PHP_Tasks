<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';

##########################################################################################################
# Fetch  User Roles 

$sql = "select * from categories"; 
$category_id = doQuery($sql);

##########################################################################################################


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 
    $productName          = Clean($_POST['productName']);
    $productDescription   = Clean($_POST['productDescription']);
    $quantiy              = Clean($_POST['quantiy']);
    $productPrice         = Clean($_POST['productPrice']);
    $category_id          = Clean($_POST['category_id']);


    # VALIDATE INPUT ...... 
    $errors = [];

    # Valoidate productName .... 
    if (!Validate($productName , 'required')) {      
        $errors['productName '] = "Field Required";
    }

    # Validate  productDescription 
    if (!Validate($productDescription, 'required')) {      
        $errors['productDescription'] = "Field Required";
    }


     # Validate  quantity 
     if (!Validate($quantiy, 'required')) {      
        $errors['quantiy'] = "Field Required";
    }



    # Validate  productPrice
      if (!Validate($productPrice, 'required')) {      
        $errors['productPrice'] = "Field Required";
       }elseif(!validate($productPrice,"number")){
        $errors['productPrice'] = "Enter productPrice ";
    }



     # Validate  category_id 
     if (!Validate($category_id, 'required')) {      
        $errors['category'] = "Field Required";
       }elseif(!validate($category_id,"number")){
        $errors['category'] = "Invalid Number Format";
    }

     

     # Validate  Image 
      if (!Validate($_FILES['image']['name'], 'required')) {      
        $errors['Image'] = "Field Required";
       }elseif(!validate($_FILES,"image")){
        $errors['Image'] = "Invalid Image Format";
    }





    # Check errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        // code ..... 

        # Upload Image ..... 
         $addedBy=$_SESSION['user']['id'];
        $image = Upload($_FILES);
        $sql1 = "insert into products (productName,productDescription,quantity,productPrice,productImage,category_id,addedBy) values ('$productName','$productDescription','$quantiy','$productPrice','$image',$category_id,$addedBy)";
         $op  = doQuery($sql1);


        if ($op) {  
            $message = ["Message" => "Raw Inserted"];
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

            PrintMessages('Dashboard / Products / Create');

            ?>




        </ol>



        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">ProductName</label>
                <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="productName" placeholder="Enter productName">
            </div>


            <div class="form-group">
                <label for="exampleInputproductDescription">ProductDescription</label>
                <textarea class="form-control"  id="exampleInputproductDescription" aria-describedby="" name="productDescription" placeholder="Enter productDescription"> </textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputquantiy"> Quantiy</label>
                <input type="number" class="form-control"  id="exampleInputquantiy" name="quantiy" placeholder="quantiy">
            </div>

             <div class="form-group">
                <label for="exampleInputproductPrice"> ProductPrice</label>
                <input type="number" class="form-control"  id="exampleInputproductPrice" name="productPrice" placeholder="productPrice">
            </div>

            <div class="form-group">
                <label for="exampleInputcategory_id">Category</label>
                <select class="form-control" id="exampleInputcategory_id" name="category_id">

                    <?php

                    while ($data = mysqli_fetch_assoc($category_id)) {

                    ?>
                        <option value="<?php echo $data['id']; ?>">
                        <?php echo $data['categoryName']; ?>
                       </option>

                    <?php } ?>

                </select>
            </div>


            <div class="form-group">
                <label for="exampleInputproductImage">productImage</label>
                <input type="file" name="image">
            </div>


            <button type="submit" class="btn btn-primary">SAVE</button>
        </form>




    </div>
</main>





<?php

require '../layouts/footer.php';

?>