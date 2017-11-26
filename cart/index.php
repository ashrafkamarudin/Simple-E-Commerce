<?php

require_once '../includes/loader.php';

//$products = $db->read(array('*'), 'cart');
$products = $db->run('SELECT * FROM cart INNER JOIN products ON products.id = cart.product_id');
$categories = $db->read(array('*'), 'categories');

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

        <div class="col-lg-12">
          <?php flash(); ?>

          <div class="container">
  <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
              <th style="width:50%">Product</th>
              <th style="width:10%">Price</th>
              <th style="width:8%">Quantity</th>
              <th style="width:22%" class="text-center">Subtotal</th>
              <th style="width:10%"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $key => $product): ?>
              <tr>
              <td data-th="Product">
                <div class="row">
                  <div class="col-sm-3 hidden-xs"><img src="http://placehold.it/100x100" alt="..." class="img-responsive"/></div>
                  <div class="col-sm-9">
                    <h4 class="nomargin"><?php echo $product['name']; ?></h4>
                    <p><?php echo $product['description']; ?></p>
                  </div>
                </div>
              </td>
              <td data-th="Price"">RM <?php echo $product['price']; ?></td>
              <td data-th="Quantity">
                <form id="formQuantity" method="POST" action="../cart.php?action=update&id=<?php echo $product['id']; ?>">
                  <input name="quantity" type="number" class="form-control text-center" value="<?php echo $product['quantity']; ?>">
                </form>
              </td>
              <td data-th="Subtotal" class="text-center">RM <label class="subtotal"><?php echo $product['price']*$product['quantity']; ?></label></td>
              <td class="actions" data-th="">
                <button type="submit" form="formQuantity" class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
                <a class="btn btn-danger btn-sm" href="../cart.php?action=delete&id=<?php echo $product['id']; ?>"><i class="fa fa-trash-o"></i></a>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr class="visible-xs">
              <td class="text-center"><strong id="total">Total $1.99</strong></td>
            </tr>
            <tr>
              <td><a href="../home" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
              <td colspan="2" class="hidden-xs"></td>
              <td class="hidden-xs text-center"><strong id="total1">Total $1.99</strong></td>
              <td><a href="#" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
            </tr>
          </tfoot>
        </table>
</div>

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
        var sum = 0;
        $('.subtotal').each(function(){
            sum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
        });

        $('#total').html('Total RM ' + sum);
        $('#total1').html('Total RM ' + sum);

      });
    </script>

  </body>

</html>
