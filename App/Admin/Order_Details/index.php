<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';


# Fetch Data .... 
$sql = "select order_details.*  , products.productName 
from order_details inner join  orders on order_details.order_id = orders.id 
inner join products on order_details.product_id = products.id ";
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

            PrintMessages('Dashboard/Order Details');

            ?>
        </ol>






        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                List Orders
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Order ID</th>
                               
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Control</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Order ID</th>
                                
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Control</th>
                            </tr>
                        </tfoot>


                        <tbody>

                            <?php

                            # Fetch And Print data .... 

                            while ($data = mysqli_fetch_assoc($op)) {
                             
                            ?>
                                <tr>
                                    <td><?php echo $data['id']; ?></td>
                                    <td><?php echo $data['order_id']; ?></td>
                                    
                                    <td><?php echo $data['productName']; ?></td>
                                    <td><?php echo $data['quantity']; ?></td>
                                    <td><?php echo $data['unitPrice']; ?></td>
                                    
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