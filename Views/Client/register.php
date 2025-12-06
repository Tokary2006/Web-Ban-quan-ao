<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm p-4 rounded-4">
                <h3 class="text-center mb-4">Đăng ký tài khoản</h3>

                <form action="" method="post">

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="<?= $_SESSION['old']['email'] ?? '' ?>"
                            class="form-control" placeholder="Nhập email...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Họ và tên</label>
                        <input type="text" name="fullname" value="<?= $_SESSION['old']['fullname'] ?? '' ?>"
                            class="form-control" placeholder="Nhập họ tên...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <input type="password" name="password" class="form-control" placeholder="Tạo mật khẩu...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Xác nhận mật khẩu</label>
                        <input type="password" name="confirm_password" class="form-control"
                            placeholder="Xác nhận mật khẩu...">
                    </div>

                    <button class="btn btn-dark w-100 mt-2" style="height: 46px;">Đăng ký</button>

                    <div class="mt-3 text-center">
                        Đã có tài khoản?
                        <a href="index.php?page=login">Đăng nhập</a>
                    </div>
                </form>
                <?php if (isset($_SESSION["error"])): ?>
                    <div class="alert alert-danger mt-3">
                        <?php echo $_SESSION["error"];
                        unset($_SESSION["error"]) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>