<?php
require_once "Models/ProductCommentModel.php";
require_once "Models/ProductModel.php";

class ProductsCommentController {
    private $productCommentModel;
    private $productModel;

    public function __construct($conn) {
        $this->productCommentModel = new ProductCommentModel($conn);
        $this->productModel = new ProductModel($conn);
    }

    // Hiển thị danh sách bình luận
    public function index() {
        $comments = $this->productCommentModel->getAll();
        require "Views/Admin/ProductsComment/index.php";
    }

    // Form sửa bình luận
    public function edit() {
        $id = $_GET['id'] ?? 0;
        $comment = $this->productCommentModel->getOne($id);
        require "Views/Admin/ProductsComment/edit.php";
    }

    // Cập nhật bình luận
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $data = ['content' => $_POST['content']];
            $this->productCommentModel->update($id, $data);
            header("Location: admin.php?page=productscomment&action=index");
        }
    }

    // Xóa bình luận
    public function delete() {  
        $id = $_GET['id'];
        $this->productCommentModel->delete($id);
        header("Location: admin.php?page=productscomment&action=index");
    }
}
?>
