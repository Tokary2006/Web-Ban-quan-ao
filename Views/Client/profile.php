<?php if (!empty($_SESSION['success'])): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= $_SESSION['success'] ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['error'])): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= $_SESSION['error'] ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<?php
// Avatar
$avatar = !empty($user['image']) ? $user['image'] : "https://placehold.co/150x150";
?>

<div id="globalConfirmBox" class="border rounded shadow-sm p-3 mt-3 d-none bg-white">
  <div class="d-flex align-items-center justify-content-between">
    <div class="text-secondary fw-semibold" id="confirmMessage"></div>
    <form id="confirmForm" method="POST" class="d-flex gap-2 ms-3" style="gap: 0.5rem;">
      <input type="hidden" name="id" id="confirmId">
      <button class="btn btn-sm btn-primary px-3">Xác nhận</button>
      <button type="button" class="btn btn-sm btn-outline-secondary px-3" onclick="hideConfirm()">Hủy</button>
    </form>
  </div>
</div>

<div class="container py-5">
  <div class="row g-4">

    <!-- Sidebar -->
    <aside class="col-lg-4">
      <div class="border rounded p-3 shadow-sm bg-white">

        <!-- User info -->
        <div class="text-center mb-3">
          <img
            src="<?= !empty($user['image']) ? 'Uploads/Avatars/' . $user['image'] : 'https://placehold.co/150x150' ?>"
            class="rounded-circle border mb-2" style="width:70px; height:70px; object-fit:cover;">
          <h6 class="mb-0"><?= $user['full_name'] ?></h6>
          <small class="text-muted"><?= $user['email'] ?></small>
        </div>

        <hr>

        <ul class="nav nav-pills flex-column">
          <li class="nav-item">
            <a class="nav-link <?= $activeTab === 'account' ? 'active' : '' ?>"
              href="index.php?page=profile&tab=account">Thông tin tài khoản</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $activeTab === 'orders' ? 'active' : '' ?>"
              href="index.php?page=profile&tab=orders">Lịch sử mua hàng</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $activeTab === 'address' ? 'active' : '' ?>"
              href="index.php?page=profile&tab=address">Địa chỉ giao hàng</a>
          </li>
          <li class="nav-item">
            <a href="/logout.php" class="nav-link text-danger">Đăng xuất</a>
          </li>
        </ul>

      </div>
    </aside>

    <!-- Main content -->
    <main class="col-lg-8">
      <div class="tab-content">

        <!-- ACCOUNT TAB -->
        <div id="account" class="tab-pane fade <?= $activeTab === 'account' ? 'show active' : '' ?>">

          <!-- FORM CẬP NHẬT THÔNG TIN -->
          <div class="border rounded p-4 shadow-sm bg-white mb-4">
            <h5 class="mb-3">Cập nhật tài khoản</h5>

            <form class="row g-3" action="index.php?page=update-profile" method="POST" enctype="multipart/form-data">
              <div class="col-12">
                <label class="form-label fw-semibold">Avatar</label>
                <input type="file" name="avatar" class="form-control" accept="image/*">
                <?php if (!empty($errors['avatar'])): ?>
                  <small class="text-danger"><?= $errors['avatar'] ?></small>
                <?php endif; ?>
                <img
                  src="<?= !empty($user['image']) ? 'Uploads/Avatars/' . $user['image'] : 'https://placehold.co/150x150' ?>"
                  class="rounded-circle mt-3 border" style="width:85px; height:85px; object-fit:cover;">
              </div>

              <div class="col-md-6">
                <label class="form-label">Họ tên</label>
                <input class="form-control" name="fullname"
                  value="<?= htmlspecialchars($_POST['fullname'] ?? $user['full_name']) ?>">
                <?php if (!empty($errors['fullname'])): ?>
                  <small class="text-danger"><?= $errors['fullname'] ?></small>
                <?php endif; ?>
              </div>

              <div class="col-md-6">
                <label class="form-label">Số điện thoại</label>
                <input class="form-control" name="phone"
                  value="<?= htmlspecialchars($_POST['phone'] ?? $user['phone'] ?? '') ?>">
                <?php if (!empty($errors['phone'])): ?>
                  <small class="text-danger"><?= $errors['phone'] ?></small>
                <?php endif; ?>
              </div>

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

          <!-- FORM ĐỔI MẬT KHẨU -->
          <div class="border rounded p-4 shadow-sm bg-white">
            <h5 class="mb-3">Đổi mật khẩu</h5>

            <form class="row g-3" action="index.php?page=change-password" method="POST">
              <div class="col-md-12">
                <label class="form-label">Mật khẩu cũ</label>
                <input type="password" name="old_password" class="form-control">
                <?php if (!empty($errors['old_password'])): ?>
                  <small class="text-danger"><?= $errors['old_password'] ?></small>
                <?php endif; ?>
              </div>

              <div class="col-md-12">
                <label class="form-label">Mật khẩu mới</label>
                <input type="password" name="new_password" class="form-control">
                <?php if (!empty($errors['new_password'])): ?>
                  <small class="text-danger"><?= $errors['new_password'] ?></small>
                <?php endif; ?>
              </div>

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
        <div id="orders" class="tab-pane fade <?= $activeTab === 'orders' ? 'show active' : '' ?>">
          <div class="border rounded p-4 shadow-sm bg-white">
            <h5 class="mb-3">Lịch sử mua hàng</h5>

            <?php if (!empty($orders)): ?>
              <table class="table table-hover mt-3 align-middle">
                <thead class="table-light">
                  <tr>
                    <th>Mã đơn</th>
                    <th>Ngày mua</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th class="text-end">Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($orders as $o): ?>
                    <tr>
                      <td class="text-center align-middle">#<?= htmlspecialchars($o['order_code']) ?></td>
                      <td class="text-center align-middle"><?= date('d/m/Y H:i', strtotime($o['created_at'])) ?></td>
                      <td class="text-center align-middle"><?= number_format($o['total_price'], 0, ',', '.') ?>₫</td>
                      <td class="text-center align-middle">
                        <?php if ($o['order_status'] == 0): ?>
                          <span class="badge">Chờ xử lý</span>
                        <?php elseif ($o['order_status'] == 1): ?>
                          <span class="badge">Đang giao</span>
                        <?php elseif ($o['order_status'] == 2): ?>
                          <span class="badge">Đã nhận</span>
                        <?php endif; ?>
                      </td>
                      <td class="text-end">
                        <a href="index.php?page=order-detail&id=<?= $o['id'] ?>"
                          class="btn btn-sm btn-outline-primary me-1 d-inline-flex align-items-center justify-content-center">
                          Xem chi tiết
                        </a>


                        <?php if ($o['order_status'] == 1): ?>
                          <button type="button" class="btn btn-sm btn-success" onclick="showConfirm({
                            message: 'Xác nhận bạn đã nhận được đơn hàng này?',
                            action: 'index.php?page=confirm-received',
                            id: <?= $o['id'] ?>,
                            method: 'POST',
                            field: 'order_id'
                          })">Đã nhận hàng</button>
                        <?php else: ?>
                          <span class="text-muted">—</span>
                        <?php endif; ?>
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
        <div id="address" class="tab-pane fade <?= $activeTab === 'address' ? 'show active' : '' ?>">
          <div class="border rounded p-4 shadow-sm bg-white">
            <h5 class="mb-3">Địa chỉ giao hàng</h5>

            <?php if (!empty($addresses)): ?>
              <?php foreach ($addresses as $a): ?>
                <div class="border rounded p-3 mb-3" id="addressItem-<?= $a['id'] ?>">
                  <div class="d-flex justify-content-between align-items-start">
                    <div>
                      <strong><?= htmlspecialchars($a['address_name']) ?></strong>
                      <div class="small text-muted"><?= htmlspecialchars($a['full_address'] . ", " . $a['city']) ?></div>
                      <div class="small text-muted">SĐT: <?= htmlspecialchars($a['recipient_phone']) ?></div>
                    </div>
                    <div class="d-flex align-items-center gap-2" style="gap: 0.5rem;">
                      <button type="button" class="btn btn-sm btn-outline-secondary"
                        onclick="showEditAddress(<?= $a['id'] ?>)">Sửa</button>
                      <button type="button" class="btn btn-sm btn-danger" onclick="showConfirm({
                        message: 'Bạn có chắc muốn xóa địa chỉ này?',
                        action: 'index.php?page=delete-address',
                        id: <?= $a['id'] ?>,
                        method: 'POST',
                        field: 'id'
                      })">Xóa</button>
                    </div>
                  </div>

                  <!-- FORM EDIT ẨN -->
                  <div class="mt-3" id="editAddressForm-<?= $a['id'] ?>" style="display:none;">
                    <form action="index.php?page=update-address" method="POST">
                      <input type="hidden" name="id" value="<?= $a['id'] ?>">
                      <div class="mb-2">
                        <label class="form-label">Tên địa chỉ</label>
                        <input type="text" name="address_name" class="form-control"
                          value="<?= htmlspecialchars($a['address_name']) ?>">
                      </div>
                      <div class="mb-2">
                        <label class="form-label">Thành phố</label>
                        <input type="text" name="city" class="form-control" value="<?= htmlspecialchars($a['city']) ?>">
                      </div>
                      <div class="mb-2">
                        <label class="form-label">Địa chỉ chi tiết</label>
                        <textarea name="full_address"
                          class="form-control"><?= htmlspecialchars($a['full_address']) ?></textarea>
                      </div>
                      <div class="mb-2">
                        <label class="form-label">Số điện thoại người nhận</label>
                        <input type="text" name="recipient_phone" class="form-control"
                          value="<?= htmlspecialchars($a['recipient_phone']) ?>">
                      </div>
                      <div class="text-end">
                        <button class="btn btn-success btn-sm">Lưu</button>
                        <button type="button" class="btn btn-secondary btn-sm"
                          onclick="hideEditAddress(<?= $a['id'] ?>)">Hủy</button>
                      </div>
                    </form>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p class="text-muted">Bạn chưa có địa chỉ nào.</p>
            <?php endif; ?>

            <!-- Nút thêm địa chỉ -->
            <button type="button" class="btn btn-primary btn-sm mt-2" id="showAddAddressForm"
              style="display: <?= $showAddForm ? 'none' : 'inline-block' ?>;">Thêm địa chỉ</button>
          </div>

          <!-- FORM THÊM ĐỊA CHỈ (ẨN) -->
          <div id="addAddressForm" class="border rounded p-4 shadow-sm bg-white mt-3"
            style="display: <?= $showAddForm ? 'block' : 'none' ?>;">
            <h5 class="mb-3">Thêm địa chỉ mới</h5>
            <form action="index.php?page=address-add" method="POST">
              <div class="mb-3">
                <label class="form-label">Tên địa chỉ</label>
                <input type="text" name="title" class="form-control"
                  value="<?= htmlspecialchars($oldData['title'] ?? '') ?>">
                <?php if (!empty($errors['title'])): ?>
                  <small class="text-danger"><?= $errors['title'] ?></small>
                <?php endif; ?>
              </div>
              <div class="mb-3">
                <label class="form-label">Thành phố</label>
                <input type="text" name="city" class="form-control"
                  value="<?= htmlspecialchars($oldData['city'] ?? '') ?>">
                <?php if (!empty($errors['city'])): ?>
                  <small class="text-danger"><?= $errors['city'] ?></small>
                <?php endif; ?>
              </div>
              <div class="mb-3">
                <label class="form-label">Địa chỉ chi tiết</label>
                <textarea name="full_address"
                  class="form-control"><?= htmlspecialchars($oldData['full_address'] ?? '') ?></textarea>
                <?php if (!empty($errors['full_address'])): ?>
                  <small class="text-danger"><?= $errors['full_address'] ?></small>
                <?php endif; ?>
              </div>
              <div class="mb-3">
                <label class="form-label">Số điện thoại người nhận</label>
                <input type="text" name="recipient_phone" class="form-control"
                  value="<?= htmlspecialchars($oldData['recipient_phone'] ?? '') ?>">
                <?php if (!empty($errors['recipient_phone'])): ?>
                  <small class="text-danger"><?= $errors['recipient_phone'] ?></small>
                <?php endif; ?>
              </div>
              <div class="text-end">
                <button class="btn btn-success">Lưu</button>
                <button type="button" class="btn btn-secondary" id="cancelAddAddress">Hủy</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </main>
  </div>
</div>

<script>
  // Hiển thị/hide form thêm địa chỉ
  const btnShow = document.getElementById('showAddAddressForm');
  const btnCancel = document.getElementById('cancelAddAddress');
  const formDiv = document.getElementById('addAddressForm');

  if (btnShow && btnCancel && formDiv) {
    btnShow.addEventListener('click', () => {
      formDiv.style.display = 'block';
      btnShow.style.display = 'none';
    });

    btnCancel.addEventListener('click', () => {
      formDiv.style.display = 'none';
      btnShow.style.display = 'inline-block';
    });
  }

  // Hiển thị form edit
  function showEditAddress(id) {
    document.getElementById('editAddressForm-' + id).style.display = 'block';
  }
  function hideEditAddress(id) {
    document.getElementById('editAddressForm-' + id).style.display = 'none';
  }

  // Confirm box
  function showConfirm({ message, action, id, method = 'POST', field = 'id' }) {
    const box = document.getElementById('globalConfirmBox');
    const form = document.getElementById('confirmForm');
    const msg = document.getElementById('confirmMessage');
    const input = document.getElementById('confirmId');

    msg.innerText = message;
    form.action = action;
    form.method = method;
    input.name = field;
    input.value = id;

    box.classList.remove('d-none');
  }
  function hideConfirm() {
    document.getElementById('globalConfirmBox').classList.add('d-none');
  }
</script>