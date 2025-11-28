<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ Sơ Người Dùng - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    a {
        text-decoration: none !important;
    }
    </style>
</head>


<div class="container py-5">
    <h2 class="mb-4 fw-bold">Hồ Sơ Của Tôi</h2>

    <div class="row">

        <div class="col-lg-4 col-md-12">
            
            <div class="card mb-4" style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
                <div class="card-body text-center">
                    <img 
                        src="https://via.placeholder.com/100/7E57C2/FFFFFF?text=JD" 
                        alt="Avatar" 
                        class="rounded-circle mb-3"
                        style="width: 100px; height: 100px; object-fit: cover; border: 4px solid #7E57C2;"
                    >
                    <h5 class="my-3 fw-bold">ADMIN GB</h5>
                    <p class="text-muted mb-1">Quản trị viên hệ thống</p>
                    
                    <div class="d-flex justify-content-center mb-3">
                        <span class="badge rounded-pill" style="background-color: #ede7f6; color: #7E57C2;">
                            <i class="bi bi-check-circle-fill me-1"></i> Đã xác minh
                        </span>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="button" class="btn btn-primary" style="background-color: #7E57C2 !important; border-color: #7E57C2 !important;">
                            <i class="bi bi-pencil-square me-1"></i> Chỉnh sửa Hồ sơ
                        </button>
                    </div>
                </div>
            </div>

            <div class="card mb-4" style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
                <div class="card-header bg-white fw-bold">
                    Tùy Chọn Tài Khoản
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <i class="bi bi-key-fill me-2 text-muted"></i> Đổi Mật Khẩu
                        <a href="#" class="btn btn-sm btn-outline-secondary">Thay đổi</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <i class="bi bi-shield-lock-fill me-2 text-muted"></i> Mở/khóa tài khoản
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked style="background-color: #7E57C2 !important; border-color: #7E57C2 !important;">
                        </div>
                    </li>
                    <li class="list-group-item text-danger fw-bold d-flex align-items-center">
                        <i class="bi bi-box-arrow-right me-2"></i> Đăng Xuất
                    </li>
                </ul>
            </div>
            
        </div>
        <div class="col-lg-8 col-md-12">

            <div class="card mb-4" style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">Thông Tin Chi Tiết & Liên Hệ</h5>
                    <form>
                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-3"><label class="form-label fw-medium"><i class="bi bi-envelope-fill me-1"></i> Email</label></div>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" value="john.doe@admin.com" disabled>
                            </div>
                        </div>
                        
                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-3"><label for="phone" class="form-label fw-medium"><i class="bi bi-phone-fill me-1"></i> Số điện thoại</label></div>
                            <div class="col-sm-9">
                                <input type="text" id="phone" class="form-control" value="+84 987 654 321">
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-3"><label for="address" class="form-label fw-medium"><i class="bi bi-house-door-fill me-1"></i> Địa chỉ</label></div>
                            <div class="col-sm-9">
                                <input type="text" id="address" class="form-control" value="23 Phố Admin, Quận Dashboard, Hà Nội">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-outline-primary" style="color: #7E57C2 !important; border-color: #7E57C2 !important;">Lưu Thay Đổi</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card" style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
                <div class="card-header bg-white fw-bold">
                    Nhật Ký Hoạt Động Gần Đây
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center">
                            <span class="badge rounded-pill me-3 p-2" style="background-color: #7E57C2 !important;">
                                <i class="bi bi-bag-fill"></i>
                            </span>
                            Đã phê duyệt đơn hàng <strong>#ORD-12345</strong>
                            <small class="ms-auto text-muted">28/11/2025 - 08:15</small>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <span class="badge rounded-pill bg-success me-3 p-2">
                                <i class="bi bi-cloud-arrow-up-fill"></i>
                            </span>
                            Đã cập nhật <strong>15 sản phẩm</strong> mới
                            <small class="ms-auto text-muted">27/11/2025 - 16:30</small>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <span class="badge rounded-pill bg-info me-3 p-2">
                                <i class="bi bi-box-arrow-in-right"></i>
                            </span>
                            Đăng nhập thành công từ <strong>Chrome/Windows 11</strong>
                            <small class="ms-auto text-muted">27/11/2025 - 09:00</small>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>