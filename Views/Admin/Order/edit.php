<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Quản lý Đơn hàng /</span>
            Chi tiết Đơn hàng #<?= $order['order_code'] ?>
        </h4>

        <div class="row mb-4">
            <!-- THÔNG TIN ĐƠN -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card h-100">
                    <h5 class="card-header">Thông Tin Đơn Hàng</h5>
                    <div class="card-body">
                        <p><strong>Mã Đơn Hàng:</strong> <?= $order['order_code'] ?></p>
                        <p><strong>Ngày Đặt:</strong> <?= $order['created_at'] ?></p>
                        <p><strong>Khách Hàng (ID):</strong> <?= $order['user_id'] ?></p>
                        <p><strong>Ghi Chú:</strong> <?= $order['note'] ?? 'Không có' ?></p>
                        <hr>

                        <form method="POST" action="admin.php?page=order&action=update_status">
                            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">

                            <div class="mb-3">
                                <label class="form-label fw-bold">Trạng Thái Đơn Hàng</label>
                               <select name="order_status" class="form-select">
    <option value="new" <?= $order['order_status']=='new'?'selected':'' ?>>
        Chờ xác nhận
    </option>
    <option value="processing" <?= $order['order_status']=='processing'?'selected':'' ?>>
        Đang xử lý
    </option>
    <option value="delivering" <?= $order['order_status']=='delivering'?'selected':'' ?>>
        Đang giao hàng
    </option>
    <option value="completed" <?= $order['order_status']=='completed'?'selected':'' ?>>
        Đã hoàn thành
    </option>
    <option value="cancelled" <?= $order['order_status']=='cancelled'?'selected':'' ?>>
        Đã hủy
    </option>
</select>

                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Lưu Trạng Thái
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <!-- GIAO HÀNG & THANH TOÁN -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card h-100">
                    <h5 class="card-header">Thông Tin Giao Nhận & Thanh Toán</h5>
                    <div class="card-body">
                        <p><strong>Số Điện Thoại:</strong> <?= $order['phone'] ?></p>
                        <p><strong>Địa Chỉ Giao:</strong> <?= $order['ship_address'] ?></p>
                        <hr>
                        <p><strong>Phương Thức TT:</strong> <?= $order['payment_method'] ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ORDER ITEMS -->
        <div class="card">
            <h5 class="card-header">Danh Sách Sản Phẩm</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Mã SP</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $subtotal = 0; ?>
                        <?php foreach ($orderDetails as $item): ?>
                            <?php $subtotal += $item['subtotal']; ?>
                            <tr>
                                <td><strong><?= $item['product_name'] ?></strong></td>
                                <td><?= $item['product_id'] ?></td>
                                <td><?= number_format($item['price']) ?> đ</td>
                                <td><?= $item['quantity'] ?></td>
                                <td><?= number_format($item['subtotal']) ?> đ</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Tổng phụ:</td>
                            <td class="fw-bold"><?= number_format($subtotal) ?> đ</td>
                        </tr>
                        <tr class="bg-light">
                            <td colspan="4" class="text-end fw-bold fs-5">TỔNG CỘNG:</td>
                            <td class="fw-bold fs-5 text-success">
                                <?= number_format($order['total_price']) ?> đ
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="mt-4">
            <a href="admin.php?page=order" class="btn btn-secondary">
                Quay lại danh sách
            </a>
        </div>

    </div>
</div>
