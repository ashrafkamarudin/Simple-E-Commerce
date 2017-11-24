<?php

require_once '../includes/loader.php';

//$products = $db->read(array('*'), 'cart');
$products = $db->run('SELECT * FROM cart INNER JOIN products ON products.id = cart.product_id');
$categories = $db->read(array('*'), 'categories');

$i = 1; // initialize count value

?>

<!DOCTYPE html>
<html lang="en">

  <head>

  <?php require_once '../includes/header.html'; ?>
  <link rel="stylesheet" type="text/css" href="../assets/css/cart.css">

  </head>

  <body>

    <!-- Navigation -->
    <?php require_once '../includes/nav.php'; ?>

    <!-- Page Content -->
    <div class="container">

      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
          <form>
            <div class="form-row">
              <div class="form-group col-md-7">
                <label for="inputEmail4">Name</label>
                <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
              </div>
              <div class="form-group col-md-5">
                <label for="inputPassword4">Contact No.</label>
                <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
              </div>
            </div>
            <div class="form-group">
              <label for="inputAddress">Address</label>
              <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity">
              </div>
              <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <select id="inputState" class="form-control">
                  <option selected>Choose...</option>
                  <option>...</option>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" class="form-control" id="inputZip">
              </div>
            </div>
            <div class="form-group">
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox"> Check me out
                </label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
          </form>
        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php require_once '../includes/authModal.html'; ?>
    <?php require_once '../includes/footer.html'; ?>

  </body>

</html>
