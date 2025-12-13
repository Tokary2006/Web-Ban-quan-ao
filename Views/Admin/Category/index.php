<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION['success'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>


<!-- Modal Xóa -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa danh mục này?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <a href="#" class="btn btn-danger" id="confirmDelete">Chấp nhận</a>
            </div>
        </div>
    </div>
</div>

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Danh mục/</span> Danh sách</h4>
        <!-- Striped Rows -->
        <div class="card p-3">
            <h3 class="card-header">Danh sách danh mục</h3>
            <div class="table-responsive">
                <table class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th>Mã danh mục</th>
                            <th>ID cha</th>
                            <th>Tên danh mục</th>
                            <th>Mô tả</th>
                            <th>Đường dẫn</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 text-center">
                        <?php foreach ($categories as $cate): ?>
                            <tr>
                                <td><?= $cate['id'] ?></td>
                                <td><?= $cate['parent_id'] ?: 'null' ?></td>
                                <td><?= $cate['name'] ?></td>
                                <td><?= $cate['description'] ?></td>
                                <td><?= $cate['slug'] ?></td>

                                <td>
                                    <?php if ($cate['status'] == 1): ?>
                                        <span class="badge bg-label-success">Hiện</span>
                                    <?php else: ?>
                                        <span class="badge bg-label-danger">Ẩn</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="admin.php?page=category&action=edit&id=<?= $cate['id'] ?>">
                                                <i class="bx bx-edit-alt me-1"></i> Sửa
                                            </a>

                                            <a href="admin.php?page=category&action=delete&id=<?= $cate['id'] ?>"
                                                class="dropdown-item btn-delete" data-id="<?= $cate['id'] ?>">
                                                <i class="bx bx-trash me-1"></i> Xóa
                                            </a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll(".btn-delete");
        const confirmBtn = document.getElementById("confirmDelete");

        deleteButtons.forEach(button => {
            button.addEventListener("click", function (e) {
                e.preventDefault();
                const url = this.getAttribute("href");
                confirmBtn.setAttribute("href", url);
                const deleteModal = new bootstrap.Modal(document.getElementById("deleteModal"));
                deleteModal.show();
            });
        });
    });
</script>