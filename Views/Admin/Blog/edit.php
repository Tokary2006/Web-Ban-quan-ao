<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Bài viết /</span> Sửa</h4>

        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <h3 class="card-header">SỬA BÀI VIẾT</h3>
                <div class="card-body">
                    <!-- id -->
                    <div class="mb-3">
                        <label for="" class="form-label">Mã bài viết</label>
                        <input type="text" class="form-control" id="id" placeholder="Vui lòng nhập mã bài viết." />
                        <small id="id_error" class="text-danger"></small>
                    </div>

                    <!-- name -->
                    <div class="mb-3">
                        <label for="" class="form-label">Tiêu đề bài viết</label>
                        <input type="text" class="form-control" id="title" placeholder="Vui lòng nhập vào tên." />
                        <small id="title_error" class="text-danger"></small>
                    </div>

                    <!-- slug -->
                    <div class="mb-3">
                        <label for="" class="form-label">Đường dẫn</label>
                        <input type="text" class="form-control" id="slug" placeholder="Vui lòng nhập vào đường dẫn." />
                        <small id="slug_error" class="text-danger"></small>
                    </div>

                    <!-- content -->
                    <div class="mb-3">
                        <label for="" class="form-label">Nội dung</label>
                        <textarea type="text" class="form-control" id="content"
                            placeholder="Vui lòng nhập vào nội dung."></textarea>
                        <small id="description_error" class="text-danger"></small>
                    </div>

                    <!-- meta description -->
                    <div class="mb-3">
                        <label for="" class="form-label">Mô tả</label>
                        <textarea type="text" class="form-control" id="meta_description"
                            placeholder="Vui lòng nhập vào mô tả."></textarea>
                        <small id="meta_description_error" class="text-danger"></small>
                    </div>

                    <!-- meta keyword -->
                    <div class="mb-3">
                        <label for="" class="form-label">Từ khóa chính</label>
                        <input type="text" class="form-control" id="meta_keyword"
                            placeholder="Vui lòng nhập vào từ khóa chính." />
                        <small id="meta_keyword_error" class="text-danger"></small>
                    </div>

                    <!-- image -->
                    <div class="mb-3">
                        <label for="" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="slug" />
                        <small id="slug_error" class="text-danger"></small>
                    </div>


                    <!-- author id -->
                    <div class="mb-3">
                        <label for="" class="form-label">Mã tác giả</label>
                        <select class="form-select" id="author_id" aria-label="Default select example">
                            <option selected>Vui lòng chọn mã tác giả...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <small id="author_id_error" class="text-danger"></small>
                    </div>

                    <!-- status -->
                    <div class="mb-3">
                        <label for="" class="form-label">Trạng thái</label>
                        <select class="form-select" name="status" required>
                            <option selected disabled>Vui lòng chọn trạng thái...</option>
                            <option value="1" <?= (isset($errors['status_old']) && $errors['status_old'] == "1") ? "selected" : "" ?>>Đã xuất bản</option>
                            <option value="0" <?= (isset($errors['status_old']) && $errors['status_old'] == "0") ? "selected" : "" ?>>Chưa duyệt</option>
                        </select>
                        <small id="status_error" class="text-danger"></small>
                    </div>
                </div>
                <button type="button" class="btn btn-primary">
                    SỬA
                </button>
            </div>
        </div>