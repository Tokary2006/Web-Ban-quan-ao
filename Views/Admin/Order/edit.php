<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Quản lý Đơn hàng /</span> Chi tiết Đơn hàng #DH20251122-0001
        </h4>

        <div class="row mb-4">
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card h-100">
                    <h5 class="card-header">Thông Tin Đơn Hàng</h5>
                    <div class="card-body">
                        <p><strong>Mã Đơn Hàng:</strong> DH20251122-0001</p>
                        <p><strong>Ngày Đặt:</strong> 22/11/2025 10:30 AM</p>
                        <p><strong>Khách Hàng:</strong> Nguyễn Văn A (ID: 25)</p>
                        <p><strong>Ghi Chú:</strong> Giao hàng vào buổi chiều.</p>
                        <hr>
                        
                        <form action="process_update_status.php" method="POST">
                            <input type="hidden" name="order_id" value="DH20251122-0001">

                            <div class="mb-3">
                                <label for="update_status" class="form-label fw-bold">Trạng Thái Hiện Tại:</label>
                                <select id="update_status" name="order_status" class="form-select">
                                    <option value="0">0 - Chờ xác nhận</option>
                                    <option value="1">1 - Đang xử lý</option>
                                    <option value="2" selected>2 - Đang giao hàng</option>
                                    <option value="3">3 - Đã hoàn thành</option>
                                    <option value="4">4 - Đã hủy</option>
                                </select>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Lưu Trạng Thái Mới</button>
                            </div>
                        </form>
                        </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card h-100">
                    <h5 class="card-header">Thông Tin Giao Nhận & Thanh Toán</h5>
                    <div class="card-body">
                        <p><strong>Người Nhận:</strong> Trần Thị B</p>
                        <p><strong>Số Điện Thoại:</strong> 0901 234 567</p>
                        <p><strong>Địa Chỉ Giao:</strong> Số 123, đường ABC, P. Ninh Kiều, Cần Thơ</p>
                        <hr>
                        <p><strong>Phương Thức TT:</strong> COD (Thanh toán khi nhận hàng)</p>
                        <p><strong>Trạng Thái TT:</strong> <span class="badge bg-label-success">Đã Thanh Toán</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <h5 class="card-header">Danh Sách Sản Phẩm (Order Items)</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Mã SP</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Áo thun cotton</strong></td>
                            <td>TS001</td>
                            <td>75.000 đ</td>
                            <td>1</td>
                            <td>75.000 đ</td>
                        </tr>
                        <tr>
                            <td><i class="fab fa-react fa-lg text-info me-3"></i> <strong>Quần Jean Slim Fit</strong></td>
                            <td>JEANS05</td>
                            <td>375.000 đ</td>
                            <td>2</td>
                            <td>750.000 đ</td>
                        </tr>
                        <tr>
                            <td><i class="fab fa-vuejs fa-lg text-success me-3"></i> Áo khoác dù</td>
                            <td>JKT003</td>
                            <td>250.000 đ</td>
                            <td>1</td>
                            <td>250.000 đ</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Tổng phụ (Subtotal):</td>
                            <td class="fw-bold">1.075.000 đ</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Phí vận chuyển:</td>
                            <td class="fw-bold">30.000 đ</td>
                        </tr>
                        <tr class="bg-light">
                            <td colspan="4" class="text-end fw-bold fs-5">TỔNG CỘNG:</td>
                            <td class="fw-bold fs-5 text-success">1.105.000 đ</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        
        <div class="mt-4">
            <a href="javascript:history.back()" class="btn btn-secondary">Quay lại danh sách</a>
            <button type="button" class="btn btn-info">Cập nhật trạng thái</button>
        </div>

    </div>
</div>