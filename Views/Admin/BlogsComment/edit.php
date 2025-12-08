<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Quản lý Bình luận /</span>
            Chi tiết & Sửa Bình luận #<?= $comment['id'] ?>
        </h4>

        <div class="card mb-4">
            <h5 class="card-header">Thông Tin Chi Tiết và Cập Nhật</h5>

            <div class="card-body">
                <form action="admin.php?page=blogscomment&action=update" method="POST">
                    <input type="hidden" name="id" value="<?= $comment['id'] ?>">

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Bài Viết Liên Quan (Blog ID)</label>
                            <p class="form-control-static">
                                <a href="#" class="text-primary fw-bold">
                                    #<?= $blog['id'] ?>: <?= $blog['title'] ?>
                                </a>
                            </p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tác Giả (User ID)</label>
                            <p class="form-control-static">
                                <?= $user['fullname'] ?> (ID: <?= $user['id'] ?>) -
                                <small><?= $user['email'] ?></small>
                            </p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Nội Dung Bình Luận (*)</label>
                        <textarea class="form-control" rows="6" name="content_text" required><?= $comment['content_text'] ?></textarea>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Cập Nhật Trạng Thái</label>
                            <select class="form-select" name="status_enum" required>
                                <option value="1" <?= $comment['status_enum'] == 1 ? "selected" : "" ?>>Ẩn</option>
                                <option value="0" <?= $comment['status_enum'] == 0 ? "selected" : "" ?>>Hiển thị</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Ngày Tạo</label>
                            <p class="form-control-static"><?= $comment['created_at'] ?></p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-primary me-2">Lưu Thay Đổi</button>

                        <a href="admin.php?page=blogscomment&action=index" class="btn btn-secondary">
                            Hủy / Quay lại
                        </a>
    
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
