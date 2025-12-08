<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Bài viết /</span> Thêm</h4>

        <div class="card p-3">
            <h3 class="card-header">Thêm Bài Viết</h3>
            <div class="card-body">
                <form action="admin.php?page=blog&action=store" method="POST" enctype="multipart/form-data">
                    <!-- Tiêu đề -->
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề bài viết</label>
                        <input type="text" class="form-control" name="title" placeholder="Nhập tiêu đề" required>
                    </div>

                    <!-- Slug -->
                    <div class="mb-3">
                        <label class="form-label">Đường dẫn</label>
                        <input type="text" class="form-control" name="slug" placeholder="Nhập đường dẫn" required>
                    </div>

                    <!-- Nội dung -->
                    <div class="mb-3">
                        <label class="form-label">Nội dung</label>
                        <textarea class="form-control" name="content_text" placeholder="Nhập nội dung" required></textarea>
                    </div>

                    <!-- Mô tả -->
                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea class="form-control" name="meta_description" placeholder="Nhập mô tả"></textarea>
                    </div>

                    <!-- Từ khóa -->
                    <div class="mb-3">
                        <label class="form-label">Từ khóa chính</label>
                        <input type="text" class="form-control" name="meta_keywords" placeholder="Nhập từ khóa">
                    </div>

                    <!-- Hình ảnh -->
                    <div class="mb-3">
                        <label class="form-label">Hình ảnh</label>
                        <input type="text" class="form-control" name="images" placeholder="Nhập URL hình ảnh">
                    </div>

                    <!-- Mã tác giả -->
                  <div class="mb-3">
    <label class="form-label">Tác giả</label>
    <select class="form-select" name="user_id" required>
        <option value="">Chọn tác giả...</option>
        <?php foreach($users as $user): ?>
            <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['username']) ?></option>
        <?php endforeach; ?>
    </select>
</div>


                    <!-- Trạng thái -->
                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select class="form-select" name="status_enum" required>
                            <option value="">Chọn trạng thái...</option>
                            <option value="1">Đã xuất bản</option>
                            <option value="0">Chưa duyệt</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>
