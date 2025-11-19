<?php
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