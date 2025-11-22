<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Quản lý /</span> Bình luận Sản phẩm
        </h4>
        
        <div class="card p-3">
            <h3 class="card-header">Danh sách Bình luận</h3>
            
            <div class="table-responsive ">
                <table class="table table-striped" id="commentTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sản phẩm (Product ID)</th>
                            <th>Tác giả (User ID)</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                        <tr>
                            <td>101</td>
                            <td><a href="#" class="text-primary">#15: Áo Hoodie Classic</a><br><small>(Product ID: 15)</small></td>
                            <td><span class="fw-bold">Nguyễn Văn A</span><br><small>(User ID: 25)</small></td>

                            <td><span class="badge bg-label-success me-1">hiển thị</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="admin.php?page=productscomment&action=edit&id=101"><i class="bx bx-edit-alt me-1"></i> Sửa/Xem chi tiết</a>
                                        <a class="dropdown-item text-danger" href="admin.php?page=productscomment&action=delete&id=101"><i class="bx bx-trash me-1"></i> Xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>102</td>
                            <td><a href="#" class="text-primary">#42: Tai nghe Gaming RGB</a><br><small>(Product ID: 42)</small></td>
                            <td><span class="fw-bold">Trần Thị B</span><br><small>(User ID: 48)</small></td>
x
                            <td><span class="badge bg-label-success me-1">hiển thị</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="admin.php?page=productscomment&action=edit&id=101"><i class="bx bx-edit-alt me-1"></i> Sửa/Xem chi tiết</a>
                                        <a class="dropdown-item text-danger" href="admin.php?page=productscomment&action=delete&id=101"><i class="bx bx-trash me-1"></i> Xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>103</td>
                            <td><a href="#" class="text-primary">#05: Giày Sneaker Premium</a><br><small>(Product ID: 05)</small></td>
                            <td><span class="fw-bold text-muted">Khách vãng lai</span><br><small>(User ID: null)</small></td>
x
                            <td><span class="badge bg-label-danger me-1">Đã ẩn</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item" href="admin.php?page=productscomment&action=edit&id=101"><i class="bx bx-edit-alt me-1"></i> Sửa/Xem chi tiết</a>
                                        <a class="dropdown-item text-danger" href="admin.php?page=productscomment&action=delete&id=101"><i class="bx bx-trash me-1"></i> Xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
