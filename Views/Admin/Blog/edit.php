<?php
session_start();
$old = $_SESSION['old_data'] ?? [];
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['old_data'], $_SESSION['errors']);
?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Bài viết /</span> Sửa</h4>

        <div class="col-md-12">
            <div class="card mb-4">
                <h3 class="card-header">SỬA BÀI VIẾT</h3>
                <div class="card-body">

                    <form action="admin.php?page=blog&action=update" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $blog['id'] ?>">

                        <!-- TITLE -->
                        <div class="mb-3">
                            <label class="form-label">Tiêu đề bài viết</label>
                            <input type="text" class="form-control" name="title"
                                   value="<?= htmlspecialchars($old['title'] ?? $blog['title']) ?>">
                            <?php if (!empty($errors['title'])): ?>
                                <small class="text-danger"><?= $errors['title'] ?></small>
                            <?php endif; ?>
                        </div>

                        <!-- SLUG -->
                        <div class="mb-3">
                            <label class="form-label">Đường dẫn</label>
                            <input type="text" class="form-control" name="slug"
                                   value="<?= htmlspecialchars($old['slug'] ?? $blog['slug']) ?>">
                            <?php if (!empty($errors['slug'])): ?>
                                <small class="text-danger"><?= $errors['slug'] ?></small>
                            <?php endif; ?>
                        </div>

                        <!-- CONTENT -->
                        <div class="mb-3">
                            <label class="form-label">Nội dung</label>
                            <textarea class="form-control" name="content_text"><?= htmlspecialchars($old['content_text'] ?? $blog['content_text']) ?></textarea>
                            <?php if (!empty($errors['content_text'])): ?>
                                <small class="text-danger"><?= $errors['content_text'] ?></small>
                            <?php endif; ?>
                        </div>

                        <!-- META DESC -->
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" name="meta_description"><?= htmlspecialchars($old['meta_description'] ?? $blog['meta_description']) ?></textarea>
                        </div>

                        <!-- META KEYWORDS -->
                        <div class="mb-3">
                            <label class="form-label">Từ khóa chính</label>
                            <input type="text" class="form-control" name="meta_keywords"
                                value="<?= htmlspecialchars($old['meta_keywords'] ?? $blog['meta_keywords']) ?>">
                        </div>

                        <!-- IMAGES -->
                        <div class="mb-3">
                            <label class="form-label">Hình ảnh</label>
                            <input type="text" class="form-control" name="images"
                                value="<?= htmlspecialchars($old['images'] ?? $blog['images']) ?>">
                        </div>

                        <!-- AUTHOR -->
                        <div class="mb-3">
                            <label class="form-label">Tác giả</label>
                            <select class="form-select" name="user_id">
                                <option value="">Chọn tác giả...</option>
                                <?php foreach($users as $user): ?>
                                    <option value="<?= $user['id'] ?>"
                                        <?= (($old['user_id'] ?? $blog['user_id']) == $user['id']) ? "selected" : "" ?>>
                                        <?= htmlspecialchars($user['username']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <?php if (!empty($errors['user_id'])): ?>
                                <small class="text-danger"><?= $errors['user_id'] ?></small>
                            <?php endif; ?>
                        </div>

                        <!-- STATUS -->
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-select" name="status_enum">
                                <option value="1" <?= (($old['status_enum'] ?? $blog['status_enum']) == 1) ? "selected" : "" ?>>Đã xuất bản</option>
                                <option value="0" <?= (($old['status_enum'] ?? $blog['status_enum']) == 0) ? "selected" : "" ?>>Chưa duyệt</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
