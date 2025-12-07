<?php if (isset($_SESSION["success"])): ?>
  <div class="alert alert-success">
    <?= $_SESSION["success"] ?>
  </div>
  <?php unset($_SESSION["success"]); ?>
<?php endif; ?>
<div class="site-blocks-cover" data-aos="fade">
  <div class="container">
    <div class="row">
      <div class="col-md-6 ml-auto order-md-2 align-self-start">
        <div class="site-block-cover-content">
          <h2 class="sub-title">#Bộ Sưu Tập Mùa Hè Mới 2025</h2>
          <h1>Giảm Giá Hàng Mới Về</h1>
          <p><a href="?page=shop" class="btn btn-black rounded-0">Mua Ngay</a></p>
        </div>
      </div>
      <div class="col-md-6 order-1 align-self-end">
        <img src="Assets/Client/images/model_3.png" alt="Ảnh" class="img-fluid">
      </div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="title-section mb-5">
      <h2 class="text-uppercase"><span class="d-block">Khám Phá</span> Các Bộ Sưu Tập</h2>
    </div>
    <div class="row align-items-stretch">
      <div class="col-lg-8">
        <div class="product-item sm-height full-height bg-gray">
          <a href="index.php?page=shop&category_id=<?= $cateIdNu['id'] ?>"
            class="product-category"><?= $cateIdNu['name'] ?> <span></span></a>
          <img src="Assets/Client/images/model_4.png" alt="Ảnh" class="img-fluid">
        </div>
      </div>
      <div class="col-lg-4">
        <div class="product-item sm-height bg-gray mb-4">
          <a href="index.php?page=shop&category_id=<?= $cateIdNam['id'] ?>"
            class="product-category"><?= $cateIdNam['name'] ?>
            <span></span></a>
          <img src="Assets/Client/images/model_5.png" alt="Ảnh" class="img-fluid">
        </div>

        <div class="product-item sm-height bg-gray">
          <a href="index.php?page=shop&category_id=<?= $cateIdGiay['id'] ?>"
            class="product-category"><?= $cateIdGiay['name'] ?>
            <span></span></a>
          <img src="Assets/Client/images/model_6.png" alt="Ảnh" class="img-fluid">
        </div>
      </div>
    </div>
  </div>
</div>


<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="title-section mb-5 col-12">
        <h2 class="text-uppercase">Sản Phẩm Phổ Biến</h2>
      </div>
    </div>
    <div class="row">
      <?php foreach ($products as $pro): ?>
        <div class="col-lg-4 col-md-6 item-entry mb-4">
          <a href="#" class="product-item md-height bg-gray d-block">
            <img src="Uploads/<?= $pro['image'] ?>" alt="Ảnh" class="img-fluid">
          </a>
          <h2 class="item-title"><a href="index.php?page=shop-single&slug=<?= $pro['slug'] ?>"><?= $pro['title'] ?></a>
          </h2>
          <?php if ($pro['discount_price']): ?>
            <strong class="item-price"><del><?= number_format($pro['discount_price']) ?> VNĐ</del>
              <?= number_format($pro['price']) ?> VNĐ</strong>
          <?php else: ?>
            <strong class="item-price"> <?= number_format($pro['price']) ?> VNĐ</strong>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="title-section text-center mb-5 col-12">
        <h2 class="text-uppercase">Sản phẩm nổi bật</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 block-3">
        <div class="nonloop-block-3 owl-carousel">

          <?php foreach ($featuredProducts as $pro): ?>
            <div class="item">
              <div class="item-entry">
                <a href="#" class="product-item md-height bg-gray d-block">
                  <img src="Assets/Client/images/<?= $pro['image'] ?>" alt="Image" class="img-fluid">
                </a>
                <h2 class="item-title"><a
                    href="index.php?page=shop-single&slug=<?= $pro['slug'] ?>"><?= $pro['title'] ?></a></h2>
                <?php if ($pro['discount_price']): ?>
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


<div class="site-blocks-cover inner-page py-5" data-aos="fade">
  <div class="container">
    <div class="row">
      <div class="col-md-6 ml-auto order-md-2 align-self-start">
        <div class="site-block-cover-content">
          <h2 class="sub-title">#Bộ Sưu Tập Mùa Hè Mới 2025</h2>
          <h1>Giày Mới</h1>
          <p><a href="index.php?page=shop&category_id=<?= $cateIdGiay['id'] ?>" class="btn btn-black rounded-0">Mua
              Ngay</a></p>
        </div>
      </div>
      <div class="col-md-6 order-1 align-self-end">
        <img src="Assets/Client/images/model_6.png" alt="Ảnh" class="img-fluid">
      </div>
    </div>
  </div>
</div>