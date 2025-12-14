<?php
require_once "Models/BlogsCommentModel.php";

class BlogsCommentController {

    // LIST
    public function index() {
        $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $conn = $db->connect();

        $model = new BlogsCommentModel($conn);
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

        $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $conn = $db->connect();
        $model = new BlogsCommentModel($conn);

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

        $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $conn = $db->connect();
        $model = new BlogsCommentModel($conn);

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

        $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $conn = $db->connect();
        $model = new BlogsCommentModel($conn);

        $model->delete($_GET['id']);

        header("Location: admin.php?page=blogscomment");
        exit;
    }
}
