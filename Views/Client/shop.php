<div class="site-blocks-cover inner-page" data-aos="fade">
  <div class="container">
    <div class="row">
      <div class="col-md-6 ml-auto order-md-2 align-self-start">
        <div class="site-block-cover-content">
          <h2 class="sub-title">#Bộ sưu tập hè mới 2019</h2>
          <h1>Hàng mới về & Giảm giá</h1>
          <p><a href="#" class="btn btn-black rounded-0">Mua ngay</a></p>
        </div>
      </div>
      <div class="col-md-6 order-1 align-self-end">
        <img src="Assets/Client/images/model_4.png" alt="Ảnh" class="img-fluid">
      </div>
    </div>
  </div>
</div>

<div class="custom-border-bottom py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="index.html">Trang chủ</a> <span class="mx-2 mb-0">/</span> <strong
          class="text-black">Cửa hàng</strong></div>
    </div>
  </div>
</div>


<div class="site-section">
  <div class="container">

    <div class="row mb-5">
      <div class="col-md-9 order-1">

        <div class="row align">
          <div class="col-md-12 mb-5">
            <div class="float-md-left">
              <h2 class="text-black h5">Tất cả sản phẩm</h2>
            </div>
            <div class="d-flex">
              <div class="dropdown mr-1 ml-md-auto">

              </div>
              <div class="btn-group">
                <button type="button" class="btn btn-white btn-sm dropdown-toggle px-4" id="dropdownMenuReference"
                  data-toggle="dropdown">Sắp xếp</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                  <a class="dropdown-item" href="<?= $urlPage ?>&sort_by=title&sort_order=asc">Tên, A đến Z</a>
                  <a class="dropdown-item" href="<?= $urlPage ?>&sort_by=title&sort_order=desc">Tên, Z đến A</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?= $urlPage ?>&sort_by=price&sort_order=asc">Giá, thấp đến cao</a>
                  <a class="dropdown-item" href="<?= $urlPage ?>&sort_by=price&sort_order=desc">Giá, cao đến thấp</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-5">
          <?php foreach ($products as $product): ?>

            <div class="col-lg-6 col-md-6 item-entry mb-4">
              <a href="#" class="product-item md-height bg-gray d-block">
                <img src="Uploads/<?= $product['image'] ?>" alt="Ảnh sản phẩm" class="img-fluid">
              </a>
              <h2 class="item-title"><a href="index.php?page=shop-single&slug=<?= $product['slug'] ?>"><?= $product['title'] ?></a></h2>
              <?php if ($product['discount_price']): ?>
                <strong class="item-price"><del><?= number_format($product['price']) ?> VNĐ</del>
                  <?= number_format($product['discount_price']) ?> VNĐ</strong>
              <?php else: ?>
                <strong class="item-price"><?= number_format($product['price']) ?> VNĐ</strong>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>

        </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="site-block-27">
              <?php if ($totalPageProduct > 1): ?>
              <ul>
                <?php if ($current_page > 1): ?>
                  <li><a href="<?= $urlPage ?>&pages=<?= $current_page - 1 ?>">&lt;</a></li>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $totalPageProduct; $i++): ?>
                  <?php
                  $active_class = ($i == $current_page) ? 'active' : '';
                  ?>
                  <li class="<?= $active_class ?>"><a href="<?= $urlPage ?>&pages=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor; ?>

                <?php if ($current_page < $totalPageProduct): ?>
                  <li><a href="<?= $urlPage ?>&pages=<?= $current_page + 1 ?>">&gt;</a></li>
                <?php endif; ?>
              </ul>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3 order-2 mb-5 mb-md-0">
        <form action="index.php" method="GET" class="d-flex mb-4" style="flex-grow: 1; max-width: 400px;">
          <input type="hidden" name="page" value="shop">
          <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..." class="form-control mr-2"
            value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
          <button type="submit" class="btn btn-primary">
            <span class="icon-search">Tìm</span>
          </button>
        </form>

        <div class="border p-4 rounded mb-4">
          <h3 class="mb-3 h6 text-uppercase text-black d-block">Danh mục</h3>
          <ul class="list-unstyled mb-0">
            <?php foreach ($categories as $category): ?>
              <li class="mb-1"><a href="?page=shop&category_id=<?= $category['id'] ?>"
                  class="d-flex"><span><?= $category['name'] ?></span> <span class="text-black ml-auto"></span></a>
              </li>
            <?php endforeach; ?>
            <li class="mb-1"><a href="?page=shop" class="d-flex"><span>Xem tất cả</span> <span
                  class="text-black ml-auto"></span></a>
            </li>
          </ul>
        </div>

        <div class="mb-4">
          
        </div>

        <div class="mb-4">
          
        </div>

      </div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="title-section mb-5">
      <h2 class="text-uppercase"><span class="d-block">Khám phá</span> Các bộ sưu tập</h2>
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
            class="product-category"><?= $cateIdNam['name'] ?> <span></span></a>
          <img src="Assets/Client/images/model_5.png" alt="Ảnh" class="img-fluid">
        </div>

        <div class="product-item sm-height bg-gray">
          <a href="index.php?page=shop&category_id=<?= $cateIdGiay['id'] ?>"
            class="product-category"><?= $cateIdGiay['name'] ?> <span></span></a>
          <img src="Assets/Client/images/model_6.png" alt="Ảnh" class="img-fluid">
        </div>
      </div>

    </div>
  </div>
</div>