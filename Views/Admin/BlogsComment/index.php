<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Quản lý /</span> Bình luận Bài viết</h4>
        
        <div class="card p-3">
            <h3 class="card-header">Danh sách Bình luận</h3>
            
            <div class="table-responsive ">
                <table class="table table-striped" id="commentTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Bài viết (Blog ID)</th>
                            <th>Tác giả (User ID)</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
             <tbody class="table-border-bottom-0">
<?php foreach ($comments as $c): ?>
    <tr>
        <!-- ID -->
        <td><?= $c['id'] ?></td>

        <!-- BLOG -->
        <td>
            <a href="#" class="text-primary">
                <?= htmlspecialchars($c['blog_title']) ?>   <!-- TÊN BÀI VIẾT -->
            </a><br>
            <small>(Blog ID: <?= $c['blog_id'] ?> - Created: <?= $c['created_at'] ?>)</small>
        </td>

        <!-- USER -->
        <td>
            <?php if ($c['user_id'] == null): ?>
                <span class="fw-bold text-muted">Khách vãng lai</span><br>
                <small>(ID: null)</small>
            <?php else: ?>
                <span class="fw-bold"><?= htmlspecialchars($c['username']) ?></span><br>
                <small>(User ID: <?= $c['user_id'] ?>)</small>
            <?php endif; ?>
        </td>

        <!-- STATUS -->
        <td>
            <?php if ($c['status_enum'] == '0'): ?>
                <span class="badge bg-label-success me-1">Hiển thị</span>
            <?php elseif ($c['status_enum'] == '1'): ?>
                <span class="badge bg-label-danger me-1">Đã Ẩn</span>
            <?php else: ?>
                <span class="badge bg-label-secondary me-1">Không rõ</span>
            <?php endif; ?>
        </td>

        <!-- ACTION -->
        <td>
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>

                <div class="dropdown-menu">
                    <a class="dropdown-item" 
                       href="admin.php?page=blogscomment&action=edit&id=<?= $c['id'] ?>">
                        <i class="bx bx-edit-alt me-1"></i> Xem / Sửa
                    </a>

                    <a class="dropdown-item text-danger" 
                       href="admin.php?page=blogscomment&action=delete&id=<?= $c['id'] ?>">
                        <i class="bx bx-trash me-1"></i> Xóa
                    </a>
                </div>
            </div>
        </td>
    </tr>
<?php endforeach; ?>
</tbody>


                </table>
            </div>
        </div>
    </div>
</div>