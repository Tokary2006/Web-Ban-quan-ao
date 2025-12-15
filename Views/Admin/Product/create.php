<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Danh mục /</span> Thêm
        </h4>

        <div class="col-md-12">
            <div class="card mb-4">
                <h3 class="card-header">THÊM DANH MỤC</h3>

                <div class="card-body">

                    <!-- FORM -->
                    <form action="admin.php?page=product&action=create" method="POST" enctype="multipart/form-data">

                        <!-- Tên sản phẩm -->
                        <div class="mb-3">
                            <label class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="title" placeholder="Nhập tên sản phẩm"
                                value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">
                            <small class="text-danger"><?= $errors['title'] ?? '' ?></small>
                        </div>

                        <!-- Danh mục -->
                        <div class="mb-3">
                            <label class="form-label">Danh mục</label>
                            <select class="form-select" name="category_id">
                                <option value="" disabled <?= empty($_POST['category_id']) ? 'selected' : '' ?>>-- Chọn
                                    danh mục --</option>
                                <?php foreach ($categories as $cate): ?>
                                    <option value="<?= $cate['id'] ?>" <?= (($_POST['category_id'] ?? '') == $cate['id']) ? 'selected' : '' ?>>
                                        <?= $cate['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-danger"><?= $errors['category_id'] ?? '' ?></small>
                        </div>

                        <!-- Slug -->
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control" name="slug"
                                placeholder="Nhập slug (hoặc để trống tự tạo)"
                                value="<?= htmlspecialchars($_POST['slug'] ?? '') ?>">
                            <small class="text-danger"><?= $errors['slug'] ?? '' ?></small>
                        </div>

                        <!-- Stock -->
                        <div class="mb-3">
                            <label class="form-label">Số lượng tồn kho</label>
                            <input type="number" class="form-control" name="stock" min="0"
                                placeholder="Nhập số lượng tồn kho (hoặc để trống mặc định bằng 0)" value="<?= $_POST['stock'] ?? null ?>">
                            <small class="text-danger"><?= $errors['stock'] ?? '' ?></small>
                        </div>

                        <!-- Giá -->
                        <div class="mb-3">
                            <label class="form-label">Giá</label>
                            <input type="number" class="form-control" name="price" min="0" step="0.01"
                            placeholder="Nhập Giá (hoặc để trống mặc định bằng 0)"
                                value="<?= $_POST['price'] ?? null ?>">
                            <small class="text-danger"><?= $errors['price'] ?? '' ?></small>
                        </div>

                        <!-- Giá giảm -->
                        <div class="mb-3">
                            <label class="form-label">Giá giảm</label>
                            <input type="number" class="form-control" name="discount_price" min="0" step="0.01"
                            placeholder="Nhập giá giảm (hoặc để trống mặc định bằng 0)"
                                value="<?= $_POST['discount_price'] ?? null ?>">
                            <small class="text-danger"><?= $errors['discount_price'] ?? '' ?></small>
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" name="description" id="editor"
                                placeholder="Nhập mô tả"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                            <small class="text-danger"><?= $errors['description'] ?? '' ?></small>
                        </div>

                        <!-- Mô tả ngắn -->
                        <div class="mb-3">
                            <label class="form-label">Mô tả ngắn</label>
                            <textarea class="form-control" name="short_description" id="shortEditor"
                                placeholder="Nhập mô tả ngắn"><?= htmlspecialchars($_POST['short_description'] ?? '') ?></textarea>
                            <small class="text-danger"><?= $errors['short_description'] ?? '' ?></small>
                        </div>

                        <!-- Hình ảnh -->
                        <div class="mb-3">
                            <label class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" name="image">
                            <small class="text-danger"><?= $errors['image'] ?? '' ?></small>
                        </div>

                        <!-- Featured -->
                        <div class="mb-3">
                            <label class="form-label">Sản phẩm nổi bật</label>
                            <select class="form-select" name="featured_id">
                                <option value="" disabled <?= empty($_POST['featured_id']) ? 'selected' : '' ?>>-- Chọn
                                    trạng
                                    thái --
                                </option>
                                <option value="1" <?= (($_POST['featured_id'] ?? '') == 1) ? 'selected' : '' ?>>Nổi bật
                                </option>
                                <option value="0" <?= (($_POST['featured_id'] ?? '') == 0) ? 'selected' : '' ?>>Không nổi
                                    bật</option>
                            </select>
                            <small class="text-danger"><?= $errors['featured_id'] ?? '' ?></small>
                        </div>

                        <button type="submit" class="btn btn-primary">Thêm</button>

                    </form>


                </div>
            </div>
        </div>

    </div>
</div>