<?php
require_once 'Models/Product.php';
$productModel = new Product($connection);

$product = $productModel->getAllProducts(1, 10,'Máy ảnh',1);
