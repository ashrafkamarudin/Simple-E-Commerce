<?php

require_once '../includes/loader.php';

$db = new database();
$categories = $db->read(array('*'), 'categories');

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

                <form class="col-md-6" action="../action.php" method="post" enctype="multipart/form-data">
                    <h1>New Product Form</h1><br>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="product_name" class="form-control" placeholder="Enter Product Name">
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select name="product_category" class="form-control">
                            <?php foreach ($categories as $key => $category): ?>
                                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="product_price" class="form-control" placeholder="Enter Product Price" min="0.00" step="0.01">
                    </div>

                    <div class="form-group">
                        <label>Product Description</label>
                        <textarea name="product_desc" class="form-control" placeholder="Enter Product Description"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="product_img" class="form-control" placeholder="Enter Bus Capacity">
                    </div>

                    <a href="#menu-toggle" class="btn btn-primary" id="menu-toggle">Toggle Menu</a>

                    <input type="hidden" name="data" value="product">

                    <button type="submit" class="btn btn-success" name="add">Submit</button>

                </form>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php require_once '../includes/footer.html'; ?>

</body>

</html>
