<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a
          href="shop.html">Shop</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Gray Shoe</strong></div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="item-entry">
          <a href="#" class="product-item md-height bg-gray d-block">
            <img src="Uploads/<?= $product['image'] ?>" alt="Image" class="img-fluid">
          </a>

        </div>

      </div>
      <div class="col-md-6">
        <h2 class="text-black"><?= $product['name'] ?></h2>
        <p><?= $product['description'] ?></p>
        <p class="mb-4"><?= $product['short_description'] ?></p>
        <?php if ($product['discount_price']): ?>
          <p><strong class="text-primary h4"><del><?= number_format($product['discount_price']) ?> VNĐ</del>
              <?= number_format($product['price']) ?> VNĐ</strong></p>
        <?php else: ?>
          <p><strong class="text-primary h4"><del><?= number_format($product['price']) ?> VNĐ</strong>
          <?php endif; ?>
        <h5 class="text-black">Kích cỡ</h5>
        <div class="mb-1 d-flex">
          <?php foreach ($sizes as $size): ?>
            <label class="d-flex mr-3 mb-3">
              <input type="radio" name="size" value="<?= $size ?>">
              <span class="text-black ml-2"><?= $size ?></span>
            </label>
          <?php endforeach; ?>
        </div>
        <h5 class="text-black">Màu</h5>
        <div class="mb-3 d-flex">
          <?php foreach ($colors as $color): ?>
            <label class="d-flex mr-3 mb-3">
              <input type="radio" name="color" value="<?= $color ?>">
              <span class="ml-2"><?= $color ?></span>
            </label>
          <?php endforeach; ?>
        </div>
        <div class="mb-5">
          <div class="input-group mb-3" style="max-width: 120px;">
            <div class="input-group-prepend">
              <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
            </div>
            <input type="text" class="form-control text-center" value="1" placeholder=""
              aria-label="Example text with button addon" aria-describedby="button-addon1">
            <div class="input-group-append">
              <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
            </div>
          </div>

        </div>
        <p><a href="?page=cart" class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary">Thêm vào giỏ hàng</a></p>

      </div>
    </div>
  </div>
</div>

<div class="site-section block-3 site-blocks-2">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 site-section-heading text-center pt-4">
        <h2>Sản phẩm liên quan</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 block-3">
        <div class="nonloop-block-3 owl-carousel">
          <?php foreach ($relatedProducts as $pro): ?>
            <?php if ($pro['slug'] !== $product['slug']): ?>
              <div class="item">
                <div class="item-entry">
                  <a href="#" class="product-item md-height bg-gray d-block">
                    <img src="Assets/Client/images/<?= $pro['image'] ?>" alt="Image" class="img-fluid">
                  </a>
                  <h2 class="item-title"><a href="index.php?page=shop-single&slug=<?= $pro['slug'] ?>"><?= $pro['name'] ?></a></h2>
                  <?php if ($pro['discount_price']): ?>
                    <strong class="item-price"><del><?= number_format($pro['discount_price']) ?> VNĐ</del>
                      <?= number_format($pro['price']) ?> VNĐ</strong>
                  <?php else: ?>
                    <strong class="item-price"> <?= number_format($pro['price']) ?> VNĐ</strong>
                  <?php endif; ?>
                </div>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>