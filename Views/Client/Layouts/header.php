<!DOCTYPE html>
<html lang="en">

<head>
  <title>Wearlya &mdash; Phong cách gói gọn trong bạn.</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="icon" type="image/png" sizes="16x16" href="Assets/img/Logo/Logo-1.png" />
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
  <link rel="stylesheet" href="Assets/Client/fonts/icomoon/style.css">

  <link rel="stylesheet" href="Assets/Client/css/bootstrap.min.css">
  <link rel="stylesheet" href="Assets/Client/css/magnific-popup.css">
  <link rel="stylesheet" href="Assets/Client/css/jquery-ui.css">
  <link rel="stylesheet" href="Assets/Client/css/owl.carousel.min.css">
  <link rel="stylesheet" href="Assets/Client/css/owl.theme.default.min.css">


  <link rel="stylesheet" href="Assets/Client/css/aos.css">

  <link rel="stylesheet" href="Assets/Client/css/style.css">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="Assets/Client/js/jquery-3.3.1.min.js"></script>
  <script src="Assets/Client/js/jquery-ui.js"></script>
</head>

<body>

  <div class="site-wrap">


    <div class="site-navbar bg-white py-2">

      <div class="search-wrap">
        <div class="container">
          <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
          <form action="#" method="post">
            <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
          </form>
        </div>
      </div>

      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="logo">
            <div class="site-logo">
              <a href="index.php" class="js-logo-clone">Wearly</a>
            </div>
          </div>
          <div class="main-nav d-none d-lg-block">
            <nav class="site-navigation text-right text-md-center" role="navigation">
              <ul class="site-menu js-clone-nav d-none d-lg-block">
                <li><a href="index.php?page=home">Trang chủ</a></li>
                <li><a href="index.php?page=shop">Cửa hàng</a></li>
                <li><a href="index.php?page=blog">Bài viết</a></li>
                <li><a href="index.php?page=contact">Liên hệ</a></li>
              </ul>
            </nav>
          </div>
          <div class="icons">
            <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
            <div class="dropdown d-inline-block position-relative">
              <a href="#" class="icons-btn d-inline-block" id="userMenu" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <span class="icon-user"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow-sm border-0 mt-2" aria-labelledby="userMenu">
                <?php if (!isset($_SESSION["user"])): ?>
                  <a class="dropdown-item" href="index.php?page=login">Đăng nhập</a>
                  <a class="dropdown-item" href="index.php?page=register">Đăng ký</a>
                <?php endif; ?>
                <?php if (isset($_SESSION["user"])): ?>
                  <a class="dropdown-item" href="index.php?page=profile">Thông tin cá nhân</a>
                  <a class="dropdown-item" href="index.php?page=cart">Giỏ hàng</a>
                <?php endif; ?>
                <a class="dropdown-item" href="index.php?page=logout">Đăng xuất</a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>