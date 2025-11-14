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
    default:
        require "Controllers/Admin/HomeController.php";
        $homeControl = new HomeController();
        $homeControl->index();
        break;
}
require "Views/Admin/Layout/footer.php";
