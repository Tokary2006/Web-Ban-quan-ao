<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Quản lý Bình luận /</span> Chi tiết & Sửa Bình luận #<?= $comment['id'] ?>
        </h4>

        <div class="card mb-4">
            <h5 class="card-header">Thông Tin Chi Tiết và Cập Nhật</h5>
            <div class="card-body">
                <form action="admin.php?page=productscomment&action=update" method="POST">
                    <input type="hidden" name="id" value="<?= $comment['id'] ?>">

                    <!-- Thông tin sản phẩm và tác giả -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Sản Phẩm Liên Quan (Product ID)</label>
                            <p class="form-control-static">
                                <a href="#" class="text-primary fw-bold">
                                    #<?= $comment['product_id'] ?>: <?= $comment['product_name'] ?>
                                </a> (ID: <?= $comment['product_id'] ?>)
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tác Giả (User ID)</label>
                            <p class="form-control-static">
                                <?= $comment['user_name'] ?? 'Khách vãng lai' ?> (ID: <?= $comment['user_id'] ?? 'null' ?>)
                            </p>
                        </div>
                    </div>

                    <!-- Nội dung bình luận -->
                    <div class="mb-4">
                        <label for="comment_content" class="form-label fw-bold">Nội Dung Bình Luận (*)</label>
                        <textarea class="form-control" id="comment_content" name="content" rows="6" required><?= htmlspecialchars($comment['content']) ?></textarea>
                        <small class="form-text text-muted">Có thể chỉnh sửa nội dung nếu cần thiết.</small>
                    </div>

                    <hr>

                    <!-- Ngày bình luận -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Ngày Bình Luận</label>
                            <p class="form-control-static"><?= $comment['created_at'] ?></p>
                        </div>
                    </div>

                    <!-- Nút hành động -->
                    <div class="mt-4 d-flex justify-content-between">
                        <div>
                            <button type="submit" class="btn btn-primary me-2">Lưu Thay Đổi</button>
                            <a href="admin.php?page=productscomment&action=index" class="btn btn-secondary">Hủy / Quay lại</a>
                        </div>
                        <a href="admin.php?page=productscomment&action=delete&id=<?= $comment['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa bình luận này?')">Xóa Bình Luận</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
