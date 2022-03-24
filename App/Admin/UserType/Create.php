<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';


if($_SERVER['REQUEST_METHOD'] == "POST"){

    // CODE ..... 
    $type_name = Clean($_POST['type_name']);

   
    # VALIDATE INPUT ...... 
    $errors = []; 
    
    if(!Validate($type_name,'required')){       //  Validate($type_name,'required') == false 
        $errors['type_name'] = "Field Required";
    }


    # Checke errors 
    if(count($errors) > 0){
       $_SESSION['Message'] = $errors;
    }else{
        // code ..... 

       $sql = "insert into users_type (type_name) values ('$type_name')"; 
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

             PrintMessages('Dashboard / Roles / Create');
             
          ?>
      
        
      
      
        </ol>



        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Type_name</label>
                <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="type_name" placeholder="Enter Type_Name">
            </div>

            <button type="submit" class="btn btn-primary">SAVE</button>
        </form>




    </div>
</main>





<?php

require '../layouts/footer.php';

?>