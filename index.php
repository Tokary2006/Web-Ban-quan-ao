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
        include "Views/Client/cart.php";
        break;
    case "checkout":
        include "Views/Client/checkout.php";
        break;
    case "blog":
        include "Views/Client/blog.php";
        break;
    case "blog-single":
        include "Views/Client/blog-single.php";
        break;
    case "register":
        include "Views/Client/register.php";
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
    case "account":
        include "Views/Client/account.php";
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