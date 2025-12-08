<?php
require_once 'Models/Database.php';
require_once 'config.php';
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
ob_start();

require_once 'config.php';
require_once 'Models/Database.php';

$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
$connection = $db->connect();


$page = $_GET["page"] ?? "";
$action = $_GET["action"] ?? "";

$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
$connection = $db->connect();

require "Views/Admin/Layout/header.php";
switch ($page) {

    case "home":
        require "Controllers/Admin/HomeController.php";
        $homeControl = new HomeController($connection);
        $homeControl->index();
        break;

    case "category":
        require "Controllers/Admin/CategoryController.php";
        $categoryControl = new CategoryController($connection);
        switch ($action) {
            case "index":  $categoryControl->index();  break;
            case "create": $categoryControl->create(); break;
            case "edit":   $categoryControl->store();  break;
            default:       $categoryControl->index();  break;
        }
        break;

    case "user":
        require "Controllers/Admin/UserController.php";
        $userControl = new UserController();
        switch ($action) {
            case "index":   $userControl->index();   break;
            case "create":  $userControl->create();  break;
            case "edit":    $userControl->store();   break;
            case "profile": $userControl->profile(); break;
            default:        $userControl->index();   break;
        }
        break;

    case "product":
        require "Controllers/Admin/ProductController.php";
        $productControl = new ProductController($connection);
        switch ($action) {
            case "index":  $productControl->index();  break;
            case "create": $productControl->create(); break;
            case "edit":   $productControl->edit();  break;
            case "delete":   $productControl->delete();  break;
            default:       $productControl->index();  break;
        }
        break;

    case "order":
        require "Controllers/Admin/OrderController.php";
        $orderControl = new OrderController();
        switch ($action) {
            case "index":  $orderControl->index();  break;
            case "create": $orderControl->create(); break;
            case "edit":   $orderControl->store();  break;
            default:       $orderControl->index();  break;
        }
        break;
    case "blog":
        require "Controllers/Admin/BlogController.php";
        $blogControl = new BlogController($connection);
        switch ($action) {
            case "index":  $blogControl->index();  break;
            case "create": $blogControl->create(); break;
            case "store":  $blogControl->store();  break;
            case "edit":   $blogControl->edit();   break;
            case "update": $blogControl->update(); break;
            case "delete": $blogControl->delete(); break;
            default:       $blogControl->index();  break;
        }
        break;
    case "blogscomment":
        require "Controllers/Admin/BlogsCommentController.php";
        $blogscmControl = new BlogsCommentController();
        switch ($action) {
            case "index":  $blogscmControl->index();  break; 
            case "edit":   $blogscmControl->edit();  break;
              case "update": $blogscmControl->update(); break;  
        case "delete": $blogscmControl->delete(); break;
            default:       $blogscmControl->index();  break;
        }
        break;
    case "productscomment":
        require "Controllers/Admin/ProductsCommentController.php";
        $pcmControl = new ProductsCommentController();
        switch ($action) {
            case "index":  $pcmControl->index();  break;
            case "create": $pcmControl->create(); break;
            case "edit":   $pcmControl->store();  break;
            default:       $pcmControl->index();  break;
        }
        break;
    case "variant":
        require "Controllers/Admin/VariantController.php";
        $variantControl = new VariantController();
        switch ($action) {
            case "index":
                $variantControl->index();
                $variantControl->indexVariantId();
                break;
            case "create": $variantControl->create(); break;
            case "edit":   $variantControl->edit();   break;
        }
        break;
    default:
        require "Controllers/Admin/HomeController.php";
        $homeControl = new HomeController($connection);
        $homeControl->index();
        break;
}

require "Views/Admin/Layout/footer.php";

