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
                    <!-- id -->
                    <div class="mb-3">
                        <label for="" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="fullname" placeholder="" />
                        <small id="fullname_error" class="text-danger"></small>
                    </div>
                    <!-- name -->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tên người dùng</label>
                        <input type="text" class="form-control" id="username" placeholder="" />
                        <small id="username_error" class="text-danger"></small>
                    </div>

                    <!-- description -->
                    <div class="mb-3">
                        <label for="" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="password"
                            placeholder=""></input>
                        <small id="password_error" class="text-danger"></small>

                    </div>

                    <!-- slug -->
                    <div class="mb-3">
                        <label for="" class="form-label">Số điện thoại</label>
                        <input type="phone" class="form-control" id="phone" placeholder="" />
                        <small id="phone_error" class="text-danger"></small>
                    </div>
<!-- email -->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="username" placeholder="" />
                        <small id="email_error" class="text-danger"></small>
                    </div>
                    <!-- address -->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" placeholder="" />
                        <small id="address_error" class="text-danger"></small>
                    </div>
                    
                    <!-- status -->
                    <div class="mb-3">
                        <label for="" class="form-label">Trạng thái</label>
                        <select class="form-select" name="status" required>
                                        <option selected disabled>Vui lòng chọn trạng thái...</option>
                                        <option value="1" <?= (isset($errors['product_status_old']) && $errors['product_status_old'] == "1") ? "selected" : "" ?>>Hoạt động</option>
                                        <option value="0" <?= (isset($errors['product_status_old']) && $errors['product_status_old'] == "0") ? "selected" : "" ?>>Vô hiệu hóa</option>
                                    </select>
                        </select>
                        <small id="parent_id_error" class="text-danger"></small>
                    </div>

                    <!-- parend_id -->
                    <div class="mb-3">

                        <label for="" class="form-label">Trạng thái</label>
                        <select class="form-select" name="status" required>
                                        <option selected disabled>Vui lòng chọn vai trò...</option>
                                        <option value="1" <?= (isset($errors['product_status_old']) && $errors['product_status_old'] == "1") ? "selected" : "" ?>>Hoạt động</option>
                                        <option value="0" <?= (isset($errors['product_status_old']) && $errors['product_status_old'] == "0") ? "selected" : "" ?>>Vô hiệu hóa</option>
                                    </select>
                        </select>
                        <small id="parent_id_error" class="text-danger"></small>
                    </div>
                        <small id="status_error" class="text-danger"></small>
                <!-- image -->
                <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="image" placeholder="" />
                        <small id="image_error" class="text-danger"></small>
                    </div>
                </div>
                </div>

                <button type="button" class="btn btn-primary">
                    Cập nhật
                </button>
            </div>
        </div>