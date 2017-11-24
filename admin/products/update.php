<?php

require_once '../includes/loader.php';

$db = new database();

$id = $_GET['id'];
$product = $db->getID($id, 'products');

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
                <form class="col-md-6" action="../action.php" method="post" enctype="multipart/form-data">
                    <h1>Update Product Form</h1><br>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="product_name" class="form-control" placeholder="Enter Product Name" value="<?php echo $product['name']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="product_price" class="form-control" placeholder="Enter Product Price" value="<?php echo $product['price']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Product Description</label>
                        <textarea name="product_desc" class="form-control" placeholder="Enter Product Description"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="product_img" class="form-control" placeholder="Enter Bus Capacity" >
                    </div>

                    <a href="#menu-toggle" class="btn btn-primary" id="menu-toggle">Toggle Menu</a>

                    <input type="hidden" name="data" value="product">
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                    <input type="hidden" name="oldFilename" value="<?php echo $product['image']; ?>">

                    <button type="submit" class="btn btn-success" name="update">Update</button>

                </form>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php require_once '../includes/footer.html'; ?>

</body>

</html>
