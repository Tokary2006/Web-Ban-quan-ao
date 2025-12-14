<?php
$old = $_SESSION['old_data'] ?? [];
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['old_data'], $_SESSION['errors']);
?>

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
                        <input type="text" class="form-control" name="title"
                            placeholder="Vui lòng nhập tiêu đề bài viết..."
                            value="<?= htmlspecialchars($old['title'] ?? '') ?>">
                        <?php if (!empty($errors['title'])): ?>
                            <p class="text-danger"><?= $errors['title'] ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Slug -->
                    <div class="mb-3">
                        <label class="form-label">Đường dẫn (slug)</label>
                        <input type="text" class="form-control" name="slug" placeholder="Vui lòng nhập slug bài viết..."
                            value="<?= htmlspecialchars($old['slug'] ?? '') ?>">
                        <?php if (!empty($errors['slug'])): ?>
                            <p class="text-danger"><?= $errors['slug'] ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Nội dung -->
                    <div class="mb-3">
                        <label class="form-label">Nội dung</label>
                        <textarea class="form-control" name="content"
                            placeholder="Vui lòng nhập nội dung bài viết..." id="content"><?= htmlspecialchars($old['content'] ?? '') ?></textarea>
                        <?php if (!empty($errors['content'])): ?>
                            <p class="text-danger"><?= $errors['content'] ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Mô tả -->
                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea class="form-control" name="meta_description"
                            placeholder="Vui lòng nhập mô tả ngắn..."><?= htmlspecialchars($old['meta_description'] ?? '') ?></textarea>
                    </div>

                    <!-- Từ khóa -->
                    <div class="mb-3">
                        <label class="form-label">Từ khóa chính</label>
                        <input type="text" class="form-control" name="meta_keywords"
                            placeholder="Vui lòng nhập từ khóa chính..."
                            value="<?= htmlspecialchars($old['meta_keywords'] ?? '') ?>">
                    </div>

                    <!-- Hình ảnh -->
                    <div class="mb-3">
                        <label class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" name="image">
                        <?php if (!empty($errors['image'])): ?>
                            <p class="text-danger"><?= $errors['image'] ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Tác giả -->
                    <div class="mb-3">
                        <label class="form-label">Tác giả</label>
                        <select class="form-select" name="user_id">
                            <option value="">Chọn tác giả...</option>
                            <?php foreach ($users as $user): ?>
                                <option value="<?= $user['id'] ?>" <?= isset($old['user_id']) && $old['user_id'] == $user['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($user['full_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($errors['user_id'])): ?>
                            <p class="text-danger"><?= $errors['user_id'] ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Trạng thái -->
                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select class="form-select" name="status">
                            <option value="">Chọn trạng thái...</option>
                            <option value="1" <?= isset($old['status']) && $old['status'] == "1" ? 'selected' : '' ?>>
                                Đã xuất bản
                            </option>
                            <option value="0" <?= isset($old['status']) && $old['status'] == "0" ? 'selected' : '' ?>>
                                Chưa duyệt
                            </option>
                        </select>
                        <?php if (!empty($errors['status'])): ?>
                            <p class="text-danger"><?= $errors['status'] ?></p>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

<script>
    let contentEditor;

    ClassicEditor
        .create(document.querySelector('#contentn'))
        .then(editor => {
            contentEditor = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script>