<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Quản lý/</span> Đơn hàng</h4>
        <div class="card p-3">
            <h3 class="card-header">Danh sách đơn hàng</h3>
            <div class="table-responsive">
                <table class="table table-striped" id="orderTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Mã Đơn Hàng</th>
                            <th>Mã Khách Hàng</th>
                            <th>Tổng Tiền</th>
                            <th>PT Thanh Toán</th>
                            <th>Trạng Thái</th>
                            <th>Địa Chỉ Giao Hàng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 text-center">

                        <tr>
                            <td>1001</td>
                            <td><span class="fw-bold">DH20251122-0001</span></td>
                            <td>25</td>
                            <td><span class="text-success fw-bold">150.000đ</span></td>
                            <td>COD</td>
                            <td><span class="badge bg-label-success me-1">Đã hoàn thành</span></td>
                            <td>Số 123, Q. Ninh Kiều, Cần Thơ</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="admin.php?page=order&action=edit"><i
                                                class="bx bx-show me-1"></i> Chi tiết</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-trash me-1 btn-danger"></i> Xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>1002</td>
                            <td><span class="fw-bold">DH20251122-0002</span></td>
                            <td>48</td>
                            <td><span class="text-success fw-bold">450.500đ</span></td>
                            <td>bank</td>
                            <td><span class="badge bg-label-primary me-1">Đang xử lý</span></td>
                            <td>24/7, Q. 1, TP. Hồ Chí Minh</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="admin.php?page=order&action=view&id=1002"><i
                                                class="bx bx-show me-1"></i> Chi tiết</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-trash me-1 btn-danger"></i> Xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>1003</td>
                            <td><span class="fw-bold">DH20251123-0003</span></td>
                            <td>12</td>
                            <td><span class="text-success fw-bold">99.000đ</span> </td>
                            <td>bank</td>
                            <td><span class="badge bg-label-danger me-1">Đã hủy</span></td>
                            <td>200 Láng, Đống Đa, Hà Nội</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="admin.php?page=orders&action=view&id=1003"><i
                                                class="bx bx-show me-1"></i> Chi tiết</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-trash me-1 btn-danger"></i> Xóa</a>
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