<?php if (!empty($_SESSION['error'])): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= $_SESSION['error'] ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>

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
          <?php if ($product['stock'] > 0): ?>
            <p class="text-muted">Tồn kho: <?= $product['stock'] ?> sản phẩm</p>
          <?php else: ?>
            <p class="text-muted">Hết hàng</p>
          <?php endif; ?>
          <button type="submit" name="add_to_cart" class="buy-now btn btn-sm px-4 py-3 btn-primary d-inline-flex align-items-center justify-content-center">Thêm vào giỏ
            hàng</button>
        </form>
      </div>
    </div>

    <!-- Thông tin chi tiết -->
    <div class="row mt-5">
      <div class="col-12">
        <div class="border rounded p-4 shadow-sm bg-white">
          <h4>Thông tin sản phẩm</h4>
          <hr>
          <p><?= $product['description'] ?></p>
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

    <!-- COMMENT SẢN PHẨM -->
    <div class="row mt-5">
      <div class="col-12">
        <div class="border rounded p-4 shadow-sm bg-white">
          <h4>Bình luận</h4>
          <hr>

          <!-- Form gửi comment -->
          <?php if (isset($_SESSION['user']) && $hasPurchased): ?>
            <form action="index.php?page=add-comment" method="POST">
              <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

              <div class="mb-3">
                <textarea name="content" class="form-control" rows="3" placeholder="Nhập bình luận của bạn..."
                  required></textarea>
              </div>

              <button type="submit" class="btn btn-primary btn-sm">
                Gửi bình luận
              </button>
            </form>

          <?php elseif (isset($_SESSION['user'])): ?>
            <p class="text-muted">
              Bạn cần mua sản phẩm này để có thể bình luận.
            </p>

          <?php else: ?>
            <p class="text-muted">
              Vui lòng <a href="index.php?page=login">đăng nhập</a> để bình luận.
            </p>
          <?php endif; ?>

          <!-- Danh sách comment -->
          <div class="mt-4">
            <?php if (!empty($comments)): ?>
              <?php foreach ($comments as $c): ?>
                <div class="border-bottom mb-3 pb-2 d-flex gap-3">

                  <!-- Avatar -->
                  <img src="Uploads/Avatars/<?= htmlspecialchars($c['image'] ?? 'default.png') ?>" width="45" height="45"
                    class="rounded-circle" onerror="this.src='https://placehold.co/45x45';">

                  <div class="gap-3">
                    <strong><?= htmlspecialchars($c['full_name']) ?></strong>
                    <small class="text-muted">
                      • <?= date('d/m/Y H:i', strtotime($c['created_at'])) ?>
                    </small>
                    <p class="mb-1">
                      <?= nl2br(htmlspecialchars($c['content'])) ?>
                    </p>
                  </div>

                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p class="text-muted">Chưa có bình luận nào.</p>
            <?php endif; ?>
          </div>

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
            <?php if ($pro['id'] == $product['id'])
              continue; ?>
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