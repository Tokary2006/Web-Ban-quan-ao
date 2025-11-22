<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$page = isset($_GET["page"]) ? $_GET["page"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "";

require "Views/Admin/Layout/header.php";
switch ($page) {
    case "home":
        require "Controllers/Admin/HomeController.php";
        $homeControl = new HomeController();
        $homeControl->index();
        break;

    case "category":
        require "Controllers/Admin/CategoryController.php";
        $categoryControl = new CategoryController();
        switch ($action) {
            case "index":
                $categoryControl->index();
                break;
            case "create":
                $categoryControl->create();
                break;
            case "edit":
                $categoryControl->store();
                break;
            default:
                $categoryControl->index();
                break;
        }
        break;
   
    case "user":
        require "Controllers/Admin/UserController.php";
        $userControl = new UserController();
        switch ($action) {
            case "index":
                $userControl->index();
                break;
            case "create":
                $userControl->create();
                break;
            case "edit":
                $userControl->store();
                break;
            default:
                $userControl->index();
                break;
        }
        break;

    case "product":
        require "Controllers/Admin/ProductController.php";
        $productControl = new ProductController();
        switch ($action) {
            case "index":
                $productControl->index();
                break;
            case "create":
                $productControl->create();
                break;
            case "edit":
                $productControl->store();
                break;
            default:
                $productControl->index();
                break;
        }
        break;

        case "order":
            require "Controllers/Admin/OrderController.php";
            $orderControl = new OrderController();
            switch ($action) {
                case "index":
                    $orderControl->index();
                    break;
                case "create":
                    $orderControl->create();
                    break;
                case "edit":
                    $orderControl->store();
                    break;
                default:
                    $orderControl->index();
                    break;
            }
            break;
            case "blogs":
                require "Controllers/Admin/BlogsCommentController.php";
                $blogscmControl = new BlogsCommentController();
                switch ($action) {
                    case "index":
                        $blogscmControl->index();
                        break;
                    case "create":
                        $blogscmControl->create();
                        break;
                    case "edit":
                        $blogscmControl->store();
                        break;
                    default:
                        $blogsControl->index();
                        break;
                }
                break;
    default:
        require "Controllers/Admin/HomeController.php";
        $homeControl = new HomeController();
        $homeControl->index();
        break;
}
require "Views/Admin/Layout/footer.php";
