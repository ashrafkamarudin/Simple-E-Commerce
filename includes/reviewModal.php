<!-- Login Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="text-align: right">
        <h5 class="modal-title" id="exampleModalLabel">Leave a review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../review.php" method="post" class="form-modal">
          <div class="form-group">
            <label>What do you think about this product?</label>
            <textarea name="review" class="form-control" rows="5"></textarea>
          </div>
          <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
          <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
          <button type="submit" class="btn btn-primary" style="float: right; margin-left: 5px" name="submit">Submit</button>
          <button type="button" class="btn btn-outline-secondary" style="float: right" data-dismiss="modal">Cancel</button>
        </form>
      </div>
      <div class="modal-footer">
        Thank you for you comments.</a>
      </div>
    </div>
  </div>
</div>