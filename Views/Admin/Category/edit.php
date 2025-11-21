<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Quản lí /</span> Sửa</h4>

        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Sửa</h5>
                <div class="card-body">
                    <!-- id -->
                    <div class="mb-3">
                        <label for="" class="form-label">Mã danh mục</label>
                        <input type="text" class="form-control" id="id" placeholder="Vui lòng nhập mã danh mục." />
                        <small id="id_error" class="text-danger"></small>
                    </div>

                    <!-- name -->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tên danh mục</label>
                        <input type="text" class="form-control" id="name" placeholder="Vui lòng nhập vào tên." />
                        <small id="name_error" class="text-danger"></small>
                    </div>

                    <!-- description -->
                    <div class="mb-3">
                        <label for="" class="form-label">Mô tả</label>
                        <textarea type="text" class="form-control" id="description"
                            placeholder="Vui lòng nhập vào mô tả."></textarea>
                        <small id="description_error" class="text-danger"></small>

                    </div>

                    <!-- slug -->
                    <div class="mb-3">
                        <label for="" class="form-label">Đường dẫn</label>
                        <input type="tẽt" class="form-control" id="slug" placeholder="Vui lòng nhập vào đường dẫn." />
                        <small id="slug_error" class="text-danger"></small>
                    </div>

                    <!-- status -->
                    <div class="mb-3">
                        <label for="" class="form-label">Trạng thái</label>
                        <select class="form-select" id="status" aria-label="Default select example">
                            <option selected>Vui lòng chọn...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <small id="parent_id_error" class="text-danger"></small>
                    </div>

                    <!-- parend_id -->
                    <div class="mb-3">
                        <label for="" class="form-label">Danh mục cha</label>
                        <select class="form-select" id="parend_id" aria-label="Default select example">
                            <option selected>Vui lòng chọn...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <small id="status_error" class="text-danger"></small>
                    </div>
                </div>
                <button type="button" class="btn btn-primary">
                    Cập nhật
                </button>
            </div>
        </div>