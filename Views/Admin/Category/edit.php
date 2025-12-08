<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Khách hàng /</span> Sửa</h4>

        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <h3 class="card-header">SỬA THÔNG TIN</h3>
                <div class="card-body">
                    <form method="POST" action="admin.php?page=category&action=edit&id=<?= $category['id'] ?>"> <input
                            type="hidden" name="id" value="<?= $category['id'] ?>">

                        <div class="mb-3">
                            <label class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" name="name" placeholder="Vui lòng nhập vào tên."
                                value="<?= $category['name'] ?>" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" name="description"
                                placeholder="Vui lòng nhập vào mô tả."><?= $category['description'] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Đường dẫn</label>
                            <input type="text" class="form-control" name="slug"
                                placeholder="Vui lòng nhập vào đường dẫn." value="<?= $category['slug'] ?>" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-select" name="status">
                                <option value="1" <?= $category['status'] == 1 ? 'selected' : '' ?>>Active</option>
                                <option value="0" <?= $category['status'] == 0 ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Danh mục cha</label>
                            <select class="form-select" name="parent_id">
                                <option value="">Chọn danh mục cha</option>

                                <option value="1" <?= $category['parent_id'] == 1 ? 'selected' : '' ?>>Áo thun</option>
                                <option value="2" <?= $category['parent_id'] == 2 ? 'selected' : '' ?>>Quần</option>

                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>