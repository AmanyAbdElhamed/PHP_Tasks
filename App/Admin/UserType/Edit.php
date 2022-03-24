<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';

##########################################################################################################
# Fetch Raw Data ..... 

$id = $_GET['id'];
$sql = "select * from users_type where id = $id";
$op  = doQuery($sql);
$data = mysqli_fetch_assoc($op);

##########################################################################################################





if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 
    $type_name = Clean($_POST['type_name']);


    # VALIDATE INPUT ...... 
    $errors = [];

    if (!Validate($type_name, 'required')) {       //  Validate($title,'required') == false 
        $errors['type_name'] = "Field Required";
    }


    # Checke errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        // code ..... 

        $sql = "update users_type set type_name = '$type_name' where id=$id";
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

            PrintMessages('Dashboard / User_Type / Edit');

            ?>


        </ol>



        <form action="edit.php?id=<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">type name</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="type_name" value="<?php echo $data['type_name']; ?>" placeholder="Enter Type_Name">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>




    </div>
</main>





<?php

require '../layouts/footer.php';

?>