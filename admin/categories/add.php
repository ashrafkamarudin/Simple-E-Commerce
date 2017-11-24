<?php

require_once '../includes/loader.php';

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
                    <h1>New Category Form</h1><br>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="category_name" class="form-control" placeholder="Enter Category Name">
                    </div>

                    <a href="#menu-toggle" class="btn btn-primary" id="menu-toggle">Toggle Menu</a>

                    <input type="hidden" name="data" value="category">

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
