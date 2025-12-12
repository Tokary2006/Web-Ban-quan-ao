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
                        <div class="mb-3">
                            <label class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" name="name" placeholder="Vui lòng nhập vào tên." />
                            <?php if (!empty($errors['name'])): ?>
                                <p class="text-danger mt-1"><?= $errors['name'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- description -->
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" name="description"
                                placeholder="Vui lòng nhập vào mô tả."></textarea>
                            <?php if (!empty($errors['description'])): ?>
                                <p class="text-danger mt-1"><?= $errors['description'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- slug -->
                        <div class="mb-3">
                            <label class="form-label">Đường dẫn</label>
                            <input type="text" class="form-control" name="slug"
                                placeholder="Vui lòng nhập vào đường dẫn." />
                            <?php if (!empty($errors['slug'])): ?>
                                <p class="text-danger mt-1"><?= $errors['slug'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- status -->
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-select" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <!-- parent_id -->
                        <div class="mb-3">
                            <label class="form-label">Danh mục cha</label>
                            <select class="form-select" name="parent_id">

                                <!-- Mặc định là root -->
                                <option value="0">-- Không có cha --</option>

                                <?php foreach ($allCategories as $parent): ?>
                                    <option value="<?= $parent['id'] ?>">
                                        <?= htmlspecialchars($parent['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                                <?php if (!empty($errors['parent_id'])): ?>
                                    <p class="text-danger mt-1"><?= $errors['parent_id'] ?></p>
                                <?php endif; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>