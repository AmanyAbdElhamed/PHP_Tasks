<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
##########################################################################################################
# Fetch Raw Data ..... 

$id = $_GET['id'];
$sql = "select * from categories where id = $id";
$op  = doQuery($sql);
$data = mysqli_fetch_assoc($op);

##########################################################################################################





if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 
     $categoryName = Clean($_POST['categoryName']);
    $categoryDescription = Clean($_POST['categoryDescription']);


    # VALIDATE INPUT ...... 
    $errors = [];

    #Validate categoryName
    if (!Validate($categoryName, 'required')) {       
        $errors['categoryName'] = "Field Required";
    }

    #Validate categoryDescription

    if (!Validate($categoryDescription, 'required')) {       
        $errors['categoryDescription'] = "Field Required";
    }


    # Checke errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        // code ..... 

        $sql = "update categories set categoryName = '$categoryName', categoryDescription = '$categoryDescription' where id = $id";
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

            PrintMessages('Dashboard / Categories/ Edit');

            ?>


        </ol>



        <form action="edit.php?id=<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">

             <div class="form-group">
                <label for="exampleInputName">Category Name</label>
                <input type="text" class="form-control"  id="exampleInputcategoryName" aria-describedby="" name="categoryName" 
                value="<?php echo $data['categoryName']?>" placeholder="Enter categoryName">
            </div>

            <div class="form-group">
                <label for="exampleInputName">Category Description</label>
                <textarea class="form-control"  id="exampleInputName" aria-describedby=""
                 name="categoryDescription"  placeholder="Enter categoryDescription"><?php echo $data['categoryDescription']?> </textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>




    </div>
</main>





<?php

require '../layouts/footer.php';

?>