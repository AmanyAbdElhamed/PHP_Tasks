<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';

# Fetch Data .... 
$sql = "select products.* , categories.categoryName from products inner join categories on products.category_id = categories.id";
$op  = doQuery($sql);

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

            PrintMessages('Dashboard/Products');

            ?>
        </ol>






        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                List User System Roles
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Product Description</th>
                                <th>Quantity</th>
                                <th>Product Price</th>
                                <th>Category Name</th>
                                <th> Image</th>
                                <th>CONTROL</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                               <th>ID</th>
                                <th>Product Name</th>
                                <th>Product Description</th>
                                <th>Quantity</th>
                                <th>Product Price</th>
                                <th>Category Name</th>
                                <th> Image</th>
                                <th>CONTROL</th>
                            </tr>
                        </tfoot>


                        <tbody>

                            <?php

                            # Fetch And Print data .... 

                            while ($data = mysqli_fetch_assoc($op)) {

                            ?>
                                <tr>
                                    <td><?php echo $data['id']; ?></td>
                                    <td><?php echo $data['productName']; ?></td>
                                    <td><?php echo $data['productDescription']; ?></td>
                                    <td><?php echo $data['quantity']; ?></td>
                                    <td><?php echo $data['productPrice']; ?></td>
                                    <td><?php echo $data['categoryName']; ?></td>
                                    <td> <img src="./uploads/<?php echo $data['productImage']; ?>"  width="80px"  height="80px"  >  </td>
                                    
                                    <td>
                                        <a href='Remove.php?id=<?php echo $data['id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>

                                        <a href='edit.php?id=<?php echo $data['id']; ?>' class='btn btn-primary m-r-1em'>Edit</a>
                                    </td>


                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>





<?php

require '../layouts/footer.php';

?>