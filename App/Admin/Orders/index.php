<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';


# Fetch Data .... 
$sql = $sql = "select orders.* , users.userType_id , users.name  from orders inner join users on orders.customer_id = users.id   inner join users_type on orders.customer_id = users_type.id  ";
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

            PrintMessages('Dashboard/Orders');

            ?>
        </ol>






        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                              
                                <th>Order Date</th>
                                <th>Number Order</th>
                                <th>Total Price</th>
                                <th>Customer Type</th>
                                <th>Status</th>
                                <th>Shapping Date</th>
                                <th>CONTROL</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                
                                <th>Order Date</th>
                                <th>Number Order</th>
                                <th>Total Price</th>
                                <th>Customer Type</th>
                                <th>Status</th>
                                <th>Shapping Date</th>
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
                                    
                                    <td><?php echo date( 'd-m-Y',$data['orderDate']); ?></td>
                                    <td><?php echo $data['number_orders']; ?></td>
                                    <td><?php echo $data['totalprice']; ?></td>
                                    <td><?php echo $data['customer_id']; ?></td>
                                    <td><?php echo $data['status']; ?></td>
                                    <td><?php echo $data['shippingDate']; ?></td>

                                    
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