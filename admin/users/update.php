<?php

require_once '../includes/loader.php';

$login = new login();

if ($login->isUserLoggedIn() == false) {
    redirect(URL . 'admin/auth'); // redirect to authenticate page
}

$db = new database();
$id = $_GET['id'];
$user = $db->getID($id, 'users');

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
                <form class="col-md-6" action="../action.php" method="post">
                    <h1>Update User Information</h1><br>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Username" value="<?php echo $user['name']; ?>">
                    </div>

                    <div class="form-group">
                        <label>E-mail Address</label>
                        <input type="text" name="email" class="form-control" placeholder="Enter E-mail address" value="<?php echo $user['email']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control">
                            <option value="user" <?php if($user['role']=="user") echo "selected"; ?>>User</option>
                            <option value="admin" <?php if($user['role']=="admin") echo "selected"; ?>>Admin</option>
                        </select>
                    </div>

                    <a href="#menu-toggle" class="btn btn-primary" id="menu-toggle">Toggle Menu</a>

                    <input type="hidden" name="data" value="user">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

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
