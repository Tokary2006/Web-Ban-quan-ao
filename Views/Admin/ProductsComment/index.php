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
            <span class="text-muted fw-light">Quản lý /</span> Bình luận Sản phẩm
        </h4>

        <div class="card p-3">
            <h3 class="card-header">Danh sách Bình luận</h3>

            <div class="table-responsive">
                <table class="table table-striped" id="commentTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sản phẩm (Product ID)</th>
                            <th>Tác giả (User ID)</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php foreach ($comments as $c): ?>
                            <tr>
                                <td><?= $c['id'] ?></td>
                                <td>
                                    <a href="#" class="text-primary">
                                        #<?= $c['product_id'] ?>: <?= $c['product_name'] ?>
                                    </a>
                                    <br><small>(Product ID: <?= $c['product_id'] ?>)</small>
                                </td>
                                <td>
                                    <span class="fw-bold <?= $c['user_name'] ? '' : 'text-muted' ?>">
                                        <?= $c['user_name'] ?? 'Khách vãng lai' ?>
                                    </span>
                                    <br><small>(User ID: <?= $c['user_id'] ?? 'null' ?>)</small>
                                </td>
                                <td>
                                    <?php if ($c['status'] == 0): ?>
                                        <span class="badge bg-warning">Chờ duyệt</span>
                                    <?php elseif ($c['status'] == 1): ?>
                                        <span class="badge bg-success">Đã duyệt</span>
                                    <?php elseif ($c['status'] == 2): ?>
                                        <span class="badge bg-secondary">Đã ẩn</span>
                                    <?php else: ?>
                                        <span class="badge bg-dark">Không xác định</span>
                                    <?php endif; ?>
                                </td>

                                <td><?= $c['created_at'] ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="admin.php?page=productscomment&action=edit&id=<?= $c['id'] ?>">
                                                <i class="bx bx-edit-alt me-1"></i> Sửa/Xem chi tiết
                                            </a>
                                            <a class="dropdown-item text-danger"
                                                href="admin.php?page=productscomment&action=delete&id=<?= $c['id'] ?>"
                                                onclick="return confirm('Bạn có chắc muốn xóa?')">
                                                <i class="bx bx-trash me-1"></i> Xóa
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($comments)): ?>
                            <tr>
                                <td colspan="6" class="text-center">Chưa có bình luận nào</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>