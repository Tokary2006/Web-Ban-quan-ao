<?php if (isset($_SESSION["success"])): ?>
    <div class="alert alert-success">
        <?= $_SESSION["success"] ?>
    </div>
    <?php unset($_SESSION["success"]); ?>
<?php endif; ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm p-4 rounded-4">
                <h3 class="text-center mb-4">Đăng nhập</h3>

                <form action="" method="post">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Nhập email..."
                            value="<?= isset($_SESSION['old_email']) ? $_SESSION['old_email'] : '' ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu...">
                    </div>

                    <button class="btn btn-dark w-100 mt-2" style="height: 46px;">Đăng nhập</button>

                    <div class="mt-3 text-center">
                        Chưa có tài khoản?
                        <a href="index.php?page=register">Đăng ký</a>
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