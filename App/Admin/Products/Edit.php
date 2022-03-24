<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
##########################################################################################################
# Fetch Raw Data ..... 
$id = $_GET['id'];
$sql = "select * from products where id = $id";
$op  = doQuery($sql);
$data = mysqli_fetch_assoc($op);

##########################################################################################################
# Fetch categories ..... 
$sql = "select * from categories"; 
$category_op  = doQuery($sql);
##########################################################################################################
#check users
if($data['addedBy'] !=  $_SESSION['user']['id'] && $_SESSION['user']['role']!="Admin"){
    header("Location: ".Url('Products'));
    exit();
}
#############################################################################



if ($_SERVER['REQUEST_METHOD'] == "POST") {

   // CODE ..... 
    $productName           = Clean($_POST['productName']);
    $productDescription    = Clean($_POST['productDescription']);
    $quantiy               = Clean($_POST['quantiy']);
    $productPrice          = Clean($_POST['productPrice']);
    $category_id           = Clean($_POST['category_id']);


    # VALIDATE INPUT ...... 
    $errors = [];

    # Validate productName .... 
    if (!Validate($productName , 'required')) {      
        $errors['productName '] = "Field Required";
    }

    # Validate  productDescription 
    if (!Validate($productDescription, 'required')) {      
        $errors['productDescription'] = "Field Required";
    }


     # Validate  quantiy 
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

    if (Validate($_FILES['image']['name'], 'required')) {      
        if(!validate($_FILES,"Image")){
       $errors['Image'] = "Invalid Image Format";
      }
   }




    # Check errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        // code ..... 

        # Upload productImage ..... 
        $addedBy=$_SESSION['user']['id'];
        $Image = Upload($_FILES);
        $sql = "update products set productName='$productName',productDescription='$productDescription',
        quantity='$quantiy',productPrice='$productPrice',productImage ='$Image',category_id=$category_id
        where addedBy=$addedBy";
         $op  = doQuery($sql);


        if ($op) {  
            $message = ["Message" => "Raw Updated"];
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
                <label for="exampleInputName">ProductName</label>
                <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="productName" placeholder="Enter productName">
         </div>


           <div class="form-group">
                <label for="exampleInputproductDescription">ProductDescription</label>
                <textarea class="form-control"  id="exampleInputproductDescription" aria-describedby="" name="productDescription" placeholder="Enter productDescription"> </textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputquantiy"> Quantity</label>
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

                    while ($cat_data = mysqli_fetch_assoc($category_op)) {

                    ?>
                        <option value="<?php echo $cat_data['id']; ?>" <?php  if($cat_data['id'] == $data['category_id']){ echo 'selected';}?>><?php echo $cat_data['categoryName']; ?></option>

                    <?php } ?>

                </select>
            </div>



            

            <div class="form-group">
                <label for="exampleInputName">Image</label>
                <input type="file" name="image" >
            </div>
        
            <img src="uploads/<?php echo $data['Image'];?>" alt="" height="90" width="90">
           <br>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>




    </div>
</main>





<?php

require '../layouts/footer.php';

?>