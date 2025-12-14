<?php
require_once 'Models/CommentProductModel.php';

class CommentProductController
{
    private $commentModel;
    public function __construct($connection)
    {
        $this->commentModel = new CommentProductModel($connection);
    }

    public function addComment()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = 'Vui lòng đăng nhập để bình luận';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $productId = $_POST['product_id'];
        $content = trim($_POST['content']);
        $userId = $_SESSION['user']['id'];

        if (!$this->commentModel->hasPurchased($productId, $userId)) {
            $_SESSION['error'] = 'Bạn chỉ có thể bình luận sau khi đã mua sản phẩm';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        if ($content === '') {
            $_SESSION['error'] = 'Nội dung bình luận không được để trống';
        } else {
            $this->commentModel->insert($productId, $userId, $content);
            $_SESSION['success'] = 'Bình luận đang chờ duyệt';
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

}