<?php
require_once 'Models/ProductModel.php';
require_once 'Models/CategoryModel.php';


class ProductController
{
    private $productModel;
    private $categoryModel;
    public function __construct($connection)
    {
        $this->productModel = new productModel($connection);
        $this->categoryModel = new categoryModel($connection);

    }
    public function shop()
    {
        $categories = $this->categoryModel->getAll();
        $pages = $_GET['pages'] ?? 1;
        $limit = $_GET['limit'] ?? 10;
        $keyword = $_GET['keyword'] ?? '';
        $categoryId = $_GET['category_id'] ?? null;
        $optionId = $_GET['option_id'] ?? '';
        $current_page = isset($_GET['pages']) ? (int) $_GET['pages'] : 1;
        $sortBy = $_GET['sort_by'] ?? 'date';
        $sortOrder = $_GET['sort_order'] ?? 'desc';
        $urlPage = 'index.php?page=shop';

        $categoryIds = array_column($categories, 'id'); // lấy tất cả id category

        if ($categoryId && !in_array($categoryId, $categoryIds)) {
            header("Location: index.php?page=error");
            exit;
        }

        if ($keyword) {
            $urlPage .= '&keyword=' . $keyword;
        }
        if ($categoryId) {
            $urlPage .= '&category_id=' . $categoryId;
        }

        if ($sortBy != 'date') {
            $urlPage .= '&sort_by=' . $sortBy;
        }
        if ($sortOrder != 'desc') {
            $urlPage .= '&sort_order=' . $sortOrder;
        }

        $products = $this->productModel->getAllProducts(
            page: $pages,
            limit: $limit,
            keyword: $keyword,
            status: 1,
            categoryId: $categoryId,
            sortBy: $sortBy,
            sortOrder: $sortOrder
        );

        $totalPageProduct = $this->productModel->getTotalProductCount($limit, $categoryId, $keyword, 1);
        $categories = $this->categoryModel->getAll();

        $cateIdNu = $this->categoryModel->getCategoryByName('Nữ');
        $cateIdNam = $this->categoryModel->getCategoryByName('Nam');
        $cateIdGiay = $this->categoryModel->getCategoryByName('Giày');

        include "Views/Client/shop.php";
    }

    public function detail()
    {
        $slug = $_GET['slug'] ?? null;

        if (!$slug) {
            header('Location: index.php?page=shop');
            exit;
        }

        $product = $this->productModel->getProductBySlug($slug, 1);

        if (!$product) {
            echo "Lỗi: Không tìm thấy sản phẩm này.";
            exit;
        }

        $relatedProducts = $this->productModel->getAllProducts(1, 6, '', 1, $product['category_id']);

        $categories = $this->categoryModel->getAll();

        include "Views/Client/shop-single.php";
    }
}
