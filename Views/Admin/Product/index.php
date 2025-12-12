<?php
use Vtiful\Kernel\Format;
?>
<div class="content-wrapper">
    <!-- Content -->

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Sản phẩm /</span> Danh sách
            </h4>

            <div class="card p-3">
                <h3 class="card-header">Danh sách sản phẩm</h3>

                <div class="table-responsive mt-3">
                    <table class="table table-striped" id="myTable">
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

                        <tbody class="table-border-bottom-0 text-center">

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
                                                <img src="Upload/Product/<?= $value["image"] ?>" width="60">
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

                                                    <a onclick="return confirm('Xác nhận xóa?')" class="dropdown-item"
                                                        href="admin.php?page=product&action=delete&id=<?= $value['id'] ?>">
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