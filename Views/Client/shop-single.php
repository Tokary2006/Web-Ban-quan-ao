<div class="site-section">
  <div class="container">
    <div class="row">
      <!-- Ảnh sản phẩm -->
      <div class="col-md-6 text-center">
        <img src="Uploads/Product/<?= htmlspecialchars($product['image']) ?>"
          alt="<?= htmlspecialchars($product['title']) ?>" class="img-fluid rounded shadow-sm"
          style="max-width: 300px; height: auto;"
          onerror="this.onerror=null; this.src='https://placehold.co/300x300?text=No+Image';">
      </div>

      <!-- Thông tin + thêm giỏ hàng -->
      <div class="col-md-6">
        <h2 class="text-black"><?= $product['title'] ?></h2>
        <p class="text-muted"><?= $product['short_description'] ?></p>
        <form action="index.php?page=add-to-cart" method="POST">
          <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

          <!-- Giá sản phẩm -->
          <?php if (!empty($product['discount_price']) && $product['discount_price'] > 0): ?>
            <p><strong class="text-primary h4"><del><?= number_format($product['price']) ?> VNĐ</del>
                <?= number_format($product['discount_price']) ?> VNĐ</strong></p>
          <?php else: ?>
            <p><strong class="text-primary h4"><?= number_format($product['price']) ?> VNĐ</strong></p>
          <?php endif; ?>

          <!-- Số lượng + nút thêm giỏ -->
          <div class="mb-3" style="max-width: 120px;">
            <div class="input-group">
              <div class="input-group-prepend">
                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
              </div>
              <input type="text" class="form-control text-center" name="quantity" value="1" min="1">
              <div class="input-group-append">
                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
              </div>
            </div>
          </div>
          <button type="submit" name="add_to_cart" class="buy-now btn btn-sm px-4 py-3 btn-primary">Thêm vào giỏ
            hàng</button>
        </form>
      </div>
    </div>

    <!-- Thông tin chi tiết sản phẩm dưới -->
    <div class="row mt-5">
      <div class="col-12">
        <div class="border rounded p-4 shadow-sm bg-white">
          <h4>Thông tin sản phẩm</h4>
          <hr>
          <p><?= $product['description'] ?></p>
          <!-- Nếu muốn, có thể thêm các thông số kỹ thuật -->
          <?php if (!empty($product['specs'])): ?>
            <ul>
              <?php foreach ($product['specs'] as $key => $value): ?>
                <li><strong><?= htmlspecialchars($key) ?>:</strong> <?= htmlspecialchars($value) ?></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="title-section text-center mb-5 col-12">
        <h2 class="text-uppercase">Sản phẩm liên quan</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 block-3">
        <div class="nonloop-block-3 owl-carousel">

          <?php foreach ($relatedProducts as $pro): ?>
            <div class="item">
              <div class="item-entry">
                <a href="index.php?page=shop-single&slug=<?= $pro['slug'] ?>"
                  class="product-item md-height bg-gray d-block">
                  <img src="Uploads/Product/<?= $pro['image'] ?>" alt="Image" class="img-fluid">
                </a>
                <h2 class="item-title"><a
                    href="index.php?page=shop-single&slug=<?= $pro['slug'] ?>"><?= $pro['title'] ?></a></h2>
                <?php if (!empty($product['discount_price']) && $product['discount_price'] > 0): ?>
                  <strong class="item-price"><del><?= number_format($pro['discount_price']) ?> VNĐ</del>
                    <?= number_format($pro['price']) ?> VNĐ</strong>
                <?php else: ?>
                  <strong class="item-price"> <?= number_format($pro['price']) ?> VNĐ</strong>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>

        </div>
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