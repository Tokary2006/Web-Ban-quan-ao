<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Danh mục /</span> Thêm</h4>

        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <h3 class="card-header">THÊM DANH MỤC</h3>
                <div class="card-body">
                    <!-- id -->
                    <div class="mb-3">
                        <label for="" class="form-label">Mã sản phẩm</label>
                        <input type="text" class="form-control" id="id" placeholder="Vui lòng nhập mã sản phẩm." />
                        <small id="id_error" class="text-danger"></small>
                    </div>

                    <!-- title -->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="title" placeholder="Vui lòng nhập vào tên." />
                        <small id="title_error" class="text-danger"></small>
                    </div>

                    <!-- description -->
                    <div class="mb-3">
                        <label for="" class="form-label">Mô tả</label>
                        <textarea type="text" class="form-control" id="description"
                            placeholder="Vui lòng nhập vào mô tả."></textarea>
                        <small id="description_error" class="text-danger"></small>
                    </div>

                    <!-- shot_description -->
                    <div class="mb-3">
                        <label for="" class="form-label">Mô tả ngắn</label>
                        <textarea type="text" class="form-control" id="shot_description"
                            placeholder="Vui lòng nhập vào mô tả ngắn."></textarea>
                        <small id="shot_description_error" class="text-danger"></small>
                    </div>

                    <!-- image -->
                    <div class="mb-3">
                        <label for="" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="slug" placeholder="Vui lòng nhập vào đường dẫn." />
                        </select>
                        <small id="status_error" class="text-danger"></small>
                    </div>

                    <!-- status -->
                    <div class="mb-3">
                        <label for="" class="form-label">Trạng thái</label>
                        <select class="form-select" name="status" required>
                            <option selected disabled>Vui lòng chọn trạng thái...</option>
                            <option value="1" <?= (isset($errors['status_old']) && $errors['status_old'] == "1") ? "selected" : "" ?>>Còn hàng</option>
                            <option value="0" <?= (isset($errors['status_old']) && $errors['status_old'] == "0") ? "selected" : "" ?>>Hết hàng</option>
                        </select>
                        <small id="status_error" class="text-danger"></small>
                    </div>

                    <!-- category id -->
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Mã danh mục</label>
                        <select class="form-select" id="category_id" aria-label="Default select example">
                            <option selected>Vui lòng chọn mã danh mục...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <small id="category_id_error" class="text-danger"></small>
                    </div>
                </div>
                <button type="button" class="btn btn-primary">
                    Thêm
                </button>
            </div>
        </div>