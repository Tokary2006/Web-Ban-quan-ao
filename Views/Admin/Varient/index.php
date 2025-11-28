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
                            <th>Mã biến thể</th>
                            <th>Tên biến thể</th>
                            <th>Giá giảm</th>
                            <th>Giá bổ sung</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>1</td>
                            <td>Nguyễn Văn A</td>
                            <td>
                                <?= number_format($value["discount_price"] = 200000) ?>đ
                            </td>
                            <td>
                                <?= number_format($value["additional_price"] = 200000) ?>đ
                            </td>
                            <td>100</td>
                            <td><?php $value["status"] = 1 ?>
                                <?php if ($value["status"] == 1): ?>
                                    <span class="badge bg-label-success me-1">Còn hàng</span>
                                <?php else: ?>
                                    <span class="badge bg-label-danger me-1">Hết hàng</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="admin.php?page=variant&action=edit"><i
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