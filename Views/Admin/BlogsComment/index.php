<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Quản lý /</span> Bình luận Bài viết</h4>
        
        <div class="card p-3">
            <h3 class="card-header">Danh sách Bình luận</h3>
            
            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="commentTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Bài viết (Blog ID)</th>
                            <th>Tác giả (User ID)</th>
                            <th>Nội dung</th>
                            <th>Ngày BL</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                        <tr>
                            <td>101</td>
                            <td><a href="#" class="text-primary">#15: Lập trình OOP cơ bản</a><br><small>(ID: 15)</small></td>
                            <td><span class="fw-bold">Nguyễn Văn A</span><br><small>(ID: 25)</small></td>
                            <td style="max-width: 350px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                Bài viết rất hay và chi tiết! Tôi đã học được nhiều điều. Cảm ơn tác giả.
                            </td>
                            <td>22/11/2025</td>
                            <td><span class="badge bg-label-success me-1">Đã duyệt</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="admin.php?page=blogs&action=edit"><i class="bx bx-edit-alt me-1"></i> Sửa/Xem chi tiết</a>
                                        <a class="dropdown-item text-danger" href="admin.php?page=comment&action=delete&id=101"><i class="bx bx-trash me-1"></i> Xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>102</td>
                            <td><a href="#" class="text-primary">#42: Cải tiến hiệu năng SQL</a><br><small>(ID: 42)</small></td>
                            <td><span class="fw-bold">Trần Thị B</span><br><small>(ID: 48)</small></td>
                            <td style="max-width: 350px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                Admin cần xem xét: Bình luận này có chứa liên kết ngoài không liên quan.
                            </td>
                            <td>22/11/2025</td>
                            <td><span class="badge bg-label-warning me-1">Chờ duyệt</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-success" href="admin.php?page=comment&action=approve&id=102"><i class="bx bx-check me-1"></i> **Duyệt**</a>
                                        <a class="dropdown-item text-danger" href="admin.php?page=comment&action=reject&id=102"><i class="bx bx-x me-1"></i> Từ chối</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>103</td>
                            <td><a href="#" class="text-primary">#05: Ứng dụng AI trong Fintech</a><br><small>(ID: 05)</small></td>
                            <td><span class="fw-bold text-muted">Khách vãng lai</span><br><small>(ID: null)</small></td>
                            <td style="max-width: 350px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                Cần bán hàng chính hãng, giá cực sốc. Truy cập website xxx.
                            </td>
                            <td>21/11/2025</td>
                            <td><span class="badge bg-label-danger me-1">Đã từ chối/Spam</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-success" href="admin.php?page=comment&action=approve&id=103"><i class="bx bx-check me-1"></i> Duyệt lại</a>
                                        <a class="dropdown-item text-danger" href="admin.php?page=comment&action=delete_permanently&id=103"><i class="bx bx-trash me-1"></i> Xóa vĩnh viễn</a>
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