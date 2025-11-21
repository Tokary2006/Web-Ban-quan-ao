<?php
use Vtiful\Kernel\Format;
?>
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
                            <th>Mã sản phẩm</th>
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
                    <tbody class="table-border-bottom-0 text-center">

                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>
                                <?= number_format($value["price"] = 200000) ?>đ
                            </td>
                            <td>Áo thun Wearly</td>
                            <td>Áo thun mặc mát</td>
                            <td>Áo thun mặc mát-ngắn</td>
                            <td>Hình ảnh</td>
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
                                        <a class="dropdown-item" href="admin.php?page=product&action=edit"><i
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