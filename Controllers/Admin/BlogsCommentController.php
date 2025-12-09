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
        session_start();

        $id = $_GET['id'];

        $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $conn = $db->connect();
        $model = new BlogsCommentModel($conn);

        $comment = $model->getById($id);

        // Trường hợp không tìm thấy ID
        if (!$comment) {
            $_SESSION['errors'] = ["not_found" => "Không tìm thấy bình luận!"];
            header("Location: admin.php?page=blogscomment&action=index");
            exit;
        }

        $blog = $model->getBlog($comment['blog_id']);
        $user = $model->getUser($comment['user_id']);

        require "Views/Admin/BlogsComment/edit.php";
    }

    public function update() {
        session_start();

        $id = $_POST['id'] ?? null;
        $content = trim($_POST['content_text'] ?? '');
        $status = $_POST['status_enum'] ?? null;

        $errors = [];
        $old = $_POST;

        // Validate ID
        if (!$id) {
            $errors['id'] = "ID không hợp lệ!";
        }

        // Validate content
        if (empty($content)) {
            $errors['content_text'] = "Vui lòng nhập nội dung bình luận!";
        }

        // Validate status
        if ($status !== "0" && $status !== "1") {
            $errors['status_enum'] = "Trạng thái không hợp lệ!";
        }

        // Nếu lỗi → quay lại form
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_data'] = $old;

            header("Location: admin.php?page=blogscomment&action=edit&id=" . $id);
            exit;
        }

        // UPDATE DB
        $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $conn = $db->connect();
        $model = new BlogsCommentModel($conn);

        $model->update($id, $content, $status);

        header("Location: admin.php?page=blogscomment&action=index");
        exit;
    }

    public function delete() {
        $id = $_GET['id'];

        $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $conn = $db->connect();
        $model = new BlogsCommentModel($conn);

        $model->delete($id);

        header("Location: admin.php?page=blogscomment&action=index");
        exit();
    }
}
