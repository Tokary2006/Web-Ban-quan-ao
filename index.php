<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
session_start();
require_once 'config.php';
require_once 'Models/Database.php';

// Tạo object Database
$database = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

// Lấy PDO connection
$connection = $database->connect();

$page = $_GET['page'] ?? 'home';

require "Views/Client/Layouts/header.php";

switch ($page) {
    case 'shop':
        require_once 'Controllers/Client/ShopController.php';
        $controller = new ProductController($connection);
        $controller->shop();
        break;
    case "shop-single":
        require_once 'Controllers/Client/ShopController.php';
        $controller = new ProductController($connection);
        $controller->detail();
        break;
    case "contact":
        include "Views/Client/contact.php";
        break;
    case "about":
        include "Views/Client/about.php";
        break;
    case "cart":
        require_once 'Controllers/Client/CartController.php';
        $cartcontroller = new CartControlller($connection);
        $cartcontroller->index();
        break;
    case "add-to-cart":
        require_once 'Controllers/Client/CartController.php';
        $cartcontroller = new CartControlller($connection);
        $cartcontroller->addToCart();
        break;
    case "blog":
        require_once 'Controllers/Client/BlogController.php';
        $blogControl = new BlogController($connection);
        $blogControl->blog();
        break;
    case "blog-single":
        require_once 'Controllers/Client/BlogController.php';
        $blogControl = new BlogController($connection);
        $blogControl->blog_detail();
        break;
    case "register":
        require_once 'Controllers/Client/AuthController.php';
        $authController = new AuthControlller($connection);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $authController->handleRegister();
        } else {
            $authController->register();
        }

        break;
    case "login":
        require_once 'Controllers/Client/AuthController.php';
        $authController = new AuthControlller($connection);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $authController->handleLogin();
        } else {
            $authController->login();
        }

        break;
    case 'logout':
        unset($_SESSION['user']);
        $_SESSION["success"] = "Bạn đã đăng xuất thành công!";
        header('Location: index.php?page=home');
        break;
    case "profile":
        require_once 'Controllers/Client/ProfileController.php';
        $controller = new ProfileController($connection);
        $controller->index();
        break;

    case "update-profile":
        require_once 'Controllers/Client/ProfileController.php';
        $controller = new ProfileController($connection);
        $controller->updateInfo();
        break;

    case "change-password":
        require_once 'Controllers/Client/ProfileController.php';
        $controller = new ProfileController($connection);
        $controller->changePassword();
        break;

    case "address-add":
        require_once 'Controllers/Client/ProfileController.php';
        $controller = new ProfileController($connection);
        $controller->addAddress();
        break;
    case "update-address":
        require_once 'Controllers/Client/ProfileController.php';
        $controller = new ProfileController($connection);
        $controller->updateAddress();
        break;
    case "delete-address":
        require_once 'Controllers/Client/ProfileController.php';
        $controller = new ProfileController($connection);
        $controller->deleteAddress();
        break;
    case "confirm-received":
        require_once 'Controllers/Client/ProfileController.php';
        $controller = new ProfileController($connection);
        $controller->confirmReceived();
        break;
    case "order-detail":
        require_once 'Controllers/Client/ProfileController.php';
        $controller = new ProfileController($connection);
        $controller->orderDetail();
        break;
    case "checkout":
        require_once 'Controllers/Client/CheckoutController.php';
        $controller = new CheckoutController($connection);
        $controller->index();
        break;
    case "place-order":
        require_once 'Controllers/Client/CheckoutController.php';
        $controller = new CheckoutController($connection);
        $controller->placeOrder();
        break;
    case "thankyou":
        require_once 'Controllers/Client/CheckoutController.php';
        $controller = new CheckoutController($connection);
        $controller->thankyou();
        break;
    case "add-comment":
        require_once 'Controllers/Client/CommentProductController.php';
        $controller = new CommentProductController($connection);
        $controller->addComment();
        break;
    case "error":
        include "Views/Client/error_404.php";
        break;
    case "home":
        require_once 'Controllers/Client/HomeController.php';
        $controller = new ProductController($connection);
        $controller->index();
        break;
}


require "Views/Client/Layouts/footer.php";

// Ngắt kết nối
$database->disconnect();