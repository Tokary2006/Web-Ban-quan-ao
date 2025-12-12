<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Khách hàng /</span> Sửa</h4>

        <div class="col-md-12">
            <div class="card mb-4">
                <h3 class="card-header">SỬA THÔNG TIN</h3>
                <div class="card-body">

                    <form method="POST" action="admin.php?page=category&action=edit&id=<?= $category['id'] ?>">
                        <input type="hidden" name="id" value="<?= $category['id'] ?>">

                        <!-- NAME -->
                        <div class="mb-3">
                            <label class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" name="name"
                                   value="<?= $category['name'] ?>"
                                   placeholder="Vui lòng nhập vào tên." />
                            
                            <?php if (!empty($errors['name'])): ?>
                                <p class="text-danger mt-1"><?= $errors['name'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" name="description"
                                placeholder="Vui lòng nhập vào mô tả."><?= $category['description'] ?></textarea>

                            <?php if (!empty($errors['description'])): ?>
                                <p class="text-danger mt-1"><?= $errors['description'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- SLUG -->
                        <div class="mb-3">
                            <label class="form-label">Đường dẫn</label>
                            <input type="text" class="form-control" name="slug"
                                   value="<?= $category['slug'] ?>"
                                   placeholder="Vui lòng nhập vào đường dẫn." />

                            <?php if (!empty($errors['slug'])): ?>
                                <p class="text-danger mt-1"><?= $errors['slug'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- STATUS -->
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-select" name="status">
                                <option value="1" <?= $category['status'] == 1 ? 'selected' : '' ?>>Active</option>
                                <option value="0" <?= $category['status'] == 0 ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>

                        <!-- PARENT ID -->
                        <div class="mb-3">
                            <label class="form-label">Danh mục cha</label>
                            <select class="form-select" name="parent_id">

                                <option value="0">(Không có cha)</option>

                                <?php foreach ($allCategories as $parent): ?>
                                    <?php if ($parent['id'] != $category['id']): ?>
                                        <option value="<?= $parent['id'] ?>"
                                            <?= ($category['parent_id'] == $parent['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($parent['name']) ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <?php if (!empty($errors['parent_id'])): ?>
                                <p class="text-danger mt-1"><?= $errors['parent_id'] ?></p>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
