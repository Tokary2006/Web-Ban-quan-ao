<?php
require_once "Models/BlogsCommentModel.php";
require_once "Models/BlogModel.php";

class CommentBlogController
{
    private $_commentModel;
    private $_blogModel;

    public function __construct($connection)
    {
        $this->_commentModel = new BlogsCommentModel($connection);
        $this->_blogModel = new BlogModel($connection);
    }

    public function store()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: ?page=login");
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $slug = $_POST['slug'] ?? '';
        $content = trim($_POST['content'] ?? '');

        if ($content === '') {
            $_SESSION['error'] = "Bình luận không được để trống";
            header("Location: ?page=blog-single&slug=$slug");
            exit;
        }

        $blog = $this->_blogModel->getBySlug($slug);
        if (!$blog) {
            $_SESSION['error'] = "Bài viết không tồn tại";
            header("Location: ?page=blog");
            exit;
        }

        $this->_commentModel->insert([
            ':blog_id' => $blog['id'],
            ':user_id' => $user_id,
            ':content' => $content
        ]);

        header("Location: ?page=blog-single&slug=$slug");
        exit;
    }

    public function delete()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: ?page=login");
            exit;
        }

        $id = (int) ($_GET['id'] ?? 0);
        $slug = $_GET['slug'] ?? '';

        $comment = $this->_commentModel->getById($id);
        if (!$comment) {
            $_SESSION['error'] = "Comment không tồn tại";
            header("Location: ?page=blog-single&slug=$slug");
            exit;
        }

        // Chỉ xóa comment của chính user
        if ($comment['user_id'] != $_SESSION['user']['id']) {
            $_SESSION['error'] = "Bạn không có quyền xóa comment này";
            header("Location: ?page=blog-single&slug=$slug");
            exit;
        }

        $this->_commentModel->delete($id);
        header("Location: ?page=blog-single&slug=$slug");
        exit;
    }
}

