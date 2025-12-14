<?php
require_once 'Models/CartModel.php';
require_once 'Models/ProductModel.php';
class CartControlller
{
    private $cartModel;
    private $productModel;
    public function __construct($connection)
    {
        $this->cartModel = new cartModel($connection);
        $this->productModel = new ProductModel($connection);
    }

    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header("location: index.php?page=login");
            return;
        }

        $user_id = $_SESSION['user']['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['remove_item_id'])) {
                $this->handleRemoveAction();
            } elseif (isset($_POST['update_cart'])) {
                $this->handleUpdateAction();
            } elseif (isset($_POST['checkout'])) {
                $checkStock = $this->handleUpdateAction();

                if (!$checkStock) {
                    header("Location: index.php?page=cart");
                    exit;
                }

                header("Location: index.php?page=checkout");
                exit;
            }

            header("Location: index.php?page=cart");
            exit;
        }

        $carts = $this->cartModel->getAllCart($user_id);

        include 'Views/Client/cart.php';
    }

    public function addToCart()
    {
        if (!isset($_SESSION['user']) || !isset($_SESSION['user']['id'])) {
            $_SESSION['error'] = 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.';
            header("location: index.php?page=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("location: index.php?page=home");
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $product_id = $_POST['product_id'] ?? 0;
        $quantity = $_POST['quantity'] ?? 1;

        $product_id = (int) $product_id;
        $quantity = max(1, (int) $quantity);

        // Lấy stock sản phẩm
        $stock = $this->productModel->getProductStock($product_id);

        if ($quantity > $stock) {
            $_SESSION['error'] = "Chỉ còn $stock sản phẩm trong kho.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        if ($product_id <= 0) {
            $_SESSION['error'] = 'ID sản phẩm không hợp lệ.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        if ($this->cartModel->addToCart($user_id, $product_id, $quantity)) {
            $_SESSION['success'] = 'Sản phẩm đã được thêm vào giỏ hàng.';
        } else {
            $_SESSION['error'] = 'Không thể thêm sản phẩm vào giỏ hàng. Vui lòng thử lại.';
        }

        header("location: index.php?page=cart");
        exit;
    }

    /**
     * Xử lý hành động XÓA một mục khỏi giỏ hàng.
     */
    private function handleRemoveAction()
    {

        $cart_item_id = (int) $_POST['remove_item_id'];

        if ($this->cartModel->removeFromCart($cart_item_id)) {
            $_SESSION['success'] = 'Sản phẩm đã được xóa khỏi giỏ hàng.';
        } else {
            $_SESSION['error'] = 'Không thể xóa sản phẩm khỏi giỏ hàng.';
        }
    }

    /**
     * Xử lý hành động CẬP NHẬT số lượng các mục trong giỏ hàng.
     */
    private function handleUpdateAction()
    {
        $quantities = $_POST['quantity'] ?? [];
        $success_count = 0;

        foreach ($quantities as $cart_item_id => $new_quantity) {
            $cart_item_id = (int) $cart_item_id;
            $new_quantity = max(1, (int) $new_quantity);

            // Lấy product_id từ giỏ hàng
            $cart_item = $this->cartModel->getCartItemById($cart_item_id);
            if (!$cart_item)
                continue;

            $stock = $this->productModel->getProductStock($cart_item['product_id']);

            if ($new_quantity > $stock) {
                $_SESSION['error'] =
                    "Sản phẩm '{$cart_item['title']}' chỉ còn $stock trong kho.";
                $new_quantity = $stock;
                return false;
            }

            $this->cartModel->updateQuantity($cart_item_id, $new_quantity);
            $success_count++;
        }


        if ($success_count > 0) {
            $_SESSION['success'] = "Đã cập nhật $success_count mục trong giỏ hàng.";
            return true;
        } else {
            $_SESSION['error'] = 'Không có mục nào được cập nhật.';
        }
    }
}