<?php

session_start();

require_once 'config.php';
require_once 'vendor/libs/database.php';
require_once 'vendor/libs/functions.php';

$db = new Database();

$products = $db->read(array('*'), 'products');

extract($_POST);

if (isset($category)) {
  $products = $db->run("
    SELECT products.name, products.image, products.price, products.description 
    FROM products
    INNER JOIN categories ON products.category = categories.id 
    WHERE categories.name =  '$category'");

}

if (isset($search)) {
  $products = $db->run("
    SELECT products.name, products.image, products.price, products.description 
    FROM products
    WHERE products.name LIKE  '%$search%'");
}

foreach ($products as $key => $product): ?>

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