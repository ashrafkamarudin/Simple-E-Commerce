<?php

require_once '../includes/loader.php';

$db = new database();
$checkouts = $db->read(array('*'), 'checkout');

$i = 1; // initialize count value

?>

<!DOCTYPE html>
<html lang="en">

<head>

<?php require_once '../includes/header.html'; ?>

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once '../includes/sidebar.html'; ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">

                <?php Flash(); // display flash message ?>

                <h1>
                    Product List
                    <a href="add.php" class="btn btn-info pull-right">Add New Product</a>
                </h1><br>
                
                <table id="example" class="display table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th>Name</th>
                            <th>Item</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zip</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($checkouts as $checkout) { ?>
                        	<tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $checkout['name']; ?></td>
                                <td><?php echo $checkout['address']; ?></td>
                                <td><?php echo $checkout['city']; ?></td>
                                <td><?php echo $checkout['state']; ?></td>
                                <td><?php echo $checkout['zip']; ?></td>
            	                <td><?php echo $checkout['product_id']; ?></td>
                                <td><?php echo $checkout['quantity']; ?></td>
            	                <td>
            	                	<a href="../action.php?data=products&delete=<?php echo $product['id']; ?>&oldFilename=<?php echo $product['image']; ?>"><i class="btn btn-danger glyphicon glyphicon-trash" onclick="return confirm('Are you sure?')"></i></a></td>
            	            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <a href="#menu-toggle" class="btn btn-primary" id="menu-toggle">Toggle Menu</a>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

	<?php require_once '../includes/footer.html'; ?>

</body>

</html>
