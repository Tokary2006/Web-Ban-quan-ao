<!-- BLOG DETAIL -->
<div class="site-section bg-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mb-5">
        <div class="bg-white p-4 rounded shadow-sm">
          <h2 class="mb-3"><?= $blog['title'] ?></h2>
          <p class="text-muted mb-4">Đăng ngày <?= $blog['created_at'] ?> — Bởi Admin</p>
          <p><?= $blog['meta_description'] ?></p>
          <blockquote class="blockquote border-left pl-3">
          </blockquote>
          <p><?= $blog['content'] ?></p>
          <img src="Uploads/Blog/<?= $blog['image'] ?>" alt="Blog" class="img-fluid mb-4 rounded">
        </div>

        <div class="bg-white p-4 mt-5 rounded shadow-sm">
          <div class="comment-section mt-5 p-4" style="border-radius: 12px;">
            <h3 class="mb-4"
              style="font-family: 'Playfair Display', serif; border-bottom: 2px solid #000000ff; padding-bottom: 8px;">
              Bình luận
            </h3>

            <?php if (isset($_SESSION['user'])): ?>
              <form method="POST" action="?page=commentBlog">
                <input type="hidden" name="slug" value="<?= htmlspecialchars($blog['slug']) ?>">
                <div style="display: flex; gap: 10px; align-items: flex-start;">
                  <img src="Uploads/Users/<?= $_SESSION['user']['image'] ?? 'https://cdn2.fptshop.com.vn/small/avatar_trang_1_cd729c335b.jpg' ?>" alt="Avatar"
                    style="width: 45px; height: 45px; border-radius: 50%;">
                  <textarea name="content" class="form-control" placeholder="Hãy chia sẻ cảm nghĩ của bạn..." rows="3"
                    required></textarea>
                </div>
                <div class="text-end mt-2">
                  <button type="submit" class="btn">Gửi</button>
                </div>
              </form>

            <?php else: ?>
              <p class="text-white">
                Vui lòng <a href="index.php?page=login">đăng nhập</a> để bình luận
              </p>
            <?php endif; ?>


            <!-- Danh sách bình luận -->
            <div class="comment-list mt-4">
              <?php if (empty($comments)): ?>
                <p class="text-white">Chưa có bình luận nào.</p>
              <?php else: ?>
                <?php foreach ($comments as $cmt): ?>
                  <div class="comment-item p-3 mb-3" style="border-radius:10px;display:flex;gap:10px;">

                    <img
                      src="Uploads/User/<?= htmlspecialchars($cmt['avatar'] ?? 'https://cdn2.fptshop.com.vn/small/avatar_trang_1_cd729c335b.jpg') ?>"
                      style="width:40px;height:40px;border-radius:50%;">


                    <div style="flex:1;">
                      <div style="display:flex;justify-content:space-between;">
                        <strong>
                          <?= htmlspecialchars($cmt['full_name']) ?>
                        </strong>
                        <small style="color:#888;">
                          <?= $cmt['created_at'] ?>
                        </small>
                      </div>

                      <p style=";margin:5px 0;">
                        <?= nl2br(htmlspecialchars($cmt['content'])) ?>
                      </p>

                      <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $cmt['user_id']): ?>
                        <a href="index.php?page=delete-comment&id=<?= $cmt['id'] ?>&slug=<?= $blog['slug'] ?>"
                          onclick="return confirm('Xóa bình luận này?')">Xóa</a>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>

            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="p-4 mb-3 bg-white rounded shadow-sm">
          <h3 class="h5 text-black mb-3">Bài viết nổi bật</h3>
          <ul class="list-unstyled">
             <?php foreach($blogs as $item): ?>
            <li><a href="?page=blog-single&slug=<?= $item['slug'] ?>"><?= $item['title'] ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>