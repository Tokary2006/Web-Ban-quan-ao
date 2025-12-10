<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
      </div>
      <div class="col-md-6">
        <form action="index.php?page=add-to-cart" method="POST">
          <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

          <h2 class="text-black"><?= $product['title'] ?></h2>
          <p><?= $product['description'] ?></p>
          <p class="mb-4"><?= $product['short_description'] ?></p>
          <?php if ($product['discount_price']): ?>
            <?php $current_price = $product['discount_price']; ?>
            <p><strong class="text-primary h4"><del><?= number_format($product['price']) ?> VNĐ</del>
                <?= number_format($product['discount_price']) ?> VNĐ</strong></p>
          <?php else: ?>
            <?php $current_price = $product['price']; ?>
            <p><strong class="text-primary h4"><?= number_format($product['price']) ?> VNĐ</strong></p>
          <?php endif; ?>

          <div class="mb-5">
            <div class="input-group mb-3" style="max-width: 120px;">
              <div class="input-group-prepend">
                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
              </div>
              <input type="text" class="form-control text-center" name="quantity" value="1" min="1" placeholder=""
                aria-label="Số lượng" aria-describedby="button-addon1">
              <div class="input-group-append">
                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
              </div>
            </div>
          </div>
          <p><button type="submit" name="add_to_cart" class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary">Thêm
              vào giỏ hàng</button></p>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  jQuery(document).ready(function ($) {
    $('.js-btn-plus').click(function () {
      let inputField = $(this).closest('.input-group').find('input');
      let inputQty = parseInt(inputField.val());

      inputField.val(inputQty);
    });

    $('.js-btn-minus').click(function () {
      let inputField = $(this).closest('.input-group').find('input');
      let inputQty = parseInt(inputField.val());

      if (inputQty > 1) {
        inputField.val(inputQty);
      }
    });
  });
</script>