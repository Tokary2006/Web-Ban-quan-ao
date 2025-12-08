<?php
require_once "Models/BlogsCommentModel.php";

class BlogsCommentController {

    public function index() {
        $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $conn = $db->connect();

        $commentModel = new BlogsCommentModel($conn);
        $comments = $commentModel->getAll();

        require "Views/Admin/BlogsComment/index.php";
    }

    public function edit() {
        $id = $_GET['id'];

        $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $conn = $db->connect();

        $model = new BlogsCommentModel($conn);

        $comment = $model->getById($id);
        $blog = $model->getBlog($comment['blog_id']);
        $user = $model->getUser($comment['user_id']);

        require "Views/Admin/BlogsComment/edit.php";
    }

    public function update() {
        $id = $_POST['id'];
        $content = $_POST['content_text'];
        $status = $_POST['status_enum'];

        $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $conn = $db->connect();

        $model = new BlogsCommentModel($conn);
        $model->update($id, $content, $status);

        header("Location: admin.php?page=blogscomment&action=index");
    }

    public function delete() {
        $id = $_GET['id'];

        $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $conn = $db->connect();

        $model = new BlogsCommentModel($conn);
        $model->delete($id);

        header("Location: admin.php?page=blogscomment&action=index");
    }
}
