<?php
    require_once 'Models/CategoryModel.php';


    class CategoryController {
        private $categoryModel;

        public function __construct($connection) {
            $this->categoryModel = new CategoryModel($connection);
        }

        public function index() {
            $categories = $this->categoryModel->getAllCategory();

            require "Views/Admin/Category/index.php";
        }

    // Xử lý cả hiển thị form TẠO MỚI (GET) và LƯU dữ liệu TẠO MỚI (POST)
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Đây là phần xử lý LƯU DỮ LIỆU TẠO MỚI
            $data = [
                'parent_id' => ($_POST['parent_id'] === '' ? null : $_POST['parent_id']),
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
                'slug' => $_POST['slug'] ?? '',
                'status' => $_POST['status'] ?? 1
            ];
            $this->categoryModel->create($data); // <--- CHỈ TẠO MỚI
            header("Location: admin.php?page=category");
            exit;
        }
        
        // Đây là phần hiển thị form (GET)
        require "Views/Admin/Category/create.php";
    }

    // Xử lý cả hiển thị form CHỈNH SỬA (GET) và LƯU dữ liệu CHỈNH SỬA (POST)
    public function edit() {
        $id = $_GET['id'] ?? null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Đây là phần xử lý LƯU DỮ LIỆU CẬP NHẬT
            $id_update = $_POST['id'] ?? null; // Lấy ID từ form hidden
            if ($id_update) {
                $data = [
                    'parent_id' => ($_POST['parent_id'] === '' ? null : $_POST['parent_id']),
                    'name' => $_POST['name'] ?? '',
                    'description' => $_POST['description'] ?? '',
                    'slug' => $_POST['slug'] ?? '',
                    'status' => $_POST['status'] ?? 1
                ];
                $this->categoryModel->store($id_update, $data); 
            }
            header("Location: admin.php?page=category");
            exit;
        }

        // Đây là phần hiển thị form (GET)
        if ($id) {
            $category = $this->categoryModel->getOneCategory($id); 
            if ($category) {
                require "Views/Admin/Category/edit.php";
                return;
            }
        }
        
        // Nếu không có ID hoặc không tìm thấy khi là GET request
        header("Location: admin.php?page=category");
        exit;
    }
    }