<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tài khoản - Lịch sử mua hàng</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{ background:#f5f6fa; }
    .account-wrapper{ border-radius:12px; background:#fff; padding:24px; box-shadow:0 4px 12px rgba(0,0,0,.06); }
    .sidebar a.active{ background:#e9f0ff; border-radius:8px;}
    .avatar{ width:70px; height:70px; object-fit:cover; border-radius:50%;}
      a { text-decoration: none !important; }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="row g-4">

    <!-- Sidebar -->
    <aside class="col-lg-4">
      <div class="account-wrapper">
        <div class="d-flex align-items-center gap-3">
          <img src="https://placehold.co/150x150" alt="avatar" class="avatar">
          <div>
            <h6 class="mb-0">Nguyễn Văn A</h6>
            <small class="text-muted">nguyenvana@email.com</small>
          </div>
        </div>

        <hr>

     
        <ul class="nav flex-column sidebar">
          <a class="nav-link active" data-bs-toggle="tab" href="#acc">Thông tin tài khoản</a>
          <a class="nav-link" data-bs-toggle="tab" href="#orders">Lịch sử mua hàng</a>
          <a class="nav-link" data-bs-toggle="tab" href="#address">Địa chỉ giao hàng</a>
          <a class="nav-link text-danger">Đăng xuất</a>
        </ul>
      </div>
    </aside>

    <!-- Main -->
    <main class="col-lg-8">
      <div class="tab-content">

        <!-- Account tab -->
        <div id="acc" class="tab-pane fade show active">
          <div class="account-wrapper">
            <h5>Thông tin tài khoản</h5>
            <form class="row g-3 mt-2">
              <div class="col-md-6">
                <label class="form-label">Họ tên</label>
                <input class="form-control" value="Nguyễn Văn A">
              </div>
              <div class="col-md-6">
                <label class="form-label">SĐT</label>
                <input class="form-control" value="0901234567">
              </div>
              <div class="col-12">
                <label class="form-label">Email</label>
                <input class="form-control" value="email@email.com">
              </div>
              <div class="col-md-6">
                <label class="form-label">Mật khẩu mới</label>
                <input type="password" class="form-control">
              </div>
              <div class="col-12 text-end">
                <button class="btn btn-primary">Lưu thay đổi</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Orders -->
        <div id="orders" class="tab-pane fade">
          <div class="account-wrapper">
            <h5>Lịch sử mua hàng</h5>
            <table class="table table-hover mt-3">
              <thead class="table-light">
                <tr>
                  <th>Mã đơn</th>
                  <th>Ngày</th>
                  <th>Sản phẩm</th>
                  <th>Tổng tiền</th>
                  <th>Trạng thái</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>DH20251101</td>
                  <td>2025-11-01</td>
                  <td>Áo Polo</td>
                  <td>250.000₫</td>
                  <td><span class="badge bg-success">Đã giao</span></td>
                </tr>
                <tr>
                  <td>DH20251015</td>
                  <td>2025-10-15</td>
                  <td>Quần jean ×2</td>
                  <td>600.000₫</td>
                  <td><span class="badge bg-warning text-dark">Đang giao</span></td>
                </tr>
                <tr>
                  <td>DH20250820</td>
                  <td>2025-08-20</td>
                  <td>Giày thể thao</td>
                  <td>750.000₫</td>
                  <td><span class="badge bg-danger">Đã huỷ</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Address -->
        <div id="address" class="tab-pane fade">
          <div class="account-wrapper">
            <h5>Địa chỉ giao hàng</h5>
            <div class="border rounded p-3 mb-3">
              <div class="d-flex justify-content-between">
                <div>
                  <strong>Nhà riêng</strong>
                  <div class="small text-muted">123 Quận Cái Răng, Cần Thơ</div>
                </div>
                <div>
                  <button class="btn btn-sm btn-outline-secondary">Sửa</button>
                  <button class="btn btn-sm btn-danger">Xóa</button>
                </div>
              </div>
            </div>
            <button class="btn btn-primary btn-sm">Thêm địa chỉ</button>
          </div>
        </div>

      </div>
    </main>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>  