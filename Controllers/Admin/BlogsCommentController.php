<?php
require_once "Models/BlogsCommentModel.php";
class BlogsCommentController {
    private $conn; 

    public function __construct($connection) {
        $this->conn = $connection;
    }

    // LIST
    public function index() {
        $model = new BlogsCommentModel($this->conn);
        $comments = $model->getAll();
        require "Views/Admin/BlogsComment/index.php";
    }

    // EDIT
    public function edit() {
        if (!isset($_GET['id'])) {
            header("Location: admin.php?page=blogscomment");
            exit;
        }
        $id = $_GET['id'];
        $model = new BlogsCommentModel($this->conn);

        $comment = $model->getById($id);
        if (!$comment) {
            header("Location: admin.php?page=blogscomment");
            exit;
        }

        $blog = $model->getBlog($comment['blog_id']);
        $user = $model->getUser($comment['user_id']);

        require "Views/Admin/BlogsComment/edit.php";
    }

    // UPDATE
    public function update() {
        $id      = $_POST['id'] ?? null;
        $content = trim($_POST['content_text'] ?? '');
        $status  = $_POST['status'] ?? null;

        if (!$id || $content === '' || !in_array($status, ['0','1'])) {
            header("Location: admin.php?page=blogscomment&action=edit&id=".$id);
            exit;
        }

        $model = new BlogsCommentModel($this->conn);
        $model->update($id, $content, $status);

        header("Location: admin.php?page=blogscomment");
        exit;
    }

    // DELETE
    public function delete() {
        if (!isset($_GET['id'])) {
            header("Location: admin.php?page=blogscomment");
            exit;
        }

        $model = new BlogsCommentModel($this->conn);
        $model->delete($_GET['id']);

        header("Location: admin.php?page=blogscomment");
        exit;
    }
}
