<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Sản phẩm /</span> Sửa
        </h4>

        <div class="card mb-4">
            <h3 class="card-header">SỬA SẢN PHẨM</h3>

            <div class="card-body">

                <form action="admin.php?page=product&action=edit" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?= $product['id'] ?>">

                    <!-- title -->
                    <div class="mb-3">
                        <label class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($_POST['title'] ?? $product['title']) ?>">
                        <?php if (!empty($errors['title'])): ?>
                            <p class="text-danger mt-1"><?= $errors['title'] ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- price -->
                    <div class="mb-3">
                        <label class="form-label">Giá</label>
                        <input type="number" class="form-control" name="price" value="<?= htmlspecialchars($_POST['price'] ?? $product['price']) ?>">
                        <?php if (!empty($errors['price'])): ?>
                            <p class="text-danger mt-1"><?= $errors['price'] ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- short description -->
                    <div class="mb-3">
                        <label class="form-label">Mô tả ngắn</label>
                        <textarea class="form-control" name="short_description"><?= htmlspecialchars($_POST['short_description'] ?? $product['short_description']) ?></textarea>
                        <?php if (!empty($errors['short_description'])): ?>
                            <p class="text-danger mt-1"><?= $errors['short_description'] ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- description -->
                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea class="form-control" name="description"><?= htmlspecialchars($_POST['description'] ?? $product['description']) ?></textarea>
                        <?php if (!empty($errors['description'])): ?>
                            <p class="text-danger mt-1"><?= $errors['description'] ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- image -->
                    <div class="mb-3">
                        <label class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" name="image">

                        <?php if (!empty($product['image'])): ?>
                            <img src="uploads/products/<?= $product['image'] ?>" width="120" class="mt-2">
                        <?php endif; ?>

                        <input type="hidden" name="old_image" value="<?= $product['image'] ?>">
                    </div>

                    <!-- status -->
                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select class="form-select" name="status">
                            <option value="1" <?= (($_POST['status'] ?? $product['status']) == 1) ? 'selected' : '' ?>>Còn hàng</option>
                            <option value="0" <?= (($_POST['status'] ?? $product['status']) == 0) ? 'selected' : '' ?>>Hết hàng</option>
                        </select>
                        <?php if (!empty($errors['status'])): ?>
                            <p class="text-danger mt-1"><?= $errors['status'] ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- category -->
                    <div class="mb-3">
                        <label class="form-label">Danh mục</label>
                        <select class="form-select" name="category_id">
                            <?php foreach ($categories as $cate): ?>
                                <option value="<?= $cate['id'] ?>"
                                    <?= (($_POST['category_id'] ?? $product['category_id']) == $cate['id']) ? 'selected' : '' ?>>
                                    <?= $cate['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($errors['category_id'])): ?>
                            <p class="text-danger mt-1"><?= $errors['category_id'] ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- submit + quay lại -->
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="admin.php?page=product" class="btn btn-secondary ms-2">Quay lại</a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
