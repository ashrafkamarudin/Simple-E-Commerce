<?php

require_once '../includes/loader.php';

$db = new database();
$categories = $db->read(array('*'), 'categories');

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
                    Product Categories
                    <a href="add.php" class="btn btn-info pull-right">Add Category</a>
                </h1><br>
                
                <table id="example" class="display table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th class="col-md-5">Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category) { ?>
                        	<tr>
                                <td><?php echo $i++; ?></td>
            	                <td><?php echo $category['name']; ?></td>
            	                <td><a href="update.php?id=<?php echo $product['id']; ?>"><i class="btn btn-success glyphicon glyphicon-edit"></i></a>
            	                	<a href="../action.php?data=category&delete=<?php echo $category['id']; ?>"><i class="btn btn-danger glyphicon glyphicon-trash" onclick="return confirm('Are you sure?')"></i></a></td>
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
