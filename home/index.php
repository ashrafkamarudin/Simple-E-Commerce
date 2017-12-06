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
          <div class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" id="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" id="searchBtn" type="submit"><i class="fa fa-search"></i></button>
          </div>

          <h1 class="my-4">Categories</h1>
          <div class="list-group">
            <a href="../home" class="list-group-item">All</a>
            <?php foreach ($categories as $key => $category): ?>
             <a href="#" class="list-group-item category" value="test"><?php echo $category['name']; ?></a>
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

          <div class="row" id="products"></div>
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

    <script type="text/javascript">
      $(document).ready(function() {
        $.ajax({
          url : "../product.php",
          method: "POST",
          success : function(data){
            $("#products").html(data);
          }
        })
      });

      $('.category').click(function() {
        $.ajax({
          url : "../product.php",
          method: "POST",
          data  : {category: $(this).html()},
          success : function(data){
            $("#products").html(data);
          }
        })
      });
      $('#searchBtn').click(function() {
        $.ajax({
          url : "../product.php",
          method: "POST",
          data  : {search: $('#search').val()},
          success : function(data){
            $("#products").html(data);
          }
        })
      });
    </script>

  </body>

</html>
