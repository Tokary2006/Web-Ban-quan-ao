<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Biến thể /</span> Thêm</h4>

        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <h3 class="card-header">THÊM BIẾN THỂ</h3>
                <div class="card-body">
                    <!-- id -->
                    <div class="mb-3">
                        <label for="" class="form-label">Mã biến thể</label>
                        <input type="text" class="form-control" id="id" placeholder="Vui lòng nhập mã biến thể." />
                        <small id="id_error" class="text-danger"></small>
                    </div>

                    <!-- title -->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Mã định danh biến thể</label>
                        <input type="text" class="form-control" id="sku_id"
                            placeholder="Vui lòng nhập vào mã định danh." />
                        <small id="sku_id_error" class="text-danger"></small>
                    </div>

                    <!-- description -->
                    <div class="mb-3">
                        <label for="" class="form-label">Giá giảm</label>
                        <input type="number" class="form-control" id="discount_price"
                            placeholder="Vui lòng nhập vào mô tả."></input>
                        <small id="discount_price_error" class="text-danger"></small>
                    </div>

                    <!-- shot_description -->
                    <div class="mb-3">
                        <label for="" class="form-label">Mô tả ngắn</label>
                        <input type="number" class="form-control" id="additional_price"
                            placeholder="Vui lòng nhập vào mô tả ngắn."></input>
                        <small id="additional_price_error" class="text-danger"></small>
                    </div>

                    <!-- image -->
                    <div class="mb-3">
                        <label for="" class="form-label">Hình ảnh</label>
                        <input type="number" class="form-control" id="quanlity"
                            placeholder="Vui lòng nhập vào số lượng." />
                        </select>
                        <small id="quanlity_error" class="text-danger"></small>
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

                    <!-- option id -->
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Mã lựa chon</label>
                        <select class="form-select" id="option_id" aria-label="Default select example">
                            <option selected>Vui lòng chọn mã lựa chọn...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <small id="option_id_error" class="text-danger"></small>
                    </div>

                    <!-- product id -->
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Mã sản phẩm</label>
                        <select class="form-select" id="product_id" aria-label="Default select example">
                            <option selected>Vui lòng chọn mã sản phẩm...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <small id="product_id_error" class="text-danger"></small>
                    </div>

                    <!-- category id -->
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Mã biến thể</label>
                        <select class="form-select" id="variant_id" aria-label="Default select example">
                            <option selected>Vui lòng chọn mã biến thể...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <small id="variant_id_error" class="text-danger"></small>
                    </div>

                    <!-- value id -->
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Mã dữa liệu</label>
                        <select class="form-select" id="value_id" aria-label="Default select example">
                            <option selected>Vui lòng chọn mã danh mục...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <small id="value_id_error" class="text-danger"></small>
                    </div>
                </div>
                <button type="button" class="btn btn-primary">
                    Thêm
                </button>
            </div>
        </div>