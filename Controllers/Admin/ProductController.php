<?php
class ProductController {
    public function index() {
        include "Views/Admin/Product/index.php";
    }

    public function create() {
        include "Views/Admin/Product/create.php";
    }

    public function store() {
        include "Views/Admin/Product/edit.php";
    }
}
?>