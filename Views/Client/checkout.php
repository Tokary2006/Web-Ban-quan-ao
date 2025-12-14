<?php unset($_SESSION['error']); ?>
<form action="index.php?page=place-order" method="POST">

  <div class="bg-light py-3">
    <div class="container">
      <a href="index.php">Trang chủ</a> /
      <a href="index.php?page=cart">Giỏ hàng</a> /
      <strong>Thanh toán</strong>
    </div>
  </div>

  <div class="site-section">
    <div class="container">
      <div class="row">

        <!-- CỘT TRÁI -->
        <div class="col-md-6">
          <h4>Thông tin giao hàng</h4>

          <!-- CHỌN KIỂU -->
          <div class="card mb-3">
            <div class="card-body">
              <label class="d-block">
                <input type="radio" name="address_type" value="saved" <?= (empty($_POST['address_type']) || $_POST['address_type'] === 'saved') && empty($errors['new_phone']) ? 'checked' : '' ?>>
                Dùng địa chỉ đã lưu
              </label>
              <label class="d-block">
                <input type="radio" name="address_type" value="new" <?= !empty($_POST['address_type']) && $_POST['address_type'] === 'new' ? 'checked' : '' ?>>
                Nhập địa chỉ mới
              </label>
            </div>
          </div>

          <!-- ĐỊA CHỈ ĐÃ CÓ -->
          <div id="saved-address">
            <?php foreach ($addresses as $i => $a): ?>
              <div class="card mb-2">
                <div class="card-body">
                  <label>
                    <input type="radio" name="saved_address_id" value="<?= $a['id'] ?>" <?= $i === 0 ? 'checked' : '' ?>>
                    <strong><?= $a['address_name'] ?></strong> – <?= $a['recipient_phone'] ?><br>
                    <?= $a['full_address'] ?>, <?= $a['city'] ?>
                  </label>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- FORM ĐỊA CHỈ MỚI -->
          <div id="new-address"
            style="display: <?= (!empty($_POST['address_type']) && $_POST['address_type'] === 'new') ||
              (!empty($errors['new_phone']) || !empty($errors['new_address']) || !empty($errors['new_city'])) ? 'block' : 'none' ?>;">
            <div class="card">
              <div class="card-body">
                <input class="form-control mb-2" name="new_phone" placeholder="SĐT"
                  value="<?= htmlspecialchars($_POST['new_phone'] ?? '') ?>">
                <?php if (!empty($errors['new_phone'])): ?>
                  <small class="text-danger"><?= $errors['new_phone'] ?></small>
                <?php endif; ?>

                <input class="form-control mb-2" name="new_address" placeholder="Địa chỉ"
                  value="<?= htmlspecialchars($_POST['new_address'] ?? '') ?>">
                <?php if (!empty($errors['new_address'])): ?>
                  <small class="text-danger"><?= $errors['new_address'] ?></small>
                <?php endif; ?>

                <input class="form-control mb-2" name="new_city" placeholder="Thành phố"
                  value="<?= htmlspecialchars($_POST['new_city'] ?? '') ?>">
                <?php if (!empty($errors['new_city'])): ?>
                  <small class="text-danger"><?= $errors['new_city'] ?></small>
                <?php endif; ?>

                <textarea class="form-control" name="note" placeholder="Ghi chú"></textarea>
              </div>
            </div>
          </div>
        </div>

        <!-- CỘT PHẢI -->
        <div class="col-md-6">
          <h4>Đơn hàng</h4>

          <div class="card mb-3">
            <div class="card-body">
              <table class="table">
                <?php foreach ($cartItems as $item): ?>
                  <tr>
                    <td><?= $item['title'] ?> x<?= $item['quantity'] ?></td>
                    <td class="text-end"><?= number_format($price * $item['quantity']) ?>đ</td>
                  </tr>
                <?php endforeach; ?>
                <tr>
                  <td><strong>Tổng</strong></td>
                  <td class="text-end"><strong><?= number_format($total) ?>đ</strong></td>
                </tr>
              </table>
            </div>
          </div>

          <!-- PAYMENT -->
          <div class="card mb-3">
            <div class="card-body">
              <h5>Thanh toán</h5>
              <label><input type="radio" name="payment_method" value="cod" checked> COD</label><br>
              <label><input type="radio" name="payment_method" value="bank"> Chuyển khoản</label><br>
              <label><input type="radio" name="payment_method" value="momo"> MoMo</label>
            </div>
          </div>

          <button class="btn btn-primary w-100 btn-lg">Đặt hàng</button>
        </div>

      </div>
    </div>
  </div>
</form>

<script>
  document.querySelectorAll('input[name="address_type"]').forEach(r => {
    r.addEventListener('change', () => {
      document.getElementById('saved-address').style.display =
        r.value === 'saved' ? 'block' : 'none';
      document.getElementById('new-address').style.display =
        r.value === 'new' ? 'block' : 'none';
    });
  });
</script>