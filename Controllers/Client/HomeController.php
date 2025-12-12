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

    public function index(){
        $products = $this->productModel->getAllProducts(1,6,'',1);
        $featuredProducts = $this->productModel->getAllProducts(1,6,'',1,null,1);
        $cateIdNu = $this->categoryModel->getCategoryByName('Nữ');
        $cateIdNam = $this->categoryModel->getCategoryByName('Nam');
        $cateIdGiay = $this->categoryModel->getCategoryByName('Giày');
        include "Views/Client/index.php";
    }
}