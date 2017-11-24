<?php

require_once '../includes/loader.php';

$db = new database();
$products = $db->read(array('*'), 'products');

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
                            <th class="col-md-3">Image</th>
                            <th class="col-md-5">Name</th>
                            <th class="col-md-1">Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) { ?>
                        	<tr>
                                <td><?php echo $i++; ?></td>
                                <td><img class="img-thumbnail img-fluid" width="200px" height="200px" src="../../assets/product_images/<?php echo $product['image']; ?>"></td>
            	                <td><?php echo $product['name']; ?></td>
                                <td><?php echo $product['price']; ?></td>
            	                <td><a href="update.php?id=<?php echo $product['id']; ?>"><i class="btn btn-success glyphicon glyphicon-edit"></i></a>
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
