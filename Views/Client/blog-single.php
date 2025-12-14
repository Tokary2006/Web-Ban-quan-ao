

      <!-- BLOG DETAIL -->
      <div class="site-section bg-light">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mb-5">
              <div class="bg-white p-4 rounded shadow-sm">
                <h2 class="mb-3"><?= $blog['title'] ?></h2>
                <p class="text-muted mb-4">Đăng ngày <?= $blog['created_at'] ?> — Bởi Admin</p>
                <p><?=$blog['meta_description'] ?></p>
                <blockquote class="blockquote border-left pl-3">
                </blockquote>
                <p><?= $blog['content'] ?></p>
                <img src="Uploads/Blog/<?= $blog['image'] ?>" alt="Blog" class="img-fluid mb-4 rounded">  
              </div>

              <div class="bg-white p-4 mt-5 rounded shadow-sm">
                <h4 class="mb-4">Bình luận</h4>
                <form>
                  <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input type="text" class="form-control" id="name" required>
                  </div>
                  <div class="form-group">
                    <label for="message">Nội dung</label>
                    <textarea id="message" class="form-control" rows="4" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                </form>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="p-4 mb-3 bg-white rounded shadow-sm">
                <h3 class="h5 text-black mb-3">Bài viết nổi bật</h3>
                <ul class="list-unstyled">
                  <li><a href="blog-single.html">Cách phối đồ thông minh</a></li>
                  <li><a href="blog-single.html">Công nghệ trong ngành thời trang</a></li>
                  <li><a href="blog-single.html">Thời trang bền vững</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

    