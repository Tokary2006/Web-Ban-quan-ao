<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Danh mục /</span> Thêm</h4>

        <form method="POST" action="admin.php?page=category&action=create">    
    <div class="mb-3">
        <label class="form-label">Tên danh mục</label>
        <input type="text" class="form-control" name="name" placeholder="Vui lòng nhập vào tên." required />
    </div>

    <!-- description -->
    <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea class="form-control" name="description" placeholder="Vui lòng nhập vào mô tả."></textarea>
    </div>

    <!-- slug -->
    <div class="mb-3">
        <label class="form-label">Đường dẫn</label>
        <input type="text" class="form-control" name="slug" placeholder="Vui lòng nhập vào đường dẫn." />
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
            <option value="">Chọn danh mục cha</option>
            <option value="1">Áo thun</option>
            <option value="2">Quần</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Thêm</button>
</form>
