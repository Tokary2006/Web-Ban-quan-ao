<?php if (!isset($user) || !is_array($user))
    return; ?>

<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Khách hàng /</span> Hồ sơ người dùng
    </h4>

    <div class="row">
        <!-- Avatar -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="<?= !empty($user['image'])
                        ? 'Uploads/User/' . $user['image']
                        : 'https://cdn2.fptshop.com.vn/small/avatar_trang_1_cd729c335b.jpg' ?>"
                        class="rounded-circle mb-3" width="130" height="130" style="object-fit: cover" alt="Avatar">

                    <h5 class="mb-1"><?= $user['full_name'] ?></h5>

                    <span class="badge bg-label-<?= $user['role'] == 1 ? 'badge bg-dark' : 'badge bg-warning' ?>">
                        <?= $user['role'] == 1 ? 'QUẢN TRỊ VIÊN' : 'KHÁCH HÀNG' ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Thông tin -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Thông tin cá nhân</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="200">Tên khách hàng</th>
                            <td><?= $user['full_name'] ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= $user['email'] ?></td>
                        </tr>
                        <tr>
                            <th>Số điện thoại</th>
                            <td><?= $user['phone'] ?? 'Chưa cập nhật' ?></td>
                        </tr>
                        <tr>
                            <th>Địa chỉ</th>
                            <td><?= $user['address'] ?? 'Chưa cập nhật' ?></td>
                        </tr>
                        <tr>
                            <th>Vai trò</th>
                            <td>
                                <span class="badge bg-label-<?= $user['role'] == 1 ? 'badge bg-dark' : 'badge bg-warning' ?>">
                                    <?= $user['role'] == 1 ? 'Quản trị viên' : 'Khách hàng' ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td>
                                <form method="post" action="admin.php?page=user&action=profile&id=<?= $user['id'] ?>"
                                    class="d-flex gap-2">

                                    <select class="form-select w-auto" name="active">
                                        <option value="1" <?= $user['active'] == 1 ? 'selected' : '' ?>>
                                            Hoạt động
                                        </option>
                                        <option value="0" <?= $user['active'] == 0 ? 'selected' : '' ?>>
                                            Vô hiệu hóa
                                        </option>
                                    </select>

                                    <button type="submit" class="btn btn-primary btn-sm">
                                        Lưu
                                    </button>
                                </form>
                            </td>
                        </tr>

                    </table>

                    <div class="mt-3">
                        <a href="admin.php?page=user&action=index" class="btn btn-outline-secondary">
                            Quay lại
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>