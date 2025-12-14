<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Bài viết/</span> Danh sách</h4>
        <!-- Striped Rows -->
        <div class="card p-3">
            <h3 class="card-header">Danh sách bài viết</h3>
            <div class="table-responsive">
                <table class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th>Mã bài viết</th>
                            <th>Mã tác giả</th>
                            <th>Tiêu đề</th>
                            <th>Hình ảnh</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php if (!empty($blogs)): ?>
                            <?php foreach ($blogs as $value): ?>
                                <tr>
                                    <td><?= htmlspecialchars($value['id']) ?></td>
                                    <td><?= htmlspecialchars($value['user_id']) ?></td>
                                    <td><?= htmlspecialchars($value['title']) ?></td>
                                    <td>
                                        <?php if (!empty($value['image'])): ?>
                                            <img src="Uploads/Blog/<?= $value['image'] ?>" width="50px" alt="Hình ảnh bài viết">
                                        <?php else: ?>
                                            <span>Chưa có ảnh</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($value['status'] == 1): ?>
                                            <span class="badge bg-label-success me-1">Đã xuất bản</span>
                                        <?php else: ?>
                                            <span class="badge bg-label-danger me-1">Chưa duyệt</span>
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
                                                    href="admin.php?page=blog&action=edit&id=<?= $value['id'] ?>">
                                                    <i class="bx bx-edit-alt me-1 btn-success"></i> Sửa
                                                </a>
                                                <a class="dropdown-item"
                                                    href="admin.php?page=blog&action=delete&id=<?= $value['id'] ?>"
                                                    onclick="return confirm('Bạn có chắc muốn xóa?')">
                                                    <i class="bx bx-trash me-1 btn-danger"></i> Xóa
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Chưa có bài viết nào</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>