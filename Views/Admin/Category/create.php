<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Khách hàng /</span> Thêm</h4>

        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <h3 class="card-header">THÊM THÔNG TIN</h3>
                <div class="card-body">
                    <form method="POST" action="admin.php?page=category&action=create">
                        <!-- Tên danh mục -->
                        <div class="mb-3">
                            <label class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" name="name" placeholder="Vui lòng nhập vào tên."
                                value="<?= htmlspecialchars($old['name'] ?? '') ?>" />
                            <?php if (!empty($errors['name'])): ?>
                                <p class="text-danger mt-1"><?= $errors['name'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" name="description"
                                placeholder="Vui lòng nhập vào mô tả."><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
                            <?php if (!empty($errors['description'])): ?>
                                <p class="text-danger mt-1"><?= $errors['description'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Slug -->
                        <div class="mb-3">
                            <label class="form-label">Đường dẫn</label>
                            <input type="text" class="form-control" name="slug"
                                placeholder="Vui lòng nhập vào đường dẫn."
                                value="<?= htmlspecialchars($old['slug'] ?? '') ?>" />
                            <?php if (!empty($errors['slug'])): ?>
                                <p class="text-danger mt-1"><?= $errors['slug'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-select" name="status">
                                <option value="">-- Chọn trạng thái --</option>
                                <option value="1" <?= isset($old['status']) && $old['status'] == '1' ? 'selected' : '' ?>>
                                    Hiện</option>
                                <option value="0" <?= isset($old['status']) && $old['status'] == '0' ? 'selected' : '' ?>>
                                    Ẩn</option>
                            </select>
                            <?php if (!empty($errors['status'])): ?>
                                <p class="text-danger mt-1"><?= $errors['status'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Parent ID -->
                        <div class="mb-3">
                            <label class="form-label">Danh mục cha</label>
                            <select class="form-select" name="parent_id">
                                <option value="0">-- Không có cha --</option>
                                <?php foreach ($allCategories as $parent): ?>
                                    <?php
                                    if (isset($old['id']) && $parent['id'] == $old['id'])
                                        continue;

                                    $selected = (isset($old['parent_id']) && $old['parent_id'] == $parent['id']) ? 'selected' : '';
                                    ?>
                                    <option value="<?= $parent['id'] ?>" <?= $selected ?>>
                                        <?= htmlspecialchars($parent['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (!empty($errors['parent_id'])): ?>
                                <p class="text-danger mt-1"><?= $errors['parent_id'] ?></p>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>