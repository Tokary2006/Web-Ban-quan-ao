<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sản phẩm /</span> Sửa</h4>

        <div class="card mb-4">
            <h3 class="card-header">SỬA SẢN PHẨM</h3>
            <div class="card-body">

                <!-- FORM -->
                <form action="admin.php?page=product&action=edit" method="POST" enctype="multipart/form-data">

                    <!-- hidden ID -->
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">

                    <!-- title -->
                    <div class="mb-3">
                        <label class="form-label">Tên sản phẩm</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            name="title"
                            value="<?= $product['title'] ?>"
                        >
                    </div>

                    <!-- price -->
                    <div class="mb-3">
                        <label class="form-label">Giá</label>
                        <input 
                            type="number" 
                            class="form-control" 
                            name="price"
                            value="<?= $product['price'] ?>"
                        >
                    </div>

                    <!-- short description -->
                    <div class="mb-3">
                        <label class="form-label">Mô tả ngắn</label>
                        <textarea class="form-control" name="short_description"><?= $product['short_description'] ?></textarea>
                    </div>

                    <!-- description -->
                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea class="form-control" name="description"><?= $product['description'] ?></textarea>
                    </div>

                    <!-- image -->
                    <div class="mb-3">
                        <label class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" name="image">
                        <img src="uploads/products/<?= $product['image'] ?>" width="120" class="mt-2">
                        <input type="hidden" name="old_image" value="<?= $product['image'] ?>">
                    </div>

                    <!-- status -->
                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select class="form-select" name="status">
                            <option value="1" <?= $product['status'] == 1 ? 'selected' : '' ?>>Còn hàng</option>
                            <option value="0" <?= $product['status'] == 0 ? 'selected' : '' ?>>Hết hàng</option>
                        </select>
                    </div>

                    <!-- category -->
                    <div class="mb-3">
                        <label class="form-label">Danh mục</label>
                        <select class="form-select" name="category_id">
                            <?php foreach ($categories as $cate): ?>
                                <option 
                                    value="<?= $cate['id'] ?>" 
                                    <?= $product['category_id'] == $cate['id'] ? 'selected' : '' ?>>
                                    <?= $cate['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- submit -->
                    <button type="submit" class="btn btn-primary">Cập nhật</button>

                </form>

            </div>
        </div>
    </div>
</div>