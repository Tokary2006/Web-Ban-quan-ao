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

                        <tr>
                            <td>1</td>
                            <td>null</td>
                            <td>Áo thun</td>
                            <td>Áo thun</td>
                            <td>ao-thun</td>
                            <td><span class="badge bg-label-success me-1">Active</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="admin.php?page=category&action=edit"><i
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