<?php

require_once '../includes/loader.php';

$id = $_GET['id'];
$product = $db->getID($id, 'products');
//$reviews = $db->read(array('*'), 'product_reviews');

$reviews = $db->run('SELECT * FROM product_reviews INNER JOIN users ON product_reviews.user_id = users.id WHERE product_reviews.product_id = ' . $id);

$categories = $db->read(array('*'), 'categories');

require_once '../includes/reviewModal.php';

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <?php require_once '../includes/header.html'; ?>

  </head>

  <body>

    <!-- Navigation -->
    <?php require_once '../includes/nav.php'; ?>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-3">
          <h1 class="my-4">Shop Name</h1>
          <div class="list-group">

           <?php foreach ($categories as $key => $category): ?>
             <a href="#" class="list-group-item"><?php echo $category['name']; ?></a>
           <?php endforeach ?>
          </div>
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

          <div class="card mt-4">
            <img class="card-img-top img-fluid" src="../assets/product_images/<?php echo $product['image']; ?>" alt="">
            <div class="card-body">
              <h3 class="card-title"><?php echo $product['name']; ?></h3>
              <h4>RM <?php echo $product['price']; ?></h4>
              <p class="card-text"><?php echo $product['description']; ?></p>
              <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
              4.0 stars
            </div>
          </div>
          <!-- /.card -->

          <div class="card card-outline-secondary my-4">
            <div class="card-header">
              Product Reviews
            </div>
            <div class="card-body">
              <?php foreach ($reviews as $key => $review): ?>
                <p><?php echo $review['review']; ?></p>
                <small class="text-muted">Posted by <?php echo $review['name']; ?> on <?php echo $review['post_at']; ?></small>
                <hr>
              <?php endforeach ?>
              <a href="#" class="btn btn-success" data-toggle="modal" data-target="#reviewModal">Leave a Review</a>
            </div>
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col-lg-9 -->

      </div>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php require_once '../includes/footer.html'; ?>

  </body>

</html>
