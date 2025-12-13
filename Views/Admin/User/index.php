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
                            <th>#</th>
                            <th>Tên khách hàng</th>
                            <th>Hình ảnh</th>
                            <th>Vai trò</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 text-center">
                        <?php foreach ($users as $item): ?>
                            <tr>
                                <td><?= $item['id'] ?></td>
                                <td><?= $item['full_name'] ?></td>
                                <?php
                                $img = $item['image']
                                    ? 'Uploads/User/' . $item['image']
                                    : 'https://cdn2.fptshop.com.vn/small/avatar_trang_1_cd729c335b.jpg';
                                ?>
                                <td><img src="<?= $img ?>" alt="" width="40" style="border-radius:100%"></td>
                                <td>
                                    <?php if ($item["role"] == 1): ?>
                                        <span class="badge badge bg-dark me-1">Quản trị viên</span>
                                    <?php else: ?>
                                        <span class="badge badge bg-warning me-1">Khách hàng</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($item["active"] == 1): ?>
                                        <span class="badge bg-label-success me-1">Hoạt động</span>
                                    <?php else: ?>
                                        <span class="badge bg-label-danger me-1">Vô hiệu hóa</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="admin.php?page=user&action=profile&id=<?= $item['id'] ?>"><i
                                                    class="bx bx-edit-alt me-1 btn-success"></i> Chi tiết</a>
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