<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Quản lý Đơn hàng /</span> Tạo Đơn Hàng Mới</h4>

        <form action="process_create_order.php" method="POST">

            <div class="card mb-4">
                <h5 class="card-header">1. Thông Tin Khách Hàng & Giao Nhận</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="customer_name" class="form-label">Tên Khách Hàng (*)</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" required placeholder="Nhập tên của khách hàng">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Số Điện Thoại (*)</label>
                            <input type="text" class="form-control" id="phone" name="phone" required placeholder="Nhập số điện thoại">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Địa Chỉ Giao Hàng Chi Tiết (*)</label>
                        <textarea class="form-control" id="address" name="address" rows="2" required placeholder="Nhập Số nhà, đường, Phường/Xã, Quận/Huyện, Tỉnh/Thành phố..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="payment_method" class="form-label">Phương Thức Thanh Toán (*)</label>
                            <select class="form-select" id="payment_method" name="payment_method" required>
                                <option value="COD" selected>COD (Thanh toán khi nhận hàng)</option>
                                <option value="BANK">Chuyển khoản Ngân hàng</option>
                                <option value="MOMO">Ví điện tử Momo/ZaloPay</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="order_notes" class="form-label">Ghi Chú Đơn Hàng</label>
                            <input type="text" class="form-control" id="order_notes" name="order_notes" placeholder="Nhập ghi chú của khách hàng">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <h5 class="card-header">2. Thêm Sản Phẩm vào Đơn Hàng</h5>
                <div class="card-body">
                    
                    <div class="row g-3 align-items-end mb-4 p-3 border rounded">
                        <div class="col-md-6">
                            <label for="product_search" class="form-label">Tìm kiếm Sản phẩm</label>
                            <input type="text" class="form-control" id="product_search" placeholder="Nhập tên hoặc mã sản phẩm...">
                        </div>
                        <div class="col-md-2">
                            <label for="product_qty" class="form-label">Số Lượng</label>
                            <input type="number" class="form-control" id="product_qty" value="1" min="1">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Đơn Giá</label>
                            <p class="form-control-static fw-bold text-danger" id="product_price">0 đ</p>
                        </div>
                        <div class="col-md-2 d-grid">
                            <button type="button" class="btn btn-success" id="add_item_btn">
                                <i class="bx bx-plus me-1"></i> Thêm SP
                            </button>
                        </div>
                    </div>

                    <h6>Danh sách sản phẩm đã thêm:</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody id="order_items_list">
                                <tr data-item-id="1">
                                    <td>1</td>
                                    <td>Áo Thun Cotton Xanh</td>
                                    <td>90.000 đ</td>
                                    <td>
                                        <input type="number" name="items[1][qty]" value="2" min="1" class="form-control form-control-sm text-center w-50 d-inline">
                                    </td>
                                    <td>180.000 đ</td>
                                    <td><button type="button" class="btn btn-sm btn-outline-danger">Xóa</button></td>
                                </tr>
                                <tr data-item-id="2">
                                    <td>2</td>
                                    <td>Quần Jean Slim Fit Đen</td>
                                    <td>350.000 đ</td>
                                    <td>
                                        <input type="number" name="items[2][qty]" value="1" min="1" class="form-control form-control-sm text-center w-50 d-inline">
                                    </td>
                                    <td>350.000 đ</td>
                                    <td><button type="button" class="btn btn-sm btn-outline-danger">Xóa</button></td>
                                </tr>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <h5 class="card-header">3. Tổng Kết Đơn Hàng</h5>
                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="col-md-6 col-lg-4">
                            <div class="list-group">
                                <div class="list-group-item d-flex justify-content-between">
                                    <span>Tổng Phụ (Subtotal):</span>
                                    <span class="fw-bold" id="subtotal">530.000 đ</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between">
                                    <label for="shipping_fee" class="form-label m-0">Phí Vận Chuyển:</label>
                                    <input type="number" id="shipping_fee" name="shipping_fee" class="form-control w-50 text-end" value="30000">
                                </div>
                                <div class="list-group-item d-flex justify-content-between bg-light fw-bold fs-5 text-success">
                                    <span>TỔNG CỘNG:</span>
                                    <span id="grand_total">560.000 đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary btn-lg me-2">Tạo Đơn Hàng</button>
                <a href="admin.php?page=order&action=index" class="btn btn-secondary btn-lg">Hủy</a>
            </div>
        </form>
        </div>
</div>