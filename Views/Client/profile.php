<?php
// Avatar
$avatar = !empty($user['avatar']) ? $user['avatar'] : "https://placehold.co/150x150";
?>

<div class="container py-5">
  <div class="row g-4">

    <!-- Sidebar -->
    <aside class="col-lg-4">
      <div class="border rounded p-3 shadow-sm bg-white">

        <!-- User info -->
        <div class="d-flex align-items-center gap-3">
          <img src="Uploads/Avatars/<?= $avatar ?>" class="rounded-circle border" style="width:70px; height:70px; object-fit:cover;">
          <div>
            <h6 class="mb-0"><?= $user['full_name'] ?></h6>
            <small class="text-muted"><?= $user['email'] ?></small>
          </div>
        </div>

        <hr>

        <ul class="nav flex-column">
          <a class="nav-link active" data-bs-toggle="tab" href="#acc">Thông tin tài khoản</a>
          <a class="nav-link" data-bs-toggle="tab" href="#orders">Lịch sử mua hàng</a>
          <a class="nav-link" data-bs-toggle="tab" href="#address">Địa chỉ giao hàng</a>
          <a href="/logout.php" class="nav-link text-danger">Đăng xuất</a>
        </ul>

      </div>
    </aside>

    <!-- Main content -->
    <main class="col-lg-8">
      <div class="tab-content">

        <!-- ACCOUNT TAB -->
        <div id="acc" class="tab-pane fade show active">

          <div class="border rounded p-4 shadow-sm bg-white mb-4">
            <h5 class="mb-3">Cập nhật tài khoản</h5>

            <!-- FORM UPDATE INFO -->
            <form class="row g-3" action="index.php?page=update-profile" method="POST" enctype="multipart/form-data">

              <!-- Avatar -->
              <div class="col-12">
                <label class="form-label fw-semibold">Avatar</label>
                <input type="file" name="avatar" class="form-control" accept="image/*">

                <?php if (!empty($errors['avatar'])): ?>
                  <small class="text-danger"><?= $errors['avatar'] ?></small>
                <?php endif; ?>

                <img src="Uploads/Avatars/<?= $avatar ?>" class="rounded-circle mt-3 border"
                  style="width:85px; height:85px; object-fit:cover;">
              </div>

              <!-- Full name -->
              <div class="col-md-6">
                <label class="form-label">Họ tên</label>
                <input class="form-control" name="fullname"
                  value="<?= htmlspecialchars($_POST['fullname'] ?? $user['full_name']) ?>">
                <?php if (!empty($errors['fullname'])): ?>
                  <small class="text-danger"><?= $errors['fullname'] ?></small>
                <?php endif; ?>
              </div>

              <!-- Phone -->
              <div class="col-md-6">
                <label class="form-label">Số điện thoại</label>
                <input class="form-control" name="phone"
                  value="<?= htmlspecialchars($_POST['phone'] ?? $user['phone'] ?? '') ?>">
                <?php if (!empty($errors['phone'])): ?>
                  <small class="text-danger"><?= $errors['phone'] ?></small>
                <?php endif; ?>
              </div>

              <!-- Email -->
              <div class="col-12">
                <label class="form-label">Email</label>
                <input class="form-control" name="email"
                  value="<?= htmlspecialchars($_POST['email'] ?? $user['email']) ?>">
                <?php if (!empty($errors['email'])): ?>
                  <small class="text-danger"><?= $errors['email'] ?></small>
                <?php endif; ?>
              </div>

              <div class="col-12 text-end mt-3">
                <button class="btn btn-primary px-4">Cập nhật</button>
              </div>
            </form>
          </div>


          <!-- PASSWORD CHANGE FORM -->
          <div class="border rounded p-4 shadow-sm bg-white">
            <h5 class="mb-3">Đổi mật khẩu</h5>

            <form class="row g-3" action="index.php?page=change-password" method="POST">

              <!-- OLD PASSWORD -->
              <div class="col-md-12">
                <label class="form-label">Mật khẩu cũ</label>
                <input type="password" name="old_password" class="form-control">
                <?php if (!empty($errors['old_password'])): ?>
                  <small class="text-danger"><?= $errors['old_password'] ?></small>
                <?php endif; ?>
              </div>

              <!-- NEW PASSWORD -->
              <div class="col-md-12">
                <label class="form-label">Mật khẩu mới</label>
                <input type="password" name="new_password" class="form-control">
                <?php if (!empty($errors['new_password'])): ?>
                  <small class="text-danger"><?= $errors['new_password'] ?></small>
                <?php endif; ?>
              </div>

              <!-- CONFIRM PASSWORD -->
              <div class="col-md-12">
                <label class="form-label">Nhập lại mật khẩu mới</label>
                <input type="password" name="confirm_password" class="form-control">
                <?php if (!empty($errors['confirm_password'])): ?>
                  <small class="text-danger"><?= $errors['confirm_password'] ?></small>
                <?php endif; ?>
              </div>

              <div class="col-12 text-end mt-3">
                <button class="btn btn-primary px-4">Đổi mật khẩu</button>
              </div>

            </form>
          </div>
        </div>

        <!-- ORDERS TAB -->
        <div id="orders" class="tab-pane fade">
          <div class="border rounded p-4 shadow-sm bg-white">
            <h5 class="mb-3">Lịch sử mua hàng</h5>

            <?php if (!empty($orders)): ?>
              <table class="table table-hover mt-3">
                <thead class="table-light">
                  <tr>
                    <th>Mã đơn</th>
                    <th>Ngày mua</th>
                    <th>Sản phẩm</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($orders as $o): ?>
                    <tr>
                      <td><?= $o['order_code'] ?></td>
                      <td><?= $o['created_at'] ?></td>
                      <td><?= $o['product_name'] ?></td>
                      <td><?= number_format($o['total'], 0, ',', '.') ?>₫</td>
                      <td>
                        <span
                          class="badge 
                          <?= $o['status'] == 'delivered' ? 'bg-success' : ($o['status'] == 'shipping' ? 'bg-warning text-dark' : 'bg-danger') ?>">
                          <?= ucfirst($o['status']) ?>
                        </span>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>

            <?php else: ?>
              <p class="text-muted mt-3">Bạn chưa có đơn hàng nào.</p>
            <?php endif; ?>
          </div>
        </div>

        <!-- ADDRESS TAB -->
        <div id="address" class="tab-pane fade">
          <div class="border rounded p-4 shadow-sm bg-white">

            <h5 class="mb-3">Địa chỉ giao hàng</h5>

            <?php if (!empty($addresses)): ?>
              <?php foreach ($addresses as $a): ?>
                <div class="border rounded p-3 mb-3">
                  <div class="d-flex justify-content-between">
                    <div>
                      <strong><?= $a['title'] ?></strong>
                      <div class="small text-muted"><?= $a['address'] ?></div>
                    </div>
                    <div>
                      <a href="/address-edit?id=<?= $a['id'] ?>" class="btn btn-sm btn-outline-secondary">Sửa</a>
                      <a href="/address-delete?id=<?= $a['id'] ?>" class="btn btn-sm btn-danger">Xóa</a>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p class="text-muted">Bạn chưa có địa chỉ nào.</p>
            <?php endif; ?>

            <a href="/address-add" class="btn btn-primary btn-sm mt-2">Thêm địa chỉ</a>
          </div>
        </div>

      </div>
    </main>

  </div>
</div>