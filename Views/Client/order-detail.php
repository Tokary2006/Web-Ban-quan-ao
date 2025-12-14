<div class="container py-4">
    <div class="border rounded p-4 shadow-sm bg-white">

        <h5 class="mb-3">Chi tiết đơn hàng #<?= $order['order_code'] ?></h5>

        <p><strong>Ngày mua:</strong> <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></p>
        <p><strong>Trạng thái:</strong>
            <?php if ($order['order_status'] == 0): ?>
                <span class="badge">Chờ xử lý</span>
            <?php elseif ($order['order_status'] == 1): ?>
                <span class="badge ">Đang giao</span>
            <?php else: ?>
                <span class="badge ">Đã nhận</span>
            <?php endif; ?>
        </p>

        <hr>

        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>Sản phẩm</th>
                    <th class="text-center">SL</th>
                    <th class="text-end">Giá</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderItems as $item): ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="Uploads/Product/<?= $item['image'] ?>"
                                    style="width:50px;height:50px;object-fit:cover;" class="rounded border">
                                <?= htmlspecialchars($item['title']) ?>
                            </div>
                        </td>
                        <td class="text-center"><?= $item['quantity'] ?></td>
                        <td class="text-end"><?= number_format($item['price']) ?>₫</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-end fw-bold">
            Tổng tiền: <?= number_format($order['total_price']) ?>₫
        </div>

        <div class="mt-3">
            <a href="index.php?page=profile&tab=orders"
                class="btn btn-secondary btn-sm d-inline-flex align-items-center justify-content-center">
                ← Quay lại
            </a>
        </div>

    </div>
</div>