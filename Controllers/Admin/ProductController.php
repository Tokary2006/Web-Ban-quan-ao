<?php
require_once 'Models/ProductModel.php';

class ProductController
{
    private $productModel;

    public function __construct($connection)
    {
        $this->productModel = new ProductModel($connection);
    }

    // LIST PRODUCTS
    public function index()
    {
        $products = $this->productModel->getAllProducts();
        require "Views/Admin/Product/index.php";
    }

    // CREATE PRODUCT
public function create()
{
    if (session_status() === PHP_SESSION_NONE) session_start();

    $errors = [];
    $categories = $this->productModel->getAllCategories();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Validate
        if (empty($_POST['title'])) $errors['title'] = "Tên sản phẩm không được để trống";
        if (empty($_POST['description'])) $errors['description'] = "Mô tả không được để trống";
        if (empty($_POST['short_description'])) $errors['short_description'] = "Mô tả ngắn không được để trống";
        if (!isset($_POST['category_id']) || $_POST['category_id'] == '') $errors['category_id'] = "Danh mục không được để trống";
        if (!isset($_POST['featured_id'])) $errors['featured_id'] = "Trạng thái nổi bật không được để trống";

        $stock = isset($_POST['stock']) && $_POST['stock'] !== '' ? (int) $_POST['stock'] : 0;
        if ($stock < 0) $errors['stock'] = "Số lượng tồn kho phải >= 0";

        $price = isset($_POST['price']) && $_POST['price'] !== '' ? (float) $_POST['price'] : 0;
        if ($price < 0) $errors['price'] = "Giá phải >= 0";

        $discount_price = isset($_POST['discount_price']) && $_POST['discount_price'] !== '' ? (float) $_POST['discount_price'] : 0;
        if ($discount_price < 0) $errors['discount_price'] = "Giá giảm phải >= 0";

        // Slug
        $slug = !empty($_POST['slug']) ? $_POST['slug'] : $this->createSlug($_POST['title']);
        if ($this->productModel->checkDuplicateSlug($slug)) $errors['slug'] = "Slug đã tồn tại";

        // Kiểm tra trùng tên
        if (!empty($_POST['title']) && $this->productModel->checkDuplicateTitle($_POST['title'])) {
            $errors['title'] = "Tên sản phẩm đã tồn tại";
        }

        // Nếu không có lỗi
        if (empty($errors)) {

            // Xử lý hình ảnh
// Xử lý hình ảnh
$image = "no_image.png"; // mặc định nếu không upload
if (!empty($_FILES['image']['name'])) {
    $file = $_FILES['image'];

    // Kiểm tra lỗi upload
    if ($file['error'] === 0) {

        $uploadDir = "Uploads/Product/";
        // Tạo folder nếu chưa tồn tại
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                $errors['image'] = "Không tạo được thư mục Uploads/Product/";
            }
        }

        // Đặt tên file mới
        $image = time() . "_" . basename($file['name']);
        $uploadPath = $uploadDir . $image;

        // Di chuyển file từ tmp lên folder
        if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
            $errors['image'] = "Upload file thất bại, kiểm tra quyền thư mục!";
        }

    } else {
        // Nếu có lỗi upload
        $errors['image'] = "Upload file lỗi, code: " . $file['error'];
    }
}


            $status = $stock == 0 ? 0 : 1;

            $data = [
                'category_id' => $_POST['category_id'],
                'title' => $_POST['title'],
                'slug' => $slug,
                'stock' => $stock,
                'price' => $price,
                'discount_price' => $discount_price,
                'description' => $_POST['description'],
                'short_description' => $_POST['short_description'],
                'image' => $image,
                'status' => $status,
                'featured_id' => $_POST['featured_id'] ?? 0
            ];

            try {
                $this->productModel->create($data);
                $_SESSION['success'] = "Thêm sản phẩm thành công!";
                header("Location: admin.php?page=product");
                exit;
            } catch (PDOException $e) {
                $errors['db'] = "Lỗi lưu sản phẩm: " . $e->getMessage();
            }
        }
    }

    require "Views/Admin/Product/create.php";
}

    // EDIT PRODUCT
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_update = $_POST['id'] ?? null;

            if (empty($_POST['title']))
                $errors['title'] = "Tên sản phẩm không được để trống";
            if (empty($_POST['description']))
                $errors['description'] = "Mô tả không được để trống";
            if (empty($_POST['short_description']))
                $errors['short_description'] = "Mô tả ngắn không được để trống";
            if (empty($_POST['category_id']))
                $errors['category_id'] = "Danh mục không được để trống";

            $stock = isset($_POST['stock']) && $_POST['stock'] !== '' ? (int) $_POST['stock'] : 0;
            if ($stock < 0) {
                $errors['stock'] = "Số lượng tồn kho phải >= 0";
            }

            $discount_price = isset($_POST['discount_price']) && $_POST['discount_price'] !== '' ? (float) $_POST['discount_price'] : 0;
            if ($discount_price < 0) {
                $errors['discount_price'] = "Giá giảm phải >= 0";
            }

            $price = isset($_POST['price']) && $_POST['price'] !== '' ? (float) $_POST['price'] : 0;
            if ($price < 0) {
                $errors['price'] = "Giá phải >= 0";
            }

            $slug = !empty($_POST['slug']) ? $_POST['slug'] : $this->createSlug($_POST['title']);

            $slugErrors = $this->validateSlug($slug, $id_update);
            if (!empty($slugErrors)) {
                $errors['slug'] = implode(', ', $slugErrors);
            }

            if (!empty($_POST['title']) && $this->productModel->checkDuplicateTitle($_POST['title'], $id_update)) {
                $errors['title'] = "Tên sản phẩm đã tồn tại";
            }

            if (empty($errors)) {
                $image = $_POST['old_image'] ?? "no_image.png";

                if (!empty($_FILES['image']['name'])) {
                    $uploadDir = "Uploads/Product/";
                    if (!is_dir($uploadDir))
                        mkdir($uploadDir, 0755, true);

                    $newImage = time() . "_" . $_FILES['image']['name'];
                    $uploadFile = $uploadDir . $newImage;

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                        if (!empty($image) && $image !== "no_image.png" && file_exists($uploadDir . $image)) {
                            unlink($uploadDir . $image);
                        }
                        $image = $newImage;
                    }
                }

                $status = $stock == 0 ? 0 : 1;

                $data = [
                    'category_id' => $_POST['category_id'],
                    'title' => $_POST['title'],
                    'slug' => $slug,
                    'stock' => $_POST['stock'] ?? 0,
                    'price' => $_POST['price'],
                    'discount_price' => $_POST['discount_price'] ?? 0,
                    'description' => $_POST['description'],
                    'short_description' => $_POST['short_description'],
                    'image' => $image,
                    'status' => $status,
                    'featured_id' => $_POST['featured_id'] ?? 0
                ];

                try {
                    $this->productModel->updateProduct($id_update, $data);
                    $_SESSION['success'] = "Sửa sản phẩm thành công!";
                    header("Location: admin.php?page=product");
                    exit;
                } catch (PDOException $e) {
                    $errors['db'] = "Lỗi cập nhật sản phẩm: " . $e->getMessage();
                }
            }

        }

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

    // DELETE PRODUCT
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            try {
                $product = $this->productModel->getOne($id);

                // Thử xóa sản phẩm trước
                $this->productModel->deleteProduct($id);

                // Nếu xóa DB thành công, xóa ảnh
                if ($product && !empty($product['image']) && $product['image'] !== 'no_image.png') {
                    $filePath = 'Uploads/Product/' . $product['image'];
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }

                $_SESSION['success'] = "Xóa sản phẩm thành công!";
            } catch (PDOException $e) {
                $_SESSION['error'] = "Xóa sản phẩm thất bại! Sản phẩm có thể đang được sử dụng trong giỏ hàng.";
            }
        }

        header("Location: admin.php?page=product");
        exit;
    }



    // Hàm slug tự động thi ko nhập

    private function createSlug($string)
    {
        $slug = strtolower($string);
        $slug = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $slug);
        $slug = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $slug);
        $slug = preg_replace('/[iíìỉĩị]/u', 'i', $slug);
        $slug = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $slug);
        $slug = preg_replace('/[úùủũụưứừửữự]/u', 'u', $slug);
        $slug = preg_replace('/[ýỳỷỹỵ]/u', 'y', $slug);
        $slug = preg_replace('/đ/u', 'd', $slug);
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        $slug = trim($slug, '-');
        return $slug;
    }

    // hàm check slug đã tồn tại chưa
    private function validateSlug($slug, $productId = null)
    {
        $errors = [];

        if (empty($slug))
            $errors[] = "Slug không được để trống";
        if (!preg_match('/^[a-z0-9-]+$/', $slug))
            $errors[] = "Slug chỉ được chứa chữ thường, số và dấu '-'";
        if ($this->productModel->checkDuplicateSlug($slug, $productId))
            $errors[] = "Slug đã tồn tại, vui lòng nhập slug khác";

        return $errors;
    }
}
