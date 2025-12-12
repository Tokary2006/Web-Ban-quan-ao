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

                        <!-- Mã sản phẩm -->
                        <!-- <div class="mb-3">
                            <label class="form-label">Mã sản phẩm</label>
                            <input type="text" class="form-control" name="id" placeholder="Nhập mã sản phẩm">
                            <small class="text-danger"><?= $errors['id'] ?? '' ?></small>
                        </div> -->

                        <!-- Tên sản phẩm -->
                        <div class="mb-3">
                            <label class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="title" placeholder="Nhập tên sản phẩm">
                            <small class="text-danger"><?= $errors['title'] ?? '' ?></small>
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" name="description" placeholder="Nhập mô tả"></textarea>
                            <small class="text-danger"><?= $errors['description'] ?? '' ?></small>
                        </div>

                        <!-- Mô tả ngắn -->
                        <div class="mb-3">
                            <label class="form-label">Mô tả ngắn</label>
                            <textarea class="form-control" name="short_description"
                                placeholder="Nhập mô tả ngắn"></textarea>
                            <small class="text-danger"><?= $errors['short_description'] ?? '' ?></small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá</label>
                            <input type="number" class="form-control" name="price" min="0" step="0.01"
                                placeholder="Nhập giá">
                            <small class="text-danger"><?= $errors['price'] ?? '' ?></small>
                        </div>

                        <!-- Hình ảnh -->
                        <div class="mb-3">
                            <label class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" name="image">
                            <small class="text-danger"><?= $errors['image'] ?? '' ?></small>
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-select" name="status">
                                <option value="" disabled selected>Chọn trạng thái…</option>
                                <option value="1">Còn hàng</option>
                                <option value="0">Hết hàng</option>
                            </select>
                            <small class="text-danger"><?= $errors['status'] ?? '' ?></small>
                        </div>

                        <!-- Danh mục -->
                        <div class="mb-3">
                            <label class="form-label">Danh mục</label>
                            <select class="form-select" name="category_id">
                                <option value="" disabled selected>-- Chọn danh mục --</option>
                                <?php foreach ($categories as $cate): ?>
                                    <option value="<?= $cate['id'] ?>" <?= (($_POST['category_id'] ?? '') == $cate['id']) ? 'selected' : '' ?>>
                                        <?= $cate['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (!empty($errors['category_id'])): ?>
                                <p class="text-danger mt-1"><?= $errors['category_id'] ?></p>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-primary">Thêm</button>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>