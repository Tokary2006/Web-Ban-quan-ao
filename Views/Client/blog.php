<!-- BLOG LIST -->
<div class="site-section bg-light">
  <div class="container">
    <div class="row mb-5 text-center">
      <div class="col-md-12">
        <h2 class="section-title mb-3">Tin tức & Bài viết mới nhất</h2>
      </div>
    </div>

    <div class="row">
      <?php foreach($blogs as $item): ?>
      <!-- Bài viết 1 -->
      <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up">
        <div class="block-4 h-100 d-flex flex-column text-center border">
          <figure class="block-4-image">
            <a href="index.php?page=blog-single&slug=<?= $item['slug'] ?>"><img src="Uploads/Blog/<?= $item['image'] ?>" alt="Xu hướng 2025" height="230px" width="340px" style="padding:10px" ></a>
          </figure>
          <div class="block-4-text p-4">
            <h3><a href="index.php?page=blog-single&slug=<?= $item['slug'] ?>"><?= $item['title'] ?></a></h3>
            <p class="text-muted small mb-2"><?= $item['created_at'] ?> - Bởi Admin</p>
            <p class="mb-0"><?= $item['meta_description'] ?>...</p>
            <a href="index.php?page=blog-single&slug=<?= $item['slug'] ?>" class="text-primary font-weight-bold d-block mt-2">Đọc thêm →</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>