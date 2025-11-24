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
                    <tbody class="table-border-bottom-0 text-center">

                        <tr>
                            <td>1</td>
                            <td>Ngọc Viết Lách</td>
                            <td>Xu hướng thời trang</td>
                            <td><img src="https://file.hstatic.net/200000897657/article/pc-thoi-trang-nao-len-ngoi_bbcd361e82294f21814bf1d81870dec3.jpg"
                                    width="50px" alt=""></td>
                            <td><?php $value["status"] = 1 ?>
                                <?php if ($value["status"] == 1): ?>
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
                                        <a class="dropdown-item" href="admin.php?page=blog&action=edit"><i
                                                class="bx bx-edit-alt me-1 btn-success"></i> Sửa</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-trash me-1 btn-danger"></i> Xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>