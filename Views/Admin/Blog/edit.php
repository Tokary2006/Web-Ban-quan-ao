<?php
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
                            <textarea class="form-control" name="content" id="content"><?= htmlspecialchars($old['content'] ?? $blog['content']) ?></textarea>
                            <?php if (!empty($errors['content'])): ?>
                                <small class="text-danger"><?= $errors['content'] ?></small>
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
                            <input type="file" class="form-control" name="image"
                                value="<?= htmlspecialchars($old['image'] ?? $blog['image']) ?>">

                            <img src="Uploads/Blog/<?= $old['image'] ?? $blog['image']  ?>" alt="" width="100px">
                        </div>

                        <!-- AUTHOR -->
                        <div class="mb-3">
                            <label class="form-label">Tác giả</label>
                            <select class="form-select" name="user_id">
                                <option value="">Chọn tác giả...</option>
                                <?php foreach($users as $user): ?>
                                    <option value="<?= $user['id'] ?>"
                                        <?= (($old['user_id'] ?? $blog['user_id']) == $user['id']) ? "selected" : "" ?>>
                                        <?= htmlspecialchars($user['full_name']) ?>
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
                            <select class="form-select" name="status">
                                <option value="1" <?= (($old['status'] ?? $blog['status']) == 1) ? "selected" : "" ?>>Đã xuất bản</option>
                                <option value="0" <?= (($old['status'] ?? $blog['status']) == 0) ? "selected" : "" ?>>Chưa duyệt</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
