<style>
/* Fix bảng order không bị cắt nút */
.content-wrapper,
.card,
.table-responsive {
    height: auto !important;
    max-height: none !important;
    overflow: visible !important;
}
</style>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Quản lý /</span> Đơn hàng
        </h4>

        <div class="card p-3">
            <h3 class="card-header">Danh sách đơn hàng</h3>

            <div class="table-responsive mt-3">
                <table class="table table-striped text-center" id="orderTable">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Mã đơn hàng</th>
                            <th>Mã KH</th>
                            <th>Tổng tiền</th>
                            <th>Thanh toán</th>
                            <th>Trạng thái</th>
                            <th>Địa chỉ giao hàng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?= $order['id'] ?></td>

                                <td class="fw-bold">
                                    <?= $order['order_code'] ?>
                                </td>

                                <td><?= $order['user_id'] ?></td>

                                <td class="fw-bold text-success">
                                    <?= number_format((float)$order['total_price']) ?>đ
                                </td>

                                <td><?= $order['payment_method'] ?></td>

                                <!-- STATUS -->
                                <td>
                                    <?php
                                        $statusMap = [
                                            '0' => [
                                                'text' => 'Đang xử lý',
                                                'class' => 'bg-label-info'
                                            ],
                                            '1' => [
                                                'text' => 'Đang giao hàng',
                                                'class' => 'bg-label-primary'
                                            ],
                                            '2' => [
                                                'text' => 'Đã hoàn thành',
                                                'class' => 'bg-label-success'
                                            ],
                                        ];

                                        $status = $order['order_status'];
                                        $text  = $statusMap[$status]['text']  ?? $status;
                                        $class = $statusMap[$status]['class'] ?? 'bg-label-secondary';
                                    ?>
                                    <span class="badge <?= $class ?>">
                                        <?= $text ?>
                                    </span>
                                </td>

                                <td><?= $order['ship_address'] ?></td>

                                <td>
                                    <div class="dropdown">
                                        <button class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                               href="admin.php?page=order&action=edit&id=<?= $order['id'] ?>">
                                                <i class="bx bx-show me-1"></i> Chi tiết
                                            </a>

                                            <a class="dropdown-item"
                                               onclick="return confirm('Xác nhận xóa đơn hàng?')"
                                               href="admin.php?page=order&action=delete&id=<?= $order['id'] ?>">
                                                <i class="bx bx-trash me-1"></i> Xóa
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">Không có đơn hàng nào</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
