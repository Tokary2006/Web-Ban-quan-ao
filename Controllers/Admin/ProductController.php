<?php
require_once 'Models/ProductModel.php';

class ProductController {

    private $productModel;

    public function __construct($connection) {
        $this->productModel = new productModel($connection);
    }

    // ===============================
    // LIST
    // ===============================
    public function index() {
        $products = $this->productModel->getAllProducts();
        require "Views/Admin/Product/index.php";
    }

    // ===============================
    // CREATE (GET + POST chung)
    // ===============================
    public function create() {

        // Nếu POST → lưu sản phẩm
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $image = null;
            if (!empty($_FILES['image']['name'])) {
                $image = time() . "_" . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], "uploads/products/" . $image);
            }
    
            $data = [
                'category_id' => $_POST['category_id'] ?? null,
                'title' => $_POST['title'] ?? '',
                'slug' => $_POST['slug'] ?? '',
                'price' => $_POST['price'] ?? 0,
                'short_description' => $_POST['short_description'] ?? '',
                'description' => $_POST['description'] ?? '',
                'image' => $image,
                'status' => $_POST['status'] ?? 1
            ];
    
            $this->productModel->create($data);
            header("Location: admin.php?page=product");
            exit;
        }
    
        // GET → load danh mục
        $categories = $this->productModel->getAllCategories();
    
        require "Views/Admin/Product/create.php";
    }
    

    // ===============================
    // EDIT (GET + POST chung)
    // ===============================
    public function edit() {
        $id = $_GET['id'] ?? null;
    
        // POST → Cập nhật sản phẩm
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $id_update = $_POST['id'] ?? null;
    
            if ($id_update) {
    
                // xử lý ảnh
                $image = $_POST['old_image'] ?? null;
                if (!empty($_FILES['image']['name'])) {
                    $image = time() . "_" . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/products/" . $image);
                }
    
                // gom dữ liệu update
                $data = [
                    'category_id' => $_POST['category_id'],
                    'title' => $_POST['title'],
                    'slug' => $_POST['slug'],
                    'price' => $_POST['price'],
                    'short_description' => $_POST['short_description'],
                    'description' => $_POST['description'],
                    'image' => $image,
                    'status' => $_POST['status']
                ];
    
                // THÊM ID VÀO DATA
                $data['id'] = $id_update;
    
                // Gọi update model
                $this->productModel->updateProduct($id_update, $data);
            }
    
            header("Location: admin.php?page=product");
            exit;
        }
    
        // GET → Hiển thị form edit
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
    // ===============================
// DELETE
// ===============================
public function delete() {
    $id = $_GET['id'] ?? null;

    if ($id) {
        // Gọi model xoá
        $this->productModel->deleteProduct($id);
    }

    header("Location: admin.php?page=product");
    exit;
}

}
