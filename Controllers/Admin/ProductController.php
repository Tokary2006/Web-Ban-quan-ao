<?php
require_once 'Models/ProductModel.php';

class ProductController
{
    private $productModel;

    public function __construct($connection)
    {
        $this->productModel = new ProductModel($connection);
    }

    // =============================
    // LIST
    // =============================
    public function index()
    {
        $products = $this->productModel->getAllProducts();
        require "Views/Admin/Product/index.php";
    }

    // =============================
    // CREATE
    // =============================
    public function create()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Validate
            if (empty($_POST['title'])) $errors['title'] = "Tên sản phẩm không được để trống";
            if (empty($_POST['description'])) $errors['description'] = "Mô tả không được để trống";
            if (empty($_POST['short_description'])) $errors['short_description'] = "Mô tả ngắn không được để trống";
            if (!isset($_POST['category_id']) || $_POST['category_id'] == '') {
                $errors['category_id'] = "Danh mục không được để trống";
            }

            // Giá
            if (!isset($_POST['price']) || $_POST['price'] === '') {
                $errors['price'] = "Giá không được để trống";
            } elseif (!is_numeric($_POST['price']) || $_POST['price'] < 0) {
                $errors['price'] = "Giá phải >= 0";
            }

            // Trạng thái
            if (!isset($_POST['status'])) {
                $errors['status'] = "Trạng thái không được để trống";
            }

            // Trùng tên
            if (!empty($_POST['title']) && $this->productModel->checkDuplicateTitle($_POST['title'])) {
                $errors['title'] = "Tên sản phẩm đã tồn tại";
            }

            // Không lỗi → lưu
            if (empty($errors)) {

                // Upload ảnh
                $image = "khong_co_hinh_anh"; // default nếu không upload

                if (!empty($_FILES['image']['name'])) {
                    $image = time() . "_" . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/products/" . $image);
                }

                $data = [
                    ':category_id' => $_POST['category_id'],
                    ':title' => $_POST['title'],
                    ':price' => $_POST['price'],
                    ':short_description' => $_POST['short_description'],
                    ':description' => $_POST['description'],
                    ':image' => $image,
                    ':status' => $_POST['status']
                ];

                $this->productModel->create($data);
                header("Location: admin.php?page=product");
                exit;
            }
        }

        $categories = $this->productModel->getAllCategories();
        require "Views/Admin/Product/create.php";
    }

    // =============================
    // EDIT
    // =============================
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id_update = $_POST['id'] ?? null;

            // Validate
            if (empty($_POST['title'])) $errors['title'] = "Tên sản phẩm không được để trống";
            if (empty($_POST['description'])) $errors['description'] = "Mô tả không được để trống";
            if (empty($_POST['short_description'])) $errors['short_description'] = "Mô tả ngắn không được để trống";
            if (empty($_POST['category_id'])) $errors['category_id'] = "Danh mục không được để trống";

            if (!isset($_POST['price']) || $_POST['price'] === '') {
                $errors['price'] = "Giá không được để trống";
            } elseif (!is_numeric($_POST['price']) || $_POST['price'] < 0) {
                $errors['price'] = "Giá phải >= 0";
            }

            if (!isset($_POST['status'])) {
                $errors['status'] = "Trạng thái không được để trống";
            }

            // Trùng tên
            if (!empty($_POST['title']) && $this->productModel->checkDuplicateTitle($_POST['title'], $id_update)) {
                $errors['title'] = "Tên sản phẩm đã tồn tại";
            }

            // Không lỗi → update
            if (empty($errors)) {

                // Xử lý ảnh
                $image = $_POST['old_image'] ?? null;
                if (!empty($_FILES['image']['name'])) {
                    $image = time() . "_" . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/products/" . $image);
                }

                $data = [
                    ':category_id' => $_POST['category_id'],
                    ':title' => $_POST['title'],
                    ':price' => $_POST['price'],
                    ':short_description' => $_POST['short_description'],
                    ':description' => $_POST['description'],
                    ':image' => $image,
                    ':status' => $_POST['status'],
                    ':id' => $id_update
                ];

                $this->productModel->updateProduct($id_update, $data);

                header("Location: admin.php?page=product");
                exit;
            }
        }

        // GET
        if ($id) {
            $product = $this->productModel->getOne($id);
            $categories = $this->productModel->getAllCategories();

            if ($product) {
                require "Views/Admin/Product/edit.php";
                return;
            }
        }

        header("Location: admin.php?page=product");
        exit;
    }

    // =============================
    // DELETE
    // =============================
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->productModel->deleteProduct($id);
        }

        header("Location: admin.php?page=product");
        exit;
    }
}
