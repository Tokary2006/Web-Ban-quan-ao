<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Quản lý Bình luận /</span> Chi tiết & Sửa Bình luận #102
        </h4>

        <div class="card mb-4">
            <h5 class="card-header">Thông Tin Chi Tiết và Cập Nhật</h5>
            <div class="card-body">
                <form action="process_edit_comment.php" method="POST">
                    <input type="hidden" name="comment_id" value="102">

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Bài Viết Liên Quan (Blog ID)</label>
                            <p class="form-control-static">
                                <a href="#" class="text-primary fw-bold">#42: Cải tiến hiệu năng SQL</a> (ID: 42)
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tác Giả (User ID)</label>
                            <p class="form-control-static">
                                Trần Thị B (ID: 48) - <small>tranthib@email.com</small>
                            </p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="comment_content" class="form-label fw-bold">Nội Dung Bình Luận (*)</label>
                        <textarea class="form-control" id="comment_content" name="comment_content" rows="6" required>Admin cần xem xét: Bình luận này có chứa liên kết ngoài không liên quan. Nội dung gốc là "Bài viết rất hay, xem thêm giải pháp SEO tại link này: http://spam.com"</textarea>
                        <small class="form-text text-muted">Có thể chỉnh sửa nội dung nếu cần thiết.</small>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="comment_status" class="form-label fw-bold">Cập Nhật Trạng Thái (*)</label>
                            <select class="form-select" id="comment_status" name="comment_status" required>
                                <option value="0">0 - Chờ duyệt</option>
                                <option value="1" selected>1 - Đã duyệt</option>
                                <option value="2">2 - Đã từ chối (Spam/Không phù hợp)</option>
                            </select>
                            <small class="form-text text-muted">Trạng thái hiện tại: Đã duyệt.</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Ngày Bình Luận</label>
                            <p class="form-control-static">22/11/2025 15:45:00</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">Lưu Thay Đổi</button>
                        <a href="admin.php?page=blogs&action=index" class="btn btn-secondary">Hủy / Quay lại</a>
                        <button type="button" class="btn btn-danger float-end">Xóa Bình Luận</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>