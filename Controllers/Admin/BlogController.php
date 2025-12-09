<?php
require_once "Models/BlogModel.php";

class BlogController {
    private $model;

    public function __construct($connection) {
        $this->model = new BlogModel($connection);
    }

    // Trang admin blog list
    public function index() {
        $blogs = $this->model->getAll();
        require "Views/Admin/Blog/index.php";
    }

    // Form thêm
    public function create() {
        session_start();
        $users = $this->model->getUsers();
        require "Views/Admin/Blog/create.php";
    }

    // Lưu blog
    public function store() {
        session_start();

        $data = [
            "user_id" => $_POST["user_id"] ?? '',
            "slug" => $_POST["slug"] ?? '',
            "title" => $_POST["title"] ?? '',
            "content_text" => $_POST["content_text"] ?? '',
            "images" => $_POST["images"] ?? '',
            "meta_keywords" => $_POST["meta_keywords"] ?? '',
            "meta_description" => $_POST["meta_description"] ?? '',
            "status_enum" => $_POST["status_enum"] ?? '',
        ];

        $errors = [];

        // Validate
        if (empty($data["title"])) {
            $errors["title"] = "Tiêu đề không được để trống!";
        }

        if (empty($data["slug"])) {
            $errors["slug"] = "Slug không được để trống!";
        }

        if (empty($data["content_text"])) {
            $errors["content_text"] = "Nội dung bắt buộc!";
        }

        if (empty($data["user_id"])) {
            $errors["user_id"] = "Vui lòng chọn tác giả!";
        }

        if ($data["status_enum"] === "") {
            $errors["status_enum"] = "Vui lòng chọn trạng thái!";
        }

        // Nếu có lỗi → quay lại form
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_data'] = $data;
            header("Location: admin.php?page=blog&action=create");
            exit;
        }

        // Lưu blog
        $this->model->create($data);
        header("Location: admin.php?page=blog&action=index");
        exit;
    }

    // Form sửa
    public function edit() {
        $id = $_GET["id"];
        $blog = $this->model->getById($id);
        $users = $this->model->getUsers();
        require "Views/Admin/Blog/edit.php";
    }

    // Update blog
public function update() {
    session_start();

    $id = $_POST["id"];

    $data = [
        "user_id" => $_POST["user_id"] ?? '',
        "slug" => $_POST["slug"] ?? '',
        "title" => $_POST["title"] ?? '',
        "content_text" => $_POST["content_text"] ?? '',
        "images" => $_POST["images"] ?? '',
        "meta_keywords" => $_POST["meta_keywords"] ?? '',
        "meta_description" => $_POST["meta_description"] ?? '',
        "status_enum" => $_POST["status_enum"] ?? '',
    ];

    $errors = [];

    if (empty($data["title"])) $errors["title"] = "Tiêu đề không được để trống!";
    if (empty($data["slug"])) $errors["slug"] = "Slug không được để trống!";
    if (empty($data["content_text"])) $errors["content_text"] = "Nội dung bắt buộc!";
    if (empty($data["user_id"])) $errors["user_id"] = "Vui lòng chọn tác giả!";
    if ($data["status_enum"] === "") $errors["status_enum"] = "Vui lòng chọn trạng thái!";

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_data'] = $data;
        header("Location: admin.php?page=blog&action=edit&id=" . $id);
        exit;
    }

    $this->model->update($id, $data);

    header("Location: admin.php?page=blog&action=index");
    exit;
}


    // Xóa blog
    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->delete($id);
        }
        header("Location: admin.php?page=blog&action=index");
        exit();
    }
}
