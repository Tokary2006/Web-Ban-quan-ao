<?php
class ProductsCommentController {
    public function index() {
        require "Views/Admin/ProductsComment/index.php";
    }

    public function create() {
        require "Views/Admin/ProductsComment/create.php";
    }
    public function store() {
        require "Views/Admin/ProductsComment/edit.php";
    }
}
?>