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
        require "Views/Admin/Blog/create.php";
    }

    // Lưu blog

public function store() {
    $data = [
        "user_id" => $_POST["user_id"] ?? 1,
        "slug" => $_POST["slug"] ?? '',
        "title" => $_POST["title"] ?? '',
        "content_text" => $_POST["content_text"] ?? '',
        "images" => $_POST["images"] ?? '',
        "meta_keywords" => $_POST["meta_keywords"] ?? '',
        "meta_description" => $_POST["meta_description"] ?? '',
        "status_enum" => $_POST["status_enum"] ?? 0,
    ];

    $this->model->create($data);

    // Chuyển về danh sách
    header("Location: admin.php?page=blog&action=index");
    exit;
}


    // Form sửa
    public function edit() {
        $id = $_GET["id"];
        $blog = $this->model->getById($id);
        require "Views/Admin/Blog/edit.php";
    }

    // Update
    public function update() {
        $id = $_POST["id"];

        $data = [
            "slug" => $_POST["slug"],
            "title" => $_POST["title"],
            "content_text" => $_POST["content_text"],
            "images" => $_POST["images"],
            "meta_keywords" => $_POST["meta_keywords"],
            "meta_description" => $_POST["meta_description"],
            "status_enum" => $_POST["status_enum"],
        ];

        $this->model->update($id, $data);
        header("Location: admin.php?page=blog&action=index");
    }

    // Xóa
public function delete() {
    $id = $_GET['id'] ?? null;
    if ($id) {
        $this->model->delete($id);
    }
    header("Location: admin.php?page=blog&action=index");
    exit();
}

}
