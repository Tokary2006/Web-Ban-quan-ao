<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Bài viết /</span> Sửa</h4>

        <div class="col-md-12">
            <div class="card mb-4">
                <h3 class="card-header">SỬA BÀI VIẾT</h3>
                <div class="card-body">
                    <form action="admin.php?page=blog&action=update" method="POST" enctype="multipart/form-data">
                        <!-- id (ẩn) -->
                        <input type="hidden" name="id" value="<?= htmlspecialchars($blog['id']) ?>">

                        <!-- title -->
                        <div class="mb-3">
                            <label class="form-label">Tiêu đề bài viết</label>
                            <input type="text" class="form-control" name="title" 
                                   value="<?= htmlspecialchars($blog['title']) ?>" required>
                        </div>

                        <!-- slug -->
                        <div class="mb-3">
                            <label class="form-label">Đường dẫn</label>
                            <input type="text" class="form-control" name="slug" 
                                   value="<?= htmlspecialchars($blog['slug']) ?>" required>
                        </div>

                        <!-- content -->
                        <div class="mb-3">
                            <label class="form-label">Nội dung</label>
                            <textarea class="form-control" name="content_text" required><?= htmlspecialchars($blog['content_text']) ?></textarea>
                        </div>

                        <!-- meta description -->
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" name="meta_description"><?= htmlspecialchars($blog['meta_description']) ?></textarea>
                        </div>

                        <!-- meta keywords -->
                        <div class="mb-3">
                            <label class="form-label">Từ khóa chính</label>
                            <input type="text" class="form-control" name="meta_keywords" 
                                   value="<?= htmlspecialchars($blog['meta_keywords']) ?>">
                        </div>

                        <!-- images -->
                        <div class="mb-3">
                            <label class="form-label">Hình ảnh</label>
                            <input type="text" class="form-control" name="images" 
                                   value="<?= htmlspecialchars($blog['images']) ?>">
                        </div>

                        <!-- author_id -->
                        <div class="mb-3">
                            <label class="form-label">Mã tác giả</label>
                            <select class="form-select" name="author_id" required>
                                <option value="">Chọn tác giả...</option>
                                <option value="1" <?= ($blog['user_id'] == 1) ? "selected" : "" ?>>One</option>
                                <option value="2" <?= ($blog['user_id'] == 2) ? "selected" : "" ?>>Two</option>
                                <option value="3" <?= ($blog['user_id'] == 3) ? "selected" : "" ?>>Three</option>
                            </select>
                        </div>

                        <!-- status -->
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-select" name="status_enum" required>
                                <option value="1" <?= ($blog['status_enum'] == 1) ? "selected" : "" ?>>Đã xuất bản</option>
                                <option value="0" <?= ($blog['status_enum'] == 0) ? "selected" : "" ?>>Chưa duyệt</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Sửa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
