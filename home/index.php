<?php

require_once '../includes/loader.php';

$products = $db->read(array('*'), 'products');
$categories = $db->read(array('*'), 'categories');

$i = 1; // initialize count value

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

        <div class="col-lg-3 my-4">
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
          </form>

          <h1 class="my-4">Shop Name</h1>
          <div class="list-group">
            <?php foreach ($categories as $key => $category): ?>
             <a href="#" class="list-group-item"><?php echo $category['name']; ?></a>
            <?php endforeach ?>
          </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

          <?php flash(); ?>

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

          <div class="row">

          <?php foreach ($products as $key => $product): ?>

            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="../assets/product_images/<?php echo $product['image']; ?>" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="../product/index.php?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a>
                  </h4>
                  <h5>RM <?php echo $product['price']; ?></h5>
                  <p class="card-text"><?php echo $product['description']; ?></p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                  <a href="../cart.php?action=add&id=<?php echo $product['id']; ?>" class="btn btn-primary pull-right">add to cart</a>
                </div>
              </div>
            </div>
            
          <?php endforeach ?>

          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php require_once '../includes/authModal.html'; ?>
    <?php require_once '../includes/footer.html'; ?>

  </body>

</html>
