<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';

# Fetch Data .... 
$sql = "select cart_items.*  , products.productName from cart_items inner join  cart on cart_items.id = cart.id 
   
   inner join products on cart_items.product_id = products.id ";
$op  = doQuery($sql);
//inner join users on cart.customer_id=users.id

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

            PrintMessages('Dashboard/Cart Items');

            ?>
        </ol>






        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                List Cart Items
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cart ID</th>
                                <th>Product Name</th>
                                <!-- <th>Customer Name</th> -->
                                <th>Control</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Cart ID</th>
                                <th>Product Name</th>
                                <!-- <th>Customer Name</th> -->
                                <th>Control</th>
                            </tr>
                        </tfoot>


                        <tbody>

                            <?php

                            # Fetch And Print data .... 

                            while ($data = mysqli_fetch_assoc($op)) {
                                // $id=$data['id'];
                                // $sql2="select name from users inner join cart on users.id=cart.customer_id where cart.id=$id";
                                // $op2=doQuery($sql2);
                                // $result=mysqli_fetch_assoc($op2);
                            ?>
                                <tr>
                                    <td><?php echo $data['id']; ?></td>
                                    <td><?php echo $data['cart_id']; ?></td>
                                    <td><?php echo $data['productName']; ?></td>
                                
                                    <!-- <td><?php //echo $result['name']; ?></td> -->
                                    <td>
                                        <a href='Remove.php?id=<?php echo $data['id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>

                                        <a href='Edit.php?id=<?php echo $data['id']; ?>' class='btn btn-primary m-r-1em'>Edit</a>
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