<?php
$old = $_SESSION['old'] ?? [];
$errors = $_SESSION['errors'] ?? [];
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm p-4 rounded-4">
                <h3 class="text-center mb-4">Đăng ký tài khoản</h3>

                <form action="index.php?page=register" method="post">

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="<?= $old['email'] ?? '' ?>"
                            class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                            placeholder="Nhập email...">

                        <?php if (!empty($errors['email'])): ?>
                            <small class="text-danger"><?= $errors['email'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Họ và tên</label>
                        <input type="text" name="fullname" value="<?= $old['fullname'] ?? '' ?>"
                            class="form-control <?= isset($errors['fullname']) ? 'is-invalid' : '' ?>"
                            placeholder="Nhập họ tên...">

                        <?php if (!empty($errors['fullname'])): ?>
                            <small class="text-danger"><?= $errors['fullname'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <input type="password" name="password"
                            class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                            placeholder="Tạo mật khẩu...">

                        <?php if (!empty($errors['password'])): ?>
                            <small class="text-danger"><?= $errors['password'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Xác nhận mật khẩu</label>
                        <input type="password" name="confirm_password"
                            class="form-control <?= isset($errors['confirm_password']) ? 'is-invalid' : '' ?>"
                            placeholder="Xác nhận mật khẩu...">

                        <?php if (!empty($errors['confirm_password'])): ?>
                            <small class="text-danger"><?= $errors['confirm_password'] ?></small>
                        <?php endif; ?>
                    </div>


                    <button class="btn btn-dark w-100 mt-2" style="height: 46px;">Đăng ký</button>

                    <div class="mt-3 text-center">
                        Đã có tài khoản?
                        <a href="index.php?page=login">Đăng nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
unset($_SESSION['errors'], $_SESSION['old']);
?>