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


<!-- Modal Xóa Sản phẩm -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa sản phẩm "<span id="deleteItemName"></span>"?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <a href="#" class="btn btn-danger" id="confirmDelete">Chấp nhận</a>
            </div>
        </div>
    </div>
</div>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Sản phẩm /</span> Danh sách
        </h4>

        <div class="card p-3">
            <h3 class="card-header">Danh sách sản phẩm</h3>
            <div class="table-responsive mt-3">
                <table class="table table-striped text-center" id="myTable">
                    <thead>
                        <tr>
                            <th>Mã SP</th>
                            <th>Mã loại</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Mô tả</th>
                            <th>Mô tả ngắn</th>
                            <th>Hình ảnh</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $value): ?>
                                <tr>
                                    <td><?= $value["id"] ?></td>
                                    <td><?= $value["category_id"] ?></td>
                                    <td><?= htmlspecialchars($value["title"]) ?></td>
                                    <td><?= number_format($value["price"]) ?>đ</td>
                                    <td><?= htmlspecialchars($value["description"]) ?></td>
                                    <td><?= htmlspecialchars($value["short_description"]) ?></td>
                                    <td>
                                        <?php if (!empty($value["image"]) && $value["image"] !== "khong_co_hinh_anh"): ?>
                                            <img src="Uploads/Product/<?= $value["image"] ?>" width="60">
                                        <?php else: ?>
                                            <span class="text-muted">Không có ảnh</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($value["status"] == 1): ?>
                                            <span class="badge bg-label-success">Còn hàng</span>
                                        <?php else: ?>
                                            <span class="badge bg-label-danger">Hết hàng</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="admin.php?page=product&action=edit&id=<?= $value['id'] ?>">
                                                    <i class="bx bx-edit-alt me-1"></i> Sửa
                                                </a>
                                                <a href="admin.php?page=product&action=delete&id=<?= $value['id'] ?>"
                                                    class="dropdown-item btn-delete"
                                                    data-name="<?= htmlspecialchars($value["title"], ENT_QUOTES) ?>">
                                                    <i class="bx bx-trash me-1"></i> Xóa
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9">Không có sản phẩm nào.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Không thêm Bootstrap nữa nếu đã có trong layout -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tableBody = document.querySelector("#myTable tbody");
        const confirmBtn = document.getElementById("confirmDelete");
        const itemNameSpan = document.getElementById("deleteItemName");

        tableBody.addEventListener("click", function (e) {
            const btn = e.target.closest(".btn-delete");
            if (btn) {
                e.preventDefault();
                const url = btn.getAttribute("href");
                const name = btn.getAttribute("data-name");

                confirmBtn.setAttribute("href", url);
                itemNameSpan.textContent = name;

                bootstrap.Modal.getOrCreateInstance(
                    document.getElementById("deleteModal")
                ).show();
            }
        });
    });

</script>