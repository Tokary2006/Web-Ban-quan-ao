<div class="site-wrap">

    <!-- BREADCRUMB -->
    <div class="bg-light py-3">
        <div class="container">
            <a href="index.php">Trang chủ</a> /
            <strong>Cảm ơn</strong>
        </div>
    </div>

    <!-- THANK YOU -->
    <div class="site-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">

                    <span class="icon-check_circle display-3 text-success mb-4 d-block"></span>

                    <h2 class="mb-3">Đặt hàng thành công 🎉</h2>

                    <p class="lead mb-4">
                        Cảm ơn bạn đã mua sắm tại <strong>Wearly</strong>.<br>
                        Đơn hàng của bạn đã được ghi nhận và sẽ sớm được xử lý.
                    </p>

                    <?php if ($order_code): ?>
                        <p class="mb-4">
                            <strong>Mã đơn hàng:</strong>
                            <span class="text-primary">#<?= htmlspecialchars($order_code) ?></span>
                        </p>
                    <?php endif; ?>

                    <div class="d-flex justify-content-center mt-4">
                        <a href="index.php?page=shop" class="btn btn-outline-primary btn-lg mx-2">
                            Tiếp tục mua sắm
                        </a>
                        <a href="index.php?page=profile" class="btn btn-primary btn-lg mx-2">
                            Xem đơn hàng
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>