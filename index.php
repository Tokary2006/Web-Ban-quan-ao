<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require_once 'config.php';
require_once 'Models/Database.php';

// Tạo object Database
$database = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

// Lấy PDO connection
$connection = $database->connect();

require_once 'router.php'; 

$page = $_GET['page'] ?? '';

require "Views/Client/Layouts/header.php";

switch ($page) {
    case "shop":
        include "Views/Client/shop.php";
        break;
    case "contact":
        include "Views/Client/contact.php";
        break;
    case "cart":
        include "Views/Client/cart.php";
        break;
    case "shop-single":
        include "Views/Client/shop-single.php";
        break;
    case "checkout":
        include "Views/Client/checkout.php";
        break;
    default:
        include "Views/Client/index.php";
        break;
}


require "Views/Client/Layouts/footer.php";
// Ngắt kết nối
$database->disconnect();
