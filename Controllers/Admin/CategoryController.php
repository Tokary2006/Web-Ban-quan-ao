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
            $status = $_POST['status'] ?? '';
            $parent_id = $_POST['parent_id'] ?? '';

            if ($parent_id === '') {
                $errors['parent_id'] = "Vui lòng chọn danh mục cha";
            }

            if ($parent_id === '' || $parent_id == 0) {
                $parent_id = null;
            }

            if ($name === '') {
                $errors['name'] = "Tên danh mục không được để trống";
            } elseif ($this->categoryModel->getCategoryByName($name)) {
                $errors['name'] = "Tên danh mục đã tồn tại";
            }

            if ($description === '') {
                $errors['description'] = "Mô tả không được để trống";
            }

            if ($status !== "1" && $status !== "0") {
                $errors['status'] = "Vui lòng chọn trạng thái hợp lệ";
            }

            if (!empty($errors)) {
                $old = [
                    'name' => $name,
                    'description' => $description,
                    'status' => $status,
                    'parent_id' => $parent_id
                ];
                $allCategories = $this->categoryModel->getAll();
                require "Views/Admin/Category/create.php";
                return;
            }

            if (empty($errors)) {
                $data = [
                    'parent_id' => $parent_id,
                    'name' => $name,
                    'description' => $description,
                    'status' => $status
                ];

                $this->categoryModel->create($data);

                $_SESSION['success'] = "Thêm danh mục thành công";

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
            $status = $_POST['status'] ?? 1;
            $parent_id = $_POST['parent_id'] ?? null;

            if ($parent_id === '') {
                $parent_id = null;
            }

            if ($name === '') {
                $errors['name'] = "Tên danh mục không được để trống";
            } elseif (!empty($id)) {
                if ($this->categoryModel->getCategoryByName($name, $id)) {
                    $errors['name'] = "Tên danh mục đã tồn tại";
                }
            }

            if ($description === '') {
                $errors['description'] = "Mô tả không được để trống";
            }

            if ($parent_id == $id) {
                $errors['parent_id'] = "Danh mục cha không hợp lệ";
            }

            if (empty($errors)) {
                $data = [
                    'parent_id' => $parent_id,
                    'name' => $name,
                    'description' => $description,
                    'status' => $status
                ];

                $this->categoryModel->update($id, $data);

                $_SESSION['success'] = "Cập nhật danh mục thành công";

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
            $result = $this->categoryModel->deleteWithChild($id);

            if ($result) {
                $_SESSION['success'] = "Xóa danh mục thành công";
            } else {
                $_SESSION['error'] = "Không thể xóa danh mục vì đang có sản phẩm liên kết";
            }
        } else {
            $_SESSION['error'] = "Danh mục không tồn tại";
        }

        header("Location: admin.php?page=category");
        exit;
    }

}
