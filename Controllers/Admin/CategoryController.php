<?php
require_once 'Models/CategoryModel.php';

class CategoryController
{
    private $categoryModel;

    public function __construct($connection)
    {
        $this->categoryModel = new CategoryModel($connection);
    }

    public function index()
    {
        $keyword = $_GET['keyword'] ?? '';
        $categories = $this->categoryModel->getAll($keyword);
        require "Views/Admin/Category/index.php";
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $slug = trim($_POST['slug'] ?? '');
            $status = $_POST['status'] ?? '';
            $parent_id = $_POST['parent_id'] ?? '';

            // Validate parent_id
            if ($parent_id === '') {
                $errors['parent_id'] = "Vui lòng chọn danh mục cha";
            }

            // Chuyển "" thành NULL để không lỗi SQL
            if ($parent_id === '' || $parent_id == 0) {
                $parent_id = null;
            }

            // Validate name
            if ($name === '') {
                $errors['name'] = "Tên danh mục không được để trống";
            } elseif ($this->categoryModel->loiTrung($name)) {
                $errors['name'] = "Tên danh mục đã tồn tại";
            }

            // Description
            if ($description === '') {
                $errors['description'] = "Mô tả không được để trống";
            }

            // Slug
            if ($slug === '') {
                $errors['slug'] = "Đường dẫn (slug) không được để trống";
            }

            // Status
            if ($status !== "1" && $status !== "0") {
                $errors['status'] = "Vui lòng chọn trạng thái hợp lệ";
            }

            // Nếu không có lỗi
            if (empty($errors)) {
                $data = [
                    'parent_id'  => $parent_id,
                    'name'       => $name,
                    'description'=> $description,
                    'slug'       => $slug,
                    'status'     => $status
                ];

                $this->categoryModel->create($data);
                header("Location: admin.php?page=category");
                exit;
            }

            $allCategories = $this->categoryModel->getAll();
            require "Views/Admin/Category/create.php";
            return;
        }

        $allCategories = $this->categoryModel->getAll();
        require "Views/Admin/Category/create.php";
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: admin.php?page=category");
            exit;
        }

        $category = $this->categoryModel->getOne($id);
        $category['parent_id'] = $category['parent_id'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $slug = trim($_POST['slug'] ?? '');
            $status = $_POST['status'] ?? 1;
            $parent_id = $_POST['parent_id'] ?? '';



            if ($name === '') {
                $errors['name'] = "Tên danh mục không được để trống";
            } elseif ($this->categoryModel->loiTrung($name, $id)) {
                $errors['name'] = "Tên danh mục đã tồn tại";
            }

            if ($description === '') {
                $errors['description'] = "Mô tả không được để trống";
            }

            if ($slug === '') {
                $errors['slug'] = "Đường dẫn (slug) không được để trống";
            }

            // Không cho chọn chính nó làm cha
            if ($parent_id == $id) {
                $errors['parent_id'] = "Danh mục cha không hợp lệ";
            }

            if (empty($errors)) {
                $data = [
                    'parent_id'  => $parent_id,
                    'name'       => $name,
                    'description'=> $description,
                    'slug'       => $slug,
                    'status'     => $status
                ];

                $this->categoryModel->update($id, $data);
                header("Location: admin.php?page=category");
                exit;
            }

            $allCategories = $this->categoryModel->getAll();
            require "Views/Admin/Category/edit.php";
            return;
        }

        $allCategories = $this->categoryModel->getAll();
        require "Views/Admin/Category/edit.php";
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->categoryModel->deleteWithChild($id);
        }
        header("Location: admin.php?page=category");
        exit;
    }
}
